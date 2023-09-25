<template>
  <AppLayout>
    <template #header>
      <div class="flex justify-between">
        <div class="flex items-center">
          <h1 class="font-extrabold text-xl text-gray-800 leading-tight">
            Reimbursement
          </h1>
        </div>
      </div>
    </template>
    <!-- <h1>Reimbursement Page</h1> -->
    <div class="p-2 px-6 leading-tight flex justify-end items-center">
      <!-- <h1 class="text-xl text-gray-700 font-extrabold pl-8">Loans</h1> -->

      <div class="flex px-3 py-1 gap-2">
        <Listbox class="w-80" v-model="form.status">
          <div class="relative">
            <ListboxButton
              class="elative w-full py-2 pl-3 pr-10 text-left bg-white rounded-lg shadow-md cursor-default focus:outline-none focus-visible:ring-2 focus-visible:ring-opacity-75 focus-visible:ring-white focus-visible:ring-offset-orange-300 focus-visible:ring-offset-2 focus-visible:border-indigo-500 sm:text-sm"
            >
              View By: {{ form.status }}
              <span
                class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none"
              >
                <SelectorIcon
                  class="w-5 h-5 text-gray-400"
                  aria-hidden="true"
                />
              </span>
            </ListboxButton>
            <transition
              leave-active-class="transition duration-100 ease-in"
              leave-from-class="opacity-100"
              leave-to-class="opacity-0"
            >
              <ListboxOptions
                class="absolute w-full py-1 mt-1 overflow-auto text-base bg-white rounded-md shadow-lg max-h-60 ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
              >
                <ListboxOption
                  v-for="status in statuses"
                  :key="status"
                  :value="status"
                  as="template"
                  ><li class="px-3 py-2 hover:bg-gray-200 cursor-pointer">
                    {{ status }}
                  </li></ListboxOption
                >
              </ListboxOptions>
            </transition>
          </div>
        </Listbox>
      </div>
    </div>
    <div class="mx-12 my-6 shadow-md">
      <table class="min-w-fit w-full divide-y divide-gray-200 table-fixed">
        <th class="text-center py-3 bg-gray-100">Medical Type</th>
        <th class="text-center py-3 bg-gray-100">Name</th>
        <th class="text-center py-3 bg-gray-100">Medical Benefit</th>
        <th class="text-center py-3 bg-gray-100">Status</th>
        <th class="text-center py-3 bg-gray-100">Amount</th>
        <th class="text-center py-3 bg-gray-100">Action</th>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="medical in medicals.data" v-bind:key="medical.id">
            <td class="text-center py-5">
              {{ medical.reimbursment_type }}
            </td>
            <td class="text-center py-5">
              {{ medical.user.name }}
            </td>
            <td class="text-center py-5">
              {{ medical.medical_benifit }}
            </td>
            <td class="text-center py-5">
              {{ medical.status }}
            </td>
            <td class="text-center py-5">
                &#8369 {{ medical.amount.toLocaleString("en-US") }}.00
            </td>
            <td class="flex justify-center py-5">
              <Link :href="route('ReimbursementProfile', medical.id)">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="26"
                  height="26"
                  fill="currentColor"
                  class="bi bi-eye text-green-500"
                  viewBox="0 0 16 16"
                >
                  <path
                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"
                  />
                  <path
                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"
                  />
                </svg>
              </Link>
            </td>
          </tr>
        </tbody>
      </table>
      <!-- <pagination class="" :links="medicals.links" /> -->
      <pagination :links="medicals.links"  @limit-event="limitEvent"/>
    </div>
  </AppLayout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { pickBy, throttle } from "lodash";

import {
  Listbox,
  ListboxButton,
  ListboxOptions,
  ListboxOption,
} from "@headlessui/vue";

export default {
  setup() {},
  components: {
    AppLayout,
    Link,
    Listbox,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
    Pagination

  },
  props: {
    medicals: Object,
    filter:Object
  },
  data() {
    return {
      form: {
        limit:this.filter.limit == null ? 5:this.filter.limit,
        status:this.filter.status
      },
      statuses: [
        "All",
        "Pending",
        "Approved",
        "For Release",
        "Released",
        "Denied",
      ],
    };
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get(route("ReimbursementView"), pickBy(this.form), {
          preserveState: true,
          preserveScroll: true,
        });
      }, 600),
    },
  },

  methods:{
    limitEvent(event){
            console.log(event)
            this.form.limit = event
        }
  }

};
</script>
