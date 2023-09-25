<template>
  <AppLayout>
    <template #header>
      <div class="flex justify-between">
        <div class="flex items-center">
          <Link :href="route('medicalList')">
            <h1 class="font-extrabold text-xl text-gray-800 leading-tight">
              Current Medical
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
            {{ userProfile.first_name }} {{ userProfile.middle_name }}
            {{ userProfile.last_name }}'s
          </h1>
        </div>
      </div>
    </template>

    <div class="grid grid-cols-1 m-8 gap-8 lg:m-10 lg:grid-cols-2">
      <div
        class="
          bg-white
          p-4
          overflow-hidden
          border-gray-300
          shadow-xl
          rounded-lg
        "
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
                  class="
                    mt-1
                    block
                    w-full
                    shadow-sm
                    sm:text-sm
                    border-gray-300
                    rounded-md
                  "
                  v-model="name"
                  disabled
                />
              </div>

              <div class="col-span-6 sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700"
                  >Date of Birth</label
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
                  v-model="birthday"
                  disabled
                />
              </div>

              <div class="col-span-6 sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700"
                  >Age</label
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
                  v-model="age"
                  disabled
                />
              </div>

              <div class="col-span-6 sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700"
                  >Date of Membership</label
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
                  v-model="employment"
                  disabled
                />
              </div>

              <div class="col-span-6 sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700"
                  >Years of Service</label
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
                  v-model="service"
                  disabled
                />
              </div>

              <div class="col-span-6 sm:col-span-4">
                <label class="block text-sm font-medium text-gray-700"
                  >If Faculty, state school or department</label
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
                  v-model="department"
                  disabled
                />
              </div>

              <div class="col-span-6 sm:col-span-3">
                <label class="block text-sm font-medium text-gray-700"
                  >Amount of Reimbursement</label
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
                  v-model="amount"
                  disabled
                />
                </div>
              </div>
            </div>
          </div>
        </form>
        <div>
          <Link :href="route('ReimburstmentPrintng',userMedical.id)">
            <div class="w-fit m-auto font-semibold py-2 px-10 text-green-500 border-2 border-green-500 rounded-lg hover:bg-green-500 hover:text-white">Print</div>
          </Link>
        </div>
      </div>
      <div class="row-span-3">
        <div class="bg-white shadow-xl rounded-lg content-center lg:mr-50">
          <span>Official Reciept</span>
          <div
            v-for="attachment in userMedical.attachments"
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
            v-for="attachment in userMedical.attachments"
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
            <span v-if="userMedical.hospital == true"
              >Statement of Account</span
            >
            <span v-if="userMedical.health == true"
              >Doctor's Endorsement</span
            >
          </div>
          <div
            v-for="attachment in userMedical.attachments"
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
            <span v-if="userMedical.health ==true"
              >Lab Results</span
            >
          </div>
          <div
            v-for="attachment in userMedical.attachments"
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
        <br />
        <div
          v-if="userMedical.status == 'Pending'"
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
            @click="rejectMedical(userMedical)"
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
            @click="acceptMedical(userMedical)"
          >
            Approve
          </button>
        </div>
      </div>
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
            >Approve {{ userProfile.first_name }}
            {{ userProfile.last_name }} Medical Reimbursment?</span
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
              @click="submitApproveMedical"
            >
              <span>Approve</span>
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
          <span></span>
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
            >Reject {{ userProfile.first_name }}
            {{ userProfile.last_name }} Medical Reimbursment?</span
          >
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
              @click="submitRejectMedical"
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
import JetApplicationLogo from "@/Jetstream/ApplicationLogo.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Modal from "@/Jetstream/Modal";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

export default {
  components: {
    JetApplicationLogo,
    AppLayout,
    Modal,
    Link,
  },
  setup() {},
  props: {
    userProfile: Object,
    userMedical: Object,
    notification: Object,
    count: Number,
  },
  data() {
    return {
      medicalToReject: Object,
      medicalToApprove: Object,
      showRejectModal: false,
      showApproveModal: false,

      name:
        this.$props.userProfile.first_name +
        " " +
        this.$props.userProfile.last_name,
      birthday: this.$props.userProfile.birth_date,
      age:
        new Date().getUTCFullYear() -
        new Date(this.$props.userProfile.birth_date).getUTCFullYear(),
      employment: this.$props.userProfile.membership,
      service:
        new Date().getUTCFullYear() -
        new Date(this.$props.userProfile.membership).getUTCFullYear(),
      department: this.$props.userProfile.department,
      amount: this.$props.userMedical.amount,
      // duration:this.$props.loan.duration,

      approveForm: this.$inertia.form({
        id: Number,
        status: "",
      }),
      rejectForm: this.$inertia.form({
        id: Number,
        status: "",
      }),
    };
  },
  methods: {
    rejectMedical(userMedical) {
      this.medicalToReject = userMedical;
      this.showRejectModal = !this.showRejectModal;
    },
    acceptMedical(userMedical) {
      this.medicalToApprove = userMedical;
      this.showApproveModal = !this.showApproveModal;
    },
    submitRejectMedical() {
      this.rejectForm.id = this.medicalToReject.id;
      this.rejectForm.status = "Rejected";
      this.rejectForm.post(route("medicalReject"), {
        onSuccess: () => {
          this.showRejectModal = false;
        },
      });
    },
    submitApproveMedical() {
      this.approveForm.id = this.medicalToApprove.id;
      this.approveForm.status = "Approved";
      this.approveForm.post(route("medicalApprove"), {
        onSuccess: () => {
          this.showApproveModal = false;
        },
      });
    },
  },
};
</script>
