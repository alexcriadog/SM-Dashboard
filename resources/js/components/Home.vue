<template>
  <div class="h-screen w-screen flex flex-col">
    <!-- HEADER -->
    <app-header></app-header>
    <dashboard class="flex-grow w-full"></dashboard>
  </div>
</template>

<script>
import Dashboard from './Dashboard.vue';

export default {
  data() {

  },
};
</script>

<style scoped>
/* Puedes agregar estilos personalizados aquí si es necesario */
</style>
