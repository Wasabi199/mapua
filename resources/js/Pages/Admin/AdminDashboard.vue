<template>
  <AppLayout title="MITRF ADMIN">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Homepage
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div>
            <button @click="viewOfficer = !viewOfficer"
            class="m-5 p-2 shadow-md rounded-lg border-2
            hover:border-red-700 hover:text-yellow-800 focus:border-red-700 focus:text-yellow-800">
                View MITRF Inc. Officers
            </button>
            <div
              class="flex justify-items-center p-6 sm:px-20 bg-white border-b border-gray-200"
            >
              <div  class="">
                <table v-if="viewOfficer"
                  class="border-separate rounded-md shadow-xl border-spacing-2 border border-slate-500 mt-12 bg-red-800
                  text-yellow-500 border-spacing-y-4 bg-opacity-90 drop-shadow-lg"
                >
                  <thead class="text-lg">
                    <tr>
                      <th class="">MITRF Inc. Officers</th>
                      <th class="flex block justify-between">

                          <div class=" text-sm mt-1 underline">
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
                      <td class=" ">{{this.boards.benefits_chairman}}</td>
                    </tr> -->
                    <tr>
                      <td class="font-bold whitespace-nowrap">Vice Chairman</td>
                      <td class="">{{this.boards.vice_chairman}}</td>
                    </tr>
                    <tr>
                      <td class="font-bold whitespace-nowrap">
                        Corporate Secretary
                      </td>
                      <td class="">{{this.boards.corporate_secretary}}</td>
                    </tr>
                    <tr>
                      <td class="font-bold whitespace-nowrap">Treasurer</td>
                      <td class=" ">{{this.boards.treasurer}}</td>
                    </tr>
                    <tr>
                      <td class="font-bold whitespace-nowrap">
                        Internal Auditor
                      </td>
                      <td class=" ">{{this.boards.internal_auditor}}</td>
                    </tr>
                    <tr>
                      <td class="font-bold whitespace-nowrap">
                        MITRF Accountant
                      </td>
                      <td class=" ">{{this.boards.accountant}}</td>
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
        <div class="flex justify-between text-xl font-bold text-gray-900 my-3">
          <div>Update Board</div>
          <svg
            class="h-6 w-6 cursor-pointer"
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
                <JetInput class="w-full border-2 border-black py-1 pl-1" v-model="this.updateBoards.chairman" :placeholder="this.boards.chairman" required/>
            </div>
            <div>
                <JetLabel>Credit Committee Chairman</JetLabel>
                <JetInput class="w-full border-2 border-black py-1 pl-1" v-model="this.updateBoards.committee_chairman" :placeholder="this.boards.committee_chairman" required/>
            </div>
            <!-- <div>
                <JetLabel>Benefits Committee Chairman</JetLabel>
                <JetInput class="w-full border-2 border-black py-1 pl-1" v-model="this.updateBoards.benefits_chairman" :placeholder="this.boards.benefits_chairman" required/>
            </div> -->
            <div>
                <JetLabel>Vice Chairman</JetLabel>
                <JetInput class="w-full border-2 border-black py-1 pl-1" v-model="this.updateBoards.vice_chairman" :placeholder="this.boards.vice_chairman" required/>
            </div>
            <div>
                <JetLabel>Corporate Secretary</JetLabel>
                <JetInput class="w-full border-2 border-black py-1 pl-1" v-model="this.updateBoards.corporate_secretary" :placeholder="this.boards.corporate_secretary" required/>
            </div>
            <div>
                <JetLabel>Treasurer</JetLabel>
                <JetInput class="w-full border-2 border-black py-1 pl-1" v-model="this.updateBoards.treasurer" :placeholder="this.boards.treasurer" required/>
            </div>
            <div>
                <JetLabel>Internal Auditor</JetLabel>
                <JetInput class="w-full border-2 border-black py-1 pl-1" v-model="this.updateBoards.internal_auditor" :placeholder="this.boards.internal_auditor" required/>
            </div>
            <div>
                <JetLabel>MITRF Accountant</JetLabel>
                <JetInput class="w-full border-2 border-black py-1 pl-1" v-model="this.updateBoards.accountant" :placeholder="this.boards.accountant" required/>
            </div>
        </div>
        <div class="w-full flex justify-center">
            <button @click="submit()" class="py-2 px-5 border-2 border-green-500 rounded-lg text-green-500 hover:bg-green-500 hover:text-white">UPDATE</button>
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
        })
    }
  },
  methods:{
    submit(){
        this.updateBoards.post(route("updateBoards"))
        this.updateBoardsModal =! this.updateBoardsModal;
    }
  }
};
</script>
