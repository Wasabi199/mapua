<template>
  <AppLayout title="Register">
    <template #header>
      <div class="flex justify-between">
        <div class="flex items-center">
          <Link :href="route('users')" class="hover:underline">
            <h1 class="text-xl font-extrabold leading-tight text-gray-800">
              Users
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
            User Register
          </h1>
        </div>
      </div>
    </template>
    <JetAuthenticationCard>
      <template #logo>
        <img src="/images/mu_white.png" alt="mu logo" class="w-64 mt-6" />
      </template>
      <JetValidationErrors class="mb-4" />
      <form @submit.prevent="submit">
        <div class="space-y-4">
          <div class="mt-2 text-lg font-extrabold">Personal Information</div>

            <div>
              <JetLabel for="firstname" value="First Name" />
              <JetInput
                id="name"
                v-model="form.first_name"
                type="text"
                class="block w-full mt-1"
                required
                autofocus
                autocomplete="firstname"
              />
            </div>
          <div>
            <JetLabel for="lastname" value="Last Name" />
            <JetInput
              id="lastname"
              v-model="form.last_name"
              type="text"
              class="block w-full mt-1"
              required
              autofocus
              autocomplete="lastname"
            />
          </div>

          <div class="flex justify-between">
            <div class="mt-4">
              <JetLabel for="date of birth" value="Date of Birth" />
              <JetInput
                id="date of birth"
                v-model="form.birth_date"
                type="date"
                class="block w-full mt-1"
                required
              />
            </div>

            <div class="mt-4">
              <JetLabel for="employment" value="Date of Employment" />
              <JetInput
                id="employment"
                v-model="form.employment"
                type="date"
                class="block w-full mt-1"
                required
              />
            </div>
          </div>
          <div>
            <JetLabel for="birth_place" value="Place of Birth" />
            <JetInput
              id="birth_place"
              v-model="form.birth_place"
              type="text"
              class="block w-full mt-1"
              required
              autofocus
            />
          </div>

          <div class="flex justify-between">
            <div class="mt-4">
              <JetLabel for="date of membership" value="Date of Membership" />
              <JetInput
                id="date of membership"
                v-model="form.membership"
                class="block w-full mt-1"
                required
                type="date"
              />
            </div>

            <div class="mt-4">
              <JetLabel for="number" value="Mobile Number" />
              <JetInput
                id="number"
                v-model="form.mobile_number"
                type="text"
                class="block w-full mt-1"
                required
              />
            </div>
          </div>

          <div class="">
            <div class="mt-4">
              <jet-label for="member_id" value="School ID" />
              <JetInput
                id="number"
                v-model="form.account_information.member_id"
                type="text"
                class="block w-full mt-1"
                placeholder="XX-XXXX-XX"
                required
              />
            </div>
          </div>
            <div class="mt-4">
              <jet-label for="department" value="Department" />
              <select
                v-model="form.department"
                class="block w-full mt-1 text-gray-900 border-gray-300 rounded-md shadow-sm dark focus:ring-opacity-50"
                required
              >
                <option disabled value="placeholder">Select Department</option>
                <option
                  v-for="department in departments"
                  v-bind:key="department"
                  :value="department"
                >
                  {{ department }}
                </option>
              </select>
          </div>
            <div class="mt-4">
              <jet-label for="role" value="Role" />
              <select
                v-model="form.account_information.role"
                class="block w-full mt-1 text-gray-900 border-gray-300 rounded-md shadow-sm dark focus:ring-opacity-50"
                required
              >
              <option selected disabled>Select Role</option>
                <option v-for="role in roles" v-bind:key="role" :value="role">
                  {{ role }}
                </option>
              </select>
            </div>
          

          <div class="mt-2 text-lg font-extrabold">Account Information</div>

          <div class="mt-4">
            <JetLabel for="email" value="Email" />
            <JetInput
              id="email"
              v-model="form.account_information.email"
              type="email"
              class="block w-full mt-1"
              required
            />
          </div>
        </div>
        <div
          v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature"
          class="mt-4"
        >
          <JetLabel for="terms">
            <div class="flex items-center">
              <JetCheckbox id="terms" name="terms" />

              <div class="ml-2">
                I agree to the
                <a
                  target="_blank"
                  :href="route('terms.show')"
                  class="text-sm text-gray-600 underline hover:text-gray-900"
                  >Terms of Service</a
                >
                and
                <a
                  target="_blank"
                  :href="route('policy.show')"
                  class="text-sm text-gray-600 underline hover:text-gray-900"
                  >Privacy Policy</a
                >
              </div>
            </div>
          </JetLabel>
        </div>

        <div class="flex items-center justify-end mt-8">
          <JetButton :disabled="isSubmitting" class="ml-4">
            Register
          </JetButton>
        </div>
      </form>
    </JetAuthenticationCard>
  </AppLayout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard.vue";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import { data } from "browserslist";

export default {
  setup() {},
  props: {
    notification: Object,
    count: Number,
  },
  components: {
    AppLayout,
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    JetButton,
    JetInput,
    JetCheckbox,
    JetLabel,
    JetValidationErrors,
    Link,
    data,
  },
  data() {
    return {
      isSubmiting: false,

      form: this.$inertia.form({
        first_name: "",
        middle_name: "",
        last_name: "",
        birth_date: "",
        birth_place: "",
        civil_status: "",

        employment: "",
        membership: "",
        mobile_number: "",
        department: "",
        // salary: "",

        account_information: {
          email: "",
          password: "",
          // password_confirmation: "",
          role: "",
          member_id: "",
        },
      }),
      member_type: ["Teaching", "Non-Teaching"],

      departments: [
        "Administration",
        "Faculty"
      ],
      roles: ["Admin", "User", "Medical"],
    };
  },
  methods: {
    submit() {
      const pass = [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
      ];
      this.form.account_information.password =
        pass[new Date(this.form.birth_date).getMonth()] +
        new Date(this.form.birth_date).getUTCDate() +
        new Date(this.form.birth_date).getUTCFullYear();
      console.log(this.form.account_information.password);

      this.form.post(route("registerUserSubmit"), {
        onStart: (visit) => {
          this.isSubmiting == true;
        },
        onFinish: (visit) => {
          this.isSubmiting == false;
        },
      });
    },
  },
};
</script>
