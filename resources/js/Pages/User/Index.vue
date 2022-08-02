<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { Inertia } from '@inertiajs/inertia';
    import { Head, Link, InertiaLink } from '@inertiajs/inertia-vue3';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Users
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                     <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <inertia-link :href="route('user.create')"> Crear usuario</inertia-link>
                        <table class="table-auto w-full">
                            <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                <tr>
                                    <th class="p-3 font-semibold">ID</th>
                                    <th class="p-3 font-semibold">Nombre</th>
                                    <th class="p-3 font-semibold">Email</th>
                                    <th class="p-3 font-semibold">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-gray-100">
                                <tr v-for="user in users" :key="user.id">
                                    <th class="p-3 border"><span class="font-medium text-gray-800"> {{ user.id }} </span></th>
                                    <th class="p-3 border"><span class="font-medium text-gray-800"> {{ user.name }} </span></th>
                                    <th class="p-3 border"><span class="font-medium text-gray-800"> {{ user.email }} </span></th>
                                    <th class="p-3 border"></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>

    export default {
        props:['users'],
        components: {
            AppLayout
        },
    };
</script>
