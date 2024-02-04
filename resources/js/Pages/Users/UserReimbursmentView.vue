<template>
  <AppLayout>
    <template #header>
      <div class="flex items-center">
        <Link :href="route('medicalView')" class="hover:underline">
        <h1 class="text-xl font-extrabold leading-tight text-gray-800">
          Medical Reimbursement
        </h1>
        </Link>
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <h1 class="text-xl font-extrabold leading-tight text-gray-800">
          Create Medical Reimbursement
        </h1>
      </div>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
          <JetValidationErrors class="mb-4" />
          <div class="mt-10 ml-6 lg:ml-20">
            <p class="mt-4 mb-1 text-lg">Purpose of Reimbursement</p>
            <select v-model="form.reimbursment_type" v-on:change="reimbursement(form.reimbursment_type)"
              class="mb-10 transition duration-150 ease-in border-2 border-gray-400 border-opacity-50 rounded-md hover:border-indigo-500">
              <option value="placeholder" disabled>
                Select Reimbursement Type
              </option>
              <option v-for="type in reimbursment" v-bind:key="type" :value="type">
                {{ type }}
              </option>
            </select>
          </div>

          <form @submit.prevent="submit" class="p-6 sm:px-20 bg-white border-b border-gray-200 mt-[-40px]"
            enctype="multipart/form-data">
            <div v-if="this.form.reimbursment_type == 'IN-PATIENT'">
              <div>
                <label class="mb-1 text-lg text-gray-700" for="amount">Amount</label><br />

                <div class="relative w-64 mt-1 rounded-md">
                  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <span class="text-lg text-gray-500"> ₱ </span>
                  </div>
                  <input v-model="form.amount" type="number" placeholder="0.00"
                    class="block w-64 pr-12 mb-5 text-black border-2 border-gray-400 border-opacity-50 rounded-md focus:ring-indigo-500 hover:border-indigo-500 pl-7 font-lg" />
                </div>
              </div>

              <div class="pt-5">
                <p class="font-bold text-md">Clinic / Hospital Name:</p>
                <input class="w-6/12 rounded-lg" type="text" v-model="this.form.clinic_name" />
              </div>
              <div class="pt-5">
                <p class="font-bold text-md">Appointment Date:</p>
                <input class="w-6/12 rounded-lg" type="date" v-model="this.form.appointment_date" />
              </div>
              <p class="mt-6 mb-1 text-lg font-semibold">Upload Requirements</p>
              <p class="text-sm italic">
                *Total maximum size for uploading is 30mb
              </p>
              <p class="pt-5 font-bold">
                Official Receipt<span class="text-sm italic font-thin">
                  Must be image file (jpg,jpeg)</span>
              </p>
              <div class="w-6/12 mb-5 border-2 border-gray-400 border-opacity-50 rounded-md hover:border-indigo-500">
                <input @change="onChange1" type="file" accept=".png, .jpg, .jpeg, .pdf, .docx"
                  class="block w-full text-[0.8rem] text-slate-500 file:mr-2 file:py-2 file:px-1 file:border-0 file:text-md file:font-semibold file:bg-gray-200 file:text-gray-500 hover:file:bg-gray-300"
                  multiple />
              </div>
              <p class="font-bold">
                Medical Certificate/Doctor's Prescription<span class="text-sm italic font-thin">
                  Must be image file (jpg,jpeg)</span>
              </p>
              <div class="w-6/12 mb-5 border-2 border-gray-400 border-opacity-50 rounded-md hover:border-indigo-500">
                <input @change="onChange2" type="file" accept=".png, .jpg, .jpeg, .pdf, .docx"
                  class="block w-full text-[0.8rem] text-slate-500 file:mr-2 file:py-2 file:px-1 file:border-0 file:text-md file:font-semibold file:bg-gray-200 file:text-gray-500 hover:file:bg-gray-300"
                  multiple />
              </div>
              <!-- <p>Must be Image File(max 10MB)</p> -->
              <p class="font-bold">
                Statement of Account<span class="text-sm italic font-thin">
                  Must be image file (jpg,jpeg)</span>
              </p>
              <div class="w-6/12 mb-5 border-2 border-gray-400 border-opacity-50 rounded-md hover:border-indigo-500">
                <input @change="onChange3" type="file" accept=".png, .jpg, .jpeg, .pdf, .docx"
                  class="block w-full text-[0.8rem] text-slate-500 file:mr-2 file:py-2 file:px-1 file:border-0 file:text-md file:font-semibold file:bg-gray-200 file:text-gray-500 hover:file:bg-gray-300"
                  multiple />
              </div>
              <!-- <p>Must be Image File(max 10MB)</p> -->
            </div>



            <div v-if="this.form.reimbursment_type == 'OUT-PATIENT'">
              <p>Reimbursement Type</p>
              <div>
                <div class="space-x-2">
                  <input v-model="this.form.health" type="checkbox" /><label>Health Checkup</label>
                </div>
                <div class="space-x-2">
                  <input v-model="this.form.mental" type="checkbox" /><label>Mental Checkup</label>
                </div>
                <div class="space-x-2">
                  <input v-model="this.form.dental" type="checkbox" /><label>Dental Checkup</label>
                </div>
                <div class="space-x-2">
                  <input v-model="this.form.eye" type="checkbox" /><label>Eye Checkup</label>
                </div>
                <div class="space-x-2">
                  <input v-model="this.form.in_patient" type="checkbox" /><label>In Patient</label>
                </div>
              </div>
              <div>
                <label class="mb-1 text-lg text-gray-700" for="amount">Amount</label><br />

                <div class="relative w-64 mt-1 rounded-md">
                  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <span class="text-lg text-gray-500"> ₱ </span>
                  </div>
                  <input v-model="form.amount" type="number" placeholder="0.00"
                    class="block w-64 pr-12 mb-5 text-black border-2 border-gray-400 border-opacity-50 rounded-md focus:ring-indigo-500 hover:border-indigo-500 pl-7 font-lg" />
                </div>
              </div>

              <div class="pt-5">
                <p class="font-bold text-md">Clinic / Hospital Name:</p>
                <input class="w-6/12 rounded-lg" type="text" v-model="this.form.clinic_name" />
              </div>
              <div class="pt-5">
                <p class="font-bold text-md">Appointment Date:</p>
                <input class="w-6/12 rounded-lg" type="date" v-model="this.form.appointment_date" />
              </div>
              <p class="mt-6 mb-1 text-lg font-semibold">Upload Requirements</p>
              <p class="text-sm italic">
                *Total maximum size for uploading is 30mb
              </p>

              <div v-if="this.form.in_patient == false">
                <p class="pt-5 font-bold">
                  Official Receipt<span class="text-sm italic font-thin">
                    Must be image file (jpg,jpeg)</span>
                </p>
                <div class="w-6/12 mb-5 border-2 border-gray-400 border-opacity-50 rounded-md hover:border-indigo-500">
                  <input @change="onChange1" type="file" accept=".png, .jpg, .jpeg, .pdf, .docx"
                    class="block w-full text-[0.8rem] text-slate-500 file:mr-2 file:py-2 file:px-1 file:border-0 file:text-md file:font-semibold file:bg-gray-200 file:text-gray-500 hover:file:bg-gray-300"
                    multiple />
                </div>
                <!-- <p>Must be Image File(max 10MB)</p> -->
                <p class="font-bold">
                  Medical Certificate/Doctor's Prescription<span class="text-sm italic font-thin">
                    Must be image file (jpg,jpeg)</span>
                </p>
                <div class="w-6/12 mb-5 border-2 border-gray-400 border-opacity-50 rounded-md hover:border-indigo-500">
                  <input @change="onChange2" type="file" accept=".png, .jpg, .jpeg, .pdf, .docx"
                    class="block w-full text-[0.8rem] text-slate-500 file:mr-2 file:py-2 file:px-1 file:border-0 file:text-md file:font-semibold file:bg-gray-200 file:text-gray-500 hover:file:bg-gray-300"
                    multiple />
                </div>
              </div>
              <div v-else>
                <p class="pt-5 font-bold">
                  Other Files<span class="text-sm italic font-thin">
                    Must be image file (jpg,jpeg)</span>
                </p>
                <div class="w-6/12 mb-5 border-2 border-gray-400 border-opacity-50 rounded-md hover:border-indigo-500">
                  <input @change="onChange1" type="file" accept=".png, .jpg, .jpeg, .pdf, .docx"
                    class="block w-full text-[0.8rem] text-slate-500 file:mr-2 file:py-2 file:px-1 file:border-0 file:text-md file:font-semibold file:bg-gray-200 file:text-gray-500 hover:file:bg-gray-300"
                    multiple />
                </div>
              </div>

              <!-- <p>Must be Image File(max 10MB)</p> -->
              <p v-if="this.form.health == true" class="font-bold">
                Doctor's Endorsement<span class="text-sm italic font-thin">
                  Must be image file (jpg,jpeg)</span>
              </p>
              <div v-if="this.form.health == true"
                class="w-6/12 mb-5 border-2 border-gray-400 border-opacity-50 rounded-md hover:border-indigo-500">
                <input @change="onChange3" type="file" accept=".png, .jpg, .jpeg, .pdf, .docx"
                  class="block w-full text-[0.8rem] text-slate-500 file:mr-2 file:py-2 file:px-1 file:border-0 file:text-md file:font-semibold file:bg-gray-200 file:text-gray-500 hover:file:bg-gray-300"
                  multiple />
              </div>
              <!-- <p>Must be Image File(max 10MB)</p> -->

              <p v-if="this.form.health == true" class="font-bold">
                Lab Results<span class="text-sm italic font-thin">
                  Must be image file (jpg,jpeg)</span>
              </p>
              <div v-if="this.form.health == true"
                class="w-6/12 mb-5 border-2 border-gray-400 border-opacity-50 rounded-md hover:border-indigo-500">
                <input @change="onChange4" type="file" accept=".png, .jpg, .jpeg, .pdf, .docx"
                  class="block w-full text-[0.8rem] text-slate-500 file:mr-2 file:py-2 file:px-1 file:border-0 file:text-md file:font-semibold file:bg-gray-200 file:text-gray-500 hover:file:bg-gray-300"
                  multiple />
              </div>
              <!-- <p>Must be Image File(max 10MB)</p> -->
            </div>
            <center>
              <button
                class="w-64 px-4 py-2 mb-5 text-lg font-semibold text-center text-yellow-500 transition duration-150 ease-in bg-red-800 rounded-lg shadow-md hover:bg-red-700 focus:ring focus:ring-indigo-300">
                Submit
              </button>
            </center>
          </form>
          <Modal :show="showModal" :closeable="true">
            <div class="p-5">
              <div class="flex justify-center my-3 mb-12 text-xl font-bold text-gray-900">
                <span>Guidelines : Medical Reimbursement</span>
              </div>

              <div class="flex my-3 font-bold text-gray-900 justify-left text-m">
                <span>Note: In-patient and out-patient medical benefits of MITRF
                  members are subject to the conditions found in the attached
                  Appendix.</span>
              </div>
              <div class="flex text-gray-900 justify-left text-s mb-9">
                <ol>
                  <li class="mb-3">
                    1. This benefit is available to all members of the MITRF
                    only. No contestability period is required to avail of the
                    benefit.
                  </li>
                  <li class="my-3">
                    2. Membership starts upon submission of the MITRF Office of
                    the duly accomplished Information Sheet of Members.
                  </li>
                  <li class="my-3">
                    3. A member who was confined for at least one day is
                    entitled to hospitalization benefit equivalent to the actual
                    expenses incurred but should not exceed Php 12,000.00 per
                    year. The member is required to submit any document from the
                    hospital or doctor which shows or proves actual
                    hospitalization subject to the requirements under Section 8
                    and 9.
                  </li>
                  <li class="my-3">
                    4. In case of procedures or treatment which does not require
                    hospitalization but which entitle the member to claim SSS or
                    Philheath in-patient medical benefits, the member is also
                    entitled to claim the in-patient benefit provided the member
                    submits documents showing that he has undergone such
                    procedure or treatment (i.e hospital or clinical records,
                    doctor's records, reports or request, billings or receipts).
                  </li>
                  <li class="my-3">
                    5. A member can be considered as an in-patient if treated
                    for all kinds of sickness and he/she had undergone any
                    surgery except aesthetic surgery.
                  </li>
                  <li class="my-3">
                    6. A member can also avail of the medical reimbursement for
                    out-patient medical, vision correction, dental procedures
                    (doctor's fee, prescription contact lens and eyeglass,
                    prophylaxis, extraction, filling, laboratory fees, drugs and
                    medicines including P500 worth of vitamins and food
                    supplements) up to the maximum amount of Php 7,000.00 per
                    year. This amount is deductible from the total
                    hospitalization benefit due to members upon presentation of
                    OR of doctor's fee, laboratory request, doctor's
                    prescription and OR of all the medicines and laboratory
                    procedures.
                  </li>
                  <li class="my-3">
                    7. A member is required to present the original official
                    receipt and submit photocopy of the original receipt duly
                    signed by the MITRF Office Manager.
                  </li>
                  <li class="my-3">
                    8. Members who have HMO cards should present a duly
                    certified billing statement from the hospital/clinic.
                  </li>
                  <li class="my-3">
                    9. Request for reimbursement must be made within (3) months
                    from the date the expenses were incurred. Submission beyond
                    the three-month period shall no longer be reimbursed.
                  </li>
                </ol>
              </div>
              <div class="flex my-3 mb-3 italic font-bold text-gray-900 justify-left text-m">
                <span>Appendix:</span>
              </div>
              <div class="flex my-3 mb-5 font-bold text-gray-900 underline justify-left text-m">
                <span>A. Computation of Medical benefits for 2021 Members of
                  MITRF</span>
              </div>

              <table class="m-auto bg-white rounded-lg shadow table-auto lg:w-5/6">
                <thead class="bg-blue-100">
                  <tr>
                    <th>Membership Year</th>
                    <th>Medical Benefits</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  <tr>
                    <td>1 year &le; x &#60; 2 years</td>
                    <td>10%</td>
                  </tr>
                  <tr>
                    <td>2 years &le; x &#60; 3 years</td>
                    <td>20%</td>
                  </tr>
                  <tr>
                    <td>3 years &le; x &#60; 4 years</td>
                    <td>30%</td>
                  </tr>
                  <tr>
                    <td>4 years &le; x &#60; 5 years</td>
                    <td>40%</td>
                  </tr>
                  <tr>
                    <td>5 years &le; x &#60; 6 years</td>
                    <td>50%</td>
                  </tr>
                  <tr>
                    <td>6 years &le; x &#60; 7 years</td>
                    <td>60%</td>
                  </tr>
                  <tr>
                    <td>7 years &le; x &#60; 8 years</td>
                    <td>70%</td>
                  </tr>
                  <tr>
                    <td>8 years &le; x &#60; 9 years</td>
                    <td>80%</td>
                  </tr>
                  <tr>
                    <td>9 years &le; x &#60; 10 years</td>
                    <td>90%</td>
                  </tr>
                  <tr>
                    <td>x &ge; 10 years</td>
                    <td>100%</td>
                  </tr>
                </tbody>
              </table>

              <div class="my-3 mb-10 italic text-gray-900 text-m">
                <span class="float-right pr-12 underline">Where x = years as member of MITRF</span><br />
              </div>

              <div class="flex my-3 mb-5 font-bold text-gray-900 underline justify-left text-m">
                <span>B. Computation of Medical benefits prior to 2021</span>
              </div>

              <table class="table-auto m-auto bg-white rounded-lg shadow min-w-[100%] lg:w-5/6">
                <thead class="bg-blue-100">
                  <tr>
                    <th>Membership Year</th>
                    <th>Medical Benefits</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  <tr>
                    <td>1 year &le; x &#60; 3 years</td>
                    <td>50%</td>
                  </tr>
                  <tr>
                    <td>3 year &le; x &#60; 5 years</td>
                    <td>70%</td>
                  </tr>
                  <tr>
                    <td>x &ge; 5 years</td>
                    <td>100%</td>
                  </tr>
                </tbody>
              </table>

              <div class="my-3 mb-16 italic text-gray-900 text-m lg:mb-10">
                <span class="float-right pr-12 underline">Where x = years as member of MITRF</span><br />
              </div>

              <div class="my-3 mb-10 italic text-gray-900 text-m">
                <span class="pr-12 underline">*The MITRF Board reserves the right to review outpatient
                  medical benefits annually, as deemed relevant by the
                  Board.</span><br />
              </div>
              <div class="flex justify-center my-3 space-x-40 text-xl font-bold dark:text-gray-200">
                <!-- Accept Button -->
                <div @click="showModal = !showModal"
                  class="flex px-4 py-1 space-x-2 text-sm font-semibold leading-snug text-green-600 uppercase border border-green-600 rounded-full cursor-pointer dark:text-green-600 dark:border-green-600 dark:hover:text-gray-200 hover:bg-green-500">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-check2-all" viewBox="0 0 16 16">
                    <path
                      d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z" />
                    <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z" />
                  </svg>
                  <span>Accept</span>
                </div>
              </div>
            </div>
          </Modal>
          <Modal :show="submitModal" :closeable="true" @close="submitModal = !submitModal">
            <div class="p-5">
              <div class="flex justify-between my-3 text-xl font-bold text-gray-900">
                <span>Agreement</span>
                <svg @click="submitModal = !submitModal" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 cursor-pointer"
                  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </div>
              <div class="text-justify">
                <span>I hereby agree to submit my documents and to allow MITRFI and
                  its authorized personnel to process my documents and personal
                  information for specifically for purposes of
                  <span class="font-bold">{{ this.form.reimbursment_type }} Reimbursement</span>, in compliance with the
                  Data Privacy Act of 2012 and MITRFI
                  policies. Acceptance of the document/s does not automatically
                  guarantee approval as the application shall be subject to the
                  evaluation and approval of the MITFRI based on its loan
                  policies.</span>
              </div>
              <div class="flex justify-center my-3 text-xl font-bold dark:text-gray-200">
                <div @click="proceed"
                  class="flex px-4 py-1 space-x-2 text-sm font-semibold leading-snug text-green-600 uppercase border border-green-600 rounded-full cursor-pointer dark:text-green-600 dark:border-green-600 dark:hover:text-gray-200 hover:bg-green-500">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-check2-all" viewBox="0 0 16 16">
                    <path
                      d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z" />
                    <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z" />
                  </svg>
                  <span>Submit</span>
                </div>
              </div>
            </div>
          </Modal>
          <Modal :show="reimbursment_balance_modal" :closeable="false"
            @close="reimbursment_balance_modal = !reimbursment_balance_modal">
            <div class="p-5">
              <div class="flex justify-between my-3 text-xl font-bold text-gray-900">
                <span>Note:</span>
              </div>
              <div class="text-justify">
                <span>You already reached your limit</span>
              </div>
              <div class="flex justify-center my-3 text-xl font-bold dark:text-gray-200">
                <div @click="reroute()"
                  class="flex px-4 py-1 space-x-2 text-sm font-semibold leading-snug text-green-600 uppercase border border-green-600 rounded-full cursor-pointer dark:text-green-600 dark:border-green-600 dark:hover:text-gray-200 hover:bg-green-500">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-check2-all" viewBox="0 0 16 16">
                    <path
                      d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z" />
                    <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z" />
                  </svg>
                  <span>Okay</span>
                </div>
              </div>
            </div>
          </Modal>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Modal from "@/Jetstream/Modal";
import route from "../../../../vendor/tightenco/ziggy/src/js";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
export default {
  components: {
    AppLayout,
    Modal,
    Link,
    JetValidationErrors,
  },
  props: {
    info: Object,
    notification: Object,
    count: Number,
    reimbursement_balance_in: Number,
    reimbursement_balance_out: Number,
    benifit: String

  },
  setup() { },
  data() {
    return {
      showModal: true,
      submitModal: false,
      isSubmiting: false,
      computationAmount: "",
      reimbursment_balance_modal: false,
      // membership: this.props.info.membership,
      form: this.$inertia.form({
        reimbursment_type: "",
        amount: "",
        clinic_name: "",
        appointment_date: "",
        medical_benifit: this.benifit,
        medical_record1: File,
        medical_record2: File,
        medical_record3: File,
        medical_record4: File,

        hospital: false,
        health: false,
        eye: false,
        dental: false,
        mental: false,
        in_patient: false,
      }),
      reimbursment: [
        "IN-PATIENT",
        "OUT-PATIENT",
        // "Hospital",
        // "Health Checkup",
        // "Dental Checkup",
        // "Medicines",
        // "Eye Checkup",
      ],
    };
  },
  methods: {
    onChange1(e) {
      // console.log("Selected File", e.target.files[0]);
      this.form.medical_record1 = e.target.files;
    },
    onChange2(e) {
      // console.log("Selected File", e.target.files[0]);
      this.form.medical_record2 = e.target.files;
    },
    onChange3(e) {
      // console.log("Selected File", e.target.files[0]);
      this.form.medical_record3 = e.target.files;
    },
    onChange4(e) {
      // console.log("Selected File", e.target.files[0]);
      this.form.medical_record4 = e.target.files;
    },
    reimbursement(value) {
      if (value == "IN-PATIENT") {
        if (this.$props.reimbursement_balance_in <= 0) {
          this.reimbursment_balance_modal = true;
        }
      } else {
        if (this.$props.reimbursement_balance_out <= 0) {
          this.reimbursment_balance_modal = true;
        }
      }
    },
    submit() {

      if (this.form.reimbursment_type == "IN-PATIENT") {
        if (this.form.amount > this.reimbursement_balance_in) {
          this.form.amount = this.reimbursement_balance_in
        }
      } else {
        if (this.form.amount > this.reimbursement_balance_out) {
          this.form.amount = this.reimbursement_balance_out
        }
      }

      this.submitModal = true;
    },
    proceed() {
      // if (this.form.reimbursment_type == "IN-PATIENT") {
      //   this.form.hospital = true;
      //   if (this.form.amount <= this.computationAmount) {
      //     if (this.form.amount <= this.$props.reimbursement_balance_in) {
      //       this.form.amount = this.form.amount;
      //       console.log("checkedasdasd");
      //     } else {
      //       this.form.amount = this.$props.reimbursement_balance_in;
      //       console.log("checked");
      //     }
      //   } else {
      //     // this.form.amount = this.$props.reimbursement_balance_in;
      //     this.form.amount = this.computationAmount;
      //   }
      // } else {
      //   this.form.hospital = false;
      //   if (this.form.amount <= this.computationAmount) {
      //     if (this.form.amount < this.$props.reimbursement_balance_out) {
      //       this.form.amount = this.form.amount;
      //     } else {
      //       this.form.amount = this.$props.reimbursement_balance_out;
      //     }
      //   } else {
      //     // this.form.amount = this.$props.reimbursement_balance_in;
      //     this.form.amount = this.computationAmount;
      //   }
      // }

      this.form.post(route("ReimburstmentSubmit"), {
        onStart: (visit) => {
          this.isSubmiting == true;
        },
        onFinish: (visit) => {
          this.isSubmiting == false;
        },
      });
      this.submitModal = false;
      console.log("Clicked");
    },

    reroute() {
      this.$inertia.get(route("ReimbursView"));
    },
  },
};
</script>
