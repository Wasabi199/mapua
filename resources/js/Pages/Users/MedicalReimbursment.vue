<template>
  <AppLayout>
    <template #header>
      <div class="flex justify-between">
        <div class="flex items-center">
          <h1 class="font-extrabold text-xl text-gray-800 leading-tight">
            Medical Reimbursement
          </h1>
        </div>
      </div>
    </template>
    <div class="p-2 px-3 leading-tight flex justify-between items-center">
      <h1 class="text-xl text-gray-700 font-extrabold pl-8">
        Medical Reimbursement
      </h1>

      <div class="flex px-3 py-1 gap-2">
        <Listbox class="w-80" v-model="form.status">
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
                hidden

              "
            >
              Sort By: {{ form.status }}
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
                  v-for="approve in approval"
                  :key="approve"
                  :value="approve"
                  as="template"
                  ><li class="px-3 py-2 hover:bg-gray-200 cursor-pointer">
                    {{ approve }}
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
                hidden
                md:block
              "
            >
              <table class="min-w-full divide-y divide-gray-200">
                <tbody class="bg-white divide-y divide-gray-200">
                  <!-- <th class="text-left px-16 bg-gray-100">Name</th> -->
                  <th class="text-center px-16 bg-gray-100">Reimbursement Type</th>
                  <th class="text-center px-16 bg-gray-100">Amount</th>
                  <th class="text-center px-16 bg-gray-100">Medical Benefit</th>
                  <th class="text-center px-16 bg-gray-100">Approval</th>
                  <th class="text-left px-24 bg-gray-100">Action</th>

                  <tr v-for="medical in medicals.data" v-bind:key="medical.id">
                    <!-- <tr> -->
                    <td class="px-16 py-4 whitespace-nowrap">
                      <div class="">
                        <div>
                          <div class="text-sm text-center font-medium text-gray-900">
                            {{ medical.reimbursment_type }}
                          </div>
                        </div>
                      </div>
                    </td>

                    <td class="px-16 py-4 whitespace-nowrap">
                      <div class="">
                        <div>
                          <div class="text-sm text-center font-medium text-gray-900">
                            &#8369 {{ medical.amount.toLocaleString("en-US") }}.00
                          </div>
                        </div>
                      </div>
                    </td>

                    <td class="px-16 py-4 whitespace-nowrap">
                      <div class="">
                        <div>
                          <div class="text-sm text-center font-medium text-gray-900">
                            {{ medical.medical_benifit }}
                          </div>
                        </div>
                      </div>
                    </td>

                    <td class="px-16 py-4 whitespace-nowrap">
                      <div class="">
                        <div>
                          <div class="text-sm text-center font-medium text-gray-900">
                            {{ medical.status }}
                          </div>
                        </div>
                      </div>
                    </td>

                    <td class=" py-4 whitespace-nowrap">
                      <div
                        class="
                          w-fit
                          text-center
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
                        <Link :href="route('MedicalBreakdown', medical.id)">
                          <div>
                            <button>VIEW MEDICAL BREAKDOWN</button>
                          </div>
                        </Link>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>

              <pagination :links="medicals.links" />
            </div>

            <div
              class="grid grid-cols-1 gap-4 md:hidden"
              v-for="medical in medicals.data"
              v-bind:key="medical.id"
            >
              <div class="bg-white p-4 rounded-lg shadow">
                <div><b>Loan Type:</b> {{ medical.reimbursment_type }}</div>
                <div><b>Loan Amount:</b>&#8369 {{ medical.amount }}</div>
                <div><b>Medical Benefit:</b> {{ medical.medical_benifit }}</div>
                <div><b>Approval:</b> {{ medical.status }}</div>
                <div
                  class="
                    flex
                    items-center
                    pl-6
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
                  <Link :href="route('MedicalBreakdown', medical.id)">
                    <div>
                      <button>VIEW MEDICAL BREAKDOWN</button>
                    </div>
                  </Link>
                </div>
              </div>
            </div>
            <pagination class="md:hidden" :links="medicals.links" />
          </div>
        </div>
      </div>
    </div>

    <div class="flex justify-center px-4 py-1 whitespace-nowrap">
      <Link
        :href="route('createReimburstment')"
        class="
          flex
          space-x-2
          mr-5
          px-1
          py-1
          border
          text-sm text-yellow-600
          dark:text-yellow-600 dark:border-yellow-600
          border-yellow-600
          uppercase
          rounded-full
          dark:hover:text-gray-200
          hover:text-white hover:border-none hover:bg-yellow-500
          cursor-pointer
        "
      >
        <button>APPLY NEW REIMBURSEMENT</button>
      </Link>
    </div>

    <div class="flex justify-center px-6 py-4 whitespace-nowrap">
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
      >
        <Link :href="route('userDashboard')">
          <button>BACK TO HOME</button>
        </Link>
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
  },
  props: {
    medicals: Object,
    filters: Object,
    notification: Object,
    count: Number,
  },

  setup() {},

  data() {
    return {
      form: {
        
        // status: this.filters.status == null ? 'All' : this.filters.status,
      },

      approval: ["All", "Processing", "Approved", "Pending"],
    };
  },

  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get(route("medicalView"), pickBy(this.form), {
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
