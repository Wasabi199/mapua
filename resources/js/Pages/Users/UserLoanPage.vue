<template>
    <AppLayout>
        <template #header>
            <div class="flex items-center">
                <Link :href="route('loansView')" class="hover:underline">
                    <h1
                        class="text-xl font-extrabold leading-tight text-gray-800"
                    >
                        Current Loan
                    </h1>
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
                <h1 class="text-xl font-extrabold leading-tight text-gray-800">
                    Apply For Loan
                </h1>
            </div>
        </template>
        <!-- <form @submit.prevent="submit"> -->
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <JetValidationErrors class="mb-4" />
                    <div class="mt-10 ml-6 lg:ml-20">
                        <p class="mt-4 mb-1 text-lg">Purpose of Loan</p>
                        <select
                            v-model="form.loan_type"
                            @change="showModal = !showModal"
                            class="mb-10 transition duration-150 ease-in border-2 border-gray-400 border-opacity-50 rounded-md hover:border-indigo-500"
                        >
                            <option value="placeholder" disabled>
                                Select Loan Type
                            </option>
                            <option
                                v-for="type in loanTypes"
                                v-bind:key="type"
                                :value="type"
                            >
                                {{ type }}
                            </option>
                        </select>
                    </div>

                    <!-- Loan For Home -->
                    <form
                        v-if="form.loan_type == 'Housing Loan'"
                        @submit.prevent="submit"
                        class="p-6 sm:px-20 bg-white border-b border-gray-200 mt-[-40px]"
                        enctype="multipart/form-data"
                    >
                        <p class="mb-1 text-lg">Terms (Months)</p>
                        <select
                            v-model="form.terms"
                            class="mb-5 transition duration-150 ease-in border-2 border-gray-400 border-opacity-50 rounded-md hover:border-indigo-500"
                        >
                            <option value="12">12</option>
                            <option value="24">24</option>
                        </select>
                        <div class="mb-5">
                            <label
                                class="mb-1 text-lg text-gray-700"
                                for="amount"
                                >Amount(Minimum of 30,000 and maximum of
                                100,000)</label
                            ><br />

                            <div class="relative w-64 mt-1 rounded-md">
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
                                >
                                    <span class="text-lg text-gray-500">
                                        ₱
                                    </span>
                                </div>
                                <input
                                    required
                                    v-model="form.amount"
                                    @change="onChangeAmount"
                                    type="number"
                                    placeholder="0.00"
                                    class="block w-64 pr-12 text-black border-2 border-gray-400 border-opacity-50 rounded-md focus:ring-indigo-500 hover:border-indigo-500 pl-7 font-lg"
                                />
                            </div>
                            <span v-show="amountValidation" class="text-red-500"
                                ><li>
                                    Minimum of 30,000 and maximum of 100,000
                                </li></span
                            >
                        </div>

                        <p class="mt-6 mb-1 text-lg font-semibold">
                            Upload requirements
                        </p>
                        <p class="mb-5 text-sm italic">
                            *Total maximum size for uploading is 30mb
                        </p>
                        <p class="mt-4 mb-1 text-lg">
                            <span class="text-red-500">*</span>
                            Member's Payslip for Validation<span
                                class="text-sm italic font-thin"
                                >Must be image file (jpg,jpeg)</span
                            >
                        </p>
                        <div
                            class="w-6/12 mb-5 border-2 border-gray-400 border-opacity-50 rounded-md hover:border-indigo-500"
                        >
                            <input
                                required
                                @change="onChange"
                                type="file"
                                accept=".png, .jpg, .jpeg, .pdf, .docx"
                                class="block w-full text-[0.8rem] text-slate-500 file:mr-2 file:py-2 file:px-1 file:border-0 file:text-md file:font-semibold file:bg-gray-200 file:text-gray-500 hover:file:bg-gray-300"
                            />
                        </div>
                        <p class="mb-1 text-lg">
                            <span class="text-red-500">*</span>
                            Upload Photo of you Including the Place to be
                            Improved/Repaired
                            <span class="text-sm italic font-thin"
                                >Must be image file (jpg,jpeg)</span
                            >
                        </p>
                        <div
                            class="w-6/12 mb-5 border-2 border-gray-400 border-opacity-50 rounded-md hover:border-indigo-500"
                        >
                            <input
                                required
                                @change="onChange2"
                                type="file"
                                accept=".png, .jpg, .jpeg, .pdf, .docx"
                                class="block w-full text-[0.8rem] text-slate-500 file:mr-2 file:py-2 file:px-1 file:border-0 file:text-md file:font-semibold file:bg-gray-200 file:text-gray-500 hover:file:bg-gray-300"
                            />
                        </div>
                        <p class="mb-1 text-lg">
                            <span class="text-red-500">*</span>
                            Upload Laborer's Quotation
                            <span class="text-sm italic font-thin"
                                >Must be image file (jpg,jpeg)</span
                            >
                        </p>
                        <div
                            class="w-6/12 mb-5 border-2 border-gray-400 border-opacity-50 rounded-md hover:border-indigo-500"
                        >
                            <input
                                @change="onChange3"
                                type="file"
                                accept=".png, .jpg, .jpeg, .pdf, .docx"
                                class="block w-full text-[0.8rem] text-slate-500 file:mr-2 file:py-2 file:px-1 file:border-0 file:text-md file:font-semibold file:bg-gray-200 file:text-gray-500 hover:file:bg-gray-300"
                            />
                        </div>
                        <div class="flex justify-center">
                            <button
                                type="button"
                                @click="submit"
                                class="w-64 px-4 py-2 mb-5 text-lg font-semibold text-center text-yellow-500 transition duration-150 ease-in bg-red-800 rounded-lg shadow-md hover:bg-red-700 focus:ring focus:ring-indigo-300"
                            >
                                Submit
                            </button>
                        </div>
                    </form>

                    <!-- Loan For Educational -->
                    <form
                        @submit.prevent="submit"
                        v-if="form.loan_type == 'Educational Loan'"
                        class="p-6 sm:px-20 bg-white border-b border-gray-200 mt-[-40px]"
                    >
                        <div class="mb-5">
                            <label
                                class="mb-1 text-lg text-gray-700"
                                for="amount"
                                >Amount(Maximum of 30,000)</label
                            ><br />
                            <div class="relative w-64 mt-1 rounded-md">
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
                                >
                                    <span class="text-lg text-gray-500">
                                        ₱
                                    </span>
                                </div>
                                <input
                                    required
                                    v-model="form.amount"
                                    @change="onChangeAmount"
                                    type="number"
                                    placeholder="0.00"
                                    class="block w-64 pr-12 text-black border-2 border-gray-400 border-opacity-50 rounded-md focus:ring-indigo-500 hover:border-indigo-500 pl-7 font-lg"
                                />
                            </div>
                            <span v-show="amountValidation" class="text-red-500"
                                ><li>Maximum of 30,000</li></span
                            >
                        </div>
                        <p class="mt-6 mb-1 text-lg font-semibold">
                            Upload Requirements
                        </p>
                        <p class="mb-5 text-sm italic">
                            *Total maximum size for uploading is 30mb
                        </p>
                        <div class="flex">
                            <input
                                v-model="forRelative"
                                class="w-5 h-5"
                                type="checkbox"
                            />

                            <span class="px-2 text-xl text-center"
                                >For Relative</span
                            >
                        </div>

                        <p class="mb-1 text-lg">
                            <span class="text-red-500">*</span>
                            Member's Payslip for Validation
                            <span class="text-sm italic font-thin">
                                Must be image file (jpg,jpeg)</span
                            >
                        </p>
                        <div
                            class="w-6/12 mb-5 border-2 border-gray-400 border-opacity-50 rounded-md hover:border-indigo-500"
                        >
                            <input
                                @change="onChange"
                                type="file"
                                accept=".png, .jpg, .jpeg, .pdf, .docx"
                                class="block w-full text-[0.8rem] text-slate-500 file:mr-2 file:py-2 file:px-1 file:border-0 file:text-md file:font-semibold file:bg-gray-200 file:text-gray-500 hover:file:bg-gray-300"
                            />
                        </div>

                        <p v-if="this.forRelative == true" class="mb-1 text-lg">
                            <span class="text-red-500">*</span>
                            Upload Proof of Relation (Birth Certificate in Case
                            of Relatives)
                            <span class="text-sm italic font-thin">
                                Must be image file (jpg,jpeg)</span
                            >
                        </p>
                        <div
                            v-if="this.forRelative == true"
                            class="w-6/12 mb-5 border-2 border-gray-400 border-opacity-50 rounded-md hover:border-indigo-500"
                        >
                            <!-- <form @submit.prevent="sendMessage"> -->
                            <input
                                @change="onChange2"
                                type="file"
                                required
                                accept=".png, .jpg, .jpeg, .pdf, .docx"
                                class="block w-full text-[0.8rem] text-slate-500 file:mr-2 file:py-2 file:px-1 file:border-0 file:text-md file:font-semibold file:bg-gray-200 file:text-gray-500 hover:file:bg-gray-300"
                                multiple
                            />
                            <!-- </form> -->
                        </div>
                        <p class="mb-1 text-lg">
                            <span class="text-red-500">*</span>
                            Upload Certificate of Enrollment and Statement of
                            Account from School
                            <span class="text-sm italic font-thin">
                                Must be image file (jpg,jpeg)</span
                            >
                        </p>
                        <div
                            class="w-6/12 mb-5 border-2 border-gray-400 border-opacity-50 rounded-md hover:border-indigo-500"
                        >
                            <input
                                @change="onChange3"
                                type="file"
                                accept=".png, .jpg, .jpeg, .pdf, .docx"
                                class="block w-full text-[0.8rem] text-slate-500 file:mr-2 file:py-2 file:px-1 file:border-0 file:text-md file:font-semibold file:bg-gray-200 file:text-gray-500 hover:file:bg-gray-300"
                                multiple
                            />
                        </div>

                        <div class="flex justify-center">
                            <button
                                type="submit"
                                class="w-64 px-4 py-2 mb-5 text-lg font-semibold text-center text-yellow-500 transition duration-150 ease-in bg-red-800 rounded-lg shadow-md hover:bg-red-700 focus:ring focus:ring-indigo-300"
                            >
                                Submit
                            </button>
                        </div>
                    </form>

                    <!-- Loan For Emergencies -->
                    <form
                        @submit.prevent="submit"
                        v-if="form.loan_type == 'Emergency Loan'"
                        class="p-6 sm:px-20 bg-white borsder-b border-gray-200 mt-[-40px]"
                    >
                        <p class="mb-1 text-lg">Terms (Months)</p>
                        <select
                            v-model="emergencyForm.terms"
                            class="mb-5 transition duration-150 ease-in border-2 border-gray-400 border-opacity-50 rounded-md hover:border-indigo-500"
                        >
                            <option value="12">12</option>
                            <option value="24">24</option>
                        </select>
                        <div class="mb-5">
                            <label class="mb-1 text-lg" for="amount"
                                >Amount(Maximum of 30,000)</label
                            ><br />
                            <div class="relative w-64 mt-1 rounded-md">
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
                                >
                                    <span class="text-lg text-gray-500">
                                        ₱
                                    </span>
                                </div>
                                <input
                                    v-model="emergencyForm.amount"
                                    @change="onChangeAmount"
                                    type="number"
                                    placeholder="0.00"
                                    class="block w-64 pr-12 text-black border-2 border-gray-400 border-opacity-50 rounded-md focus:ring-indigo-500 hover:border-indigo-500 pl-7 font-lg"
                                />
                            </div>
                            <span v-show="amountValidation" class="text-red-500"
                                ><li>Maximum of 30,000</li></span
                            >
                        </div>
                        <p class="mt-6 mb-1 text-lg font-semibold">
                            Upload Requirements
                        </p>
                        <p class="mb-5 text-sm italic">
                            *Total maximum size for uploading is 30mb
                        </p>

                        <p class="mb-1 text-lg">
                            Member's Payslip for Validation
                            <span class="text-sm italic font-thin">
                                Must be image file (jpg,jpeg)</span
                            >
                        </p>
                        <div
                            class="w-6/12 mb-5 border-2 border-gray-400 border-opacity-50 rounded-md hover:border-indigo-500"
                        >
                            <input
                                @change="onChange1"
                                type="file"
                                accept=".png, .jpg, .jpeg, .pdf, .docx"
                                class="block w-full text-[0.8rem] text-slate-500 file:mr-2 file:py-2 file:px-1 file:border-0 file:text-md file:font-semibold file:bg-gray-200 file:text-gray-500 hover:file:bg-gray-300"
                            />
                        </div>

                        <div class="flex justify-center">
                            <button
                                type="submit"
                                class="w-64 px-4 py-2 mb-5 text-lg font-semibold text-center text-yellow-500 transition duration-150 ease-in bg-red-800 rounded-lg shadow-md hover:bg-red-700 focus:ring focus:ring-indigo-300"
                            >
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
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
        <!-- </form> -->
        <!-- Guidelines -->
        <Modal :show="showModal" :closeable="true">
            <!-- Housing Loan Guidelines -->
            <div v-if="form.loan_type == 'Housing Loan'" class="p-5">
                <div
                    class="flex justify-center my-3 text-xl font-bold text-gray-900"
                >
                    <span>Guidelines : {{ form.loan_type }}</span>
                </div>
                <br />
                <div
                    class="flex my-3 font-bold text-gray-900 justify-left text-l"
                >
                    <span><u>MITRF LOAN TERMS AND CONDITIONS</u> </span>
                </div>
                <br />
                <div
                    class="flex my-3 font-bold text-gray-900 justify-left text-m"
                >
                    <span>Eligibility Requirements </span>
                </div>
                <div class="flex my-3 text-gray-900 justify-left text-s">
                    <span
                        >1. Member-borrower must be a regular employee of the
                        institute and contributing 5% of his monthly basic
                        salary to MITRF.
                    </span>
                </div>
                <div class="flex my-3 text-gray-900 justify-left text-s">
                    <span
                        >2. Member-borrower must maintain at least 45% net take
                        home pay after deducting all his obligations including
                        the MITRF amortization.
                    </span>
                </div>
                <br />
                <div
                    class="flex my-3 font-bold text-gray-900 justify-left text-m"
                >
                    <span>Loan Amount </span>
                </div>
                <div class="flex my-3 text-gray-900 justify-left text-s">
                    <span
                        >1. The maximum amount shall be the total
                        member-follower's fund contribution and earnings.
                    </span>
                </div>
                <br />
                <div
                    class="flex my-3 font-bold text-gray-900 justify-left text-m"
                >
                    <span>Housing Assistance </span>
                </div>
                <div class="flex my-3 text-gray-900 justify-left text-s">
                    <span
                        >For housing, Loan requirements are the following:
                        (30,000 - 100,000 maximum, 1-2 years term)
                    </span>
                </div>
                <div class="flex my-3 text-gray-900 justify-left text-s">
                    <span>1. Application Form </span>
                </div>
                <div class="flex my-3 text-gray-900 justify-left text-s">
                    <span
                        >2. Photo of you including the place to be
                        improved/repaired.
                    </span>
                </div>
                <div class="flex my-3 text-gray-900 justify-left text-s">
                    <span>3. Laborer's quotation. </span>
                </div>
                <br />
                <div class="flex my-3 text-gray-900 justify-left text-s">
                    <span
                        ><u
                            ><i
                                >This loan have a 9% interest per annum and a 2%
                                service fee</i
                            ></u
                        >
                    </span>
                </div>
                <div
                    class="flex my-3 font-bold text-gray-900 justify-left text-s"
                >
                    <span
                        ><u
                            >Note: It cannot be loaned at the same time with
                            Education Loan.</u
                        >
                    </span>
                </div>

                <div></div>
                <div
                    class="flex justify-center my-3 space-x-40 text-xl font-bold dark:text-gray-200"
                >
                    <!-- Accept Button -->
                    <div
                        @click="accept"
                        class="flex px-4 py-1 space-x-2 text-sm font-semibold leading-snug text-green-600 uppercase border border-green-600 rounded-full cursor-pointer dark:text-green-600 dark:border-green-600 dark:hover:text-gray-200 hover:bg-green-500"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="currentColor"
                            class="bi bi-check2-all"
                            viewBox="0 0 16 16"
                        >
                            <path
                                d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z"
                            />
                            <path
                                d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z"
                            />
                        </svg>
                        <span>Accept</span>
                    </div>
                </div>
            </div>

            <!-- Educational Loan Guidelines -->
            <div v-if="form.loan_type == 'Educational Loan'" class="p-5">
                <div
                    class="flex justify-center my-3 text-xl font-bold text-gray-900"
                >
                    <span>Guidelines : {{ form.loan_type }}</span>
                </div>
                <br />
                <div
                    class="flex my-3 font-bold text-gray-900 justify-left text-l"
                >
                    <span><u>MITRF LOAN TERMS AND CONDITIONS</u> </span>
                </div>
                <br />
                <div
                    class="flex my-3 font-bold text-gray-900 justify-left text-m"
                >
                    <span>Eligibility Requirements </span>
                </div>
                <div class="flex my-3 text-gray-900 justify-left text-s">
                    <span
                        >1. Member-borrower must be a regular employee of the
                        institute and contributing 5% of his monthly basic
                        salary to MITRF.
                    </span>
                </div>
                <div class="flex my-3 text-gray-900 justify-left text-s">
                    <span
                        >2. Member-borrower must maintain at least 45% net take
                        home pay after deducting all his obligations including
                        the MITRF amortization.
                    </span>
                </div>

                <br />
                <div
                    class="flex my-3 font-bold text-gray-900 justify-left text-m"
                >
                    <span>Loan Amount </span>
                </div>

                <div class="flex my-3 text-gray-900 justify-left text-s">
                    <span
                        >1. The maximum amount shall be the total
                        member-follower's fund contribution and earnings.
                    </span>
                </div>

                <br />
                <div
                    class="flex my-3 font-bold text-gray-900 justify-left text-m"
                >
                    <span>Education Assistance </span>
                </div>

                <div class="flex my-3 text-gray-900 justify-left text-s">
                    <span
                        >For Education, Loan requirements are the following:
                        (30,000 maximum, 1 year term)
                    </span>
                </div>
                <div class="flex my-3 text-gray-900 justify-left text-s">
                    <span>1. Application Form </span>
                </div>
                <div class="flex my-3 text-gray-900 justify-left text-s">
                    <span
                        >2. Proof of relation (Birth certificate in case of
                        relatives).
                    </span>
                </div>
                <div class="flex my-3 text-gray-900 justify-left text-s">
                    <span
                        >3. Certificate of Enrollment and Statement of Account
                        from school.
                    </span>
                </div>
                <br />
                <div class="flex my-3 text-gray-900 justify-left text-s">
                    <span
                        ><u
                            ><i
                                >This loan have a 9% interest per annum and a 2%
                                service fee</i
                            ></u
                        >
                    </span>
                </div>
                <div
                    class="flex my-3 font-bold text-gray-900 justify-left text-s"
                >
                    <span
                        ><u
                            >Note: It cannot be loaned at the same time with
                            Housing Loan.</u
                        >
                    </span>
                </div>
                <div
                    class="flex justify-center my-3 text-xl font-bold dark:text-gray-200"
                >
                    <div
                        @click="accept"
                        class="flex px-4 py-1 space-x-2 text-sm font-semibold leading-snug text-green-600 uppercase border border-green-600 rounded-full cursor-pointer dark:text-green-600 dark:border-green-600 dark:hover:text-gray-200 hover:bg-green-500"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="currentColor"
                            class="bi bi-check2-all"
                            viewBox="0 0 16 16"
                        >
                            <path
                                d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z"
                            />
                            <path
                                d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z"
                            />
                        </svg>
                        <span>Accept</span>
                    </div>
                </div>
            </div>

            <!-- Emergency Loan Guidelines -->
            <div v-if="form.loan_type == 'Emergency Loan'" class="p-5">
                <div
                    class="flex justify-center my-3 text-xl font-bold text-gray-900"
                >
                    <span>Guidelines : {{ form.loan_type }}</span>
                </div>
                <br />
                <div
                    class="flex my-3 font-bold text-gray-900 justify-left text-l"
                >
                    <span><u>MITRF LOAN TERMS AND CONDITIONS</u> </span>
                </div>
                <br />
                <div
                    class="flex my-3 font-bold text-gray-900 justify-left text-m"
                >
                    <span>Eligibility Requirements </span>
                </div>
                <div class="flex my-3 text-gray-900 justify-left text-s">
                    <span
                        >1. Member-borrower must be a regular employee of the
                        institute and contributing 5% of his monthly basic
                        salary to MITRF.
                    </span>
                </div>
                <div class="flex my-3 text-gray-900 justify-left text-s">
                    <span
                        >2. Member-borrower must maintain at least 45% net take
                        home pay after deducting all his obligations including
                        the MITRF amortization.
                    </span>
                </div>

                <br />
                <div
                    class="flex my-3 font-bold text-gray-900 justify-left text-m"
                >
                    <span>Loan Amount </span>
                </div>

                <div class="flex my-3 text-gray-900 justify-left text-s">
                    <span
                        >1. The maximum amount shall be the total
                        member-follower's fund contribution and earnings.
                    </span>
                </div>

                <br />
                <div
                    class="flex my-3 font-bold text-gray-900 justify-left text-m"
                >
                    <span>Emergency Assistance </span>
                </div>

                <div class="flex my-3 text-gray-900 justify-left text-s">
                    <span
                        >For emergency, Loan requirements are the following:
                        (30,000 maximum, 1-2 years term)
                    </span>
                </div>
                <div class="flex my-3 text-gray-900 justify-left text-s">
                    <span>1. Application Form </span>
                </div>
                <div class="flex my-3 text-gray-900 justify-left text-s">
                    <span>2. 4.5% interest for a 2-year term. </span>
                </div>
                <div class="flex my-3 text-gray-900 justify-left text-s">
                    <span>3. 2.25% interest for a 1-year term. </span>
                </div>
                <div class="flex my-3 text-gray-900 justify-left text-s">
                    <span
                        >4. 45% threshold of net pay is not applicable but must
                        not be zero or negative.
                    </span>
                </div>

                <div
                    class="flex justify-center my-3 space-x-40 text-xl font-bold dark:text-gray-200"
                >
                    <!-- Accept Button -->
                    <div
                        @click="accept"
                        class="flex px-4 py-1 space-x-2 text-sm font-semibold leading-snug text-green-600 uppercase border border-green-600 rounded-full cursor-pointer dark:text-green-600 dark:border-green-600 dark:hover:text-gray-200 hover:bg-green-500"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="currentColor"
                            class="bi bi-check2-all"
                            viewBox="0 0 16 16"
                        >
                            <path
                                d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z"
                            />
                            <path
                                d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z"
                            />
                        </svg>
                        <span>Accept</span>
                    </div>
                </div>
            </div>

            <!-- Submit modal -->
        </Modal>
        <Modal
            :show="submitModal"
            :closeable="true"
            @close="submitModal = !submitModal"
        >
            <div class="p-5">
                <div
                    class="flex justify-between my-2 text-xl font-bold text-gray-900"
                >
                    <span>Data Privacy Compliance</span>
                    <div
                        class="flex my-5 font-normal text-justify text-gray-900"
                    ></div>
                    <svg
                        @click="submitModal = !submitModal"
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 cursor-pointer"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </div>
                <div class="text-justify">
                    <span
                        >I hereby agree to submit my documents and to allow
                        MITRFI and its authorized personnel to process my
                        documents and personal information for specifically for
                        purposes of
                        <span class="font-bold">{{ this.form.loan_type }}</span
                        >, in compliance with the Data Privacy Act of 2012 and
                        MITRFI policies. Acceptance of the document/s does not
                        automatically guarantee approval as the application
                        shall be subject to the evaluation and approval of the
                        MITFRI based on its loan policies.</span
                    >
                </div>
                <div
                    class="flex justify-center my-3 text-xl font-bold dark:text-gray-200"
                >
                    <div
                        @click="proceed"
                        class="flex px-4 py-1 space-x-2 text-sm font-semibold leading-snug text-green-600 uppercase border border-green-600 rounded-full cursor-pointer dark:text-green-600 dark:border-green-600 dark:hover:text-gray-200 hover:bg-green-500"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="currentColor"
                            class="bi bi-check2-all"
                            viewBox="0 0 16 16"
                        >
                            <path
                                d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z"
                            />
                            <path
                                d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z"
                            />
                        </svg>
                        <span>Submit</span>
                    </div>
                </div>
            </div>
        </Modal>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Modal from "@/Jetstream/Modal";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import { Link } from "@inertiajs/inertia-vue3";

