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
                Branches
            </h2>
        </template>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                         <div class="grid grid-cols-1 gap-4">
                            <div class="bg-white p-4 rounded-lg shadow">
                                <div class=" text-sm grid grid-cols-1">
                                    <form class="">
                                        <div class="ui message red" v-show="error">{{ error }}</div>
                                        <div class="ui segment">
                                            <div class="field">
                                                <div class="ui right icon input large" :class="{ loading: spinner }">
                                                    <input class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" type="text" placeholder="Enter your address" v-model="address" ref="autocomplete" />
                                                    <i class="dot circle link icon" @click="locatorButtonPressed">x</i>
                                                </div>
                                            </div>
                                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Go</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="bg-white p-4 rounded-lg shadow">
                                <div class=" text-sm grid grid-cols-1">
                                    <div id="map" ref="map">

                                    </div>

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
import axios from "axios";

export default {
    props: ['branches', 'errors'],
    components: {
        AppLayout
    },
    data() {
        return {
            address: "",
            error: "",
            spinner: false,
        };
    },

    mounted() {
        var autocomplete = new google.maps.places.Autocomplete(
            this.$refs["autocomplete"],
            {
                bounds: new google.maps.LatLngBounds(
                    new google.maps.LatLng(45.4215296, -75.6971931)
                ),
            }
        );

        autocomplete.addListener("place_changed", () => {
            var place = autocomplete.getPlace();

            this.showLocationOnTheMap(
                place.geometry.location.lat(),
                place.geometry.location.lng()
            );
        });
    },

    methods: {
        locatorButtonPressed() {
            this.spinner = true;

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        this.getAddressFrom(
                            position.coords.latitude,
                            position.coords.longitude
                        );

                        this.showLocationOnTheMap(
                            position.coords.latitude,
                            position.coords.longitude
                        );
                    },
                    (error) => {
                        this.error =
                            "Locator is unable to find your address. Please type your address manually.";
                        this.spinner = false;
                        // console.log(error.message);
                    }
                );
            } else {
                this.error = error.message;
                this.spinner = false;
                console.log("Your browser does not support geolocation API ");
            }
        },
        getAddressFrom(lat, long) {
            axios.get("https://maps.googleapis.com/maps/api/geocode/json?latlng="
                    +lat+"," +long +"&key=AIzaSyCJo0d84q3_W-zY6-m9_QJGa1UTY_vn2es",{headers: {'Access-Control-Allow-Origin': '*','Content-Type': 'application/json',},withCredentials: true}
                )
                .then((response) => {
                    if (response.data.error_message) {
                        this.error = response.data.error_message;
                        console.log(response.data.error_message);

                    } else {
                        this.address = response.data.results[0].formatted_address;

                        // console.log(response.data.results[0].formatted_address);
                    }
                    this.spinner = false;
                })
                .catch((error) => {
                    this.error = error.message;
                    this.spinner = false;
                    console.log(error.message);
                });
        },
        showLocationOnTheMap(latitude, longitude) {
            // Show & center the Map based oon
            var map = new google.maps.Map(this.$refs["map"], {
                zoom: 15,
                center: new google.maps.LatLng(latitude, longitude),
                mapTypeId: google.maps.MapTypeId.ROADMAP,
            });

            new google.maps.Marker({
                position: new google.maps.LatLng(latitude, longitude),
                map: map,
            });
        },
    },
};
</script>


<style>
#map {
    height: 400px;
}
</style>



