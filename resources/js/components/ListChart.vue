<template>
    <div class="flex flex-col items-center justify-center" v-if="series[0].data.length > 0">
        <div class="min-w-full flex justify-between">
            <p class="text-2xl font-bold">Countries</p>
        </div>
        <apexchart class="hidden sm:block" width="500" height="340" type="bar" :options="options" :series="series">
        </apexchart>
        <apexchart class="visible sm:hidden" width="340" height="340" type="bar" :options="options" :series="series">
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
                    name: "Country",
                    data: [],
                    color: "#F05252",
                }
            ],
            options: {
                chart: {
                    sparkline: {
                        enabled: false,
                    },
                    type: "bar",
                    width: "100%",
                    height: 400,
                    toolbar: {
                        show: false,
                    }
                },
                fill: {
                    opacity: 1,
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                        columnWidth: "100%",
                        borderRadiusApplication: "end",
                        borderRadius: 6,
                        dataLabels: {
                            position: "top",
                        },
                    },
                },
                legend: {
                    show: true,
                    position: "bottom",
                },
                dataLabels: {
                    enabled: false,
                },
                tooltip: {
                    shared: true,
                    intersect: false,
                    formatter: function (value) {
                        return "$" + value
                    }
                },
                xaxis: {
                    labels: {
                        show: true,
                        style: {
                            fontFamily: "Inter, sans-serif",
                            cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                        }
                    },
                    categories: [],
                    axisTicks: {
                        show: false,
                    },
                    axisBorder: {
                        show: false,
                    },
                },
                yaxis: {
                    labels: {
                        show: true,
                        style: {
                            fontFamily: "Inter, sans-serif",
                            cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                        }
                    }
                },
                grid: {
                    show: true,
                    strokeDashArray: 4,
                    padding: {
                        left: 2,
                        right: 2,
                        top: -20
                    },
                },
                fill: {
                    opacity: 1,
                }
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
            axios.get("/api/followers/calculate/count-by-group?group_by=country&start_date=" + this.startDate + "&end_date=" + this.endDate + "")
                .then(response => {
                    this.options.xaxis.categories = Object.keys(response.data.data);
                    this.series[0].data = Object.values(response.data.data);
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