<template>
  <AppLayout>
    <template #header>
      <div class="flex items-center">
        <Link :href="route('loansView')" class="hover:underline">
          <h1 class="font-extrabold text-xl text-gray-800 leading-tight">
            Current Loan
          </h1>
        </Link>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-6 w-6"
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
        <h1 class="font-extrabold text-xl text-gray-800 leading-tight">
          Apply For Loan
        </h1>
      </div>
    </template>
    <!-- <form @submit.prevent="submit"> -->
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <JetValidationErrors class="mb-4" />
          <div class="ml-6 lg:ml-20 mt-10">
            <p class="mb-1 mt-4 text-lg">Purpose of Loan</p>
            <select
              v-model="form.loan_type"
              @change="showModal = !showModal"
              class="border-2 border-gray-400 border-opacity-50 hover:border-indigo-500 transition ease-in duration-150 rounded-md mb-10"
            >
              <option value="placeholder" disabled>Select Loan Type</option>
              <option v-for="type in loanTypes" v-bind:key="type" :value="type">
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
              class="mb-5 border-2 border-gray-400 border-opacity-50 hover:border-indigo-500 transition ease-in duration-150 rounded-md"
            >
              <option value="12">12</option>
              <option value="24">24</option>
            </select>
            <div class="mb-5">
              <label class="mb-1 text-lg text-gray-700" for="amount"
                >Amount(Minimum of 30,000 and maximum of 100,000)</label
              ><br />

              <div class="mt-1 relative w-64 rounded-md">
                <div
                  class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                >
                  <span class="text-gray-500 text-lg"> ₱ </span>
                </div>
                <input
                  v-model="form.amount"
                  @change="onChangeAmount"
                  type="number"
                  placeholder="0.00"
                  class="focus:ring-indigo-500 border-2 border-opacity-50 border-gray-400 hover:border-indigo-500 text-black block pl-7 pr-12 w-64 font-lg rounded-md"
                />
              </div>
              <span v-show="amountValidation" class="text-red-500"
                ><li>Minimum of 30,000 and maximum of 100,000</li></span
              >
            </div>
            <p class="mb-1 text-lg mt-6 font-semibold">Upload requirements</p>
            <p class="italic text-sm mb-5">
              *Total maximum size for uploading is 30mb
            </p>
            <p class="mb-1 text-lg mt-4">
              Member's Payslip for Validation<span
                class="text-sm italic font-thin"
                >Must be image file (jpg,jpeg)</span
              >
            </p>
            <div
              class="border-2 border-gray-400 border-opacity-50 hover:border-indigo-500 w-6/12 rounded-md mb-5"
            >
              <input
                @change="onChange"
                type="file"
                accept=".png, .jpg, .jpeg, .pdf, .docx"
                class="block w-full text-[0.8rem] text-slate-500 file:mr-2 file:py-2 file:px-1 file:border-0 file:text-md file:font-semibold file:bg-gray-200 file:text-gray-500 hover:file:bg-gray-300"
              />
            </div>
            <p class="mb-1 text-lg">
              Upload Photo of you Including the Place to be Improved/Repaired
              <span class="text-sm italic font-thin"
                >Must be image file (jpg,jpeg)</span
              >
            </p>
            <div
              class="border-2 border-gray-400 border-opacity-50 hover:border-indigo-500 w-6/12 rounded-md mb-5"
            >
              <input
                @change="onChange2"
                type="file"
                accept=".png, .jpg, .jpeg, .pdf, .docx"
                class="block w-full text-[0.8rem] text-slate-500 file:mr-2 file:py-2 file:px-1 file:border-0 file:text-md file:font-semibold file:bg-gray-200 file:text-gray-500 hover:file:bg-gray-300"
              />
            </div>
            <p class="mb-1 text-lg">
              Upload Laborer's Quotation
              <span class="text-sm italic font-thin"
                >Must be image file (jpg,jpeg)</span
              >
            </p>
            <div
              class="border-2 border-gray-400 border-opacity-50 hover:border-indigo-500 w-6/12 rounded-md mb-5"
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
                class="py-2 px-4 mb-5 bg-red-800 hover:bg-red-700 focus:ring focus:ring-indigo-300 text-yellow-500 w-64 transition ease-in duration-150 text-lg text-center font-semibold shadow-md rounded-lg"
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
              <label class="mb-1 text-lg text-gray-700" for="amount"
                >Amount(Maximum of 30,000)</label
              ><br />
              <div class="mt-1 relative w-64 rounded-md">
                <div
                  class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                >
                  <span class="text-gray-500 text-lg"> ₱ </span>
                </div>
                <input
                  required
                  v-model="form.amount"
                  @change="onChangeAmount"
                  type="number"
                  placeholder="0.00"
                  class="focus:ring-indigo-500 border-2 border-opacity-50 border-gray-400 hover:border-indigo-500 text-black block pl-7 pr-12 w-64 font-lg rounded-md"
                />
              </div>
              <span v-show="amountValidation" class="text-red-500"
                ><li>Maximum of 30,000</li></span
              >
            </div>
            <p class="mb-1 text-lg mt-6 font-semibold">Upload Requirements</p>
            <p class="italic text-sm mb-5">
              *Total maximum size for uploading is 30mb
            </p>
            <div class="flex">
              <input v-model="forRelative" class="w-5 h-5" type="checkbox" />

              <span class="text-center text-xl px-2">For Relative</span>
            </div>

            <p class="mb-1 text-lg">
              Member's Payslip for Validation
              <span class="italic font-thin text-sm">
                Must be image file (jpg,jpeg)</span
              >
            </p>
            <div
              class="border-2 border-gray-400 border-opacity-50 hover:border-indigo-500 w-6/12 rounded-md mb-5"
            >
              <input
                @change="onChange"
                type="file"
                accept=".png, .jpg, .jpeg, .pdf, .docx"
                class="block w-full text-[0.8rem] text-slate-500 file:mr-2 file:py-2 file:px-1 file:border-0 file:text-md file:font-semibold file:bg-gray-200 file:text-gray-500 hover:file:bg-gray-300"
              />
            </div>

            <p v-if="this.forRelative == true" class="mb-1 text-lg">
              Upload Proof of Relation (Birth Certificate in Case of Relatives)
              <span class="italic font-thin text-sm">
                Must be image file (jpg,jpeg)</span
              >
            </p>
            <div
              v-if="this.forRelative == true"
              class="border-2 border-gray-400 border-opacity-50 hover:border-indigo-500 w-6/12 rounded-md mb-5"
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
              Upload Certificate of Enrollment and Statement of Account from
              School
              <span class="italic font-thin text-sm">
                Must be image file (jpg,jpeg)</span
              >
            </p>
            <div
              class="border-2 border-gray-400 border-opacity-50 hover:border-indigo-500 w-6/12 rounded-md mb-5"
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
                class="py-2 px-4 mb-5 bg-red-800 hover:bg-red-700 focus:ring focus:ring-indigo-300 text-yellow-500 w-64 transition ease-in duration-150 text-lg text-center font-semibold shadow-md rounded-lg"
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
              class="mb-5 border-2 border-gray-400 border-opacity-50 hover:border-indigo-500 transition ease-in duration-150 rounded-md"
            >
              <option value="12">12</option>
              <option value="24">24</option>
            </select>
            <div class="mb-5">
              <label class="mb-1 text-lg" for="amount"
                >Amount(Maximum of 30,000)</label
              ><br />
              <div class="mt-1 relative w-64 rounded-md">
                <div
                  class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                >
                  <span class="text-gray-500 text-lg"> ₱ </span>
                </div>
                <input
                  v-model="emergencyForm.amount"
                  @change="onChangeAmount"
                  type="number"
                  placeholder="0.00"
                  class="focus:ring-indigo-500 border-2 border-opacity-50 border-gray-400 hover:border-indigo-500 text-black block pl-7 pr-12 w-64 font-lg rounded-md"
                />
              </div>
              <span v-show="amountValidation" class="text-red-500"
                ><li>Maximum of 30,000</li></span
              >
            </div>
            <p class="mb-1 text-lg mt-6 font-semibold">Upload Requirements</p>
            <p class="italic text-sm mb-5">
              *Total maximum size for uploading is 30mb
            </p>

            <p class="mb-1 text-lg">
              Member's Payslip for Validation
              <span class="italic font-thin text-sm">
                Must be image file (jpg,jpeg)</span
              >
            </p>
            <div
              class="border-2 border-gray-400 border-opacity-50 hover:border-indigo-500 w-6/12 rounded-md mb-5"
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
                class="py-2 px-4 mb-5 bg-red-800 hover:bg-red-700 focus:ring focus:ring-indigo-300 text-yellow-500 w-64 transition ease-in duration-150 text-lg text-center font-semibold shadow-md rounded-lg"
              >
                Submit
              </button>
            </div>
          </form>
        </div>
      </div>
      <div class="flex justify-center px-6 py-4 whitespace-nowrap">
        <div
          class="flex space-x-2 mr-5 px-4 py-1 border text-md text-red-600 dark:text-red-600 dark:border-red-600 border-red-600 uppercase rounded-full dark:hover:text-gray-200 hover:text-white hover:border-none hover:bg-red-500 cursor-pointer"
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
        <div class="flex justify-center text-xl font-bold text-gray-900 my-3">
          <span>Guidelines : {{ form.loan_type }}</span>
        </div>
        <br />
        <div class="flex justify-left text-l font-bold text-gray-900 my-3">
          <span><u>MITRF LOAN TERMS AND CONDITIONS</u> </span>
        </div>
        <br />
        <div class="flex justify-left text-m font-bold text-gray-900 my-3">
          <span>Eligibility Requirements </span>
        </div>
        <div class="flex justify-left text-s text-gray-900 my-3">
          <span
            >1. Member-borrower must be a regular employee of the institute and
            contributing 5% of his monthly basic salary to MITRF.
          </span>
        </div>
        <div class="flex justify-left text-s text-gray-900 my-3">
          <span
            >2. Member-borrower must maintain at least 45% net take home pay
            after deducting all his obligations including the MITRF
            amortization.
          </span>
        </div>
        <br />
        <div class="flex justify-left text-m font-bold text-gray-900 my-3">
          <span>Loan Amount </span>
        </div>
        <div class="flex justify-left text-s text-gray-900 my-3">
          <span
            >1. The maximum amount shall be the total member-follower's fund
            contribution and earnings.
          </span>
        </div>
        <br />
        <div class="flex justify-left text-m font-bold text-gray-900 my-3">
          <span>Housing Assistance </span>
        </div>
        <div class="flex justify-left text-s text-gray-900 my-3">
          <span
            >For housing, Loan requirements are the following: (30,000 - 100,000
            maximum, 1-2 years term)
          </span>
        </div>
        <div class="flex justify-left text-s text-gray-900 my-3">
          <span>1. Application Form </span>
        </div>
        <div class="flex justify-left text-s text-gray-900 my-3">
          <span
            >2. Photo of you including the place to be improved/repaired.
          </span>
        </div>
        <div class="flex justify-left text-s text-gray-900 my-3">
          <span>3. Laborer's quotation. </span>
        </div>
        <br />
        <div class="flex justify-left text-s text-gray-900 my-3">
          <span
            ><u
              ><i
                >This loan have a 9% interest per annum and a 2% service fee</i
              ></u
            >
          </span>
        </div>
        <div class="flex justify-left text-s font-bold text-gray-900 my-3">
          <span
            ><u
              >Note: It cannot be loaned at the same time with Education
              Loan.</u
            >
          </span>
        </div>

        <div></div>
        <div
          class="flex justify-center text-xl font-bold dark:text-gray-200 my-3 space-x-40"
        >
          <!-- Accept Button -->
          <div
            @click="accept"
            class="flex space-x-2 px-4 py-1 border text-sm leading-snug font-semibold text-green-600 dark:text-green-600 dark:border-green-600 border-green-600 uppercase rounded-full dark:hover:text-gray-200 hover:bg-green-500 cursor-pointer"
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
        <div class="flex justify-center text-xl font-bold text-gray-900 my-3">
          <span>Guidelines : {{ form.loan_type }}</span>
        </div>
        <br />
        <div class="flex justify-left text-l font-bold text-gray-900 my-3">
          <span><u>MITRF LOAN TERMS AND CONDITIONS</u> </span>
        </div>
        <br />
        <div class="flex justify-left text-m font-bold text-gray-900 my-3">
          <span>Eligibility Requirements </span>
        </div>
        <div class="flex justify-left text-s text-gray-900 my-3">
          <span
            >1. Member-borrower must be a regular employee of the institute and
            contributing 5% of his monthly basic salary to MITRF.
          </span>
        </div>
        <div class="flex justify-left text-s text-gray-900 my-3">
          <span
            >2. Member-borrower must maintain at least 45% net take home pay
            after deducting all his obligations including the MITRF
            amortization.
          </span>
        </div>

        <br />
        <div class="flex justify-left text-m font-bold text-gray-900 my-3">
          <span>Loan Amount </span>
        </div>

        <div class="flex justify-left text-s text-gray-900 my-3">
          <span
            >1. The maximum amount shall be the total member-follower's fund
            contribution and earnings.
          </span>
        </div>

        <br />
        <div class="flex justify-left text-m font-bold text-gray-900 my-3">
          <span>Education Assistance </span>
        </div>

        <div class="flex justify-left text-s text-gray-900 my-3">
          <span
            >For Education, Loan requirements are the following: (30,000
            maximum, 1 year term)
          </span>
        </div>
        <div class="flex justify-left text-s text-gray-900 my-3">
          <span>1. Application Form </span>
        </div>
        <div class="flex justify-left text-s text-gray-900 my-3">
          <span
            >2. Proof of relation (Birth certificate in case of relatives).
          </span>
        </div>
        <div class="flex justify-left text-s text-gray-900 my-3">
          <span
            >3. Certificate of Enrollment and Statement of Account from school.
          </span>
        </div>
        <br />
        <div class="flex justify-left text-s text-gray-900 my-3">
          <span
            ><u
              ><i
                >This loan have a 9% interest per annum and a 2% service fee</i
              ></u
            >
          </span>
        </div>
        <div class="flex justify-left text-s font-bold text-gray-900 my-3">
          <span
            ><u
              >Note: It cannot be loaned at the same time with Housing Loan.</u
            >
          </span>
        </div>
        <div
          class="flex justify-center text-xl font-bold dark:text-gray-200 my-3"
        >
          <div
            @click="accept"
            class="flex space-x-2 px-4 py-1 border text-sm leading-snug font-semibold text-green-600 dark:text-green-600 dark:border-green-600 border-green-600 uppercase rounded-full dark:hover:text-gray-200 hover:bg-green-500 cursor-pointer"
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
        <div class="flex justify-center text-xl font-bold text-gray-900 my-3">
          <span>Guidelines : {{ form.loan_type }}</span>
        </div>
        <br />
        <div class="flex justify-left text-l font-bold text-gray-900 my-3">
          <span><u>MITRF LOAN TERMS AND CONDITIONS</u> </span>
        </div>
        <br />
        <div class="flex justify-left text-m font-bold text-gray-900 my-3">
          <span>Eligibility Requirements </span>
        </div>
        <div class="flex justify-left text-s text-gray-900 my-3">
          <span
            >1. Member-borrower must be a regular employee of the institute and
            contributing 5% of his monthly basic salary to MITRF.
          </span>
        </div>
        <div class="flex justify-left text-s text-gray-900 my-3">
          <span
            >2. Member-borrower must maintain at least 45% net take home pay
            after deducting all his obligations including the MITRF
            amortization.
          </span>
        </div>

        <br />
        <div class="flex justify-left text-m font-bold text-gray-900 my-3">
          <span>Loan Amount </span>
        </div>

        <div class="flex justify-left text-s text-gray-900 my-3">
          <span
            >1. The maximum amount shall be the total member-follower's fund
            contribution and earnings.
          </span>
        </div>

        <br />
        <div class="flex justify-left text-m font-bold text-gray-900 my-3">
          <span>Emergency Assistance </span>
        </div>

        <div class="flex justify-left text-s text-gray-900 my-3">
          <span
            >For emergency, Loan requirements are the following: (30,000
            maximum, 1-2 years term)
          </span>
        </div>
        <div class="flex justify-left text-s text-gray-900 my-3">
          <span>1. Application Form </span>
        </div>
        <div class="flex justify-left text-s text-gray-900 my-3">
          <span>2. 4.5% interest for a 2-year term. </span>
        </div>
        <div class="flex justify-left text-s text-gray-900 my-3">
          <span>3. 2.25% interest for a 1-year term. </span>
        </div>
        <div class="flex justify-left text-s text-gray-900 my-3">
          <span
            >4. 45% threshold of net pay is not applicable but must not be zero
            or negative.
          </span>
        </div>

        <div
          class="flex justify-center text-xl font-bold dark:text-gray-200 my-3 space-x-40"
        >
          <!-- Accept Button -->
          <div
            @click="accept"
            class="flex space-x-2 px-4 py-1 border text-sm leading-snug font-semibold text-green-600 dark:text-green-600 dark:border-green-600 border-green-600 uppercase rounded-full dark:hover:text-gray-200 hover:bg-green-500 cursor-pointer"
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
        <div class="flex justify-between text-xl font-bold text-gray-900 my-2">
          <span>Data Privacy Compliance</span>
          <div class="flex text-justify font-normal text-gray-900 my-5"></div>
          <svg
            @click="submitModal = !submitModal"
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6 cursor-pointer"
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
            >I hereby agree to submit my documents and to allow MITRFI and its
            authorized personnel to process my documents and personal
            information for specifically for purposes of
            <span class="font-bold">{{ this.form.loan_type }}</span
            >, in compliance with the Data Privacy Act of 2012 and MITRFI
            policies. Acceptance of the document/s does not automatically
            guarantee approval as the application shall be subject to the
            evaluation and approval of the MITFRI based on its loan
            policies.</span
          >
        </div>
        <div
          class="flex justify-center text-xl font-bold dark:text-gray-200 my-3"
        >
          <div
            @click="proceed"
            class="flex space-x-2 px-4 py-1 border text-sm leading-snug font-semibold text-green-600 dark:text-green-600 dark:border-green-600 border-green-600 uppercase rounded-full dark:hover:text-gray-200 hover:bg-green-500 cursor-pointer"
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

      loanTypes: ["Housing Loan", "Educational Loan", "Emergency Loan"],
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
        // proof:'',
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
        let interest = 0.09;
        this.form.interest = (0.02 + interest * (this.form.terms / 12)).toFixed(
          2
        );
        this.form.loan_amount =
          this.form.amount + this.form.amount * this.form.interest;
      } else if (this.form.loan_type == "Educational Loan") {
        if (this.forRelative == true) {
          let interest = 0.09;
          this.form.terms = 12;
          this.form.interest = (
            0.02 +
            interest * (this.form.terms / 12)
          ).toFixed(2);
          this.form.loan_amount =
            this.form.amount + this.form.amount * this.form.interest;
        } else {
          let interest = 0.09;
          this.educationalForm.terms = 12;
          this.educationalForm.amount = this.form.amount;
          this.educationalForm.loan_type = "Educational Loan";
          this.educationalForm.interest = (
            0.02 +
            interest * (this.educationalForm.terms / 12)
          ).toFixed(2);
          this.educationalForm.loan_amount =
            this.educationalForm.amount +
            this.educationalForm.amount * this.educationalForm.interest;
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
          if (this.form.amount >= 30000 && this.form.amount <= 100000) {
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
          if (this.form.amount >= 30000 && this.form.amount <= 100000) {
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
