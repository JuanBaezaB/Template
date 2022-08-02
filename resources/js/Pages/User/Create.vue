<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { Inertia } from '@inertiajs/inertia';
    import JetInputError from '@/Jetstream/InputError.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create User
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                     <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <label>Name:</label>
                            <input type="text" v-model="name" />
                            <div v-if="errors.name">{{ errors.name }}</div>
                            <label>Email:</label>
                            <input type="email" v-model="email" />
                            <div v-if="errors.email">{{ errors.email }}</div>
                            <label>Password:</label>
                            <input type="password"  v-model="password" />
                            <JetInputError :message="errors.password" />
                            <button type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>

    export default {
        props:["errors"],
        data() {
            return {
                name:'Juan',
                email:'test@test.cl',
                password:'1234'

            }
        },
        components: {
            AppLayout
        },
        methods: {
            submit(){
                Inertia.post(route('user.store'),{
                    name: this.name,
                    email: this.email,
                    password: this.password
                })
            }
        },
    };
</script>
