<template>
  <AppLayout title="MITRF ADMIN">
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Homepage
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-screen-2xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
          <div>
            <button @click="viewOfficer = !viewOfficer"
            class="p-2 m-5 border-2 rounded-lg shadow-md hover:border-red-700 hover:text-yellow-800 focus:border-red-700 focus:text-yellow-800">
                View MITRF Inc. Officers
            </button>
            <div
              class="flex p-6 bg-white border-b border-gray-200 justify-items-center sm:px-20"
            >
              <div  class="">
                <table v-if="viewOfficer"
                  class="mt-12 text-yellow-500 bg-red-800 border border-separate rounded-md shadow-xl border-spacing-2 border-slate-500 border-spacing-y-4 bg-opacity-90 drop-shadow-lg"
                >
                  <thead class="text-lg">
                    <tr>
                      <th class="">MITRF Inc. Officers</th>
                      <th class="flex justify-between block">

                          <div class="mt-1 text-sm underline ">
                              <p>Updated last: <span>{{new Date(this.boards.updated_at).toLocaleDateString()}}</span></p>
                          </div>
                          <svg
                          xmlns="http://www.w3.org/2000/svg"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke-width="1.5"
                          stroke="currentColor"
                          class="w-6 h-6 cursor-pointer hover:text-green-500"
                          @click="updateBoardsModal = !updateBoardsModal"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                          />
                        </svg>
                      </th>
                    </tr>
                  </thead>
                  <tbody class="text-sm">
                    <tr>
                      <td class="font-bold whitespace-nowrap">MITRF Chairman</td>
                      <td class="">{{this.boards.chairman}}</td>
                    </tr>
                    <tr>
                      <td class="font-bold whitespace-nowrap">Credit Committee Chairman</td>
                      <td class="">{{this.boards.committee_chairman}}</td>
                    </tr>
                    <!-- <tr>
                      <td class="font-bold whitespace-nowrap">
                        Benefits Committee Chairman
                      </td>
                      <td class="">{{this.boards.benefits_chairman}}</td>
                    </tr> -->
                    <tr>
                      <td class="font-bold whitespace-nowrap">Committee Member</td>
                      <td class="">{{this.boards.vice_chairman}}</td>
                    </tr>
                    <tr>
                      <td class="font-bold whitespace-nowrap">
                        Committee Member
                      </td>
                      <td class="">{{this.boards.corporate_secretary}}</td>
                    </tr>
                    <tr>
                      <td class="font-bold whitespace-nowrap">Treasurer</td>
                      <td class="">{{this.boards.treasurer}}</td>
                    </tr>
                    <tr>
                      <td class="font-bold whitespace-nowrap">
                        Internal Auditor
                      </td>
                      <td class="">{{this.boards.internal_auditor}}</td>
                    </tr>
                    <tr>
                      <td class="font-bold whitespace-nowrap">
                        MITRF Accountant
                      </td>
                      <td class="">{{this.boards.accountant}}</td>
                    </tr>
                    <tr>
                      <td class="font-bold whitespace-nowrap">
                        School Physician
                      </td>
                      <td class="">{{this.boards.school_physician}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="" :class="[viewOfficer==false?'mx-auto':'max-w-screen-2xl']">
                <div class="">
                  <img alt="mitrf logo" src="/images/mu_white.png" />
                </div>
                <div class="flex p-6">
                  <p class="mx-auto text-2xl font-bold">
                    Hi, {{ $page.props.user.name }}!
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <Modal
      :closeable="true"
      :show="updateBoardsModal"
      @close="updateBoardsModal = !updateBoardsModal"
    >
      <div class="p-5">
        <div class="flex justify-between my-3 text-xl font-bold text-gray-900">
          <div>Update Board</div>
          <svg
            class="w-6 h-6 cursor-pointer"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
            @click="updateBoardsModal = !updateBoardsModal"
          >
            <path
              d="M6 18L18 6M6 6l12 12"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
            />
          </svg>
        </div>
        <div class="p-5 space-y-5">
            <div>
                <JetLabel>MITRF Chairman</JetLabel>
                <JetInput class="w-full py-1 pl-1 border-2 border-black" v-model="this.updateBoards.chairman" :placeholder="this.boards.chairman" required/>
            </div>
            <div>
                <JetLabel>Credit Committee Chairman</JetLabel>
                <JetInput class="w-full py-1 pl-1 border-2 border-black" v-model="this.updateBoards.committee_chairman" :placeholder="this.boards.committee_chairman" required/>
            </div>
            <!-- <div>
                <JetLabel>Benefits Committee Chairman</JetLabel>
                <JetInput class="w-full py-1 pl-1 border-2 border-black" v-model="this.updateBoards.benefits_chairman" :placeholder="this.boards.benefits_chairman" required/>
            </div> -->
            <div>
                <JetLabel>Committee Member</JetLabel>
                <JetInput class="w-full py-1 pl-1 border-2 border-black" v-model="this.updateBoards.vice_chairman" :placeholder="this.boards.vice_chairman" required/>
            </div>
            <div>
                <JetLabel>Committee Member</JetLabel>
                <JetInput class="w-full py-1 pl-1 border-2 border-black" v-model="this.updateBoards.corporate_secretary" :placeholder="this.boards.corporate_secretary" required/>
            </div>
            <div>
                <JetLabel>Treasurer</JetLabel>
                <JetInput class="w-full py-1 pl-1 border-2 border-black" v-model="this.updateBoards.treasurer" :placeholder="this.boards.treasurer" required/>
            </div>
            <div>
                <JetLabel>Internal Auditor</JetLabel>
                <JetInput class="w-full py-1 pl-1 border-2 border-black" v-model="this.updateBoards.internal_auditor" :placeholder="this.boards.internal_auditor" required/>
            </div>
            <div>
                <JetLabel>MITRF Accountant</JetLabel>
                <JetInput class="w-full py-1 pl-1 border-2 border-black" v-model="this.updateBoards.accountant" :placeholder="this.boards.accountant" required/>
            </div>
            <div>
                <JetLabel>School Physician</JetLabel>
                <JetInput class="w-full py-1 pl-1 border-2 border-black" v-model="this.updateBoards.school_physician" :placeholder="this.boards.school_physician" required/>
            </div>
        </div>
        <div class="flex justify-center w-full">
            <button @click="submit()" class="px-5 py-2 text-green-500 border-2 border-green-500 rounded-lg hover:bg-green-500 hover:text-white">UPDATE</button>
        </div>

      </div>
    </Modal>
  </AppLayout>
</template>

<script>
import JetApplicationLogo from "@/Jetstream/ApplicationLogo.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Modal from "@/Jetstream/Modal";
import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";

export default {
  components: {
    JetApplicationLogo,
    AppLayout,
    Modal,
    JetLabel,
    JetInput,
  },
  setup() {},
  props: {
    notification: Object,
    count: Number,
    boards:Object
  },
  data(){
    return{
        updateBoardsModal:false,
        viewOfficer:false,
        updateBoards:this.$inertia.form({
            chairman:'',
            committee_chairman:'',
            // benefits_chairman:'',
            vice_chairman:'',
            corporate_secretary:'',
            treasurer:'',
            internal_auditor:'',
            accountant:'',
            school_physician:''
        })
    }
  },
  methods:{
    submit(){
        this.updateBoards.chairman = this.updateBoards.chairman !=''? this.updateBoards.chairman: this.boards.chairman
        this.updateBoards.committee_chairman = this.updateBoards.committee_chairman !=''? this.updateBoards.committee_chairman: this.boards.committee_chairman
        this.updateBoards.vice_chairman = this.updateBoards.vice_chairman !=''? this.updateBoards.vice_chairman: this.boards.vice_chairman
        this.updateBoards.corporate_secretary = this.updateBoards.corporate_secretary !=''? this.updateBoards.corporate_secretary: this.boards.corporate_secretary
        this.updateBoards.treasurer = this.updateBoards.treasurer !=''? this.updateBoards.treasurer: this.boards.treasurer
        this.updateBoards.internal_auditor = this.updateBoards.internal_auditor !=''? this.updateBoards.internal_auditor: this.boards.internal_auditor
        this.updateBoards.accountant = this.updateBoards.accountant !=''? this.updateBoards.accountant: this.boards.accountant
        this.updateBoards.school_physician = this.updateBoards.school_physician !=''? this.updateBoards.school_physician: this.boards.school_physician
      
        this.updateBoards.post(route("updateBoards"))
        this.updateBoardsModal =! this.updateBoardsModal;
    }
  }
};
</script>
