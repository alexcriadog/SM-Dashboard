<template>
    <div class="flex flex-col items-center justify-center">
        <div class="min-w-full flex justify-between">
            <p class="text-2xl font-bold">Users this week</p>
            <div class="flex justify-center items-center">
                <h5 class="leading-none text-2xl font-semibold text-gray-900pb-2 mr-2">32.4k</h5>
                <div class="flex justify-center items-center text-base font-semibold text-green-500">
                    <span class="">12%</span>
                    <svg class="w-3 h-3 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13V1m0 0L1 5m4-4 4 4" />
                    </svg>
                </div>
            </div>
        </div>
        <apexchart class="hidden sm:block" width="500" height="340" type="bar" :options="options" :series="series">
        </apexchart>
        <apexchart class="visible sm:hidden" width="340" height="340" type="bar" :options="options" :series="series">
        </apexchart>
    </div>
</template>

<script>
export default {
    props: {},
    data() {
        return {
            series: [
                    {
                        name: "Income",
                        color: "#31C48D",
                        data: ["1420", "1620", "620"],
                    },
                    {
                        name: "Expense",
                        data: ["788", "810", "1366"],
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
                        },
                        formatter: function (value) {
                            return "$" + value
                        }
                    },
                    categories: ["Jul", "Aug", "Sept"],
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
    }
};
</script>

<style scoped>
/* Puedes agregar estilos personalizados aquí si es necesario */
</style>