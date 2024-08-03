<template>
    <div class="min-h-100 flex flex-col items-center justify-center rounded">
        <h5 class="text-2xl font-bold mb-2">Website traffic</h5>
        <div class="flex-grow">
            <apexchart width="400" height="360" type="donut" :options="options" :series="series"></apexchart>
        </div>
    </div>
</template>

<script>
export default {
    props: {},
    data() {
        return {
            series: [35.1, 23.5, 2.4, 5.4],
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
                                    label: "Unique visitors",
                                    fontFamily: "Inter, sans-serif",
                                    formatter: function (w) {
                                        const sum = w.globals.seriesTotals.reduce((a, b) => {
                                            return a + b
                                        }, 0)
                                        return '$' + sum + 'k'
                                    },
                                },
                                value: {
                                    show: true,
                                    fontFamily: "Inter, sans-serif",
                                    offsetY: -20,
                                    formatter: function (value) {
                                        return value + "k"
                                    },
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
                labels: ["Direct", "Sponsor", "Affiliate", "Email marketing"],
                dataLabels: {
                    enabled: false,
                },
                legend: {
                    position: "bottom",
                    fontFamily: "Inter, sans-serif",
                },
                yaxis: {
                    labels: {
                        formatter: function (value) {
                            return value + "k"
                        },
                    },
                },
                xaxis: {
                    labels: {
                        formatter: function (value) {
                            return value + "k"
                        },
                    },
                    axisTicks: {
                        show: false,
                    },
                    axisBorder: {
                        show: false,
                    },
                },
            }
        };
    }
};
</script>

<style scoped>
/* Puedes agregar estilos personalizados aquí si es necesario */
</style>