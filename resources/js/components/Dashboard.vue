<template>
    <div class="p-4 bg-teal-600/10">
        <div class="border-gray-200 rounded-lg mt-20">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4">
                <div style="height: 390px" class="grid grid-cols-2 rounded-lg drop-shadow-xl">
                    <indicator v-for="(card, index) in cards" :key="index" :title="card.title" :content="card.content"
                        :icon="card.icon" :color="card.color" />
                </div>
                <div style="height: 390px" class="flex items-center justify-center rounded-lg bg-white drop-shadow-xl">
                    <list-chart></list-chart>
                </div>
                <div style="height: 390px" class="flex items-center justify-center rounded-lg bg-white drop-shadow-xl">
                    <radial-chart></radial-chart>
                </div>
            </div>
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-4 mb-4">
                <div style="height: 390px"
                    class="flex items-center justify-center rounded-lg bg-white drop-shadow-xl">
                    <sm-table></sm-table>
                </div>
                <div style="height: 390px"
                    class="flex items-center justify-center rounded-lg bg-white drop-shadow-xl">
                    <line-chart></line-chart>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            cards: [
                {
                    title: "Usuarios Activos",
                    content: "2,400",
                    icon: "fa-users",
                    color: "bg-red-400",
                },
                {
                    title: "Nuevas Ventas",
                    content: "$12,400",
                    icon: "fa-dollar-sign",
                    color: "bg-blue-400",
                },
                {
                    title: "Nuevos Mensajes",
                    content: "14",
                    icon: "fa-envelope",
                    color: "bg-green-400",
                },
                {
                    title: "Tareas Pendientes",
                    content: "5",
                    icon: "fa-tasks",
                    color: "bg-yellow-400",
                },
            ],
        };
    },
};
</script>

<style scoped>
/* Puedes agregar estilos personalizados aquí si es necesario */
</style>