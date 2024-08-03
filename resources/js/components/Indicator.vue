<template>
    <div class="flex items-center justify-center rounded">
        <div :class="`rounded-2xl shadow-md h-40 w-40 sm:w-64 p-4 ${color} flex items-center justify-center`">
            <div class="flex items-center">
                <font-awesome-icon :icon="icon" class="text-black-100 text-2xl" />
                <div class="ml-4">
                    <h2 class="text-sm font-semibold text-black-100">{{ title }}</h2>
                    <p class="text-2xl font-bold text-black-100">{{ content }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            required: true,
        },
        content: {
            type: String,
            required: true,
        },
        icon: {
            type: String,
            required: true,
        },
        color: {
            type: String,
            required: true,
        },
    },
};
</script>

<style scoped>
/* Puedes agregar estilos personalizados aquí si es necesario */
</style>