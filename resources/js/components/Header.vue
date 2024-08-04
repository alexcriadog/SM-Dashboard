<template>
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <img src="./../../images/camaleonics.jpg" class="h-12 me-3" alt="Camaleonic Analytics Logo" />
                    <div class="flex flex-col">
                        <span class="text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Welcome
                            to Dashboard!</span>
                        <span class="text-md sm:text-sm whitespace-nowrap dark:text-white">Current
                            Date</span>
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

        };
    },
};
</script>

<style scoped>
/* Puedes agregar estilos personalizados aquí si es necesario */
</style>