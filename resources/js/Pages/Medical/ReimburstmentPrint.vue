<template>
  <div class="p-10">
    <div class="border-b-4 border-black border-solid">
      <div class="flex justify-between grid-cols-2">
        <div class="">
            <p>Date:__________________</p>
                <p class="mt-5 text-base font-bold">TO : MIT RETIREMENT FUND, INC. </p>
                    <p>
                        I underwent medical examination/treatment and spent a total of PHP
                        <span class="underline">{{medical.amount}}</span> at the
                    </p>
                <p>
                    <span class="underline">{{medical.clinic_name}}</span> (hospital/clinic) on
                    <span class="underline ">{{medical.appointment_date}}</span>
                </p>
        </div>
        <div class="mx-auto w-28">
            <img src="/images/mu_white.png" alt="mitrf logo">
        </div>
      </div>
      <p class="mt-2">
        Diagnosis:_________________________________________
      </p>
      <p>Attached herewith are the following:</p>
      <div class="flex gap-x-14">
        <p><input type="checkbox" checked>Official Reciepts</p>
        <p><input type="checkbox" checked>Hospital Bill/Statement of Account</p>
      </div>
      <div class="flex gap-x-10">
        <!-- <p><input type="checkbox" :checked="medical.hospital == true">Medical Certificate</p> -->
        <p><input type="checkbox"  :checked="medical.health == true">Doctor's Prescription/Medical Certificate</p>
        <p><input type="checkbox" :checked="medical.health == true">Laboratory Exam Results</p>
      </div>
      <div class="flex gap-x-6">
        <p><input type="checkbox">Others</p>
      </div>
      <div class="flex mt-5 gap-x-52">
        <p>Respectfully yours,</p>
        <p>Verified by,</p>
      </div>
      <div class="flex mt-5 gap-x-48">
        <p class="border-b-2">{{(info.first_name+" "+info.middle_name+" "+info.last_name)}}</p>
        <p class="-ml-10 underline">{{ board.school_physician }}</p>
      </div>
      <div class="flex mb-5 gap-x-16">
        <p>Member Signature-Over Printed Name</p>
        <p>MIT School Physician</p>
      </div>
    </div>
    <div class="mt-5">
      <div>To be filled-out by RF Accountant:</div>
      <div class="px-20 m-auto ">
        <table class="w-full border-2 table-fixed ">
          <thead>
            <tr>
              <th class="bg-gray-400 border">DATE</th>
              <th class="bg-gray-400 border">AMOUNT(In-Patient)</th>
              <th class="bg-gray-400 border">AMOUNT(Out-Patient)</th>
              <th class="bg-gray-400 border">BALANCE</th>
            </tr>
          </thead>
          <tbody>
            <tr>
                <td class="py-5 border"></td>
                <td class="border"></td>
                <td class="border"></td>
                <td class="border"></td>
            </tr>
            <tr>
                <td class="py-5 border"></td>
                <td class="border"></td>
                <td class="border"></td>
                <td class="border"></td>
            </tr>
            <tr>
                <td class="py-5 border"></td>
                <td class="border"></td>
                <td class="border"></td>
                <td class="border"></td>
            </tr>
            <tr>
                <td class="py-5 border"></td>
                <td class="border"></td>
                <td class="border"></td>
                <td class="border"></td>
            </tr>
          </tbody>
        </table>

      </div>
      <div class="mt-5">Remarks (if any)___________________________________________________________</div>
      <div class="flex mt-14 gap-x-52">
        <p>Respectfully yours,</p>
        <p class="-ml-36">Verified by,</p>
      </div>
       <div class="flex mt-8">
           <div class="col-span-3">
               <div class="-ml-1 font-semibold text-center border-b-2">{{this.board.accountant}}</div>
               <p class="text-left">Accounting Assistant</p>
           </div>
           <div class="col-span-3">
               <div class="font-semibold text-center border-b-2 mx-36">{{this.board.chairman}}</div>
               <p class="text-center">Chairman of the Board - MITRF</p>
           </div>
       </div>

    </div>
  </div>

   <p style="page-break-before: always">&nbsp;</p>
  
  <div class="m-auto w-fit">
        <div v-if="medical.in_patient== false">
        <div class="content-center rounded-lg lg:mr-50">
          <span>Official Reciept</span>
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
        <div class="content-center bg-white rounded-lg shadow-xl lg:mr-50">
          <span>Medical Certificate/Doctor's Prescription</span>
          <div
            v-for="attachment in medical.attachments"
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
      </div>
        <div class="content-center bg-white rounded-lg shadow-xl lg:mr-50">
          <div>
            <span v-if="medical.hospital == true"
              >Statement of Account</span
            >
            <span v-if="medical.health == true"
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
        <div class="content-center bg-white rounded-lg shadow-xl lg:mr-50">
          <div>
            <span v-if="medical.health ==true"
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
</template>
<script>
import Table from "../../Components/Table.vue";
export default {
  setup() {
    Table;
  },
  props: {
    medical: Object,
    info: Object,
    board:Object,
  },
};
</script>
