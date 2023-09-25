<template>
  <AppLayout title="Loans">
    <template #header>
      <div class="flex justify-between">
        <div class="flex items-center">
          <h1 class="font-extrabold text-xl text-gray-800 leading-tight">
            Loans
          </h1>
        </div>
      </div>
    </template>

    <div class="p-2 px-6 leading-tight flex justify-end items-center">
      <!-- <h1 class="text-xl text-gray-700 font-extrabold pl-8">Loans</h1> -->

      <div class="flex px-3 py-1 gap-2">
        <Listbox class="w-80" v-model="form.approval">
          <div class="relative">
            <ListboxButton
              class="
                elative
                w-full
                py-2
                pl-3
                pr-10
                text-left
                bg-white
                rounded-lg
                shadow-md
                cursor-default
                focus:outline-none
                focus-visible:ring-2
                focus-visible:ring-opacity-75
                focus-visible:ring-white
                focus-visible:ring-offset-orange-300
                focus-visible:ring-offset-2
                focus-visible:border-indigo-500
                sm:text-sm
              "
            >
              View By: {{ form.approval }}
              <span
                class="
                  absolute
                  inset-y-0
                  right-0
                  flex
                  items-center
                  pr-2
                  pointer-events-none
                "
              >
                <SelectorIcon
                  class="w-5 h-5 text-gray-400"
                  aria-hidden="true"
                />
              </span>
            </ListboxButton>
            <transition
              leave-active-class="transition duration-100 ease-in"
              leave-from-class="opacity-100"
              leave-to-class="opacity-0"
            >
              <ListboxOptions
                class="
                  absolute
                  w-full
                  py-1
                  mt-1
                  overflow-auto
                  text-base
                  bg-white
                  rounded-md
                  shadow-lg
                  max-h-60
                  ring-1 ring-black ring-opacity-5
                  focus:outline-none
                  sm:text-sm
                "
              >
                <ListboxOption
                  v-for="status in statuses"
                  :key="status"
                  :value="status"
                  as="template"
                  ><li class="px-3 py-2 hover:bg-gray-200 cursor-pointer">
                    {{ status }}
                  </li></ListboxOption
                >
              </ListboxOptions>
            </transition>
          </div>
        </Listbox>
      </div>
    </div>

    <div class="mx-12 my-6 shadow-md">
      <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div
            class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
          >
            <div
              class="
                shadow
                overflow-hidden
                border-b border-gray-200
                sm:rounded-lg
              "
            >
              <table class="min-w-full divide-y divide-gray-200">
                <tbody
                  class="
                    bg-white
                    divide-y divide-gray-200
                    border-gray-200
                    sm:rounded-lg
                  "
                >
                  <th class="text-center px-16 bg-gray-100">Name</th>
                  <th class="text-center px-16 bg-gray-100">Loan Type</th>
                  <th class="text-center px-16 bg-gray-100">Loan Balance</th>
                  <th class="text-center px-16 bg-gray-100">Status</th>
                  <th class="text-center px-16 bg-gray-100">Duration</th>
                  <th class="text-center px-16 bg-gray-100">Last Updated Loan Payment</th>
                  <th class="text-left px-16 bg-gray-100">Action</th>

                  <tr v-for="loan in loans.data" v-bind:key="loan.id">
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="">
                        <div>
                          <Link :href="route('contributions', loan.id)">
                            <div class="text-sm text-center font-medium text-gray-900">
                              {{ loan.user.name }}
                            </div>
                          </Link>
                        </div>
                      </div>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="">
                        <div>
                          <div class="text-sm text-center font-medium text-gray-900">
                            {{
                              loan.loan_type
                            }}
                          </div>
                        </div>
                      </div>
                    </td>

                    <td class="px-14 py-4 whitespace-nowrap">
                      <div class="">
                        <div>
                          <div class="text-sm text-center font-medium text-gray-900">
                            &#8369 {{loan.loan_amount.toLocaleString("en-US")}}.00
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class=" py-4 whitespace-nowrap">
                      <div class="">
                        <div class="">
                          <div class="text-sm text-center font-medium text-gray-900">
                            {{
                              loan.approval
                            }}
                          </div>
                        </div>
                      </div>
                    </td>

                    <td class=" py-4 whitespace-nowrap">
                      <div class="">
                        <div>
                          <div class="text-sm text-center font-medium text-gray-900">
                            {{
                              loan.duration
                            }} months
                          </div>
                        </div>
                      </div>
                    </td>

                    <td class="px-10 py-4 whitespace-nowrap">
                      <div class="">
                        <div>
                          <div class="text-sm text-center font-medium text-gray-900">
                           {{
                              loan.contributions[loan.contributions.length-1] != null? new Date(loan.contributions[loan.contributions.length-1].created_at).toLocaleDateString()+" "+new Date(loan.contributions[loan.contributions.length-1].created_at).toLocaleTimeString():'No Loan Payment Yet'
                            }}
                          </div>
                        </div>
                      </div>
                    </td>

                    <td class="px-20 py-4 whitespace-nowrap">
                      <div class="">
                        <div class="">
                          <div class="text-sm font-medium text-green-700">
                            <Link :href="route('contributions', loan.id)">
                              <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="20"
                                fill="currentColor"
                                class="bi bi-eye"
                                viewBox="0 0 16 16"
                              >
                                <path
                                  d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"
                                />
                                <path
                                  d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"
                                />
                              </svg>
                            </Link>
                          </div>
                        </div>
                      </div>
                    </td>

                  </tr>
                </tbody>
              </table>

              <pagination :links="loans.links " @limit-event="limitEvent" />

              <Modal
                :closeable="true"
                :show="showDeleteModal"
                @close="showDeleteModal = !showDeleteModal"
              >
                <div class="p-5">
                  <div
                    class="
                      flex
                      justify-between
                      text-xl
                      font-bold
                      text-gray-900
                      my-3
                    "
                  >
                    <span>Update Loan Table</span>
                    <svg
                      class="h-6 w-6 cursor-pointer"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                      xmlns="http://www.w3.org/2000/svg"
                      @click="showDeleteModal = !showDeleteModal"
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
                    <svg
                      class="h-36 w-36 rounded-full text-red-700 opacity-60"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="1.5px"
                      version="1.1"
                      viewBox="0 0 40 40"
                      xml:space="preserve"
                      xmlns="http://www.w3.org/2000/svg"
                      xmlns:xlink="http://www.w3.org/1999/xlink"
                    >
                      <g>
                        <path
                          d="M17.125,0C7.668,0,0,7.667,0,17.125S7.668,34.25,17.125,34.25c9.459,0,17.125-7.667,17.125-17.125S26.584,0,17.125,0z    M23.445,11.422c1.355,0,2.453,1.099,2.453,2.453s-1.098,2.453-2.453,2.453c-1.354,0-2.451-1.099-2.451-2.453   S22.093,11.422,23.445,11.422z M10.806,11.422c1.354,0,2.453,1.099,2.453,2.453s-1.099,2.453-2.453,2.453s-2.453-1.099-2.453-2.453   S9.453,11.422,10.806,11.422z M26.457,25.641c-0.26,0.492-0.77,0.801-1.328,0.801H9.121c-0.559,0-1.067-0.309-1.328-0.801   c-0.26-0.494-0.225-1.09,0.093-1.549c2.098-3.046,5.551-4.865,9.239-4.865c3.689,0,7.146,1.819,9.24,4.866   C26.684,24.55,26.718,25.146,26.457,25.641z"
                        />
                      </g>
                      <g></g>
                      <g></g>
                      <g></g>
                      <g></g>
                      <g></g>
                      <g></g>
                      <g></g>
                      <g></g>
                      <g></g>
                      <g></g>
                      <g></g>
                      <g></g>
                      <g></g>
                      <g></g>
                      <g></g>
                    </svg>
                    <span class="text-center"
                      >You are about to delete {{ loanToDelete.user.name }}'s
                      {{ loanToDelete.loan_type }} loan are you sure you want to
                      proceed?</span
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
                        @click="submitDeleteLoan"
                      >
                        <svg
                          class="h-6 w-6"
                          fill="none"
                          stroke="currentColor"
                          viewBox="0 0 24 24"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                          />
                        </svg>
                        <span>Yes I'm sure</span>
                      </div>
                    </div>
                    <div class="flex text-xl font-bold dark:text-gray-200 my-3">
                      <div
                        class="
                          flex
                          space-x-2
                          px-4
                          py-1
                          border
                          text-md text-gray-600
                          dark:text-gray-600 dark:border-gray-600
                          border-gray-600
                          uppercase
                          rounded-full
                          dark:hover:text-gray-200
                          hover:text-white hover:border-none hover:bg-gray-500
                          cursor-pointer
                        "
                        @click="showDeleteModal = !showDeleteModal"
                      >
                        <svg
                          class="h-6 w-6"
                          fill="none"
                          stroke="currentColor"
                          viewBox="0 0 24 24"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                          />
                        </svg>
                        <span>Nevermind</span>
                      </div>
                    </div>
                  </div>
                </div>
              </Modal>
            </div>
          </div>
        </div>
      </div>
    </div>
    <form enctype="multipart/form-data" @submit.prevent="verify">
      <div class="pl-12">Update Loan Payment/s</div>
      <JetValidationErrors class="mb-4" />
      <input
        @input="forms.file = $event.target.files[0]"
        name="file"
        type="file"
        class="
          border border-yellow-500
          hover:bg-yellow-300
          rounded-md
          m-2
          p-2
          flex
          items-center
          ml-12
        "
      />
      <button

        type="submit"
        class="
          border border-yellow-500
          hover:bg-yellow-300
          rounded-md
          m-2
          p-2
          flex
          items-center
          ml-12
        "
      >
        <svg
          class="h-4 w-4 mr-2"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
        </svg>
        Upload csv file
      </button>
    </form>
    <Modal :closeable="true" :show="showPasswordModal" @close="showPasswordModal = !showPasswordModal">
      <div class="p-5">
      <div class="flex justify-between ">
        <div class="text-2xl font-semibold">Password</div>
        <div class="">
          <svg
            class="h-6 w-6 cursor-pointer"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
            @click="showPasswordModal = !showPasswordModal"
          >
            <path
              d="M6 18L18 6M6 6l12 12"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
            />
          </svg>
        </div>

      </div>
      <div class="text-center text-2xl py-5">Please Enter Password for Validation</div>
      <JetValidationErrors class="mb-4 ml-12"  />
      <div class="pt-5">

        <JetLabel class="text-lg">Password</JetLabel>
        <JetInput v-model="this.forms.password" class="w-full" type="password"/>
      </div>
      <div class="m-auto w-fit">
        <button @click="submit" class="border-2 border-green-400 py-3 px-10 mt-5 rounded-lg font-semibold text-lg hover:bg-green-500 hover:text-white">Verify</button>
      </div>
    </div>
    </Modal>
  </AppLayout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import JetApplicationLogo from "@/Jetstream/ApplicationLogo.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Modal from "@/Jetstream/Modal";
