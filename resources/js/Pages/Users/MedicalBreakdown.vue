<template>
  <AppLayout>
    <div class="flex justify-between bg-white shadow">
      <div class="flex items-center px-4 py-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <Link :href="route('userDashboard')">
        <h2 class="text-xl font-extrabold leading-tight text-gray-800">
          Medical Breakdown
        </h2>
        </Link>
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <h1 class="text-xl leading-tight text-gray-800 ont-extrabold">
          {{ info.first_name + info.last_name }}
        </h1>
      </div>
    </div>

    <div class="grid grid-cols-1 gap-8 m-8 lg:m-10 lg:grid-cols-2">
      <div class="p-4 overflow-hidden bg-white border-gray-300 rounded-lg shadow-xl">
        <form>
          <div class="px-2 py-5 bg-white sm:p-6">
            <div class="grid grid-cols-6 gap-6">
              <div class="col-span-6 sm:col-span-3">
                <label class="block text-sm font-medium text-gray-700">Name of Borrower</label>
                <input type="text" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                  :value="info.first_name + ' ' + info.last_name" disabled />
              </div>

              <div class="col-span-6 sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Date of Employment</label>
                <input type="date" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                  :value="info.employment" disabled />
              </div>

              <div class="col-span-6 sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Years of Service</label>
                <input type="text" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm" :value="new Date().getUTCFullYear() -
                  new Date(info.membership).getUTCFullYear()
                  " disabled />
              </div>

              <div class="col-span-6 sm:col-span-3">
                <label class="block text-sm font-medium text-gray-700">Amount</label>
                <div>
                  <span class="absolute mt-1.5 pl-2 font-bold">&#8369</span>
                  <input type="number" class="block w-full pl-6 mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                    :value="medical.amount" disabled />
                </div>
              </div>
              <div class="col-span-6 sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Reimbursement Type</label>
                <input type="text" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                  :value="medical.reimbursment_type" disabled />
              </div>
              <div class="col-span-6 sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Approval Status</label>
                <input type="text" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                  :value="medical.status" disabled />
              </div>
            </div>
          </div>
        </form>
      </div>
      <div v-if="medical.status == 'Approved'" class="row-span-3">
        <div class="content-center bg-white rounded-lg shadow-xl lg:mr-50">
          <span>Official Receipt</span>
          <div v-for="attachment in medical.attachments" v-bind:key="attachment.id">
            <img class="w-64 h-64" v-if="attachment.type == 1" :src="attachment.image == null ? '' : attachment.image
              " />
          </div>
        </div>
        <div class="content-center bg-white rounded-lg shadow-xl lg:mr-50">
          <span>Medical Certificate/Doctor's Prescription</span>
          <div v-for="attachment in medical.attachments" v-bind:key="attachment.id">
            <img class="w-64 h-64" v-if="attachment.type == 2" :src="attachment.image == null ? '' :  attachment.image
              " />
          </div>
        </div>
        <div class="content-center bg-white rounded-lg shadow-xl lg:mr-50">
          <div>
            <span v-if="medical.hospital == true">Statement of Account</span>
            <span v-if="medical.health == true">Doctor's Endorsement</span>
          </div>
          <div v-for="attachment in medical.attachments" v-bind:key="attachment.id">
            <img class="w-64 h-64" v-if="attachment.type == 3" :src="attachment.image == null ? '' :  attachment.image
              " />
          </div>
        </div>
        <div class="content-center bg-white rounded-lg shadow-xl lg:mr-50">
          <div>
            <span v-if="medical.health == true">Lab Results</span>
          </div>
          <div v-for="attachment in medical.attachments" v-bind:key="attachment.id">
            <img class="w-64 h-64" v-if="attachment.type == 4" :src="attachment.image == null ? '' :  attachment.image
              " />
          </div>
        </div>
      </div>
      <div v-if="medical.status == 'For Release'" class="row-span-3">
        <div class="w-full p-5 bg-white rounded-lg shadow-xl">
          <p class="font-semibold">Good News!</p>
          <p>Your Medical Reimbursement has been processed.</p>
          <p>
            A representative will send you an email for updates on the release of your loan.
          </p>
        </div>
      </div>
      <div v-if="medical.status == 'Released'" class="row-span-3">
        <div class="w-full p-5 bg-white rounded-lg shadow-xl">
          <div class="flex m-auto gap-x-2 w-fit">
            <p class="font-semibold">Amount:</p>
            <p>{{ medical.amount.toLocaleString("en-US") }}</p>
          </div>
          <div class="flex m-auto gap-x-2 w-fit">
            <p class="font-semibold">Date Released:</p>
            <p>{{ new Date(medical.updated_at) }}</p>
          </div>
        </div>
      </div>
    </div>

    <div class="flex justify-center">
      <div class="flex justify-between my-3">
        <div
          class="flex px-4 py-1 mr-5 space-x-2 text-red-600 uppercase border border-red-600 rounded-full cursor-pointer text-md dark:text-red-600 dark:border-red-600 dark:hover:text-gray-200 hover:text-white hover:border-none hover:bg-red-500">
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

  setup() { },

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
