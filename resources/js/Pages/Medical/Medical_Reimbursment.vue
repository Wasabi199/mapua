<template>
  <AppLayout>
    <template #header>
      <div class="flex justify-between">
        <div class="flex items-center">
          <h1 class="font-extrabold text-xl text-gray-800 leading-tight">
            Medical Reimbursements
          </h1>
        </div>
      </div>
    </template>

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
                <tbody class="bg-white divide-y divide-gray-200">
                  <!-- <th class="text-left px-16 bg-gray-100">Name</th> -->
                  <th class="text-center px-16 bg-gray-100">Medical Type</th>
                  <th class="text-center px-16 bg-gray-100">Name</th>
                  <th class="text-center px-16 bg-gray-100">Medical Benefit</th>
                  <th class="text-center px-16 bg-gray-100">Status</th>
                  <th class="text-center px-16 bg-gray-100">Amount</th>
                  <th class="text-left px-16 bg-gray-100">Action</th>

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
                          <div class="text-sm font-medium text-gray-900 text-center">
                            {{ med.user.name }}
                          </div>
                        </div>
                      </div>
                    </td>

                    <td class="px-24 py-4 whitespace-nowrap">
                      <div class="">
                        <div>
                          <div class="text-sm font-medium text-gray-900 text-center">
                            {{ med.medical_benifit }}
                          </div>
                        </div>
                      </div>
                    </td>

                    <td class="px-16 py-4 whitespace-nowrap">
                      <div class="">
                        <div>
                          <div class="text-sm font-medium text-gray-900 text-center">
                            {{ med.status }}
                          </div>
                        </div>
                      </div>
                    </td>

                    <td class="px-16 py-4 whitespace-nowrap">
                      <div class="">
                        <div>
                          <div class="text-sm font-medium text-gray-900 text-center">
                            ₱ {{ med.amount.toLocaleString("en-US") }}.00
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="px-[4%] py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="text-center">
                          <div class="text-sm font-medium text-gray-900">
                            <Link :href="route('medicalProfile', med.id)">
                              <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="25"
                                height="25"
                                fill="currentColor"
                                class="bi bi-eye text-green-500"
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

  setup() {},
  props: {
    medical: Object,
    notification: Object,
    count: Number,
  },
  data() {
    return {
      // form: {
      // search: this.filters.search,

      // },
      statuses: ["Pending", "Aprrove", "Processing"],
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