import { pickBy, throttle } from "lodash";
import JetInput from '@/Jetstream/Input.vue';
import JetLabel from '@/Jetstream/Label.vue';
import route from "../../../../vendor/tightenco/ziggy/src/js";
import { useForm } from "@inertiajs/inertia-vue3";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import {
  Listbox,
  ListboxButton,
  ListboxOptions,
  ListboxOption,
} from "@headlessui/vue";
// import SelectorIcon
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
    JetValidationErrors,
    // SelectorIcon
    JetInput,
    JetLabel
  },
  props: {
    loans: Object,
    filters: Object,
    notification: Object,
    count: Number,
  },

  setup() {
    const forms = useForm({
      file: null,
      password:'',
    });

    function submit() {
      this.showPasswordModal = !this.showPasswordModal
      forms.post(route("importContributions"));
    }
    return { forms, submit };
  },

  data() {
    return {
      loanToDelete: Object,
      showDeleteModal: false,
      showPasswordModal:false,

      form: {
        limit:this.filters.limit == null ? 5:this.filters.limit,
        approval: this.filters.approval == null ? "All" : this.filters.approval,
      },

      statuses: [
        "All",
        "Submitted",
        "For Processing",
        "Processed",
        "For Release",
        "Released",
        "Denied",
      ],

      deleteForm: this.$inertia.form({
        id: Number,
      }),


    };
  },

  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get(route("adminLoansView"), pickBy(this.form), {
          preserveState: true,
          preserveScroll: true,
        });
      }, 600),
    },
  },

  methods: {
    deleteLoan(loan) {
      this.loanToDelete = loan;
      this.showDeleteModal = !this.showDeleteModal;
    },
    submitDeleteLoan() {
      this.deleteForm.id = this.loanToDelete.id;
      this.deleteForm.delete(route("loanDelete"), {
        onSuccess: () => {
          this.showDeleteModal = false;
        },
      });
    },
    verify(){
      this.showPasswordModal = !this.showPasswordModal
    },
    limitEvent(event){
            console.log(event)
            this.form.limit = event
        }
  },
};
</script>
<style scoped>
i {
  font-size: 1rem !important;
}
</style>
