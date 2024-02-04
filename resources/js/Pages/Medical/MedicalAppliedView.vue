<template>
  <AppLayout>
    <template #header>
      <div class="flex justify-between">
        <div class="flex items-center">
          <Link :href="route('medicalList')">
            <h1 class="text-xl font-extrabold leading-tight text-gray-800">
              Current Medical
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
            {{ userProfile.first_name }} {{ userProfile.middle_name }}
            {{ userProfile.last_name }}'s
          </h1>
        </div>
      </div>
    </template>

    <div class="grid grid-cols-1 gap-8 m-8 lg:m-10 lg:grid-cols-2">
      <div
        class="p-4 overflow-hidden bg-white border-gray-300 rounded-lg shadow-xl "
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
                  class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
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
                  class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
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
                  class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
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
                  class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
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
                  class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
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
                  class="block w-full mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
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
                  class="block w-full pl-6 mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                  v-model="amount"
                  disabled
                />
                </div>
              </div>
              <div class="col-span-6 sm:col-span-6">
                <label class="block text-sm font-medium text-gray-700"
                  >Signed Document</label
                >
                <div>
             
                  <input @change="onChange1" type="file" accept=".png, .jpg, .jpeg, .pdf, .docx"
                    class="block border-black border rounded-md w-full text-[0.8rem] text-slate-500 file:mr-2 file:py-2 file:px-1 file:text-md file:font-semibold file:bg-gray-200 file:text-gray-500 hover:file:bg-gray-300"
                     />
                </div>
              </div>
            </div>
          </div>
        </form>
        <div>
          <Link :href="route('ReimburstmentPrintng',userMedical.id)">
            <div class="px-10 py-2 m-auto font-semibold text-green-500 border-2 border-green-500 rounded-lg w-fit hover:bg-green-500 hover:text-white">Print</div>
          </Link>
        </div>
      </div>
      <div class="row-span-3">
        <div v-if="userMedical.in_patient== false">
        <div class="content-center bg-white rounded-lg shadow-xl lg:mr-50">
          <span>Official Reciept</span>
          <div
            v-for="attachment in userMedical.attachments"
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
        <div class="content-center bg-white rounded-lg shadow-xl lg:mr-50">
          <span>Medical Certificate/Doctor's Prescription</span>
          <div
            v-for="attachment in userMedical.attachments"
            v-bind:key="attachment.id"
          >
            <img
              class="w-64 h-64"
              v-if="attachment.type == 2"
              :src="
                attachment.image == null ? '' :  attachment.image
              "
            />
          </div>
        </div>
      </div>
      <div v-else>
        <div class="content-center bg-white rounded-lg shadow-xl lg:mr-50">
          <span>Other Files</span>
          <div
            v-for="attachment in userMedical.attachments"
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
      </div>
        <div class="content-center bg-white rounded-lg shadow-xl lg:mr-50">
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
                attachment.image == null ? '' :  attachment.image
              "
            />
          </div>
        </div>
        <div class="content-center bg-white rounded-lg shadow-xl lg:mr-50">
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
                attachment.image == null ? '' :  attachment.image
              "
            />
          </div>
        </div>
        <br />
        <div
          v-if="userMedical.status == 'Pending'"
          class="flex items-center justify-center w-full gap-20 p-0 m-0"
        >
          <button
            type="button"
            class="w-64 px-4 py-2 mb-5 text-lg font-semibold text-center text-white transition duration-150 ease-in bg-red-600 rounded-lg shadow-md hover:bg-red-700 focus:ring focus:ring-red-300"
            @click="rejectMedical(userMedical)"
          >
            Reject
          </button>

          <button
            type="button"
            class="w-64 px-4 py-2 mb-5 text-lg font-semibold text-center text-white transition duration-150 ease-in bg-green-600 rounded-lg shadow-md hover:bg-green-700 focus:ring focus:ring-green-300"
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
            >For Approval {{ userProfile.first_name }}
            {{ userProfile.last_name }} Medical Reimbursment?</span
          >
        </div>
        <div class="flex justify-center">
          <div
            class="flex justify-between my-3 text-xl font-bold dark:text-gray-200"
          >
            <div
              class="flex px-4 py-1 mr-5 space-x-2 text-green-600 uppercase border border-green-600 rounded-full cursor-pointer text-md dark:text-green-600 dark:border-green-600 dark:hover:text-gray-200 hover:text-white hover:border-none hover:bg-green-500"
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
        <div class="flex justify-between my-3 text-xl font-bold text-gray-900">
          <span></span>
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
            >Reject {{ userProfile.first_name }}
            {{ userProfile.last_name }} Medical Reimbursment?</span
          >
        </div>
        <div class="flex justify-center">
          <div class="flex my-3 text-xl font-bold dark:text-gray-200">
            <div
              class="flex px-4 py-1 space-x-2 text-red-600 uppercase border border-red-600 rounded-full cursor-pointer text-md dark:text-red-600 dark:border-red-600 dark:hover:text-gray-200 hover:text-white hover:border-none hover:bg-red-500"
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
        signed_document:File
      }),
      rejectForm: this.$inertia.form({
        id: Number,
        status: "",
      }),
    };
  },
  methods: {
    onChange1(e) {
      this.approveForm.signed_document = e.target.files;
    },
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
      this.approveForm.status = "For Approval";
      this.approveForm.post(route("medicalApprove"), {
        onSuccess: () => {
          this.showApproveModal = false;
        },
      });
    },
  },
};
</script>
