<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { Inertia } from '@inertiajs/inertia';
    import JetInputError from '@/Jetstream/InputError.vue';
    import JetInput from '@/Jetstream/Input.vue';
    import JetLabel from '@/Jetstream/Label.vue';
    import JetButton from '@/Jetstream/Button.vue';
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
                            <JetLabel for="name" value="Name" />
                            <JetInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" autofocus />
                            <JetInputError :message="errors.name" />

                            <JetLabel for="email" value="Email" />
                            <JetInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" autofocus />
                            <JetInputError :message="errors.email" />

                            <JetLabel for="password" value="Password" />
                            <JetInput id="password" v-model="form.password" type="password" class="mt-1 block w-full"  autofocus />
                            <JetInputError :message="errors.password" />

                            <button type="submit"></button>
                            <JetButton class="mt-1" type="submit">
                                Submit
                            </JetButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>

export default {
    props: ["errors"],
    data() {
        return {
            form: {
                name: 'Juan',
                email: 'test@test.cl',
                password: '1234'
            }
        }
    },
    components: {
        AppLayout,
        JetInputError,
        JetLabel,
        JetInput,
        JetButton
    },
    methods: {
        submit() {
            Inertia.post(route('user.store'), this.form)
        }
    },
};
</script>
