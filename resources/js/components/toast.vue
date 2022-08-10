<template>
    <Transition name="fade">
        <div v-if="toast && visible" v-bind:class="{'shadow-yellow-600': toast.type == 'warning', 'shadow-green-600': toast.type == 'success' }" class="absolute flex max-w-xs w-full mt-12 mr-4 top-1 right-0 p-4 bg-white border rounded-md shadow-sm">
            <div class="flex items-center">
                <svg v-bind:class="{ 'hidden': toast.type == 'warning' }" xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>

                <svg v-bind:class="{ 'hidden': toast.type == 'success' }" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <p v-bind:class="{ 'text-yellow-600': toast.type == 'warning' }" class="ml-3 text-sm font-bold text-green-600"> {{ toast.message }} !</p>
            </div>
            <button @click="visible = false" type="button"
                class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 hover:bg-gray-100  h-8 w-8 ">
                <i class="fa fa-close"></i> x
            </button>
        </div>
    </Transition>
</template>

<script>
export default {
    props: {
        toast: Object
    },
    data() {
        return {
            visible: false,
            timeout: null
        }
    },
    watch: {
        toast: {
            deep: true,
            handler() {
                this.visible = true;
                if(this.timeout){
                    clearTimeout(this.timeout);
                }
                //this.timeout = setTimeout(() => this.visible = false, 1000);
            }
        }
    }
};
</script>

<style>
    .fade-enter-active, .fade-leave-active {
        transition: opacity 0.5s ease;
    }
    .fade-enter-from, .fade-leave-to {
        opacity: 0;
    }
</style>
