<template>
    <div class="flex flex-col items-center justify-center rounded" v-if="series[0].data.length > 0">
        <div class="min-w-full flex justify-between">
            <p class="text-2xl font-bold">New Users</p>
        </div>
        <apexchart class="hidden md:hidden xl:block" width="900" height="340" type="area" :options="options"
            :series="series"></apexchart>
        <apexchart class="hidden md:block xl:hidden" width="650" height="340" type="area" :options="options"
            :series="series"></apexchart>
        <apexchart class="visible sm:hidden" width="340" height="340" type="area" :options="options" :series="series">
        </apexchart>
    </div>
    <div v-else>
        NO DATA
    </div>
</template>

<script>
import axios from 'axios';
export default {
    props: {
        startDate: {
            required: true,
        },
        endDate: {
            required: true,
        },
    },
    data() {
        return {
            series: [
                {
                    name: "New users",
                    data: [],
                    color: "#1A56DB",
                }
            ],
            options: {
                chart: {
                    fontFamily: "Inter, sans-serif",
                    toolbar: {
                        show: false,
                    },
                },
                xaxis: {
                    labels: {
                        show: true,
                        style: {
                            fontFamily: "Inter, sans-serif",
                            cssClass: 'text-xs font-normal fill-gray-500'
                        }
                    },
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                },
                yaxis: {
                    show: false,
                },
                dataLabels: {
                    enabled: false,
                },
            }
        };
    },
    watch: {
        startDate() {
            this.fetchData(); // Fetch data when filterType changes
        },
    },
    methods: {
        formatDate(dateString) {
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            const date = new Date(dateString);
            const day = String(date.getDate()).padStart(2, '0'); // Día con dos dígitos
            const month = months[date.getMonth()]; // Obtener nombre del mes
            const year = String(date.getFullYear()).slice(-2); // Obtener los últimos dos dígitos del año
            return `${day} ${month} ${year}`;
        },
        async fetchData() {
            this.loading = true;
            axios.get("/api/followers/show/date-range?start_date=" + this.startDate + "&end_date=" + this.endDate + "",{
                headers: {
                    'Authorization': `Bearer ${process.env.API_SECRET_TOKEN}`
                }
            })
                .then(response => {
                    let followersByDate = [];
                    response.data.forEach(follower => {
                        follower.follower_stats.forEach(stat => {
                            const formattedDate = this.formatDate(stat.date_followed);
                            if (followersByDate[formattedDate]) {
                                followersByDate[formattedDate] += 1;
                            } else {
                                followersByDate[formattedDate] = 1;
                            }
                        });
                    });
                    const sortedDates = Object.keys(followersByDate).sort((a, b) => new Date(a).getTime() - new Date(b).getTime());
                    this.series[0].data = sortedDates.map(date => ({
                        x: date,
                        y: followersByDate[date]
                    }));
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    this.loading = false;
                });
        }
    },
    mounted() {
        // Fetch data initially
        if (this.startDate != undefined) this.fetchData();
    }
};
</script>

<style scoped>
/* Puedes agregar estilos personalizados aquí si es necesario */
</style>