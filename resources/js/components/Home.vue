<template>
  <div class="h-screen w-screen flex flex-col">
    <!-- HEADER -->
    <app-header @periods="handlePeriods"></app-header>
    <dashboard class="flex-grow w-full" :selectedPeriod="periods"></dashboard>
  </div>
</template>

<script>
import Dashboard from './Dashboard.vue';

export default {
  data() {
    return {
      periods: { name: 'Last week', code: '7' }
    };
  },
  methods: {
    handlePeriods(periods) {
      this.periods = periods;
    }
  }
};
</script>

<style scoped>
/* Puedes agregar estilos personalizados aquí si es necesario */
</style>
