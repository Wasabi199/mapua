<template>
    <AppLayout title="MITRF APP">
        <div class="text-center grid">
            <div class="w-fit block mx-auto my-4 mt-16">
                <button @click="showModal = true" class="bg-red-800 hover:bg-red-600 active:bg-red-800 inline-flex h-16 p-0 rounded-[5px] lg:w-92 text-lg font-semibold">
                    <p class="inline-flex py-0 px-16 text-white text-xl my-auto items-center h-full lg:px-20 lg:text-2xl">Contributions</p>
                    <div id="add" class="inline-flex py-0 h-full">
                        <img class="h-1/2 my-auto mx-6" src="/images/contribution.png"/>
                    </div>
                </button>
            </div>

            <JetNavLink :href="route('userLoanDashboard')" :active="route().current('userLoanDashboard')" class="w-fit block mx-auto my-4">
                <button class="bg-orange-700 hover:bg-orange-700 active:bg-orange-800 mx-auto inline-flex h-16 p-0 rounded-[5px] lg:w-96 text-lg font-semibold">
                    <p class="inline-flex py-0 px-[100px] text-white text-xl my-auto items-center h-full lg:px-[120px] lg:text-2xl">Loans</p>
                    <div id="add" class="inline-flex py-0 h-full">
                        <img class="h-1/2 my-auto mx-6" src="/images/loan.png"/>
                    </div>
                </button>
            </JetNavLink>

            <JetNavLink :href="route('ReimbursView')" :active="route().current('ReimbursView')" class="w-fit block mx-auto my-4">
                <button class="bg-amber-600 hover:bg-amber-600 active:bg-amber-800 mx-auto inline-flex h-16 p-0 rounded-[5px] lg:w-96 text-lg font-semibold">
                    <p class="inline-flex py-0 px-4 text-white text-xl my-auto items-center h-full lg:px-[21px] lg:text-2xl">Medical Reimbursement</p>
                    <div id="add" class="inline-flex py-0 h-full">
                        <img class="h-1/2 my-auto mx-6" src="/images/medical.png"/>
                    </div>
                </button>
            </JetNavLink>
        </div>

        <Modal  :show="showModal" :closeable="true" @close="showModal = !showModal">
            <div  class="p-5">
                <div class="flex justify-between text-xl font-bold text-gray-900 my-3 " >
                    <span class="text-center">Contributions</span>
                <svg @click="showModal = !showModal" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                </div>

                <div class="flex justify-left text-m font-bold text-gray-900 my-3 mt-10">
                    <span>Total Contribution: ₱ {{contribution.contribution_amount.toLocaleString('en-US')}}.00 as of {{new Date(contribution.updated_at)}}</span>
                </div>

                <div class="flex justify-end text-xl font-bold dark:text-gray-200 my-3">
                    <div @click="showModal = false" class="flex space-x-2 px-4 py-1 border text-sm leading-snug font-semibold text-green-600 dark:text-green-600 dark:border-green-600 border-green-600 uppercase rounded-full dark:hover:text-gray-200 hover:bg-green-500 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">
                            <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z"/>
                            <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z"/>
                        </svg>
                        <span>Ok</span>
                    </div>
                </div>
            </div>
        </Modal>

    </AppLayout>
</template>

<script>
import JetApplicationLogo from "@/Jetstream/ApplicationLogo.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import JetNavLink from '@/Jetstream/NavLink.vue';
import Modal from '@/Jetstream/Modal';
import route from '../../../../vendor/tightenco/ziggy/src/js';

export default {
    components: {
        JetApplicationLogo,
        JetNavLink,
        AppLayout,
        Modal,
    },
    setup() {

    },
       data() {
        return {
            showModal:false,

        }
    },

    props: {
        notification: Object,
        count: Number,
        contribution:Object,
    },


};
</script>

<style scoped>
    #add {
        background: rgba(0,0,0,0.08);
    }
</style>
