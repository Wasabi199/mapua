<template>
  <AppLayout>
    <template #header>
      <div class="flex justify-between">
        <div class="flex items-center">
          <Link :href="route('adminLoansView')" class="hover:underline">
            <h1 class="text-xl font-extrabold leading-tight text-gray-800">
              Loans
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
            {{ info.first_name }} {{ info.middle_name }} {{ info.last_name }}'s
          </h1>
        </div>
      </div>
    </template>

    <div class="grid grid-cols-1 gap-8 m-8 lg:m-10 lg:grid-cols-2">
      <!-- Left Box -->
      <div
        class="overflow-hidden "
      >
        <div v-if="loan.approval === 'Denied'">
          <form>
            <div class="px-2 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                  <label class="block text-sm font-medium text-gray-700"
                    >Name of Borrower</label
                  >
                  <input
                    type="text"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                    :value="fname + ' ' + lname"
                    disabled
                  />
                </div>

                <div class="col-span-6 sm:col-span-2">
                  <label class="block text-sm font-medium text-gray-700"
                    >Loan Type</label
                  >
                  <input
                    type="text"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                    :value="loan_type"
                    disabled
                  />
                </div>

                <div class="col-span-6 sm:col-span-2">
                  <label class="block text-sm font-medium text-gray-700"
                    >Loan Status</label
                  >
                  <input
                    type="text"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                    :value="loan_status"
                    disabled
                  />
                </div>

                <div class="col-span-6 sm:col-span-2">
                  <label class="block text-sm font-medium text-gray-700"
                    >Membership Date</label
                  >
                  <input
                    type="date"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                    :value="employment"
                    disabled
                  />
                </div>

                <div class="col-span-6 sm:col-span-2">
                  <label class="block text-sm font-medium text-gray-700"
                    >Years of Membership</label
                  >
                  <input
                    type="number"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                    :value="service"
                    disabled
                  />
                </div>

                <div class="col-span-6 sm:col-span-4">
                  <label class="block text-sm font-medium text-gray-700"
                    >If Administration Employee, state department</label
                  >
                  <input
                    type="text"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                    :value="department"
                    disabled
                  />
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label class="block text-sm font-medium text-gray-700"
                    >Amount of Loan</label
                  >
                  <div>
                    <span class="absolute mt-1.5 pl-2 font-bold">&#8369</span>

                  <input
                    type="number"
                    class="block w-full pl-6 mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                    :value="amount"
                    disabled
                  />
                  </div>
                </div>


                <div class="col-span-6 sm:col-span-2">
                  <label class="block text-sm font-medium text-gray-700"
                    >Term of Payment &lpar;Months&rpar;</label
                  >
                  <input
                    type="number"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                    :value="duration"
                    disabled
                  />
                </div>
              </div>
            </div>
          </form>

        </div>
        <div v-if="loan.approval === 'Submitted'">
          <form>
            <div class="px-2 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                  <label class="block text-sm font-medium text-gray-700"
                    >Name of Borrower</label
                  >
                  <input
                    type="text"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                    :value="fname + ' ' + lname"
                    disabled
                  />
                </div>

                <div class="col-span-6 sm:col-span-2">
                  <label class="block text-sm font-medium text-gray-700"
                    >Loan Type</label
                  >
                  <input
                    type="text"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                    :value="loan_type"
                    disabled
                  />
                </div>

                <div class="col-span-6 sm:col-span-2">
                  <label class="block text-sm font-medium text-gray-700"
                    >Loan Status</label
                  >
                  <input
                    type="text"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                    :value="loan_status"
                    disabled
                  />
                </div>

                <div class="col-span-6 sm:col-span-2">
                  <label class="block text-sm font-medium text-gray-700"
                    >Membership Date</label
                  >
                  <input
                    type="date"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                    :value="employment"
                    disabled
                  />
                </div>

                <div class="col-span-6 sm:col-span-2">
                  <label class="block text-sm font-medium text-gray-700"
                    >Years of Membership</label
                  >
                  <input
                    type="number"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                    :value="service"
                    disabled
                  />
                </div>

                <div class="col-span-6 sm:col-span-4">
                  <label class="block w-full text-sm font-medium text-gray-700"
                    >If Administration Employee, state department</label
                  >
                  <input
                    type="text"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                    :value="department"
                    disabled
                  />
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label class="block text-sm font-medium text-gray-700"
                    >  Principal Amount</label
                  >
                  <div class="relative">
                    <span class="absolute mt-1.5 pl-2 font-bold">&#8369</span>
                        <input
                    type="number"
                    class="block w-full pl-6 mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                    :value="loan.amount"
                    disabled
                  />

                  </div>
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label class="block text-sm font-medium text-gray-700"
                    >Net Amount due to Borrower</label
                  >
                  <div class="relative">
                    <span class="absolute mt-1.5 pl-2 font-bold">&#8369</span>

                  <input
                    type="number"
                    class="block w-full pl-6 mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                    :value="amount"
                    disabled
                  />
                  </div>
                </div>

                <div class="col-span-6 sm:col-span-2">
                  <label class="block text-sm font-medium text-gray-700"
                    >Term of Payment &lpar;Months&rpar;</label
                  >
                  <input
                    type="number"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                    :value="duration"
                    disabled
                  />
                </div>
              </div>
            </div>
          </form>
          <div class="flex justify-center">
            <Link :href="route('printingLoan', loan.id)">
              <div
                class="flex justify-between my-3 text-xl font-bold dark:text-gray-200"
              >
                <div
                  class="flex px-4 py-1 mr-5 space-x-2 text-green-600 uppercase border border-green-600 rounded-full cursor-pointer text-md dark:text-green-600 dark:border-green-600 dark:hover:text-gray-200 hover:text-white hover:border-none hover:bg-green-500"
                >
                  <span>Print</span>
                </div>
              </div>
            </Link>
          </div>
        </div>

        <div
          v-if="loan.approval == 'Processed'"
          class="p-4 overflow-hidden bg-white border-gray-300 shadow-xl sm:rounded-lg"
        >
          <!-- Contact -->
          <div class="mb-8">


            <div class="flex text-lg">
              <svg
                class="w-6 h-6 text-red-900"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
              </svg>

              <p class="pl-2 font-semibold">{{ info.mobile_number }}</p>
            </div>
          </div>

          <!-- Name -->
          <div class="flex justify-between">
            <div class="flex text-lg">
              <p class="font-semibold">Name:</p>
              <p class="ml-2 underline">
                {{ info.first_name }} {{ info.last_name }}
              </p>
            </div>
          </div>



          <!-- birth date -->

          <div class="flex text-lg">
            <p class="font-semibold">Loan Type:</p>
            <p class="ml-2 underline">{{ loan.loan_type }}</p>
          </div>

          <!-- Loan Status -->
          <div class="flex text-lg">
            <p class="font-semibold">Loan Status:</p>
            <p class="ml-2 underline">{{ loan.approval }}</p>
          </div>
          <!-- address -->

          <!-- department -->

          <div class="flex text-lg">
            <p class="font-semibold">Department:</p>
            <p class="ml-2 underline">{{ info.department }}</p>
          </div>
          <!-- membership date -->
          <div class="flex text-lg">
            <p class="font-semibold">Principal Amount:</p>
            <p class="ml-2 underline">&#8369 {{ loan.amount.toLocaleString("en-US") }}</p>
          </div>
          <div class="flex text-lg">
            <p class="font-semibold">Net Amount due to Borrower:</p>
            <p class="ml-2 underline">&#8369 {{ loan.loan_amount.toLocaleString("en-US") }}</p>
          </div>
          <div class="flex text-lg">
            <p class="font-semibold">Loan Duration:</p>
            <p class="ml-2 underline">{{ loan.duration }} months</p>
          </div>
        </div>

        <div v-if="loan.approval === 'For Processing'">
          <form>
            <div class="px-2 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                  <label class="block text-sm font-medium text-gray-700"
                    >Name of Borrower</label
                  >
                  <input
                    type="text"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                    :value="fname + ' ' + lname"
                    disabled
                  />
                </div>

                <div class="col-span-6 sm:col-span-2">
                  <label class="block text-sm font-medium text-gray-700"
                    >Loan Type</label
                  >
                  <input
                    type="text"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                    :value="loan_type"
                    disabled
                  />
                </div>

                <div class="col-span-6 sm:col-span-2">
                  <label class="block text-sm font-medium text-gray-700"
                    >Loan Status</label
                  >
                  <input
                    type="text"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                    :value="loan_status"
                    disabled
                  />
                </div>

                <div class="col-span-6 sm:col-span-2">
                  <label class="block text-sm font-medium text-gray-700"
                    >Membership Date</label
                  >
                  <input
                    type="date"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                    :value="employment"
                    disabled
                  />
                </div>

                <div class="col-span-6 sm:col-span-2">
                  <label class="block text-sm font-medium text-gray-700"
                    >Years of Membership</label
                  >
                  <input
                    type="number"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                    :value="service"
                    disabled
                  />
                </div>

                <div class="col-span-6 sm:col-span-4">
                  <label class="block text-sm font-medium text-gray-700"
                    >If Administration Employee, state department</label
                  >
                  <input
                    type="text"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                    :value="department"
                    disabled
                  />
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label class="block text-sm font-medium text-gray-700"
                    >Principal Amount</label
                  >

                  <div class="relative">
                    <span class="absolute mt-1.5 pl-2 font-bold">&#8369</span>
                    <input
                    type="number"
                    class="block w-full pl-6 mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                    :value="loan.amount"
                    disabled
                  />

                  </div>
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label class="block text-sm font-medium text-gray-700"
                    >Net Amount due to Borrower</label
                  >
                  <div>
                    <span class="absolute mt-1.5 pl-2 font-bold">&#8369</span>
                    <input
                    type="number"
                    class="block w-full pl-6 mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                    :value="amount"
                    disabled
                  />
                  </div>

                </div>



                <div class="col-span-6 sm:col-span-2">
                  <label class="block text-sm font-medium text-gray-700"
                    >Term of Payment &lpar;Months&rpar;</label
                  >
                  <input
                    type="number"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                    :value="duration"
                    disabled
                  />
                </div>
              </div>
            </div>
          </form>
          <div class="flex justify-center">
            <Link :href="route('printingLoan', loan.id)">
              <div
                class="flex justify-between my-3 text-xl font-bold dark:text-gray-200"
              >
                <div
                  class="flex px-4 py-1 mr-5 space-x-2 text-green-600 uppercase border border-green-600 rounded-full cursor-pointer text-md dark:text-green-600 dark:border-green-600 dark:hover:text-gray-200 hover:text-white hover:border-none hover:bg-green-500"
                >
                  <span>Print</span>
                </div>
              </div>
            </Link>
          </div>
        </div>

        <div
          v-if="loan.approval == 'For Release'"
          class="p-4 overflow-hidden bg-white border-gray-300 shadow-xl sm:rounded-lg"
        >
          <div class="mb-8">
            <div class="flex text-lg">
              <svg
                class="w-6 h-6 text-red-900"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
              </svg>
              <p class="pl-2 font-semibold">{{ info.mobile_number }}</p>
            </div>
          </div>

          <!-- Name -->
          <div class="flex justify-between">
            <div class="flex text-lg">
              <p class="font-semibold">Name:</p>
              <p class="ml-2 underline">
                {{ info.first_name }} {{ info.last_name }}
              </p>
            </div>
          </div>



          <!-- birth date -->
          <div class="flex text-lg">
            <p class="font-semibold">Loan Type:</p>
            <p class="ml-2 underline">{{ loan.loan_type }}</p>
          </div>

          <!-- place of birth -->
          <div class="flex text-lg">
            <p class="font-semibold">Loan Status:</p>
            <p class="ml-2 underline">{{ loan.approval }}</p>
          </div>
          <!-- address -->



          <!-- department -->

          <div class="flex text-lg">
            <p class="font-semibold">Department:</p>
            <p class="ml-2 underline">{{ info.department }}</p>
          </div>
          <!-- membership date -->

          <div class="flex text-lg">
            <p class="font-semibold">Loan Amount:</p>
            <p class="ml-2 underline">&#8369 {{ loan.amount.toLocaleString("en-US") }}</p>
          </div>

           <!-- LOAN AMOUNT-->

           <div class="flex text-lg">
            <p class="font-semibold">Net Amount Due to Borrower:</p>
            <p class="ml-2 underline">&#8369 {{ loan.loan_amount.toLocaleString("en-US") }}</p>
          </div>

          <div class="flex text-lg">
            <p class="font-semibold">Loan Duration:</p>
            <p class="ml-2 underline">{{ loan.duration }} months</p>
          </div>

        </div>

        <div
          v-if="loan.approval == 'Released'"
          class="p-4 overflow-hidden bg-white border-gray-300 shadow-xl sm:rounded-lg"
        >
          <div class="mb-8">
            <div class="flex text-lg">
              <svg
                class="w-6 h-6 text-red-900"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
              </svg>
              <p class="pl-2 font-semibold">{{ info.mobile_number }}</p>
            </div>
          </div>

          <!-- Name -->
          <div class="flex justify-between">
            <div class="flex text-lg">
              <p class="font-semibold">Name:</p>
              <p class="ml-2 underline">
                {{ info.first_name }} {{ info.last_name }}
              </p>
            </div>
          </div>



          <!-- birth date -->
          <div class="flex text-lg">
            <p class="font-semibold">Loan Type:</p>
            <p class="ml-2 underline">{{ loan.loan_type }}</p>
          </div>

          <!-- place of birth -->
          <div class="flex text-lg">
            <p class="font-semibold">Loan Status:</p>
            <p class="ml-2 underline">{{ loan.approval }}</p>
          </div>


          <!-- department -->

          <div class="flex text-lg">
            <p class="font-semibold">Department:</p>
            <p class="ml-2 underline">{{ info.department }}</p>
          </div>
          <!-- LOAN AMOUNT-->

          <div class="flex text-lg">
            <p class="font-semibold">Loan Amount:</p>
            <p class="ml-2 underline">&#8369 {{ loan.amount.toLocaleString("en-US") }}</p>
          </div>

          <!-- LOAN AMOUNT-->

          <div class="flex text-lg">
            <p class="font-semibold">Net Amount Due to Borrower:</p>
            <p class="ml-2 underline">&#8369 {{ loan.loan_amount.toLocaleString("en-US") }}</p>
          </div>


          <div class="flex text-lg">
            <p class="font-semibold">Loan Duration:</p>
            <p class="ml-2 underline">{{ loan.duration -contributions.total }} months</p>
          </div>

        </div>
      </div>

      <!-- Right Box -->
      <div
        v-if="loan.approval == 'For Release'"
        class="content-center bg-white rounded-lg shadow-xl lg:mr-50"
      >
        <div class="flex justify-between m-4">
          <div class="text-lg">
            <p class="content-center font-bold">Good news!</p>
            <p>Your Personal Loan application has been processed.</p>
            <p>
              A representative will send you an email for updates on the release of your loan.
            </p>
          </div>
        </div>
      </div>

      <div
        v-if="loan.approval == 'Released'"
        class="content-center w-full bg-white rounded-lg shadow-xl lg:mr-50"
      >
        <table class="min-w-full mx-auto mt-5 divide-y divide-gray-200">
          <thead class="inline-auto">
            <tr
              class="box-content w-20 h-10 p-4 text-yellow-400 bg-red-800 border-10"
            >
              <th class="px-16 text-left">ID</th>
              <th class="px-16 text-left">Amount</th>
              <th class="px-16 text-left">Date of Payment</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr
              v-for="contribution in contributions.data"
              v-bind:key="contribution.id"
            >
              <td class="px-6 py-6 whitespace-nowrap">
                <div class="flex items-center">
                  <div>
                    <div class="px-10 text-sm font-medium text-gray-900">
                      {{ contribution.id }}
                    </div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div>
                    <div class="px-10 text-sm font-medium text-gray-900">
                        &#8369 {{ contribution.contribution_amount }}
                    </div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div>
                    <div class="px-8 text-sm font-medium text-gray-900">
                      {{ new Date(contribution.created_at).toLocaleDateString() +" "+ new Date(contribution.created_at).toLocaleTimeString()}}
                    </div>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <Pagination :links="contributions.links"></Pagination>
      </div>

      <div
        v-if="loan.approval == 'Processed'"
        class="max-w-lg min-w-full row-span-3 overflow-hidden bg-white border-gray-300 sm:rounded-lg place-self-center"
      >
        <div v-if="loan.loan_type == 'Housing Loan'">
          <p class="font-semibold">Member's Payslip for Validation:</p>
        </div>
        <div v-if="loan.loan_type == 'Educational Loan'">
          <p class="font-semibold">Member's Payslip for Validation:</p>
        </div>
        <div v-if="loan.loan_type == 'Emergency Loan'">
          <p class="font-semibold">Member's Payslip for Validation:</p>
        </div>
        <br />

        <!-- IMAGE 1-->
        <div class="content-center bg-white rounded-lg shadow-xl lg:mr-50">
          <img
            :src="loan.attachment1 == null ? 'https://fopm-sams.s3.amazonaws.com/' : loan.attachment1"
            class="w-auto h-auto"
          />
        </div>
        <!-- IMAGE 1-->
        <br />
        <div v-if="loan.loan_type == 'Housing Loan'">
          <p class="font-semibold">
            Photo of you Including the Place to be Improved/Repaired:
          </p>
        </div>
        <div v-if="loan.loan_type == 'Educational Loan' && loan.attachment2 != null">
          <p class="font-semibold">
            Proof of Relation (Birth Certificate in Case of Relatives):
          </p>
        </div>
        <!-- <div v-if="loan.loan_type == 'Emergency Loan'">
          <p class="font-semibold">4.5% interest for a 2-year term:</p>
        </div> -->

        <!-- IMAGE 2-->
        <div class="content-center bg-white rounded-lg shadow-xl lg:mr-50">
          <img
            :src="loan.attachment2 == null ? 'https://fopm-sams.s3.amazonaws.com/' : loan.attachment2"
            class="w-auto h-auto"
          />
        </div>
        <!-- IMAGE 2-->
        <br />
        <div v-if="loan.loan_type == 'Housing Loan'">
          <p class="font-semibold">Laborer's Quotation:</p>
        </div>
        <div v-if="loan.loan_type == 'Educational Loan'">
          <p class="font-semibold">
            Certificate of Enrollment and Statement of Account from School:
          </p>
        </div>

        <!-- <div v-if="loan.loan_type == 'Emergency Loan'">
          <p class="font-semibold">2.25% interest for a 1-year term:</p>
        </div> -->

        <!-- IMAGE 3-->
        <div class="content-center bg-white rounded-lg shadow-xl lg:mr-50">
          <img
            :src="loan.attachment3 == null ? 'https://fopm-sams.s3.amazonaws.com/' : loan.attachment3"
            class="w-auto h-auto"
          />
        </div>
        <!-- IMAGE 3-->
        <br />
      </div>
      <div
        v-if="loan.approval == 'For Processing'"
        class="w-full row-span-3 overflow-hidden bg-white border-gray-300 sm:rounded-lg place-self-center"
      >
        <div v-if="loan.loan_type == 'Housing Loan'">
          <p class="font-semibold">Member's Payslip for Validation:</p>
        </div>
        <div v-if="loan.loan_type == 'Educational Loan'">
          <p class="font-semibold">Member's Payslip for Validation:</p>
        </div>
        <div v-if="loan.loan_type == 'Emergency Loan'">
          <p class="font-semibold">Member's Payslip for Validation:</p>
        </div>
        <br />

        <!-- IMAGE 1-->
        <div class="content-center bg-white rounded-lg shadow-xl lg:mr-50">
          <img
            :src="loan.attachment1 == null ? 'https://fopm-sams.s3.amazonaws.com/' : loan.attachment1"
            class="w-auto h-auto"
          />
        </div>
        <!-- IMAGE 1-->
        <br />
        <div v-if="loan.loan_type == 'Housing Loan'">
          <p class="font-semibold">
            Photo of you Including the Place to be Improved/Repaired:
          </p>
        </div>
        <div v-if="loan.loan_type == 'Educational Loan' && loan.attachment2 != null">
          <p class="font-semibold">
            Proof of Relation (Birth Certificate in Case of Relatives):
          </p>
        </div>
        <!-- <div v-if="loan.loan_type == 'Emergency Loan'">
          <p class="font-semibold">4.5% interest for a 2-year term:</p>
        </div> -->

        <!-- IMAGE 2-->
        <div class="content-center bg-white rounded-lg shadow-xl lg:mr-50">
          <img
            :src="loan.attachment2 == null ? 'https://fopm-sams.s3.amazonaws.com/' : loan.attachment2"
            class="w-auto h-auto"
          />
        </div>
        <!-- IMAGE 2-->
        <br />
        <div v-if="loan.loan_type == 'Housing Loan'">
          <p class="font-semibold">Laborer's Quotation:</p>
        </div>
        <div v-if="loan.loan_type == 'Educational Loan'">
          <p class="font-semibold">
            Certificate of Enrollment and Statement of Account from School:
          </p>
        </div>

        <!-- <div v-if="loan.loan_type == 'Emergency Loan'">
          <p class="font-semibold">2.25% interest for a 1-year term:</p>
        </div> -->

        <!-- IMAGE 3-->
        <div class="content-center bg-white rounded-lg shadow-xl lg:mr-50">
          <img
            :src="loan.attachment3 == null ? 'https://fopm-sams.s3.amazonaws.com/' : loan.attachment3"
            class="w-auto h-auto"
          />
        </div>

        <br />
        <div
          v-if="loan.approval == 'For Processing'"
          class="flex items-center justify-center w-full gap-20 p-0 m-0"
        >
          <button
            type="button"
            class="w-64 px-4 py-2 mb-5 text-lg font-semibold text-center text-white transition duration-150 ease-in bg-red-600 rounded-lg shadow-md hover:bg-red-700 focus:ring focus:ring-red-300"
            @click="rejectLoan(loan)"
          >
            Reject
          </button>

          <button
            type="button"
            class="w-64 px-4 py-2 mb-5 text-lg font-semibold text-center text-white transition duration-150 ease-in bg-green-600 rounded-lg shadow-md hover:bg-green-700 focus:ring focus:ring-green-300"
            @click="acceptLoan(loan)"
          >
            Accept
          </button>
        </div>
      </div>
      <div
      v-else-if="loan.approval == 'Denied'"
      class="w-full p-4 m-auto text-center bg-white border-gray-300 rounded-lg shadow-xl h-fit"
    >
      <h1>Rejected Loan Application</h1>
      <div class="font-semibold">{{loan.reason}}</div>
    </div>
      <div v-if="loan.approval == 'Submitted'" class="row-span-3">
        <div v-if="loan.loan_type == 'Housing Loan'">
          <p class="font-semibold">Member's Payslip for Validation:</p>
        </div>
        <div v-if="loan.loan_type == 'Educational Loan'">
          <p class="font-semibold">Member's Payslip for Validation:</p>
        </div>
        <div v-if="loan.loan_type == 'Emergency Loan'">
          <p class="font-semibold">Member's Payslip for Validation:</p>
        </div>
        <div class="content-center bg-white rounded-lg shadow-xl lg:mr-50">
          <img
            :src="loan.attachment1 == null ? 'https://fopm-sams.s3.amazonaws.com/' : loan.attachment1"
            class="w-auto h-auto"
          />
        </div>
        <div v-if="loan.loan_type == 'Housing Loan'">
          <p class="font-semibold">
            Photo of you Including the Place to be Improved/Repaired:
          </p>
        </div>
        <div v-if="loan.loan_type == 'Educational Loan' && loan.attachment2 != null">
          <p class="font-semibold">
            Proof of Relation (Birth Certificate in Case of Relatives):
          </p>
        </div>
        <!-- <div v-if="loan.loan_type == 'Emergency Loan'">
          <p class="font-semibold">4.5% interest for a 2-year term:</p>
        </div> -->
        <div class="content-center bg-white rounded-lg shadow-xl lg:mr-50">
          <img
            :src="loan.attachment2 == null ? 'https://fopm-sams.s3.amazonaws.com/' : loan.attachment2"
            class="w-auto h-auto"
          />
        </div>
        <div v-if="loan.loan_type == 'Housing Loan'">
          <p class="font-semibold">Laborer's Quotation:</p>
        </div>
        <div v-if="loan.loan_type == 'Educational Loan'">
          <p class="font-semibold">
            Certificate of Enrollment and Statement of Account from School:
          </p>
        </div>

        <!-- <div v-if="loan.loan_type == 'Emergency Loan'">
          <p class="font-semibold">2.25% interest for a 1-year term:</p>
        </div> -->
        <div class="content-center bg-white rounded-lg shadow-xl lg:mr-50">
          <img
            :src="loan.attachment3 == null ? 'https://fopm-sams.s3.amazonaws.com/' : loan.attachment3"
            class="w-auto h-auto"
          />
        </div>
      </div>
      <br />
    </div>

    <div
      v-if="loan.approval == 'For Release'"
      class="flex items-center justify-center w-full gap-20 p-0 m-0"
    >
      <button
        type="button"
        class="w-64 px-4 py-2 mb-5 text-lg font-semibold text-center text-white transition duration-150 ease-in bg-red-600 rounded-lg shadow-md hover:bg-red-700 focus:ring focus:ring-red-300"
        @click="releasedLoan(loan)"
      >
        Released
      </button>
    </div>

    <div v-if="loan.approval == 'Released'" class="row-span-3"></div>

    <div
      v-if="loan.approval == 'Processed'"
      class="flex items-center justify-center w-full gap-20 p-0 m-0"
    >
      <button
        type="button"
        class="w-64 px-4 py-2 mb-5 text-lg font-semibold text-center text-white transition duration-150 ease-in bg-green-600 rounded-lg shadow-md hover:bg-green-700 focus:ring focus:ring-green-300"
        @click="releaseLoan(loan)"
      >
        For Release
      </button>
    </div>

    <Modal
      :closeable="true"
      :show="showApproveModal"
      @close="showApproveModal = !showApproveModal"
    >
      <div class="p-5">
        <div class="flex justify-between my-3 text-xl font-bold text-gray-900">
          <span></span>
          <svg
            class="w-6 h-6 cursor-pointer"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
            @click="showApproveModal = !showApproveModal"
          >
            <path
              d="M6 18L18 6M6 6l12 12"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
            />
          </svg>
        </div>
        <div
          class="flex flex-col items-center my-3 text-xl font-bold text-gray-900 "
        >
          <span class="text-center"
            >Accept {{ info.first_name }} {{ info.last_name }}'s loan?</span
          >
        </div>
        <div class="flex justify-center">
          <div
            class="flex justify-between my-3 text-xl font-bold dark:text-gray-200"
          >
            <div
              class="flex px-4 py-1 mr-5 space-x-2 text-green-600 uppercase border border-green-600 rounded-full cursor-pointer text-md dark:text-green-600 dark:border-green-600 dark:hover:text-gray-200 hover:text-white hover:border-none hover:bg-green-500"
              @click="submitApproveLoan"
            >
              <span>Accept</span>
            </div>
          </div>
        </div>
      </div>
    </Modal>
    <Modal
      :closeable="true"
      :show="showReleaseModal"
      @close="showReleaseModal = !showReleaseModal"
    >
      <div class="p-5">
        <div class="flex justify-between my-3 text-xl font-bold text-gray-900">
          <span></span>
          <svg
            class="w-6 h-6 cursor-pointer"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
            @click="showReleaseModal = !showReleaseModal"
          >
            <path
              d="M6 18L18 6M6 6l12 12"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
            />
          </svg>
        </div>
        <div
          class="flex flex-col items-center my-3 text-xl font-bold text-gray-900 "
        >
          <span class="text-center"
            >Release {{ info.first_name }} {{ info.last_name }} loan?</span
          >
        </div>
        <div class="flex justify-center">
          <div
            class="flex justify-between my-3 text-xl font-bold dark:text-gray-200"
          >
            <div
              class="flex px-4 py-1 mr-5 space-x-2 text-green-600 uppercase border border-green-600 rounded-full cursor-pointer text-md dark:text-green-600 dark:border-green-600 dark:hover:text-gray-200 hover:text-white hover:border-none hover:bg-green-500"
              @click="submitReleaseLoan"
            >
              <span>Release</span>
            </div>
          </div>
        </div>
      </div>
    </Modal>
    <Modal
      :closeable="true"
      :show="showReleasedModal"
      @close="showReleasedModal = !showReleasedModal"
    >
      <div class="p-5">
        <div class="flex justify-between my-3 text-xl font-bold text-gray-900">
          <span></span>
          <svg
            class="w-6 h-6 cursor-pointer"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
            @click="showReleasedModal = !showReleasedModal"
          >
            <path
              d="M6 18L18 6M6 6l12 12"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
            />
          </svg>
        </div>
        <div
          class="flex flex-col items-center my-3 text-xl font-bold text-gray-900 "
        >
          <span class="text-center"
            >Released {{ info.first_name }} {{ info.last_name }}'s loan?</span
          >
        </div>
        <div class="flex justify-center">
          <div
            class="flex justify-between my-3 text-xl font-bold dark:text-gray-200"
          >
            <div
              class="flex px-4 py-1 mr-5 space-x-2 text-red-600 uppercase border border-red-600 rounded-full cursor-pointer text-md dark:text-red-600 dark:border-red-600 dark:hover:text-gray-200 hover:text-white hover:border-none hover:bg-red-500"
              @click="submitReleasedLoan"
            >
              <span>Released</span>
            </div>
          </div>
        </div>
      </div>
    </Modal>
    <Modal
      :closeable="true"
      :show="showRejectModal"
      @close="showRejectModal = !showRejectModal"
    >
      <div class="p-5">
        <div class="flex justify-between my-3 text-xl font-bold text-gray-900">

          <svg
            class="w-6 h-6 cursor-pointer"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
            @click="showRejectModal = !showRejectModal"
          >
            <path
              d="M6 18L18 6M6 6l12 12"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
            />
          </svg>
        </div>
        <div
          class="flex flex-col items-center my-3 text-xl font-bold text-gray-900 "
        >
          <span class="text-center"
            >Reject {{ info.first_name }} {{ info.last_name }}'s loan?</span
          >
        </div>
        <div>
          <select class="w-full rounded-lg" v-model="selectedReason">
            <option disabled>Select Reason</option>
            <option v-for="reason in rejectReason" v-bind:key="reason.id">{{reason}}</option>
          </select>

        </div>
        <div class="w-full mt-2" v-if="this.selectedReason == 'Other'" >
          <textarea class="w-full" v-model="this.rejectForm.reason"></textarea>
        </div>
        <div class="flex justify-center">
          <div class="flex my-3 text-xl font-bold dark:text-gray-200">
            <div
              class="flex px-4 py-1 space-x-2 text-red-600 uppercase border border-red-600 rounded-full cursor-pointer text-md dark:text-red-600 dark:border-red-600 dark:hover:text-gray-200 hover:text-white hover:border-none hover:bg-red-500"
              @click="submitRejectLoan"
            >
              <span>Reject</span>
            </div>
          </div>
        </div>
      </div>
    </Modal>
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
    loan: Object,
    info: Object,
    contributions: Object,
    notification: Object,
    count: Number,
  },
  setup() {},
  data() {
    return {
      loanToReject: Object,
      loanToApprove: Object,
      loanToRelease: Object,
      loanReleased: Object,
      showRejectModal: false,
      showApproveModal: false,
      showReleaseModal: false,
      showReleasedModal: false,

      selectedReason:'',


      fname: this.$props.info.first_name,
      lname: this.$props.info.last_name,
      loan_type: this.$props.loan.loan_type,
      loan_status:this.$props.loan.approval,
      employment: this.$props.info.membership,
      service:
        new Date().getUTCFullYear() -
        new Date(this.$props.info.membership).getUTCFullYear(),
      department: this.$props.info.department,
      amount: this.$props.loan.loan_amount,
      duration: this.$props.loan.duration,

      rejectForm: this.$inertia.form({
        id: Number,
        approval: "",
        reason:'',
      }),

      approveForm: this.$inertia.form({
        id: Number,
        approval: "",
      }),
      releaseForm: this.$inertia.form({
        id: Number,
        approval: "",
      }),
      releasedForm: this.$inertia.form({
        id: Number,
        approval: "",
      }),

      rejectReason:[
        'Preferred loan amount is not within 45% threshold of members takehome net pay.',
        'Not enough contributions and earnings to apply a loan.',
        'Uploaded requirements not clear/readable',
        'Other',

      ]
    };
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get(route("contributions"), pickBy(this.form), {
          preserveState: true,
          preserveScroll: true,
        });
      }, 600),
    },
  },
  methods: {
    rejectLoan(loan) {
      this.loanToReject = loan;
      this.showRejectModal = !this.showRejectModal;
    },
    acceptLoan(loan) {
      this.loanToApprove = loan;
      this.showApproveModal = !this.showApproveModal;
    },
    releaseLoan(loan) {
      this.loanToRelease = loan;
      this.showReleaseModal = !this.showReleaseModal;
    },
    releasedLoan(loan) {
      this.loanReleased = loan;
      this.showReleasedModal = !this.showReleasedModal;
    },

    submitRejectLoan() {
      this.rejectForm.id = this.loanToReject.id;
      this.rejectForm.approval = "Denied";
      if(this.selectedReason != 'Other'){
        this.rejectForm.reason = this.selectedReason
        console.log(this.rejectForm.reason);
      }
      this.rejectForm.post(route("loanReject"), {
        onSuccess: () => {
          this.showRejectModal = false;
        },
      });

    },
    submitApproveLoan() {
      this.approveForm.id = this.loanToApprove.id;
      this.approveForm.approval = "Processed";
      this.approveForm.post(route("loanApprove"), {
        onSuccess: () => {
          this.showApproveModal = false;
        },
      });
    },
    submitReleaseLoan() {
      this.releaseForm.id = this.loanToRelease.id;
      this.releaseForm.approval = "For Release";
      this.releaseForm.post(route("loanRelease"), {
        onSuccess: () => {
          this.showReleaseModal = false;
        },
      });
    },
    submitReleasedLoan() {
      this.releasedForm.id = this.loanReleased.id;
      this.releasedForm.approval = "Released";
      this.releasedForm.post(route("loanReleased"), {
        onSuccess: () => {
          this.showReleasedModal = false;
        },
      });
    },
  },
};
</script>
