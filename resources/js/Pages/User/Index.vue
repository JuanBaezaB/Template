<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link, InertiaLink } from '@inertiajs/inertia-vue3';
import JetInputError from '@/Jetstream/InputError.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetButton from '@/Jetstream/Button.vue';


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

                        <button @click="openModal()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Create New User</button>

                        <div class="overflow-auto rounded-lg shadow hidden md:block">
                            <table class=" w-full">
                                <thead
                                    class="text-xs font-semibold uppercase text-gray-400 bg-gray-50 border-b-2 border-gray-200 ">
                                    <tr>
                                        <th class="w-20 p-3 font-semibold text-sm tracking-wide text-left">ID</th>
                                        <th class="w-25 p-3 font-semibold text-sm tracking-wide text-left">Nombre</th>
                                        <th class="w-25 p-3 font-semibold text-sm tracking-wide text-left">Email</th>
                                        <th class="w-22 p-3 font-semibold text-sm tracking-wide text-left">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm divide-y divide-gray-100">
                                    <tr v-for="user in users" :key="user.id">
                                        <th class="p-3 border text-sm text-gray-700 text-left whitespace-nowrap"><span
                                                class="font-bold text-blue-500"> {{ user.id }} </span></th>
                                        <th class="p-3 border text-sm text-gray-700 text-left "><span
                                                class="font-medium text-gray-800"> {{ user.name }} </span></th>
                                        <th class="p-3 border text-sm text-gray-700 text-left whitespace-nowrap"><span
                                                class="font-medium text-gray-800"> {{ user.email }} </span></th>
                                        <th class="p-3 border text-sm text-gray-700 text-left whitespace-nowrap">
                                            <button @click="edit(user)"
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                                            <button @click="deleteRow(user)"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="grid grid-cols-1 gap-4 md:hidden">
                            <div v-for="user in users" class="bg-white p-4 rounded-lg shadow">
                                <div class=" text-sm grid grid-cols-3">
                                    <div class="font-bold text-blue-500 col-span-2">{{ user.id }}</div>
                                    <div class="row-span-3 flex justify-center items-center ">

                                         <div class="inline-flex rounded-md shadow-sm">
                                            <button @click="edit(user)" class="px-2 py-2 inline-flex justify-center items-center gap-2 -ml-px first:rounded-l-lg first:ml-0 last:rounded-r-lg border font-medium align-middle bg-blue-500 hover:bg-blue-700 text-white text-xs">Edit</button>

                                            <button @click="deleteRow(user)" class="px-2 py-2 inline-flex justify-center items-center gap-2 -ml-px first:rounded-l-lg first:ml-0 last:rounded-r-lg border font-medium align-middle bg-red-500 hover:bg-red-700 text-white text-xs">Delete</button>
                                        </div>
                                    </div>
                                    <div class="col-span-2"> {{ user.name }}</div>
                                    <div class="col-span-2">{{ user.email }}</div>

                                </div>
                            </div>
                        </div>


                        <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpen">
                            <div
                                class="flex justify-center items-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                                <div class="fixed inset-0 transition-opacity">
                                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                </div>

                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
                                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                                    role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                    <form>
                                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                            <div class="">
                                                <div class="mb-4">
                                                    <JetLabel for="name" value="Name" />
                                                    <JetInput id="name" v-model="form.name" type="text"
                                                        class="mt-1 block w-full" placeholder="Juan" autofocus />
                                                    <JetInputError :message="errors.name" />

                                                    <JetLabel for="email" value="Email" />
                                                    <JetInput id="email" v-model="form.email" type="email"
                                                        class="mt-1 block w-full" autofocus />
                                                    <JetInputError :message="errors.email" />

                                                    <JetLabel for="password" value="Password" />
                                                    <JetInput id="password" v-model="form.password" type="password"
                                                        class="mt-1 block w-full" autofocus />
                                                    <JetInputError :message="errors.password" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                                <button wire:click.prevent="store()" type="button"
                                                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                                    v-show="!editMode" @click="save(form)">
                                                    Save
                                                </button>
                                            </span>
                                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                                <button wire:click.prevent="store()" type="button"
                                                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                                    v-show="editMode" @click="update(form)">
                                                    Update
                                                </button>
                                            </span>
                                            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                                                <button @click="closeModal()" type="button"
                                                    class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                                    Cancel
                                                </button>
                                            </span>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>

export default {
    props: ['users', 'data', 'errors'],
    components: {
        AppLayout,
        JetInputError,
        JetLabel,
        JetInput,
        JetButton
    },

    data() {
        return {
            editMode: false,
            isOpen: false,
            form: {
                title: null,
            },
        }
    },
    methods: {
        openModal() {
            this.isOpen = true;
        },
        closeModal() {
            this.isOpen = false;
            this.reset();
            this.editMode = false;
        },
        reset() {
            this.form = {
                title: null,
                body: null,
            }
        },
        save(data) {
            this.$inertia.post(route('user.store'), data);
            this.reset();
            this.closeModal();
            this.editMode = false;
        },
        edit(data) {
            this.form = Object.assign({}, data);
            this.editMode = true;
            this.openModal();
        },
        update(data) {
            data._method = 'PATCH';
            this.$inertia.post('/dashboard/user/edit/' + data.id, data)
            this.reset();
            this.closeModal();
        },
        deleteRow(data) {
            if (!confirm('Are you sure want to remove?')) return;
            data._method = 'DELETE';
            this.$inertia.post('/dashboard/user/delete/' + data.id, data)
            this.reset();
            this.closeModal();
        },
    },
};
</script>


