<template>
  <AppLayout>
    <template #header>
      <div class="flex justify-between">
        <div class="flex items-center">
          <Link :href="route('adminLoansView')" class="hover:underline">
            <h1 class="font-extrabold text-xl text-gray-800 leading-tight">
              Loans
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
            {{ info.first_name }} {{ info.middle_name }} {{ info.last_name }}'s
          </h1>
        </div>
      </div>
    </template>

    <div class="grid grid-cols-1 m-8 gap-8 lg:m-10 lg:grid-cols-2">
      <!-- Left Box -->
      <div
        class=" overflow-hidden"
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
                    class="
                      mt-1
                      block
                      w-full
                      shadow-sm
                      sm:text-sm
                      border-gray-300
                      rounded-md
                    "
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
                    class="
                      mt-1
                      block
                      w-full
                      shadow-sm
                      sm:text-sm
                      border-gray-300
                      rounded-md
                    "
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
                    class="
                      mt-1
                      block
                      w-full
                      shadow-sm
                      sm:text-sm
                      border-gray-300
                      rounded-md
                    "
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
                    class="
                      mt-1
                      block
                      w-full
                      shadow-sm
                      sm:text-sm
                      border-gray-300
                      rounded-md
                    "
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
                    class="
                      mt-1
                      block
                      w-full
                      shadow-sm
                      sm:text-sm
                      border-gray-300
                      rounded-md
                    "
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
                    class="
                      mt-1
                      block
                      w-full
                      shadow-sm
                      sm:text-sm
                      border-gray-300
                      rounded-md
                    "
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
                    class="
                      mt-1
                      block
                      w-full
                      shadow-sm
                      sm:text-sm
                      border-gray-300
                      rounded-md
                      pl-6
                    "
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
                    class="
                      mt-1
                      block
                      w-full
                      shadow-sm
                      sm:text-sm
                      border-gray-300
                      rounded-md
                    "
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
                    class="
                      mt-1
                      block
                      w-full
                      shadow-sm
                      sm:text-sm
                      border-gray-300
                      rounded-md
                    "
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
                    class="
                      mt-1
                      block
                      w-full
                      shadow-sm
                      sm:text-sm
                      border-gray-300
                      rounded-md
                    "
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
                    class="
                      mt-1
                      block
                      w-full
                      shadow-sm
                      sm:text-sm
                      border-gray-300
                      rounded-md
                    "
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
                    class="
                      mt-1
                      block
                      w-full
                      shadow-sm
                      sm:text-sm
                      border-gray-300
                      rounded-md
                    "
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
                    class="
                      mt-1
                      block
                      w-full
                      shadow-sm
                      sm:text-sm
                      border-gray-300
                      rounded-md
                    "
                    :value="service"
                    disabled
                  />
                </div>

                <div class="col-span-6 sm:col-span-4">
                  <label class="w-full block text-sm font-medium text-gray-700"
                    >If Administration Employee, state department</label
                  >
                  <input
                    type="text"
                    class="
                      mt-1
                      block
                      w-full
                      shadow-sm
                      sm:text-sm
                      border-gray-300
                      rounded-md
                    "
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
                    class="
                      mt-1
                      block
                      w-full
                      shadow-sm
                      sm:text-sm
                      border-gray-300
                      rounded-md
                      pl-6
                    "
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
                    class="
                      mt-1
                      block
                      w-full
                      shadow-sm
                      sm:text-sm
                      border-gray-300
                      rounded-md
                      pl-6
                    "
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
                    class="
                      mt-1
                      block
                      w-full
                      shadow-sm
                      sm:text-sm
                      border-gray-300
                      rounded-md
                    "
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
                class="
                  flex
                  justify-between
                  text-xl
                  font-bold
                  dark:text-gray-200
                  my-3
                "
              >
                <div
                  class="
                    flex
                    space-x-2
                    mr-5
                    px-4
                    py-1
                    border
                    text-md text-green-600
                    dark:text-green-600 dark:border-green-600
                    border-green-600
                    uppercase
                    rounded-full
                    dark:hover:text-gray-200
                    hover:text-white hover:border-none hover:bg-green-500
                    cursor-pointer
                  "
                >
                  <span>Print</span>
                </div>
              </div>
            </Link>
          </div>
        </div>

        <div
          v-if="loan.approval == 'Processed'"
          class="
            bg-white
            p-4
            overflow-hidden
            border-gray-300
            shadow-xl
            sm:rounded-lg
          "
        >
          <!-- Contact -->
          <div class="mb-8">


            <div class="flex text-lg">
              <svg
                class="h-6 w-6 text-red-900"
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
          <div class="justify-between flex">
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
                    class="
                      mt-1
                      block
                      w-full
                      shadow-sm
                      sm:text-sm
                      border-gray-300
                      rounded-md
                    "
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
                    class="
                      mt-1
                      block
                      w-full
                      shadow-sm
                      sm:text-sm
                      border-gray-300
                      rounded-md
                    "
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
                    class="
                      mt-1
                      block
                      w-full
                      shadow-sm
                      sm:text-sm
                      border-gray-300
                      rounded-md
                    "
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
                    class="
                      mt-1
                      block
                      w-full
                      shadow-sm
                      sm:text-sm
                      border-gray-300
                      rounded-md
                    "
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
                    class="
                      mt-1
                      block
                      w-full
                      shadow-sm
                      sm:text-sm
                      border-gray-300
                      rounded-md
                    "
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
                    class="
                      mt-1
                      block
                      w-full
                      shadow-sm
                      sm:text-sm
                      border-gray-300
                      rounded-md
                    "
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
                    class="
                      mt-1
                      block
                      w-full
                      shadow-sm
                      sm:text-sm
                      border-gray-300
                      rounded-md
                      pl-6
                    "
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
                    class="
                      mt-1
                      block
                      w-full
                      shadow-sm
                      sm:text-sm
                      border-gray-300
                      rounded-md
                      pl-6
                    "
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
                    class="
                      mt-1
                      block
                      w-full
                      shadow-sm
                      sm:text-sm
                      border-gray-300
                      rounded-md
                    "
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
                class="
                  flex
                  justify-between
                  text-xl
                  font-bold
                  dark:text-gray-200
                  my-3
                "
              >
                <div
                  class="
                    flex
                    space-x-2
                    mr-5
                    px-4
                    py-1
                    border
                    text-md text-green-600
                    dark:text-green-600 dark:border-green-600
                    border-green-600
                    uppercase
                    rounded-full
                    dark:hover:text-gray-200
                    hover:text-white hover:border-none hover:bg-green-500
                    cursor-pointer
                  "
                >
                  <span>Print</span>
                </div>
              </div>
            </Link>
          </div>
        </div>

        <div
          v-if="loan.approval == 'For Release'"
          class="
            bg-white
            p-4
            overflow-hidden
            border-gray-300
            shadow-xl
            sm:rounded-lg
          "
        >
          <div class="mb-8">
            <div class="flex text-lg">
              <svg
                class="h-6 w-6 text-red-900"
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
          <div class="justify-between flex">
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
          class="
            bg-white
            p-4
            overflow-hidden
            border-gray-300
            shadow-xl
            sm:rounded-lg
          "
        >
          <div class="mb-8">
            <div class="flex text-lg">
              <svg
                class="h-6 w-6 text-red-900"
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
          <div class="justify-between flex">
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
        class="bg-white shadow-xl rounded-lg content-center lg:mr-50"
      >
        <div class="justify-between flex m-4">
          <div class="text-lg">
            <p class="font-bold content-center">Good news!</p>
            <p>Your Personal Loan application has been processed.</p>
            <p>
              A representative will send you an email for updates on the release of your loan.
            </p>
          </div>
        </div>
      </div>

      <div
        v-if="loan.approval == 'Released'"
        class="w-full bg-white shadow-xl rounded-lg content-center lg:mr-50"
      >
        <table class="min-w-full divide-y divide-gray-200 mt-5 mx-auto">
          <thead class="inline-auto">
            <tr
              class="
                box-content
                h-10
                w-20
                p-4
                border-10
                bg-red-800
                text-yellow-400
              "
            >
              <th class="text-left px-16">ID</th>
              <th class="text-left px-16">Amount</th>
              <th class="text-left px-16">Date of Payment</th>
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
        class="
        min-w-full
          row-span-3
          bg-white
          overflow-hidden
          border-gray-300
          sm:rounded-lg
          max-w-lg
          place-self-center
        "
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
        <div class="bg-white shadow-xl rounded-lg content-center lg:mr-50">
          <img
            :src="loan.attachment1 == null ? '' : loan.attachment1"
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
        <div class="bg-white shadow-xl rounded-lg content-center lg:mr-50">
          <img
            :src="loan.attachment2 == null ? '' : loan.attachment2"
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
        <div class="bg-white shadow-xl rounded-lg content-center lg:mr-50">
          <img
            :src="loan.attachment3 == null ? '' : loan.attachment3"
            class="w-auto h-auto"
          />
        </div>
        <!-- IMAGE 3-->
        <br />
      </div>
      <div
        v-if="loan.approval == 'For Processing'"
        class="
          row-span-3
          bg-white
          overflow-hidden
          border-gray-300
          sm:rounded-lg
          w-full
          place-self-center
        "
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
        <div class="bg-white shadow-xl rounded-lg content-center lg:mr-50">
          <img
            :src="loan.attachment1 == null ? '' : loan.attachment1"
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
        <div class="bg-white shadow-xl rounded-lg content-center lg:mr-50">
          <img
            :src="loan.attachment2 == null ? '' : loan.attachment2"
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
        <div class="bg-white shadow-xl rounded-lg content-center lg:mr-50">
          <img
            :src="loan.attachment3 == null ? '' : loan.attachment3"
            class="w-auto h-auto"
          />
        </div>

        <br />
        <div
          v-if="loan.approval == 'For Processing'"
          class="w-full p-0 m-0 flex items-center justify-center gap-20"
        >
          <button
            type="button"
            class="
              py-2
              px-4
              mb-5
              bg-red-600
              hover:bg-red-700
              focus:ring focus:ring-red-300
              text-white
              w-64
              transition
              ease-in
              duration-150
              text-lg text-center
              font-semibold
              shadow-md
              rounded-lg
            "
            @click="rejectLoan(loan)"
          >
            Reject
          </button>

          <button
            type="button"
            class="
              py-2
              px-4
              mb-5
              bg-green-600
              hover:bg-green-700
              focus:ring focus:ring-green-300
              text-white
              w-64
              transition
              ease-in
              duration-150
              text-lg text-center
              font-semibold
              shadow-md
              rounded-lg
            "
            @click="acceptLoan(loan)"
          >
            Accept
          </button>
        </div>
      </div>
      <div
      v-else-if="loan.approval == 'Denied'"
      class="
        bg-white
        p-4
        border-gray-300
        shadow-xl
        rounded-lg
        h-fit
        m-auto
        w-full
        text-center
      "
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
        <div class="bg-white shadow-xl rounded-lg content-center lg:mr-50">
          <img
            :src="loan.attachment1 == null ? '' : loan.attachment1"
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
        <div class="bg-white shadow-xl rounded-lg content-center lg:mr-50">
          <img
            :src="loan.attachment2 == null ? '' : loan.attachment2"
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
        <div class="bg-white shadow-xl rounded-lg content-center lg:mr-50">
          <img
            :src="loan.attachment3 == null ? '' : loan.attachment3"
            class="w-auto h-auto"
          />
        </div>
      </div>
      <br />
    </div>

    <div
      v-if="loan.approval == 'For Release'"
      class="w-full p-0 m-0 flex items-center justify-center gap-20"
    >
      <button
        type="button"
        class="
          py-2
          px-4
          mb-5
          bg-red-600
          hover:bg-red-700
          focus:ring focus:ring-red-300
          text-white
          w-64
          transition
          ease-in
          duration-150
          text-lg text-center
          font-semibold
          shadow-md
          rounded-lg
        "
        @click="releasedLoan(loan)"
      >
        Released
      </button>
    </div>

    <div v-if="loan.approval == 'Released'" class="row-span-3"></div>

    <div
      v-if="loan.approval == 'Processed'"
      class="w-full p-0 m-0 flex items-center justify-center gap-20"
    >
      <button
        type="button"
        class="
          py-2
          px-4
          mb-5
          bg-green-600
          hover:bg-green-700
          focus:ring focus:ring-green-300
          text-white
          w-64
          transition
          ease-in
          duration-150
          text-lg text-center
          font-semibold
          shadow-md
          rounded-lg
        "
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
        <div class="flex justify-between text-xl font-bold text-gray-900 my-3">
          <span></span>
          <svg
            class="h-6 w-6 cursor-pointer"
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
          class="
            flex flex-col
            items-center
            text-xl
            font-bold
            text-gray-900
            my-3
          "
        >
          <span class="text-center"
            >Accept {{ info.first_name }} {{ info.last_name }}'s loan?</span
          >
        </div>
        <div class="flex justify-center">
          <div
            class="
              flex
              justify-between
              text-xl
              font-bold
              dark:text-gray-200
              my-3
            "
          >
            <div
              class="
                flex
                space-x-2
                mr-5
                px-4
                py-1
                border
                text-md text-green-600
                dark:text-green-600 dark:border-green-600
                border-green-600
                uppercase
                rounded-full
                dark:hover:text-gray-200
                hover:text-white hover:border-none hover:bg-green-500
                cursor-pointer
              "
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
        <div class="flex justify-between text-xl font-bold text-gray-900 my-3">
          <span></span>
          <svg
            class="h-6 w-6 cursor-pointer"
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
          class="
            flex flex-col
            items-center
            text-xl
            font-bold
            text-gray-900
            my-3
          "
        >
          <span class="text-center"
            >Release {{ info.first_name }} {{ info.last_name }} loan?</span
          >
        </div>
        <div class="flex justify-center">
          <div
            class="
              flex
              justify-between
              text-xl
              font-bold
              dark:text-gray-200
              my-3
            "
          >
            <div
              class="
                flex
                space-x-2
                mr-5
                px-4
                py-1
                border
                text-md text-green-600
                dark:text-green-600 dark:border-green-600
                border-green-600
                uppercase
                rounded-full
                dark:hover:text-gray-200
                hover:text-white hover:border-none hover:bg-green-500
                cursor-pointer
              "
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
        <div class="flex justify-between text-xl font-bold text-gray-900 my-3">
          <span></span>
          <svg
            class="h-6 w-6 cursor-pointer"
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
          class="
            flex flex-col
            items-center
            text-xl
            font-bold
            text-gray-900
            my-3
          "
        >
          <span class="text-center"
            >Released {{ info.first_name }} {{ info.last_name }}'s loan?</span
          >
        </div>
        <div class="flex justify-center">
          <div
            class="
              flex
              justify-between
              text-xl
              font-bold
              dark:text-gray-200
              my-3
            "
          >
            <div
              class="
                flex
                space-x-2
                mr-5
                px-4
                py-1
                border
                text-md text-red-600
                dark:text-red-600 dark:border-red-600
                border-red-600
                uppercase
                rounded-full
                dark:hover:text-gray-200
                hover:text-white hover:border-none hover:bg-red-500
                cursor-pointer
              "
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
        <div class="flex justify-between text-xl font-bold text-gray-900 my-3">

          <svg
            class="h-6 w-6 cursor-pointer"
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
          class="
            flex flex-col
            items-center
            text-xl
            font-bold
            text-gray-900
            my-3
          "
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
          <div class="flex text-xl font-bold dark:text-gray-200 my-3">
            <div
              class="
                flex
                space-x-2
                px-4
                py-1
                border
                text-md text-red-600
                dark:text-red-600 dark:border-red-600
                border-red-600
                uppercase
                rounded-full
                dark:hover:text-gray-200
                hover:text-white hover:border-none hover:bg-red-500
                cursor-pointer
              "
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
