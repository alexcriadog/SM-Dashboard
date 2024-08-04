<template>
    <div class="w-100 flex justify-center items-center">
        <div class="flex flex-col rounded-2xl bg-white px-4 py-8 text-center h-40 w-40 sm:w-64 ">
            <dt class="order-last text-lg font-medium text-gray-500">{{ title }}</dt>
    
            <dd :class="`text-4xl font-extrabold ${color} md:text-5xl`">{{ data }}</dd>
        </div>
    </div>

    <!--  <div :class="`rounded-2xl shadow-md h-40 w-40 sm:w-64 p-4 ${color} flex items-center justify-center`">
            <div class="flex items-center">
                <font-awesome-icon :icon="icon" class="text-black-100 text-2xl" />
                <div class="ml-4">
                    <h2 class="text-sm font-semibold text-black-100">{{ title }}</h2>
                    <p class="text-2xl font-bold text-black-100">{{ data }}</p>
                </div>
            </div>
        </div> 
    </div> -->
</template>

<script>

export default {
    props: {
        title: {
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
        content: {
            required: true,
        },
    },
    data() {
        return {
            data: null
        };
    },
    watch: {
        content() {
            this.data = this.content;
        }
    },
    methods: {

    },
    mounted() {

    }
};
</script>

<style scoped>
/* Puedes agregar estilos personalizados aquí si es necesario */
</style>