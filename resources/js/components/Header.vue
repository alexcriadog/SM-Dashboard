<template>
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <img src="./../../images/camaleonics.jpg" class="h-12 me-3" alt="Camaleonic Analytics Logo" />
                    <div class="flex items-center">
                        <span
                            class="text-xl font-semibold hidden sm:block sm:mr-4 sm:text-2xl whitespace-nowrap dark:text-white">Welcome
                            to Dashboard!</span>
                        <Select v-model="selectedPeriod" @change="periodChanged" optionLabel="name" :options="periods"
                            class="w-full md:w-56" />
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ms-3">
                        <img class="w-12 h-12 rounded-full sm:mr-2"
                            src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                        <span class="hidden sm:block font-semibold">Alex criado</span>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    data() {
        return {
            selectedPeriod: { name: 'Last week', code: '7' },
            periods: [
                { name: 'Last week', code: '7' },
                { name: 'Last two weeks', code: '14' },
                { name: 'Last 30 days', code: '30' },
                { name: 'Last 365 days', code: '365' }
            ]
        };
    },
    methods: {
        periodChanged() {
            this.$emit('periods', this.selectedPeriod);
        }
    }
};
</script>

<style scoped>
/* Puedes agregar estilos personalizados aquí si es necesario */
</style>