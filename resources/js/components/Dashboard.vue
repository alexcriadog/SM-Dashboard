<template>
    <div class="p-4 bg-blue-50">
        <div class="border-gray-200 rounded-lg mt-20">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4">
                <div style="height: 390px" class="grid grid-cols-2 rounded-lg drop-shadow-xl">
                    <indicator v-for="(card, index) in cards" :key="index" :title="card.title" :content="card.content"
                        :icon="card.icon" :color="card.color" :url="card.url" />
                </div>
                <div style="height: 390px" class="flex items-center justify-center rounded-lg bg-white drop-shadow-xl">
                    <list-chart :startDate="startDate" :endDate="endDate"></list-chart>
                </div>
                <div style="height: 390px" class="flex items-center justify-center rounded-lg bg-white drop-shadow-xl">
                    <radial-chart :startDate="startDate" :endDate="endDate"></radial-chart>
                </div>
            </div>
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-4 mb-4">
                <div style="height: 390px" class="flex items-center justify-center rounded-lg bg-white drop-shadow-xl">
                    <sm-table :startDate="startDate" :endDate="endDate"></sm-table>
                </div>
                <div style="height: 390px" class="flex items-center justify-center rounded-lg bg-white drop-shadow-xl">
                    <line-chart :startDate="startDate" :endDate="endDate"></line-chart>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    props: {
        selectedPeriod: {
            type: Object,
            required: true,
        }
    },
    watch: {
        selectedPeriod() {
            this.getDateRange(); // Fetch data when filterType changes
        }
    },
    computed: {
    },
    data() {
        return {
            startDate: null,
            endDate: null,
            cards: [
                {
                    title: "Comments",
                    icon: "fa-users",
                    color: "text-red-600",
                    content: null,
                },
                {
                    title: "Likes",
                    icon: "fa-dollar-sign",
                    color: "text-blue-600",
                    content: null,
                },
                {
                    title: "New Followers",
                    icon: "fa-envelope",
                    color: "text-green-600",
                    content: null,
                },
                {
                    title: "Interaction Rate",
                    icon: "fa-tasks",
                    color: "text-yellow-600",
                    content: null,
                },
            ],
        };
    },
    methods: {
        getDateRange() {
            const now = new Date();
            let startDate, endDate;

            switch (this.selectedPeriod.code) {
                case '7':
                    // Last 7 days including today
                    startDate = new Date(now);
                    startDate.setDate(startDate.getDate() - 6); // 6 days ago from today
                    endDate = new Date(now); // Today
                    break;

                case '14':
                    // Last 14 days including today
                    startDate = new Date(now);
                    startDate.setDate(startDate.getDate() - 13); // 13 days ago from today
                    endDate = new Date(now); // Today
                    break;

                case '30':
                    // Last 30 days including today
                    startDate = new Date(now);
                    startDate.setDate(startDate.getDate() - 29); // 29 days ago from today
                    endDate = new Date(now); // Today
                    break;

                case '365':
                    // Last 365 days including today
                    startDate = new Date(now);
                    startDate.setDate(startDate.getDate() - 364); // 364 days ago from today
                    endDate = new Date(now); // Today
                    break;

                default:
                    throw new Error('Invalid period');
            }

            // Reset hours, minutes, seconds, and milliseconds to 00:00:00 for startDate
            startDate.setHours(0, 0, 0, 0);

            // Set endDate to the end of the day
            endDate.setHours(23, 59, 59, 999);

            // Update component's data properties
            this.startDate = startDate.toISOString().split('T')[0];
            this.endDate = endDate.toISOString().split('T')[0];

            // Fetch data from the API with the updated date range
            this.fetchData();
        },
        async fetchData() {
            axios.get("/api/combined-data?start_date=" + this.startDate + "&end_date=" + this.endDate + "", {
                headers: {
                    'Authorization': `Bearer ${process.env.API_SECRET_TOKEN}`
                }
            })
                .then(response => {
                    this.cards[0].content = response.data.total_comments;
                    this.cards[1].content = response.data.total_likes;
                    this.cards[2].content = response.data.total_followers;
                    this.cards[3].content = response.data.interaction_rate;
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }
    },
    mounted() {
        this.getDateRange();
    }
};
</script>

<style scoped>
/* Puedes agregar estilos personalizados aquí si es necesario */
</style>