<template>
    <div class="min-h-100 flex flex-col items-center justify-center rounded" v-if="series.length > 0">
        <h5 class="text-2xl font-bold mb-2">Gender</h5>
        <div class="flex-grow">
            <apexchart width="400" height="360" type="donut" :options="options" :series="series"></apexchart>
        </div>
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
            series: [],
            options: {
                colors: ["#1C64F2", "#16BDCA", "#FDBA8C", "#E74694"],
                chart: {
                    height: 250,
                    width: "100%",
                    type: "donut",
                },
                stroke: {
                    colors: ["transparent"],
                    lineCap: "",
                },
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                name: {
                                    show: true,
                                    fontFamily: "Inter, sans-serif",
                                    offsetY: 20,
                                },
                                total: {
                                    showAlways: true,
                                    show: true,
                                    label: "Total",
                                    fontFamily: "Inter, sans-serif"
                                },
                                value: {
                                    show: true,
                                    fontFamily: "Inter, sans-serif",
                                    offsetY: -20
                                },
                            },
                            size: "80%",
                        },
                    },
                },
                grid: {
                    padding: {
                        top: -2,
                    },
                },
                labels: [],
                dataLabels: {
                    enabled: false,
                },
                legend: {
                    position: "bottom",
                    fontFamily: "Inter, sans-serif",
                },
                yaxis: {
                },
                xaxis: {
                    axisTicks: {
                        show: false,
                    },
                    axisBorder: {
                        show: false,
                    },
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
        async fetchData() {
            axios.get("/api/followers/calculate/count-by-group?group_by=gender&start_date=" + this.startDate + "&end_date=" + this.endDate + "",{
                headers: {
                    'Authorization': `Bearer ${process.env.API_SECRET_TOKEN}`
                }
            })
                .then(response => {
                    this.options.labels = Object.keys(response.data.data);
                    this.series = Object.values(response.data.data);
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }
    },
    mounted() {
        console.log('mounted.fetchData.url', this.startDate);
        // Fetch data initially
        if (this.startDate != undefined) this.fetchData();
    }
};
</script>

<style scoped>
/* Puedes agregar estilos personalizados aquí si es necesario */
</style>