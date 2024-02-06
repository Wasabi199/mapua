<template>
    <AppLayout>
        <template #header>
            <div class="flex justify-between">
                <div class="flex items-center">
                    <h1
                        class="text-xl font-extrabold leading-tight text-gray-800"
                    >
                        Current Loans
                    </h1>
                </div>
            </div>
        </template>
        <div
            class="flex items-center justify-between p-2 px-6 overflow-hidden leading-tight"
        >
            <h1 class="pl-8 text-xl font-extrabold text-gray-700">
                Loans Management
            </h1>

            <div class="px-6 py-4 whitespace-nowrap"></div>
        </div>
        <div class="mx-12 my-6 shadow-md">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div
                        class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"
                    >
                        <div
                            class="hidden overflow-hidden border-b border-gray-200 shadow sm:rounded-lg md:block"
                        >
                            <table class="min-w-full divide-y divide-gray-200">
                                <tbody
                                    class="bg-white divide-y divide-gray-200"
                                >
                                    <th class="px-16 text-center bg-gray-100">
                                        Loan Type
                                    </th>
                                    <th class="px-16 text-center bg-gray-100">
                                        Amortization
                                    </th>
                                    <th class="px-16 text-center bg-gray-100">
                                        Duration
                                    </th>
                                    <th class="px-16 text-center bg-gray-100">
                                        Date of Loan Application
                                    </th>
                                    <th class="px-16 text-center bg-gray-100">
                                        Loan Status
                                    </th>
                                    <th class="px-24 text-left bg-gray-100">
                                        Action
                                    </th>
                                    <tr
                                        v-for="loan in loans.data"
                                        v-bind:key="loan.id"
                                    >
                                        <td
                                            class="px-16 py-4 whitespace-nowrap"
                                        >
                                            <div class="">
                                                <div>
                                                    <div
                                                        class="text-sm font-medium text-center text-gray-900"
                                                    >
                                                        {{ loan.loan_type }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="px-16 py-4 whitespace-nowrap"
                                        >
                                            <div class="">
                                                <div>
                                                    <div
                                                        class="text-sm font-medium text-center text-gray-900"
                                                    >
                                                    &#8369 {{
                                                            loan.loan_amount.toLocaleString("en-US")
                                                        }}

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="px-16 py-4 whitespace-nowrap"
                                        >
                                            <div class="">
                                                <div>
                                                    <div
                                                        class="text-sm font-medium text-center text-gray-900"
                                                    >
                                                        {{
                                                            loan.duration
                                                        }}
                                                        months
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="px-16 py-4 whitespace-nowrap"
                                        >
                                            <div class="">
                                                <div>
                                                    <div
                                                        class="text-sm font-medium text-center text-gray-900"
                                                    >
                                                        {{
                                                            new Date(
                                                                loan.created_at
                                                            )
                                                        }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td
                                            class="px-16 py-4 whitespace-nowrap"
                                        >
                                            <div class="">
                                                <div>
                                                    <div
                                                        class="text-sm font-medium text-center text-gray-900"
                                                    >
                                                        {{
                                                            loan.loan_status
                                                        }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 whitespace-nowrap">
                                            <div
                                                class="px-4 py-1 text-center text-green-600 uppercase border border-green-600 rounded-full cursor-pointer w-fit text-md dark:text-green-600 dark:border-green-600 dark:hover:text-gray-200 hover:text-white hover:border-none hover:bg-green-500"
                                            >
                                                <Link
                                                    :href="
                                                        route(
                                                            'UserLoanView',
                                                            loan.id
                                                        )
                                                    "
                                                >
                                                    <div class="text-center">
                                                        VIEW LOAN APPLICATION
                                                    </div>
                                                </Link>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <pagination :links="loans.links" />
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="grid grid-cols-1 gap-4 md:hidden"
                v-for="loan in loans.data"
                v-bind:key="loan.id"
            >

                <div class="p-4 bg-white rounded-lg shadow">
                    <div><b>Loan Type:</b> {{ loan.loan_type }}</div>
                    <div><b>Amortization:</b> &#8369 {{ (loan.loan_amount.toFixed(2)).toLocaleString("en-US") }}</div>
                    <div><b>Duration:</b> {{ loan.duration }} months</div>
                    <div><b>Loan Status:</b> {{ loan.loan_status }}</div>
                    <div>
                        <b>Date of Loan Application:</b>
                        {{ new Date(loan.created_at) }}
                    </div>
                    <div
                        class="flex items-center py-1 pl-12 text-green-600 uppercase border border-green-600 rounded-full cursor-pointer text-md dark:text-green-600 dark:border-green-600 dark:hover:text-gray-200 hover:text-white hover:border-none hover:bg-green-500"
                    >
                        <Link :href="route('UserLoanView', loan.id)">
                            <div>
                                <button>VIEW LOAN APPLICATION</button>
                            </div>
                        </Link>
                    </div>
                </div>
            </div>
            <pagination class="md:hidden" :links="loans.links" />
        </div>
        <div class="flex-direction: column">
            <div class="flex justify-center px-6 py-4 whitespace-nowrap">
                <Link
                    :href="route('userLoan')"
                    class="flex px-4 py-1 mr-5 space-x-2 text-yellow-600 uppercase border border-yellow-600 rounded-full cursor-pointer text-md dark:text-yellow-600 dark:border-yellow-600 dark:hover:text-gray-200 hover:text-white hover:border-none hover:bg-yellow-500"
                >
                    <button>APPLY NEW LOAN</button>
                </Link>
            </div>
            <div class="flex justify-center px-6 py-4 whitespace-nowrap">
                <div
                    class="flex px-4 py-1 mr-5 space-x-2 text-red-600 uppercase border border-red-600 rounded-full cursor-pointer text-md dark:text-red-600 dark:border-red-600 dark:hover:text-gray-200 hover:text-white hover:border-none hover:bg-red-500"
                >
                    <Link :href="route('userDashboard')">
                        <button>BACK TO HOME</button>
                    </Link>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Components/NormalPagination.vue";
import JetApplicationLogo from "@/Jetstream/ApplicationLogo.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Modal from "@/Jetstream/Modal";
import { pickBy, throttle } from "lodash";
import route from "../../../../vendor/tightenco/ziggy/src/js";
import { useForm } from "@inertiajs/inertia-vue3";
import {
    Listbox,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
} from "@headlessui/vue";
export default {
    components: {
        AppLayout,
        Pagination,
        JetApplicationLogo,
        Link,
        Modal,
        Listbox,
        ListboxButton,
        ListboxOptions,
        ListboxOption,
    },
    props: {
        loans: Object,
        notification: Object,
        count: Number,
    },

    setup() {},

    data() {
        return {
            id: Number,
        };
    },

    watch: {
        form: {
            deep: true,
            handler: throttle(function () {
                this.$inertia.get(route("usersLoansView"), pickBy(this.form), {
                    preserveState: true,
                    preserveScroll: true,
                });
            }, 600),
        },
    },
};
</script>
<style scoped>
i {
    font-size: 1rem !important;
}
</style>
