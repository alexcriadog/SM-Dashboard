<template>
    <div class="flex flex-col items-center justify-between" v-if="followers.length > 0">
        <p class="text-2xl font-bold self-start justify-self-start">Table</p>
        <DataTable :loading="loading" dataKey="id" :value="followers" sortMode="multiple" paginator :rows="3"
            class="visible sm:hidden min-w-full flex-grow">
            <Column field="name" header="Name">
                <template #body="{ data }">
                    {{ data.name }}
                </template>
            </Column>
            <Column field="follower_stats" sortable header="Likes">
                <template #body="slotProps">
                    {{ slotProps.data.follower_stats[0].likes }}
                </template>
            </Column>
            <Column field="follower_stats" sortable header="Comments">
                <template #body="slotProps">
                    {{ slotProps.data.follower_stats[0].comments }}
                </template>
            </Column>
        </DataTable>
        <DataTable :loading="loading" dataKey="id" :value="followers" sortMode="multiple" paginator :rows="5"
            class="hidden md:hidden xl:block min-w-full">
            <Column field="name" header="Name">
                <template #body="{ data }">
                    {{ data.name }}
                </template>
            </Column>
            <Column field="country" sortable header="Country"></Column>
            <Column field="email" sortable header="Email"></Column>
            <Column field="followers_count" sortable header="Followers"></Column>
            <Column field="follower_stats" sortable header="Likes">
                <template #body="slotProps">
                    {{ slotProps.data.follower_stats[0].likes }}
                </template>
            </Column>
            <Column field="follower_stats" sortable header="Comments">
                <template #body="slotProps">
                    {{ slotProps.data.follower_stats[0].comments }}
                </template>
            </Column>
        </DataTable>
        <DataTable :loading="loading" dataKey="id" :value="followers" sortMode="multiple" paginator :rows="3"
            class="hidden md:block xl:hidden min-w-full">
            <Column field="name" header="Name">
                <template #body="{ data }">
                    {{ data.name }}
                </template>
            </Column>
            <Column field="country" sortable header="Country"></Column>
            <Column field="followers_count" sortable header="Followers"></Column>
            <Column field="follower_stats" sortable header="Likes">
                <template #body="slotProps">
                    {{ slotProps.data.follower_stats[0].likes }}
                </template>
            </Column>
            <Column field="follower_stats" sortable header="Comments">
                <template #body="slotProps">
                    {{ slotProps.data.follower_stats[0].comments }}
                </template>
            </Column>
        </DataTable>
    </div>
    <div v-else>
        NO DATA
    </div>
</template>

<script>
import axios from 'axios';
import { FilterMatchMode } from '@primevue/core/api';
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
            loading: false,
            followers: [],
            filters: {
                name: { value: null, matchMode: FilterMatchMode.CONTAINS },
            },
        };
    },
    watch: {
        startDate() {
            this.fetchData(); // Fetch data when filterType changes
        },
    },
    methods: {
        async fetchData() {
            this.loading = true;
            axios.get("/api/followers/show/date-range?start_date=" + this.startDate + "&end_date=" + this.endDate + "",{
                headers: {
                    'Authorization': `Bearer ${process.env.API_SECRET_TOKEN}`
                }
            })
                .then(response => {
                    console.log(response);
                    this.followers = response.data;
                    this.loading = false;
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    this.loading = false;
                });
        }
    },
    mounted() {
        // Fetch data initially
        if (this.startDate != undefined) this.fetchData();
    }
};
</script>

<style scoped>
/* Puedes agregar estilos personalizados aquí si es necesario */
</style>