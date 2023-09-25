<template>
      <Modal :show="dataPrivacyModal" :closeable="false">
            <div class="p-5">
                <div class="text-center text-xl font-bold text-gray-900 my-3 " >
                    <span class="text-center">Data Privacy Compliance</span>
                </div>
                <!-- Content -->
                <div class="py-10 text-xl text-justify">I hereby agree to submit my documents and to allow MITRFI and its authorized personnel to process my documents and personal information in compliance with the Data Privacy Act of 2012 and MITRFI policies. Acceptance of the
document/s does not automatically guarantee approval as the application shall be subject to the evaluation and approval of the MITFRI based on its loan policies.</div>
                <div class="flex justify-between gap-x-2 2xl:px-20">
                    <div class=" bg-red-500 w-fit text-center text-white px-10 py-4 rounded-full text-lg font-semibold ">
                        <form @submit.prevent="logout">
                            <button>Disagree</button>
                        </form>
                    </div>
                    <Link :href="route('userDashboard')">
                        <div  class="bg-green-500 w-fit text-center  px-10 py-4 rounded-full text-white text-xl font-semibold">
                            <div>Agree</div>
                        </div>
                    </Link>
                </div>
            </div>
        </Modal>
</template>
<script>
import Modal from '@/Jetstream/Modal';
import {Link} from '@inertiajs/inertia-vue3';
export default {
    components:{
        Modal,
        Link
    },

    setup() {
        
    },
    data(){
        return{
            dataPrivacyModal:true,
        }
    },
    methods:{
        logout(){
            this.$inertia.post(route('logout'))
        }
    }
}
</script>