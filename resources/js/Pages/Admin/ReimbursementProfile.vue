<template>
  <AppLayout>
    <template #header>
      <div class="flex justify-between">
        <div class="flex items-center">
          <Link :href="route('ReimbursementView')">
            <h1
              class="text-xl font-extrabold leading-tight text-gray-800 hover:underline"
            >
              Reimbursement
            </h1>
          </Link>
        </div>
      </div>
    </template>
    <div class="flex px-10 py-5 gap-x-5">
      <div class="w-full">
        <div class="p-5 bg-white rounded-lg shadow-xl h-fit">
          <div class="flex gap-x-2">
            <p>Name:</p>
            <p class="font-semibold">
              {{
                info.first_name + " " + info.middle_name + " " + info.last_name
              }}
            </p>
          </div>
          <div class="flex gap-x-2">
            <p>Reimbursement Type:</p>
            <p class="font-semibold">{{ medical.reimbursment_type }}</p>
          </div>
          <div class="flex gap-x-2">
            <p>Status:</p>
            <p class="font-semibold">{{ medical.status }}</p>
          </div>
          <div class="flex gap-x-2">
            <p>Reimbursement Amount:</p>
            <p class="font-semibold">&#8369 {{ medical.amount.toLocaleString("en-US") }}</p>
          </div>
          <div class="flex gap-x-2">
            <p>Reimbursement Benefit:</p>
            <p class="font-semibold">{{ medical.medical_benifit }}</p>
          </div>
        </div>

        <!-- <div>
          
        </div> -->
        
        <div class="m-auto mt-10 w-fit">
          <button v-if="this.medical.status == 'Approved'"
            class="bg-[#DC2626] text-white py-4 px-20 text-lg rounded-lg"
            @click="showForReleasedModal = !showForReleasedModal"
          >
            For Release
          </button>
          <button v-if="this.medical.status == 'For Release'"
            class="bg-[#DC2626] text-white py-4 px-20 text-lg rounded-lg"
            @click="(showReleasedModal = !showReleasedModal)"
          >
            Released
          </button>
        </div>
      </div>
      <div
        v-if="this.medical.status == 'Approved'"
        class="w-full p-5 bg-white rounded-lg shadow-xl h-fit "
      >
        <div class="content-center mb-5 rounded-lg lg:mr-50">
          <span>Official Reciept:</span>
          <div
            v-for="attachment in medical.attachments"
            v-bind:key="attachment.id"
          >
            <img
              class="w-64 h-64"
              v-if="attachment.type == 1"
              :src="
                attachment.image == null ? '' :  attachment.image
              "
            />
          </div>
        </div>
        <div class="content-center rounded-lg lg:mr-50">
          <span>Medical Certificate/Doctor's Prescription:</span>
          <div
            v-for="attachment in medical.attachments"
            v-bind:key="attachment.id"
          >
            <img
              class="w-64 h-64"
              v-if="attachment.type == 2"
              :src="
                attachment.image == null ? '' : attachment.image
              "
            />
          </div>
        </div>
        <div
          v-if="
            this.medical.hospital == true ||
            this.medical.health == true
          "
          class="content-center rounded-lg lg:mr-50"
        >
          <div>
            <span v-if="this.medical.hospital == true"
              >Statement of Account</span
            >
            <span v-if="this.medical.health == true"
              >Doctor's Endorsement</span
            >
          </div>
          <div
            v-for="attachment in medical.attachments"
            v-bind:key="attachment.id"
          >
            <img
              class="w-64 h-64"
              v-if="attachment.type == 3"
              :src="
                attachment.image == null ? '' :  attachment.image
              "
            />
          </div>
        </div>
        <div
          v-if="this.medical.health == true"
          class="content-center rounded-lg lg:mr-50"
        >
          <div>
            <span v-if="medical.health == true"
              >Lab Results</span
            >
          </div>
          <div
            v-for="attachment in medical.attachments"
            v-bind:key="attachment.id"
          >
            <img
              class="w-64 h-64"
              v-if="attachment.type == 4"
              :src="
                attachment.image == null ? '' :  attachment.image
              "
            />
          </div>
        </div>
      </div>
      <div
        v-if="this.medical.status == 'For Release'"
        class="w-full p-5 bg-white rounded-lg shadow-xl"
      >
        <p class="font-semibold">Good News!</p>
        <p>Your Medical Reimbursement has been processed.</p>
        <p>
          A representative will send you an email for updates on the release of your loan.
        </p>
      </div>
      <div
        v-if="this.medical.status == 'Released'"
        class="w-full p-5 bg-white rounded-lg shadow-xl"
      >
        <div class="flex m-auto gap-x-2 w-fit">
          <p class="font-semibold">Amount:</p>
          <p>{{this.medical.amount.toLocaleString("en-US")}}</p>
        </div>
        <div class="flex m-auto gap-x-2 w-fit">
          <p class="font-semibold">Date Released:</p>
          <p>{{new Date(this.medical.updated_at)}}</p>
        </div>
      </div>
    </div>

    <Modal
      :closeable="true"
      :show="showForReleasedModal"
      @close="showForReleasedModal = !showForReleasedModal"
    >
      <div class="p-5">
        <div class="flex justify-end my-3 text-xl font-bold text-gray-900">
          <svg
            class="w-6 h-6 cursor-pointer"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
            @click="showForReleasedModal = !showForReleasedModal"
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
          class="flex flex-col items-center my-10 text-xl font-bold text-gray-900 "
        >
          <span
            >{{
              this.info.first_name +
              " " +
              this.info.middle_name +
              " " +
              this.info.last_name
            }}'s Reimbursement is for Release.</span
          >
        </div>

        <div class="flex justify-center">
          <div class="flex my-3 text-xl font-bold dark:text-gray-200">
            <div
              class="flex px-4 py-1 space-x-2 text-red-600 uppercase border border-red-600 rounded-full cursor-pointer text-md dark:text-red-600 dark:border-red-600 dark:hover:text-gray-200 hover:text-white hover:border-none hover:bg-red-500"
              @click="reimbursementReleaseFunction()"
            >
              <span>For Release</span>
            </div>
          </div>
        </div>
      </div>
    </Modal>

    <Modal
      :closeable="true"
      :show="showReleasedModal"
      @close="(showReleasedModal = !showReleasedModal)"
    >
      <div class="p-5">
        <div class="flex justify-end my-3 text-xl font-bold text-gray-900">
          <svg
            class="w-6 h-6 cursor-pointer"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
            @click="(showReleasedModal = !showReleasedModal)"
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
          class="flex flex-col items-center my-10 text-xl font-bold text-gray-900 "
        >
          <span
            >{{
              this.info.first_name +
              " " +
              this.info.middle_name +
              " " +
              this.info.last_name
            }}'s Reimbursement has been Released.</span
          >
        </div>

        <div class="flex justify-center">
          <div class="flex my-3 text-xl font-bold dark:text-gray-200">
            <div
              class="flex px-4 py-1 space-x-2 text-red-600 uppercase border border-red-600 rounded-full cursor-pointer text-md dark:text-red-600 dark:border-red-600 dark:hover:text-gray-200 hover:text-white hover:border-none hover:bg-red-500"
              @click="reimbursementReleasedFunction()"
            >
              <span>Released</span>
            </div>
          </div>
        </div>
      </div>
    </Modal>
  </AppLayout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Modal from "@/Jetstream/Modal";

export default {
  setup() {},
  components: {
    AppLayout,
    Link,
    Modal,
  },
  props: {
    medical: Object,
    info: Object,
  },
  data() {
    return {
      showForReleasedModal: false,
      showReleasedModal:false,
      reimbursementRelease: this.$inertia.form({
        id: Number,
        status: "",
      }),
    };
  },
  methods: {
    reimbursementReleaseFunction() {
      this.reimbursementRelease.id = this.medical.id;
      this.reimbursementRelease.status = "For Release";

      this.reimbursementRelease.post(route("updateReimbursement"), {
        onSuccess: () => {
          this.showForReleasedModal = false;
        },
      });
    },
    reimbursementReleasedFunction() {
      this.reimbursementRelease.id = this.medical.id;
      this.reimbursementRelease.status = "Released";

      this.reimbursementRelease.post(route("updateReimbursement"), {
        onSuccess: () => {
          this.showReleasedModal = false;
        },
      });
    },
  },
};
</script>
