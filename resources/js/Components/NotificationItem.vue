<template>
    <TransitionRoot
        :show="isShowing && notification != null"
        enter="transition-opacity duration-75"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="transition-opacity duration-150"
        leave-from="opacity-100"
        leave-to="opacity-0"
    >
        <div class="flex flex-col w-96 p-3  text-gray-800  bg-white shadow rounded-lg">
            <div class="flex flex-row justify-between">
                <div class="flex space-x-3 items-center pl-3">
                    
                    <div class="flex flex-col">
                        <h1 class="flex text-lg font-bold relative">
                            <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-0 animate-ping h-6 w-6 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                            </svg> -->
                            <span>{{notification.header}}</span>
                        </h1>
                    </div>
                </div>
                <svg @click="isShowing = !isShowing" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="flex p-3 border-t-[1px]  border-t-gray-300 mt-2">
                <p class="text-gray-800 ">
                   {{notification.message}} 
                </p>
            </div>
        </div>
    </TransitionRoot>
</template>

<script>
import {ref} from 'vue'
  import { TransitionRoot } from '@headlessui/vue'
export default {
    components:{ TransitionRoot },
    setup() {
        const isShowing = ref(true)
        return {
            isShowing
        }
    },
    props:{
        notification: Object
    }
}
</script>