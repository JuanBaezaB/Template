<template>

     <div v-if="toast && visible" class="absolute flex items-center justify-between max-w-xs w-full mt-1 mr-4 top-0 right-0 p-4 bg-white border rounded-md shadow-sm shadow-green-600">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-500" viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                    clip-rule="evenodd" />
            </svg>
            <p class="ml-3 text-sm font-bold text-green-600"> {{ toast.message }} !</p>
        </div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 hover:bg-gray-100  h-8 w-8 " >
            <i class="fa fa-close"></i>
        </button>

    </div>
</template>

<script>
    export default {
        props: {
            toast : Object
        },
        data() {
            return {
                visible: false
            }
        },
        watch:{
            toast:{
                deep:true,
                handler(){
                    this.visible = true;
                    setTimeout(()=>this.visible = false, 1000);
                }
            }
        }
    };
</script>
