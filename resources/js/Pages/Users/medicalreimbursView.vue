<template>
    <AppLayout title="Loan Dashboard">
       <div class="text-center grid">
            <JetNavLink :href="route('createReimburstment')" :active="route().current('createReimburstment')" class="w-fit block mx-auto my-4 mt-16">
                <button class="bg-red-800 hover:bg-red-700 active:bg-red-700 inline-flex h-16 p-0 rounded-[5px] lg:w-92 text-lg font-semibold">
                    <p class="inline-flex py-0 px-12 text-white text-xl my-auto items-center h-full lg:px-16 lg:text-2xl">Apply for a Medical Reimbursement </p>
                    <div id="add" class="inline-flex py-0 h-full">
                        <img class="h-1/2 my-auto mx-6" src="/images/apply.png"/>
                    </div>
                </button>
            </JetNavLink>

            <JetNavLink :href="route('medicalView')" :active="route().current('medicalView')" class="w-fit block mx-auto my-4">
                <button class="bg-amber-700 hover:bg-amber-600 active:bg-amber-700 inline-flex h-16 p-0 rounded-[5px] lg:w-92 text-lg font-semibold">
                    <p class="inline-flex py-0 px-8 text-white text-xl my-auto items-center h-full lg:px-11 lg:text-2xl">View Existing Reimbursements</p>
                    <div id="add" class="inline-flex py-0 h-full">
                        <img class="h-1/2 my-auto mx-6" src="/images/view.png"/>
                    </div>
                </button>
            </JetNavLink>
       </div>

    </AppLayout>
</template>

<script>
import JetApplicationLogo from "@/Jetstream/ApplicationLogo.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import JetNavLink from '@/Jetstream/NavLink.vue';

export default {
    components: {
        JetApplicationLogo,
        JetNavLink,
        AppLayout,
    },
    setup() {},
    props: {
        notification: Object,
        count: Number,

    },
};
</script>

<style scoped>
    #add {
        background: rgba(0,0,0,0.08);
    }
</style>
