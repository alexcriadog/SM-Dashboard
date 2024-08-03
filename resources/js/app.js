/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import { createApp } from 'vue';
import '../sass/app.scss';

import VueApexCharts from "vue3-apexcharts";

import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faUsers, faDollarSign, faEnvelope, faTasks } from '@fortawesome/free-solid-svg-icons';
library.add(faUsers, faDollarSign, faEnvelope, faTasks);

import PrimeVue from 'primevue/config';
import Aura from '@primevue/themes/aura';

const app = createApp({});

import Dashboard from './components/Dashboard.vue';
import Home from './components/Home.vue';
import Header from './components/Header.vue';
import Indicator from './components/Indicator.vue';
import LineChart from './components/LineChart.vue';
import RadialChart from './components/RadialChart.vue';
import ListChart from './components/ListChart.vue';
import SMTable from './components/SMTable.vue';
app.component('dashboard', Dashboard);
app.component('home', Home);
app.component('app-header', Header);
app.component('indicator', Indicator);
app.component('line-chart', LineChart);
app.component('radial-chart', RadialChart);
app.component('list-chart', ListChart);
app.component('sm-table', SMTable);

import DataTable from 'primevue/datatable';
import Button from 'primevue/button';
import Column from 'primevue/column';
import Select from 'primevue/select';
import Tag from 'primevue/tag';
import InputNumber from 'primevue/inputnumber';
import InputText from 'primevue/inputtext';
app.component('Button', Button);
app.component('DataTable', DataTable);
app.component('Column', Column);
app.component('Select', Select);
app.component('Tag', Tag);
app.component('InputNumber', InputNumber);
app.component('InputText', InputText);

app.component('font-awesome-icon', FontAwesomeIcon);

app.use(VueApexCharts)
app.use(PrimeVue, {
    theme: {
        preset: Aura
    }
});
app.mount('#app');
