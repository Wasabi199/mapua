<template>
  <AppLayout>
    <div class="flex justify-between bg-white shadow">
      <div
        class="flex items-center max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8"
      >
        <h2 class="font-extrabold text-xl text-gray-800 leading-tight">
          Medical Breakdown
        </h2>

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
        <h1 class="ont-extrabold text-xl text-gray-800 leading-tight">
          {{ info.first_name + info.last_name }}
        </h1>
      </div>
    </div>

    <div class="grid grid-cols-1 m-8 gap-8 lg:m-10 lg:grid-cols-2">
      <div
        class="bg-white p-4 overflow-hidden border-gray-300 shadow-xl rounded-lg"
      >
        <form>
          <div class="px-2 py-5 bg-white sm:p-6">
            <div class="grid grid-cols-6 gap-6">
              <div class="col-span-6 sm:col-span-3">
                <label class="block text-sm font-medium text-gray-700"
                  >Name of Borrower</label
                >
                <input
                  type="text"
                  class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                  :value="info.first_name + ' ' + info.last_name"
                  disabled
                />
              </div>

              <div class="col-span-6 sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700"
                  >Date of Employment</label
                >
                <input
                  type="date"
                  class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                  :value="info.employment"
                  disabled
                />
              </div>

              <div class="col-span-6 sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700"
                  >Years of Service</label
                >
                <input
                  type="text"
                  class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                  :value="
                    new Date().getUTCFullYear() -
                    new Date(info.membership).getUTCFullYear()
                  "
                  disabled
                />
              </div>

              <div class="col-span-6 sm:col-span-3">
                <label class="block text-sm font-medium text-gray-700"
                  >Amount</label
                >
                <div>
                    <span class="absolute mt-1.5 pl-2 font-bold">&#8369</span>
                <input
                  type="number"
                  class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md pl-6"
                  :value="medical.amount"
                  disabled
                />
              </div>
                </div>
              <div class="col-span-6 sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700"
                  >Reimbursement Type</label
                >
                <input
                  type="text"
                  class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                  :value="medical.reimbursment_type"
                  disabled
                />
              </div>
              <div class="col-span-6 sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700"
                  >Approval Status</label
                >
                <input
                  type="text"
                  class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                  :value="medical.status"
                  disabled
                />
              </div>
            </div>
          </div>
        </form>
      </div>
      <div v-if="medical.status == 'Approved'" class="row-span-3">
        <div class="bg-white shadow-xl rounded-lg content-center lg:mr-50">
          <span>Official Receipt</span>
          <div
            v-for="attachment in medical.attachments"
            v-bind:key="attachment.id"
          >
            <img
              class="w-64 h-64"
              v-if="attachment.type == 1"
              :src="
                attachment.image == null ? '' : '../../../' + attachment.image
              "
            />
          </div>
        </div>
        <div class="bg-white shadow-xl rounded-lg content-center lg:mr-50">
          <span>Medical Certificate/Doctor's Prescription</span>
          <div
            v-for="attachment in medical.attachments"
            v-bind:key="attachment.id"
          >
            <img
              class="w-64 h-64"
              v-if="attachment.type == 2"
              :src="
                attachment.image == null ? '' : '../../../' + attachment.image
              "
            />
          </div>
        </div>
        <div class="bg-white shadow-xl rounded-lg content-center lg:mr-50">
          <div>
            <span v-if="medical.hospital == true">Statement of Account</span>
            <span v-if="medical.health == true">Doctor's Endorsement</span>
          </div>
          <div
            v-for="attachment in medical.attachments"
            v-bind:key="attachment.id"
          >
            <img
              class="w-64 h-64"
              v-if="attachment.type == 3"
              :src="
                attachment.image == null ? '' : '../../../' + attachment.image
              "
            />
          </div>
        </div>
        <div class="bg-white shadow-xl rounded-lg content-center lg:mr-50">
          <div>
            <span v-if="medical.health == true">Lab Results</span>
          </div>
          <div
            v-for="attachment in medical.attachments"
            v-bind:key="attachment.id"
          >
            <img
              class="w-64 h-64"
              v-if="attachment.type == 4"
              :src="
                attachment.image == null ? '' : '../../../' + attachment.image
              "
            />
          </div>
        </div>
      </div>
      <div v-if="medical.status == 'For Release'" class="row-span-3">
        <div class="w-full bg-white shadow-xl rounded-lg p-5">
          <p class="font-semibold">Good News!</p>
          <p>Your Medical Reimbursement has been processed.</p>
          <p>
            A representative will send you an email for updates on the release of your loan.
          </p>
        </div>
      </div>
      <div v-if="medical.status == 'Released'" class="row-span-3">
        <div class="w-full bg-white shadow-xl rounded-lg p-5">
          <div class="flex gap-x-2 m-auto w-fit">
            <p class="font-semibold">Amount:</p>
            <p>{{ medical.amount.toLocaleString("en-US") }}.00</p>
          </div>
          <div class="flex gap-x-2 m-auto w-fit">
            <p class="font-semibold">Date Released:</p>
            <p>{{ new Date(medical.updated_at) }}</p>
          </div>
        </div>
      </div>
    </div>

    <div class="flex justify-center">
      <div class="flex justify-between my-3">
        <div
          class="flex space-x-2 mr-5 px-4 py-1 border text-md text-red-600 dark:text-red-600 dark:border-red-600 border-red-600 uppercase rounded-full dark:hover:text-gray-200 hover:text-white hover:border-none hover:bg-red-500 cursor-pointer"
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
    medical: Object,
    notification: Object,
    count: Number,
    info: Object,
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
