<template>
    <div class="max-w-md mx-auto bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-4">
            <h2 class="text-2xl font-bold mb-4">Formulario de Registro</h2>

            <!-- Mensaje de éxito -->
            <div v-if="successMessage" class="mb-4 p-4 text-green-700 bg-green-100 border border-green-400 rounded">
                {{ successMessage }}
            </div>

            <!-- Formulario -->
            <form @submit.prevent="submitForm" class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">
                        Nombre
                    </label>
                    <input type="text" id="name" v-model="form.name"
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Introduce tu nombre" required />
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Correo Electrónico
                    </label>
                    <input type="email" id="email" v-model="form.email"
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="correo@ejemplo.com" required />
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Contraseña
                    </label>
                    <input type="password" id="password" v-model="form.password"
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Introduce una contraseña" required />
                </div>

                <div>
                    <button type="submit" :disabled="loading"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span v-if="loading" class="loader mr-2"></span>
                        {{ loading ? 'Enviando...' : 'Registrar' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: {
                name: '',
                email: '',
                password: '',
            },
            successMessage: '',
            loading: false,
        };
    },
    methods: {
        async submitForm() {
            this.loading = true;
            this.successMessage = '';

            try {
                // Simulamos una llamada a la API
                await new Promise((resolve) => setTimeout(resolve, 2000));

                // Reseteamos el formulario y mostramos el mensaje de éxito
                this.form.name = '';
                this.form.email = '';
                this.form.password = '';
                this.successMessage = '¡Registro exitoso!';
            } catch (error) {
                console.error('Error en el registro:', error);
            } finally {
                this.loading = false;
            }
        },
    },
};
</script>

<style scoped>
.loader {
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-left-color: white;
    border-radius: 50%;
    width: 16px;
    height: 16px;
    display: inline-block;
    animation: spin 0.8s linear infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}
</style>