<template>
  <AppLayout title="Users">
    <template #header>
      <div class="flex justify-between">
        <div class="flex items-center">
          <h1 class="text-xl font-extrabold leading-tight text-gray-800">
            Users
          </h1>
        </div>
      </div>
    </template>

    <div class="flex items-center justify-between p-2 px-6 leading-tight">
      <h1 class="pl-8 text-xl font-extrabold text-gray-700">User Management</h1>

      <div class="flex-1">
        <Link :href="route('registerUser')" class="ml-4 text-sm font-semibold text-blue-500 hover:underline">
        Register New Member
        </Link>
      </div>

      <input id="search_term" v-model="this.form.search" class="mx-4 border rounded-md" name="search_term"
        placeholder="Search" type="text" />
    </div>

    <div class="mx-12 my-6 shadow-md">
      <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200">
                <th class="px-8 text-center bg-gray-100">Name</th>
                <!-- <th class="text-center bg-gray-100 px-9">Contact No.</th> -->
                <th class="px-16 text-center bg-gray-100">E-mail</th>
                <th class="px-16 text-center bg-gray-100">Department</th>
                <th class="text-center bg-gray-100 px-14">
                  Last Updated Contribution
                </th>

                <tbody class="bg-white divide-y divide-gray-200">
                  <tr v-for="user in users.data" v-bind:key="user.id">
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="">
                        <Link :href="route('userProfile', user.id)">
                        <div>
                          <div class="text-sm font-medium text-center text-gray-900">
                            {{ user.name }}
                          </div>
                        </div>
                        </Link>
                      </div>
                    </td>
                    <!-- <td class="px-6 py-4 whitespace-nowrap">
                      <div class="">
                        <div>
                          <div class="text-sm font-medium text-center text-gray-900">
                            {{ user.admin_reg.mobile_number }}
                          </div>
                        </div>
                      </div>
                    </td> -->

                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="">
                        <div>
                          <div class="text-sm font-medium text-center text-gray-900">
                            {{ user.email }}
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="px-20 py-4 whitespace-nowrap">
                      <div class="">
                        <div>
                          <div class="text-sm font-medium text-center text-gray-900">
                            {{ user.admin_reg.department }}
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="px-20 py-4 whitespace-nowrap">
                      <div class="">
                        <div>
                          <div class="text-sm font-medium text-center text-gray-900">
                            {{
                              new Date(
                                user.user_contribution.updated_at
                              ).toLocaleDateString() +
                              " " +
                              new Date(
                                user.user_contribution.updated_at
                              ).toLocaleTimeString()
                            }}
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="py-4 text-sm font-medium whitespace-nowrap">
                      <!-- edit user info -->
                      <div class="inline-flex gap-x-5">
                        <Link :href="route('userProfile', user.id)" class="text-indigo-600 hover:text-indigo-900">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                          class="bi bi-eye" viewBox="0 0 16 16">
                          <path
                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                          <path
                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                        </svg>
                        </Link>

                        <!-- delete user -->

                        <!-- <svg
                          class="w-6 h-6 text-red-800 bg-gray-100 hover:text-red-500"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="2"
                          viewBox="0 0 24 24"
                          xmlns="http://www.w3.org/2000/svg"
                          @click="deleteUser(user)"
                        >
                          <path
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                        </svg> -->

                        <!-- Archive User -->

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                          stroke="green" class="w-6 h-6 bg-gray-100 cursor-pointer hover:text-green-400"
                          @click="deleteUser(user)">
                          <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <pagination :links="users.links" @limit-event="limitEvent" />


              <Modal :closeable="true" :show="showDeleteModal" @close="showDeleteModal = !showDeleteModal">
                <div class="p-5">
                  <div class="flex justify-between my-3 text-xl font-bold text-gray-900">
                    <span>Update User Table</span>
                    <svg class="w-6 h-6 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                      xmlns="http://www.w3.org/2000/svg" @click="showDeleteModal = !showDeleteModal">
                      <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                    </svg>
                  </div>
                  <div class="flex flex-col items-center my-3 text-xl font-bold text-gray-900">
                    <svg class="text-green-700 rounded-full h-36 w-36 opacity-60" version="1.0"
                      xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 45.001 45.001">
                      <path
                        d="m20.919.053-1.142.131C12.771.967 6.356 5.282 2.822 11.583-.105 16.812-.781 23.361 1.02 29.135c.615 1.995 1.652 4.21 2.022 4.35.291.114.641-.044.818-.361.123-.228.105-.291-.326-1.212-.58-1.221-.949-2.144-1.221-3.041-1.645-5.394-1.214-10.87 1.265-15.854 2.575-5.185 7.338-9.176 12.885-10.819 4.332-1.274 9.15-1.125 13.307.405 1.987.729 4.35 2.065 5.907 3.33 1.125.923 1.23.967 1.626.65.166-.131.228-.263.228-.492 0-.361-.193-.562-1.477-1.538A22.637 22.637 0 0 0 25.883.263c-1.09-.175-4.166-.307-4.965-.21z" />
                      <path
                        d="M38.418 7.699c-.317.396-.282.484.685 1.669 1.617 2.013 3.024 4.728 3.726 7.198.606 2.144.809 3.612.809 5.888-.009 2.496-.291 4.404-.967 6.496a21.218 21.218 0 0 1-17.199 14.51c-2.022.291-4.754.245-6.548-.096-.361-.07-.676-.123-.694-.123s-.035-.175-.035-.396c0-.228-.061-.519-.131-.667-.131-.254-.131-.263.158-.545.632-.597.862-1.538.545-2.284-.123-.308-.123-.317.114-.492.131-.096.361-.378.492-.624.219-.405.245-.527.21-1.063l-.035-.606h2.954c3.26 0 3.56-.035 4.148-.527 1.125-.932.853-2.812-.501-3.437-.335-.158-.711-.166-7.014-.166-7.268 0-7.014.018-7.559-.501a1.459 1.459 0 0 1-.326-.545c-.044-.175-.088-1.363-.088-2.636 0-2.575-.035-2.803-.519-3.358-.396-.475-.879-.694-1.529-.694-.818 0-1.468.378-1.846 1.09-.184.343-.193.501-.236 2.777-.061 2.803-.088 2.945-.914 3.999-1.125 1.433-1.547 2.249-1.775 3.437-.166.914-.166 4.332.009 5.159.291 1.38 1.282 2.645 2.566 3.295 1.072.527 1.372.554 5.87.527l3.956-.026.431-.254.422-.245.764.14c2.689.51 5.369.519 8.069.044 7.321-1.291 13.552-6.17 16.637-13.016.773-1.705 1.424-4.017 1.731-6.091.228-1.591.21-4.789-.044-6.345-.624-3.849-2.074-7.286-4.315-10.248-.949-1.247-1.177-1.468-1.538-1.468a.543.543 0 0 0-.484.228zM9.589 26.183l.21.166.044 2.628c.044 2.601.044 2.619.273 3.102a2.917 2.917 0 0 0 1.398 1.398l.484.228 6.82.044c6.557.044 6.837.053 7.014.21.201.184.245.65.096.932-.175.326-.519.352-4.623.352-3.877 0-3.999.009-4.166.175s-.21.326-.184.615c.026.21.44.527.676.527.317 0 .65.37.65.72-.009.527-.352.773-1.09.773-.606 0-.729.053-.888.352-.236.457.114.967.667.967.282 0 .606.387.606.72-.009.527-.352.773-1.09.773-.606 0-.729.053-.888.352-.228.448.114.967.65.967.263 0 .624.405.624.694 0 .378-.079.527-.361.667-.201.114-.871.131-3.929.131-2.127 0-3.886-.035-4.157-.088a3.612 3.612 0 0 1-2.803-2.803c-.14-.773-.114-3.858.053-4.649.166-.827.571-1.599 1.265-2.479.291-.361.667-.923.836-1.247.484-.906.571-1.486.571-3.787 0-2.435.044-2.584.755-2.601.158-.009.37.07.484.158zM11.294 9.15c-1.098.158-2.54.711-2.75 1.055-.236.378.096.958.554.958.096 0 .457-.114.801-.263 1.952-.818 4.087-.615 6.117.571.764.448 1.011.484 1.282.193.282-.3.254-.694-.079-.976-.764-.641-2.566-1.372-3.796-1.538a7.211 7.211 0 0 0-2.127 0z" />
                      <path
                        d="M30.032 11.294c-2.558.519-3.63.764-3.752.879-.396.352-.105 1.098.422 1.098.352 0 7.189-1.38 7.4-1.494.219-.114.378-.484.308-.711-.07-.21-.466-.519-.65-.51-.079.009-1.748.335-3.726.738zm-17.068 1.838c-.501.228-1.028.773-1.23 1.256-.175.413-.343 1.943-.282 2.593.149 1.643 1.978 2.628 3.472 1.864.862-.448 1.256-1.168 1.38-2.54.053-.545.035-.641-.131-.862-.14-.166-.263-.236-.475-.236-.44 0-.597.245-.729 1.116-.053.413-.166.844-.245.958a1.081 1.081 0 0 1-1.864-.079c-.105-.219-.123-.431-.07-1.151.035-.492.114-1.011.175-1.16.158-.378.536-.615 1.055-.676.492-.053.746-.282.746-.685 0-.615-.914-.818-1.803-.396zm14.985 1.328c-.492.158-1.072.632-1.372 1.142-.175.3-.245.624-.352 1.468-.14 1.204-.105 1.599.193 2.188.597 1.186 2.1 1.634 3.295.993.862-.475 1.186-1.107 1.282-2.461.053-.792.053-.792-.193-.985-.3-.236-.484-.245-.773-.018-.236.184-.273.308-.378 1.274-.044.448-.096.562-.387.853-.273.273-.396.335-.667.335a1.142 1.142 0 0 1-1.028-.641c-.131-.273-.14-.422-.053-1.221.14-1.293.352-1.617 1.151-1.713.21-.026.448-.088.536-.131.236-.123.352-.501.236-.783-.175-.422-.72-.536-1.494-.3zm-12.99 11.338c-.236.3-.245.571-.018.818.193.21.405.254 1.573.317 2.284.14 5.494.941 8.174 2.048.641.273 1.265.484 1.389.484.422.009.676-.475.501-.941-.07-.175-.862-.58-2.1-1.055-2.742-1.063-5.783-1.748-8.227-1.864l-1.098-.053-.193.245z" />
                    </svg>

                    <span class="text-center">You are about to archive {{ userToDelete.name }}'s
                      profile. Are you sure you want to proceed?</span>
                  </div>
                  <div class="flex justify-center">
                    <div class="flex justify-between my-3 text-xl font-bold dark:text-gray-200">
                      <div
                        class="flex px-4 py-1 mr-5 space-x-2 text-green-600 uppercase border border-green-600 rounded-full cursor-pointer text-md dark:text-green-600 dark:border-green-600 dark:hover:text-gray-200 hover:text-white hover:border-none hover:bg-green-500"
                        @click="submitDeleteUser">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                          stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                        </svg>
                        <span>Yes I'm sure</span>
                      </div>
                    </div>
                    <div class="flex my-3 text-xl font-bold dark:text-gray-200">
                      <div
                        class="flex px-4 py-1 space-x-2 text-gray-600 uppercase border border-gray-600 rounded-full cursor-pointer text-md dark:text-gray-600 dark:border-gray-600 dark:hover:text-gray-200 hover:text-white hover:border-none hover:bg-gray-500"
                        @click="showDeleteModal = !showDeleteModal">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                          xmlns="http://www.w3.org/2000/svg">
                          <path d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        </svg>
                        <span>Nevermind</span>
                      </div>
                    </div>
                  </div>
                </div>
              </Modal>
            </div>
          </div>
        </div>
      </div>
    </div>
    <JetValidationErrors class="mb-4 ml-12" />
    <div class="flex justify-between">
      <form enctype="multipart/form-data" method="post" @submit.prevent="verifyUserPasswordFunc">
        <h1 class="ml-12">Upload User Record</h1>

        <input @input="forms.file = $event.target.files[0]" name="file" type="file"
          class="flex items-center p-2 m-2 ml-12 border border-yellow-500 rounded-md hover:bg-yellow-300" />
        <button type="submit"
          class="flex items-center p-2 m-2 ml-12 border border-yellow-500 rounded-md hover:bg-yellow-300">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" stroke-linecap="round"
              stroke-linejoin="round" />
          </svg>
          Upload csv file
        </button>
      </form>
      <form enctype="multipart/form-data" method="post" @submit.prevent="verifyContriPasswordFunc">
        <h1 class="ml-12">Update Contribution</h1>

        <input @input="formsContri.file = $event.target.files[0]" name="file" type="file"
          class="flex items-center p-2 m-2 ml-12 border border-yellow-500 rounded-md hover:bg-yellow-300" />
        <button type="submit"
          class="flex items-center p-2 m-2 ml-12 border border-yellow-500 rounded-md hover:bg-yellow-300">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" stroke-linecap="round"
              stroke-linejoin="round" />
          </svg>
          Upload csv file
        </button>
      </form>
    </div>

    <Modal :closeable="true" :show="verifyUserPassword" @close="verifyUserPassword = !verifyUserPassword">
      <div class="p-5">
        <div class="flex justify-between">
          <div class="text-2xl font-semibold">Password</div>
          <div class="">
            <svg class="w-6 h-6 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg" @click="verifyUserPassword = !verifyUserPassword">
              <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
            </svg>
          </div>
        </div>
        <div class="py-5 text-2xl text-center">
          Please Enter Password for Validation
        </div>
        <JetValidationErrors class="mb-4 ml-12" />
        <div class="pt-5">
          <JetLabel class="text-lg">Password</JetLabel>
          <JetInput v-model="this.forms.password" class="w-full" type="password" />
        </div>
        <div class="m-auto w-fit">
          <button @click="submit"
            class="px-10 py-3 mt-5 text-lg font-semibold border-2 border-green-400 rounded-lg hover:bg-green-500 hover:text-white">
            Verify
          </button>
        </div>
      </div>
    </Modal>

    <Modal :closeable="true" :show="verifyContriPassword" @close="verifyContriPassword = !verifyContriPassword">
      <div class="p-5">
        <div class="flex justify-between">
          <div class="text-2xl font-semibold">Password</div>
          <div class="">
            <svg class="w-6 h-6 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg" @click="verifyContriPassword = !verifyContriPassword">
              <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
            </svg>
          </div>
        </div>
        <div class="py-5 text-2xl text-center">
          Please Enter Password for Validation
        </div>
        <JetValidationErrors class="mb-4 ml-12" />
        <div class="pt-5">
          <JetLabel class="text-lg">Password</JetLabel>
          <JetInput v-model="this.formsContri.password" class="w-full" type="password" />
        </div>
        <div class="m-auto w-fit">
          <button @click="submitContri"
            class="px-10 py-3 mt-5 text-lg font-semibold border-2 border-green-400 rounded-lg hover:bg-green-500 hover:text-white">
            Verify
          </button>
        </div>
      </div>
    </Modal>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import JetApplicationLogo from "@/Jetstream/ApplicationLogo.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Modal from "@/Jetstream/Modal";
