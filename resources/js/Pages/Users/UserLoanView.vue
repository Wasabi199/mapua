<template>
    <AppLayout>
        <div class="flex justify-between bg-white shadow">
            <div
                class="flex items-center px-4 py-2 mx-auto max-w-7xl sm:px-6 lg:px-8"
            >
            <Link :href="route('userLoanDashboard')">
                <h2 class="text-xl font-extrabold leading-tight text-gray-800">
                    Loans
                </h2>
            </Link>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-6 h-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 5l7 7-7 7"
                    />
                </svg>

                <h1 class="text-xl leading-tight text-gray-800 ont-extrabold">
                    {{ users.name }}
                </h1>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 m-8 lg:m-10 lg:grid-cols-2">
            <div
                class="p-4 overflow-hidden bg-white border-gray-300 rounded-lg shadow-xl"
            >
                <form>
                    <div class="px-2 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label
                                    class="block text-sm font-medium text-gray-700"
                                    >Name of Borrower</label
                                >
                                <input
                                    type="text"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                                    :value="$props.users.name"
                                    disabled
                                />
                            </div>

                            <div class="col-span-6 sm:col-span-2">
                                <label
                                    class="block text-sm font-medium text-gray-700"
                                    >Date of Membership</label
                                >
                                <input
                                    type="date"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                                    :value="$props.users.admin_reg.membership"
                                    disabled
                                />
                            </div>

                            <div class="col-span-6 sm:col-span-2">
                                <label
                                    class="block text-sm font-medium text-gray-700"
                                    >Years of Membership</label
                                >
                                <input
                                    type="number"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                                    :value="
                                        new Date().getUTCFullYear() -
                                        new Date(
                                            $props.users.admin_reg.membership
                                        ).getUTCFullYear()
                                    "
                                    disabled
                                />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label
                                    class="block text-sm font-medium text-gray-700"
                                    >Principal Amount</label
                                >
                                <div>
                    <span class="absolute mt-1.5 pl-2 font-bold">&#8369</span>

                                <input
                                    type="number"
                                    class="block w-full pl-6 mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                                    :value="$props.loans.amount"
                                    disabled
                                />
                                </div>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label
                                    class="block text-sm font-medium text-gray-700"
                                    >Net Amount Due to Borrower</label
                                >
                                <div>
                    <span class="absolute mt-1.5 pl-2 font-bold">&#8369</span>

                                <input
                                    type="number"
                                    class="block w-full pl-6 mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                                    :value="$props.loans.loan_amount"
                                    disabled
                                />
                                </div>
                            </div>
                            <div class="col-span-6 sm:col-span-2">
                                <label
                                    class="block text-sm font-medium text-gray-700"
                                    >Remaining Term of Payments
                                    &lpar;Months&rpar;</label
                                >
                                <input
                                    type="number"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                                    :value="loan_duration"
                                    disabled
                                />
                            </div>

                            <div class="col-span-6 sm:col-span-2">
                                <label
                                    class="block text-sm font-medium text-gray-700"
                                    >Approval Status</label
                                >
                                <input
                                    type="text"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                                    :value="$props.loans.approval"
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="col-span-6 mt-2 sm:col-span-2">
                            <label
                                class="block text-sm font-medium text-gray-700"
                                >Date of Loan Application</label
                            >
                            <input
                                type="text"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                                :value="new Date($props.loans.created_at)"
                                disabled
                            />
                        </div>
                    </div>
                </form>
            </div>

            <div
                v-if="
                    loans.approval != 'Released' &&
                    loans.approval != 'Denied' &&
                    loans.approval != 'For Release'
                "
                class="row-span-3"
            >
                <div v-if="loans.loan_type == 'Housing Loan'">
                    <p class="font-semibold">
                        Member's Payslip for Validation:
                    </p>
                </div>
                <div v-if="loans.loan_type == 'Educational Loan'">
                    <p class="font-semibold">
                        Member's Payslip for Validation:
                    </p>
                </div>
                <div v-if="loans.loan_type == 'Emergency Loan'">
                    <p class="font-semibold">
                        Member's Payslip for Validation:
                    </p>
                </div>
                <div
                    class="content-center bg-white rounded-lg shadow-xl lg:mr-50"
                >
                    <img
                        :src="
                            loans.attachment1 == null
                                ? ''
                                : '../' + loans.attachment1
                        "
                        class="w-auto h-auto"
                    />
                </div>
                <div v-if="loans.loan_type == 'Housing Loan'">
                    <p class="font-semibold">
                        Photo of you Including the Place to be
                        Improved/Repaired:
                    </p>
                </div>
                <div
                    v-if="
                        loans.loan_type == 'Educational Loan' &&
                        loans.attachment2 != null
                    "
                >
                    <p class="font-semibold">
                        Proof of Relation (Birth Certificate in Case of
                        Relatives):
                    </p>
                </div>
                <div
                    class="content-center bg-white rounded-lg shadow-xl lg:mr-50"
                >
                    <img
                        :src="
                            loans.attachment2 == null
                                ? ''
                                : '../' + loans.attachment2
                        "
                        class="w-auto h-auto"
                    />
                </div>
                <div v-if="loans.loan_type == 'Housing Loan'">
                    <p class="font-semibold">Laborer's Quotation:</p>
                </div>
                <div v-if="loans.loan_type == 'Educational Loan'">
                    <p class="font-semibold">
                        Certificate of Enrollment and Statement of Account from
                        School:
                    </p>
                </div>
                <div
                    class="content-center bg-white rounded-lg shadow-xl lg:mr-50"
                >
                    <img
                        :src="
                            loans.attachment3 == null
                                ? ''
                                : '../' + loans.attachment3
                        "
                        class="w-auto h-auto"
                    />
                </div>
            </div>

            <div
                v-if="loans.approval == 'For Release'"
                class="content-center bg-white rounded-lg shadow-xl lg:mr-50"
            >
                <div class="flex justify-between m-4">
                    <div class="text-lg">
                        <p class="content-center font-bold">Good news!</p>
                        <p>
                            Your Personal Loan application has been processed.
                        </p>
                        <p>
                            A representative will send you an email for updates
                            on the release of your loan.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Desktop view loan payment breakdown -->

            <div
                v-if="loans.approval == 'Released'"
                class="content-center hidden w-full bg-white rounded-lg shadow-xl lg:mr-50 md:block"
            >
                <table class="min-w-full mx-auto divide-y divide-gray-200">
                    <thead class="inline-auto">
                        <tr
                            class="box-content w-20 h-10 p-4 text-yellow-400 bg-red-800 border-10"
                        >
                            <th class="px-8 text-center">Loan </th>
                            <th class="px-10 text-center">Amount</th>
                            <th class="px-16 text-center">Date of Payment</th>
                    </tr>
               </thead>
                   <tbody class="bg-white divide-y divide-gray-200">
                        <tr
                            v-for="contribution in contributions.data"
                            v-bind:key="contribution.id"
                        >
                            <td class="px-6 py-6 whitespace-nowrap">
                                <div class="">
                                    <div>
                                        <div
                                            class="px-8 text-sm font-medium text-center text-gray-900"
                                        >
                                            {{ contribution.id }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="">
                                    <div>
                                        <div
                                            class="px-12 text-sm font-medium text-center text-gray-900"
                                        >
                                        &#8369
                                            {{
                                                contribution.contribution_amount.toLocaleString("en-US")
                                            }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="m-auto">
                                        <div
                                            class="px-2 text-sm font-medium text-gray-900"
                                        >
                                            {{
                                                new Date(
                                                    contribution.updated_at
                                                ).toLocaleString("en-us", {
                                                    month: "short",
                                                    day: "numeric",
                                                    year: "numeric",
                                                })
                                            }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <Pagination :links="contributions.links"></Pagination>
            </div>


            <!-- mobile view loan loan breakdown -->

            <div
                v-if="loans.approval == 'Released'"
                class="text-xl font-semibold md:hidden"
            >
                Breakdown of Loan Payment
            </div>
            <div
                class="grid grid-cols-1 gap-4 md:hidden"
                v-for="contribution in contributions.data"
                v-bind:key="contribution.id"
            >
                <div class="p-4 bg-white rounded-lg shadow">
                    <div><b>Loan:</b> {{ contribution.id }}</div>
                    <div>
                        <b>Loan Amount:</b>
                        &#8369 {{ contribution.contribution_amount }}
                    </div>
                    <div>
                        <b>Date of Payment:</b>
                        {{ new Date(contribution.updated_at) }}
                    </div>
                </div>
            </div>
            <pagination
                v-if="loans.approval == 'Released'"
                class="md:hidden"
                :links="contributions.links"
            />
            <div
                v-if="loans.approval == 'Denied'"
                class="w-full p-4 m-auto text-center bg-white border-gray-300 rounded-lg shadow-xl h-fit"
            >
                <h1>Rejected Loan Application</h1>
                <div class="font-semibold">{{ loans.reason }}</div>
            </div>
        </div>
        <div class="flex justify-center">
            <div class="flex justify-between my-3">
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

import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import Pagination from "@/Components/NormalPagination.vue";
import { pickBy, throttle } from "lodash";
import Modal from "@/Jetstream/Modal";
export default {
    components: {
        AppLayout,
        Link,
        Pagination,
        Modal,
    },
    props: {
        users: Object,
        loans: Object,
        notification: Object,
        info: Object,
        contributions: Object,
    },
    data() {
        return {
            loan_duration: this.loans.duration - this.contributions.total,
        };
    },
    setup() {},
};
</script>