export default {
    props: {
        users: Object,
        notification: Object,
        count: Number,
    },

    components: {
        AppLayout,
        Modal,
        Link,
        JetValidationErrors,
    },
    setup() {},

    data() {
        return {
            amountValidation: false,
            isSubmiting: false,
            showModal: false,
            submitModal: false,
            forRelative: false,
            total_amount: 0,

            membership: this.$props.users.admin_reg.membership,

            loanTypes: ["Housing Loan", "Educational Loan"],

            form: this.$inertia.form({
                loan_type: "",
                amount: "",
                loan_amount: "",
                terms: "",
                interest: "",
                attachment1: "",
                attachment2: "",
                attachment3: "",
            }),
            educationalForm: this.$inertia.form({
                loan_type: "",
                amount: "",
                loan_amount: "",
                terms: "",
                interest: "",
                attachment1: "",
                attachment3: "",
            }),

            emergencyForm: this.$inertia.form({
                loan_type: "",
                amount: "",
                loan_amount: "",
                terms: "",
                interest: "",
                attachment1: "",
            }),
        };
    },
    methods: {
        accept() {
            console.log("clicked_accept");
            this.showModal = false;
        },
        onChange(e) {
            console.log("Selected File 1", e.target.files[0]);
            if (this.form.loan_type == "Educational Loan") {
                if (this.forRelative == true) {
                    this.form.attachment1 = e.target.files[0];
                } else {
                    this.educationalForm.attachment1 = e.target.files[0];
                }
            } else {
                this.form.attachment1 = e.target.files[0];
            }
        },
        onChange1(e) {
            console.log("Selected File 1", e.target.files[0]);

            this.emergencyForm.attachment1 = e.target.files[0];
        },
        onChange2(e) {
            console.log("Selected File 2", e.target.files[0]);
            this.form.attachment2 = e.target.files[0];
        },
        onChange3(e) {
            console.log("Selected File 3", e.target.files[0]);
            if (this.form.loan_type == "Educational Loan") {
                if (this.forRelative == true) {
                    this.form.attachment3 = e.target.files[0];
                } else {
                    this.educationalForm.attachment3 = e.target.files[0];
                }
            } else {
                this.form.attachment3 = e.target.files[0];
            }
        },

        // onChange4(e) {
        //   console.log("Selected File 4", e.target.files[0]);
        //   this.form.attachment4 = e.target.files[0];
        // },

        submit() {
            this.submitModal = true;
            if (this.form.loan_type == "Housing Loan") {
                if (this.form.terms == 12) {
                    let interest = 0.0475473;
                    this.form.interest = (
                        interest *
                        (this.form.terms / 12)
                    ).toFixed(7);
                    this.form.loan_amount = (
                        this.form.amount +
                        this.form.amount * this.form.interest
                    ).toFixed(2);
                } else {
                    let interest = 0.0945673;
                    this.form.interest = (
                        interest *
                        (this.form.terms / 24)
                    ).toFixed(7);
                    this.form.loan_amount = (
                        this.form.amount +
                        this.form.amount * this.form.interest
                    ).toFixed(2);
                }
            } else if (this.form.loan_type == "Educational Loan") {
                if (this.forRelative == true) {
                    let interest = 0.0475473;
                    this.form.terms = 12;
                    this.form.interest = (
                        interest *
                        (this.form.terms / 12)
                    ).toFixed(7);
                    this.form.loan_amount = (
                        this.form.amount +
                        this.form.amount * this.form.interest
                    ).toFixed(2);
                } else {
                    let interest = 0.0475473;
                    this.educationalForm.terms = 12;
                    this.educationalForm.amount = this.form.amount;
                    this.educationalForm.loan_type = "Educational Loan";
                    this.educationalForm.interest = (
                        interest *
                        (this.educationalForm.terms / 12)
                    ).toFixed(7);
                    this.educationalForm.loan_amount =
                        this.educationalForm.amount +
                        this.educationalForm.amount *
                            this.educationalForm.interest;
                }
            } else {
                let interest = 0.0225;
                this.emergencyForm.loan_type = "Emergency Loan";
                this.emergencyForm.interest =
                    interest * (this.emergencyForm.terms / 12);
                this.emergencyForm.loan_amount =
                    this.emergencyForm.amount +
                    this.emergencyForm.amount * this.emergencyForm.interest;
            }
        },

        onChangeAmount() {
            console.log(this.emergencyForm.amount);
            console.log(this.form.loan_type);
            if (this.form.loan_type != "Emergency Loan") {
                if (this.form.loan_type == "Housing Loan") {
                    if (
                        this.form.amount >= 30000 &&
                        this.form.amount <= 100000
                    ) {
                        this.amountValidation = false;
                        console.log(true);
                    } else {
                        this.amountValidation = true;
                        console.log(false);
                    }
                } else if (this.form.loan_type == "Educational Loan") {
                    if (this.form.amount <= 30000) {
                        this.amountValidation = false;
                    } else {
                        this.amountValidation = true;
                        console.log(false);
                    }
                }
            } else {
                if (this.emergencyForm.amount <= 30000) {
                    this.amountValidation = false;
                } else {
                    this.amountValidation = true;
                    console.log(false);
                }
            }
        },

        proceed() {
            if (this.form.loan_type != "Emergency Loan") {
                if (this.form.loan_type == "Housing Loan") {
                    if (
                        this.form.amount >= 30000 &&
                        this.form.amount <= 100000
                    ) {
                        // if(this.forRelative == true){
                        this.form.post(route("createLoans"), {
                            onStart: (visit) => {
                                this.isSubmiting == true;
                            },
                            onFinish: (visit) => {
                                this.isSubmiting == false;
                            },
                        });
                    } else {
                        this.amountValidation = true;
                        this.submitModal = false;
                    }
                }

                if (this.form.loan_type == "Educational Loan") {
                    if (this.form.amount <= 30000) {
                        if (this.forRelative == true) {
                            this.form.post(route("createLoansWithRelative"), {
                                onStart: (visit) => {
                                    this.isSubmiting == true;
                                },
                                onFinish: (visit) => {
                                    this.isSubmiting == false;
                                },
                            });
                        } else {
                            this.educationalForm.post(route("educational"), {
                                onStart: (visit) => {
                                    this.isSubmiting == true;
                                },
                                onFinish: (visit) => {
                                    this.isSubmiting == false;
                                },
                            });
                        }
                    } else {
                        this.amountValidation = true;
                        this.submitModal = false;
                    }
                }
            } else {
                // if (this.form.loan_type == "Emergency Loan") {
                if (this.emergencyForm.amount <= 30000) {
                    this.emergencyForm.post(route("emergency"), {
                        onStart: (visit) => {
                            this.isSubmiting == true;
                        },
                        onFinish: (visit) => {
                            this.isSubmiting == false;
                        },
                    });
                } else {
                    this.amountValidation = true;
                    this.submitModal = false;
                }
                // }
            }

            console.log("clicked");
            this.submitModal = false;
        },
    },
};
</script>

<style scoped>
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>