import { pickBy, throttle } from "lodash";
import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";
import route from "../../../../vendor/tightenco/ziggy/src/js";
import { useForm } from "@inertiajs/inertia-vue3";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
// import Pagination from '../../Components/Pagination.vue';

export default {
  components: {
    AppLayout,
    Pagination,
    JetApplicationLogo,
    Link,
    Modal,
    JetValidationErrors,
    JetInput,
    JetLabel
  },
  props: {
    filters: Object,
    users: Object,
    notification: Object,
    count: Number,
  },

  setup() {
    const forms = useForm({
      file: null,
      password: "",
    });
    const formsContri = useForm({
      file: null,
      password: "",
    });

    function submit() {
      this.verifyUserPassword = !this.verifyUserPassword;
      forms.post(route("import"), {
        onFinish: (visit) => {
          this.verifyUserPassword = !this.verifyUserPassword;

        }
      });
    }
    function submitContri() {
      this.verifyContriPassword = !this.verifyContriPassword;
      formsContri.post(route("userContriImport"));
    }
    return { forms, submit, formsContri, submitContri };
  },

  data() {
    return {
      userToDelete: Object,
      verifyUserPassword: false,
      verifyContriPassword: false,
      showDeleteModal: false,

      form: {
        limit: this.filters.limit == null ? 5 : this.filters.limit,
        search: this.filters.search,
      },

      deleteForm: this.$inertia.form({
        id: Number,
        status: 2,
      }),
    };
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get(route("users"), pickBy(this.form), {
          preserveState: true,
          preserveScroll: true,
        });
      }, 600),
    },
  },
  methods: {
    deleteUser(user) {
      this.userToDelete = user;
      this.showDeleteModal = !this.showDeleteModal;
    },
    submitDeleteUser() {
      this.deleteForm.id = this.userToDelete.id;
      this.deleteForm.delete(route("userDelete"), {
        onSuccess: () => {
          this.showDeleteModal = false;
        },
      });
    },
    verifyUserPasswordFunc() {
      this.verifyUserPassword = !this.verifyUserPassword;
    },
    verifyContriPasswordFunc() {
      this.verifyContriPassword = !this.verifyContriPassword;
    },

    limitEvent(event) {
      console.log(event)
      this.form.limit = event
    }
  },


};
</script>
