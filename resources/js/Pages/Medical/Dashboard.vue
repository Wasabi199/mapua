<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Homepage
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div>
                        <div
                            class="flex p-6 sm:px-20 bg-white border-b border-gray-200"
                        >
                            <div class="mx-auto">
                                <img
                                    alt="mitrf logo"
                                    src="/images/mu_white.png"
                                />
                                <div class="flex p-6">
                                    <p class="mx-auto text-2xl font-bold">
                                        Hi, {{ $page.props.user.name }}!
                                    </p>
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
import JetApplicationLogo from "@/Jetstream/ApplicationLogo.vue";
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    components: {
        JetApplicationLogo,
        AppLayout,
    },
    setup() {},
    props: {
        notification: Object,
        count: Number,
    },
};
</script>
