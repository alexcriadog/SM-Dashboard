<template>
    <div class="flex flex-col items-center justify-center rounded">
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
        <apexchart class="hidden sm:block" width="900" height="340" type="area" :options="options" :series="series"></apexchart>
        <apexchart class="visible sm:hidden" width="340" height="340" type="area" :options="options" :series="series"></apexchart>
    </div>
</template>

<script>
export default {
    props: {},
    data() {
        return {
            series: [
                {
                    name: "New users",
                    data: [30, 40, 45, 50, 49, 60, 70],
                    color: "#1A56DB",
                },
                {
                    name: "New users2",
                    data: [21, 32, 43, 54, 90, 34, 70],
                    color: "#F05252",
                },
            ],
            options: {
                chart: {
                    fontFamily: "Inter, sans-serif",
                    toolbar: {
                        show: false,
                    },
                },
                xaxis: {
                    categories: ['01 Feb', '02 Feb', '03 Feb', '04 Feb', '05 Feb', '06 Feb', '07 Feb']
                },
                yaxis: {
                    show: false,
                },
                dataLabels: {
                    enabled: false,
                },
            }
        };
    }
};
</script>

<style scoped>
/* Puedes agregar estilos personalizados aquí si es necesario */
</style>