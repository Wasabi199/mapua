<template>
  <AppLayout>
    <template #header>
      <div class="flex justify-between">
        <div class="flex items-center">
          <h1 class="text-xl font-extrabold leading-tight text-gray-800">
            Medical Reimbursements
          </h1>
        </div>
      </div>
    </template>

    <div class="mx-12 my-6 shadow-md">
      <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="flex items-center justify-end p-2 px-6 leading-tight">
              <!-- <h1 class="pl-8 text-xl font-extrabold text-gray-700">Loans</h1> -->

              <div class="flex gap-2 px-3 py-1">
                <Listbox class="w-80" v-model="form.status">
                  <div class="relative">
                    <ListboxButton
                      class="w-full py-2 pl-3 pr-10 text-left bg-white rounded-lg shadow-md cursor-default elative focus:outline-none focus-visible:ring-2 focus-visible:ring-opacity-75 focus-visible:ring-white focus-visible:ring-offset-orange-300 focus-visible:ring-offset-2 focus-visible:border-indigo-500 sm:text-sm">
                      View By: {{ form.status }}
                      <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                        <SelectorIcon class="w-5 h-5 text-gray-400" aria-hidden="true" />
                      </span>
                    </ListboxButton>
                    <transition leave-active-class="transition duration-100 ease-in" leave-from-class="opacity-100"
                      leave-to-class="opacity-0">
                      <ListboxOptions
                        class="absolute w-full py-1 mt-1 overflow-auto text-base bg-white rounded-md shadow-lg max-h-60 ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                        <ListboxOption v-for="status in statuses" :key="status" :value="status" as="template">
                          <li class="px-3 py-2 cursor-pointer hover:bg-gray-200">
                            {{ status }}
                          </li>
                        </ListboxOption>
                      </ListboxOptions>
                    </transition>
                  </div>
                </Listbox>
              </div>
            </div>
          <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            
            <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200">
                <tbody class="bg-white divide-y divide-gray-200">
                  <!-- <th class="px-16 text-left bg-gray-100">Name</th> -->
                  <th class="px-16 text-center bg-gray-100">Medical Type</th>
                  <th class="px-16 text-center bg-gray-100">Name</th>
                  <!-- <th class="px-16 text-center bg-gray-100">Medical Benefit</th> -->
                  <th class="px-16 text-center bg-gray-100">Status</th>
                  <!-- <th class="px-16 text-center bg-gray-100">Amount</th> -->
                  <th class="px-16 text-left bg-gray-100">Action</th>

                  <tr v-for="med in medical.data" v-bind:key="med.id">
                    <!-- <tr> -->
                    <td class="px-16 py-4 whitespace-nowrap">
                      <div class="text-center">
                        <div class="">
                          <Link :href="route('medicalProfile', med.id)">
                          <div class="text-sm font-medium text-gray-900">
                            {{ med.reimbursment_type }}
                          </div>
                          </Link>
                        </div>
                      </div>
                    </td>
                    <td class="px-16 py-4 whitespace-nowrap">
                      <div class="">
                        <div>
                          <div class="text-sm font-medium text-center text-gray-900">
                            {{ med.user.name }}
                          </div>
                        </div>
                      </div>
                    </td>

                    <!-- <td class="px-24 py-4 whitespace-nowrap">
                      <div class="">
                        <div>
                          <div class="text-sm font-medium text-center text-gray-900">
                            {{ med.medical_benifit }}
                          </div>
                        </div>
                      </div>
                    </td> -->

                    <td class="px-16 py-4 whitespace-nowrap">
                      <div class="">
                        <div>
                          <div class="text-sm font-medium text-center text-gray-900">
                            {{ med.status }}
                          </div>
                        </div>
                      </div>
                    </td>

                    <!-- <td class="px-16 py-4 whitespace-nowrap">
                      <div class="">
                        <div>
                          <div class="text-sm font-medium text-center text-gray-900">
                            ₱ {{ med.amount.toLocaleString("en-US") }}.00
                          </div>
                        </div>
                      </div>
                    </td> -->
                    <td class="px-[4%] py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="text-center">
                          <div class="text-sm font-medium text-gray-900">
                            <Link :href="route('medicalProfile', med.id)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                              class="text-green-500 bi bi-eye" viewBox="0 0 16 16">
                              <path
                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                              <path
                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                            </svg>
                            </Link>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>

              <pagination :links="medical.links" />
            </div>
          </div>
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
    Listbox,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
  },

  setup() { },
  props: {
    medical: Object,
    notification: Object,
    count: Number,
    filter: Object,
  },
  data() {
    return {


      form: {
        status: this.filter.status
      },

      statuses: [
      "All",
      "Pending",
      "For Approval",
        "Approved",
        "For Release",
        "Released",
        "Rejected",
      ],
 
      // statuses: ["Pending", "Aprrove", "Processing"],
    };
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get(route("medicalList"), pickBy(this.form), {
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
