<template>
  <AppLayout title="Register">
    <template #header>
      <div class="flex justify-between">
        <div class="flex items-center">
          <Link :href="route('users')" class="hover:underline">
            <h1 class="font-extrabold text-xl text-gray-800 leading-tight">
              Users
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
            User Register
          </h1>
        </div>
      </div>
    </template>
    <JetAuthenticationCard>
      <template #logo>
        <img src="/images/mu_white.png" alt="mu logo" class="w-64 mt-6" />
      </template>

      <!-- <div class="text-rose-600">
                    <ul>
                        <li v-for="error in $page.props.errors" v-bind:key="error">{{error}}</li>
                    </ul>
                </div> -->
      <JetValidationErrors class="mb-4" />

      <form @submit.prevent="submit">
        <div class="space-y-4">
          <div class="mt-2 text-lg font-extrabold">Personal Information</div>

          <div class="flex justify-between">
            <div>
              <JetLabel for="firstname" value="First Name" />
              <JetInput
                id="name"
                v-model="form.first_name"
                type="text"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="firstname"
              />
            </div>
            <div>
              <JetLabel for="middlename" value="Middle Name" />
              <JetInput
                id="middlename"
                v-model="form.middle_name"
                type="text"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="middle"
              />
            </div>
            <!--
                <div >
                    <JetLabel for="suffix" value="Suffix" />
                    <JetInput
                        id="suffix"

                        type="text"
                        class="mt-1 block w-full"
                        required
                        autofocus

                    />
                </div> -->
          </div>
          <div>
            <JetLabel for="lastname" value="Last Name" />
            <JetInput
              id="lastname"
              v-model="form.last_name"
              type="text"
              class="mt-1 block w-full"
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
                class="mt-1 block w-full"
                required
              />
            </div>

            <div class="mt-4">
              <JetLabel for="employment" value="Date of Employment" />
              <JetInput
                id="employment"
                v-model="form.employment"
                type="date"
                class="mt-1 block w-full"
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
              class="mt-1 block w-full"
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
                class="mt-1 block w-full"
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
                class="mt-1 block w-full"
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
                class="mt-1 block w-full"
                placeholder="XX-XXXX-XX"
                required
              />
            </div>
          </div>
          <div class="flex">
            <div class="mt-4">
              <jet-label for="department" value="Department" />
              <select
                v-model="form.department"
                class="mt-1 block w-full dark text-gray-900 border-gray-300 focus:ring-opacity-50 rounded-md shadow-sm"
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
          </div>
          <!-- <div class="mt-4">
            <JetLabel for="salary" value="Salary" />
            <JetInput
              id="salary"
              v-model="form.salary"
              type="text"
              class="mt-1 block w-full"
              required
            />
          </div> -->

          <div class="flex justify-between">
            <div class="mt-4">
              <jet-label for="role" value="Role" />
              <select
                v-model="form.account_information.role"
                class="mt-1 block w-full dark text-gray-900 border-gray-300 focus:ring-opacity-50 rounded-md shadow-sm"
                required
              >
              <option selected disabled>Select Role</option>
                <!-- <option value="User" selected>User</option>
                <option value="Admin">Admin</option>
                <option value="Medical">Medical</option> -->
                <option v-for="role in roles" v-bind:key="role" :value="role">
                  {{ role }}
                </option>
              </select>
            </div>

            <div class="mt-4">
              <JetLabel for="civil status" value="Civil Status" />
              <select
                v-model="form.civil_status"
                class="mt-1 block w-full dark text-gray-900 border-gray-300 focus:ring-opacity-50 rounded-md shadow-sm"
                required
              >
                <option disabled value="placeholder">Select Status</option>
                <option
                  v-for="status in civil_status"
                  v-bind:key="status"
                  :value="status"
                >
                  {{ status }}
                </option>
              </select>
            </div>
          </div>

          <div class="mt-2 text-lg font-extrabold">Account Information</div>

          <div class="mt-4">
            <JetLabel for="email" value="Email" />
            <JetInput
              id="email"
              v-model="form.account_information.email"
              type="email"
              class="mt-1 block w-full"
              required
            />
          </div>

          <!-- <div class="flex space-x-8">
            <div class="mt-4">
              <JetLabel for="password" value="Password" />
              <JetInput
                id="password"
                v-model="form.account_information.password"
                type="password"
                class="mt-1 block w-full"
                required
                autocomplete="new-password"
              />
            </div>

            <div class="mt-4">
              <JetLabel for="password_confirmation" value="Confirm Password" />
              <JetInput
                id="password_confirmation"
                v-model="form.account_information.password_confirmation"
                type="password"
                class="mt-1 block w-full"
                required
                autocomplete="new-password"
              />
            </div>
          </div> -->
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
                  class="underline text-sm text-gray-600 hover:text-gray-900"
                  >Terms of Service</a
                >
                and
                <a
                  target="_blank"
                  :href="route('policy.show')"
                  class="underline text-sm text-gray-600 hover:text-gray-900"
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
        "School of Architecture, Industrial Design, and the Built Environment",

        "School of Chemical, Biological, and Materials Engineering and Sciences",

        "School of Civil, Environmental, and Geological Engineering",

        "School of Electrical, Electronics, and Computer Engineering",

        "School of Industrial Engineering and Engineering Management",

        "School of Mechanical and Manufacturing Engineering",

        "School of Media Studies",

        "School of Social Sciences and Education",

        "Department of Arts and Letters",

        "Department of Mathematics",

        "Department of Physics",

        "School of Information Technology",

        "E.T. Yuchengo School of Business in collaboration with Arizona State University",

        "Admin office(Treasury, Registrar, Admission)",

        "Maintenance",
      ],
      roles: ["Admin", "User", "Medical"],
      civil_status: ["Single", "Maried", "Widowed", "Divorced"],
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
