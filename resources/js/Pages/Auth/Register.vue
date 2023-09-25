<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue';
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue';
import JetButton from '@/Jetstream/Button.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetCheckbox from '@/Jetstream/Checkbox.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register" />

    <JetAuthenticationCard>
        <template #logo>
            <img src="/images/mu_logo.png" alt="mu logo" class="h-40 w-45">
        </template>

        <JetValidationErrors class="mb-4" />

        <form @submit.prevent="submit">
            <div class="mt-2 text-lg font-extrabold">
                Personal Information
            </div>
            <div>
                <JetLabel for="name" value="Name" />
                <JetInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="name"
                />
            </div>
            <div class="mt-4">
                <JetLabel for="date of birth" value="Date of Birth" />
                <JetInput
                    id="date of birth"
                    v-model="form.date"
                    type="text"
                    class="mt-1 block w-full"
                    required
                />
            </div>

            <div class="mt-4">
                <JetLabel for="date of employment" value="Date of Employment" />
                <JetInput
                    id="date of employment"
                    v-model="form.date"
                    type="text"
                    class="mt-1 block w-full"
                    required
                />
            </div>


            <div class="mt-4">
                <JetLabel for="date of membership" value="Date of Membership" />
                <JetInput
                    id="date of membership"
                    v-model="form.date"
                    type="text"
                    class="mt-1 block w-full"
                    required
                />
            </div>
            <div class="mt-4">
                <JetLabel for="number" value="Mobile Number" />
                <JetInput
                    id="number"
                    v-model="form.number"
                    type="text"
                    class="mt-1 block w-full"
                    required
                />
            </div>
            <div class="mt-2 text-lg font-extrabold">
                Address Information
            </div>

            <div class="mt-4">
                <JetLabel for="region" value="Region" />
                <JetInput
                    id="region"
                    v-model="form.region"
                    type="text"
                    class="mt-1 block w-full"
                    required
                />
            </div>

            <div class="mt-4">
                <JetLabel for="province" value="Province" />
                <JetInput
                    id="province"
                    v-model="form.region"
                    type="text"
                    class="mt-1 block w-full"
                    required
                />
            </div>

            <div class="mt-4">
                <JetLabel for="municipality" value="Municipality" />
                <JetInput
                    id="municipality"
                    v-model="form.region"
                    type="text"
                    class="mt-1 block w-full"
                    required
                />
            </div>

            <div class="mt-4">
                <JetLabel for="barangay" value="Barangay" />
                <JetInput
                    id="barangay"
                    v-model="form.region"
                    type="text"
                    class="mt-1 block w-full"
                    required
                />
            </div>

            <div class="mt-2 text-lg font-extrabold">
                Account Information
            </div>

            <div class="mt-4">
                <JetLabel for="email" value="Email" />
                <JetInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                />
            </div>

            <div class="mt-4">
                <JetLabel for="password" value="Password" />
                <JetInput
                    id="password"
                    v-model="form.password"
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
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
            </div>

            <div class="mt-4">
                <JetLabel for="role" value="Role" />
                <JetInput
                    id="role"
                    v-model="form.role"
                    type="text"
                    class="mt-1 block w-full"
                    required
                />
            </div>

            <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                <JetLabel for="terms">
                    <div class="flex items-center">
                        <JetCheckbox id="terms" v-model:checked="form.terms" name="terms" />

                        <div class="ml-2">
                            I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                        </div>
                    </div>
                </JetLabel>
            </div>

            <div class="flex items-center justify-end mt-4">
                <JetButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </JetButton>
            </div>
        </form>
    </JetAuthenticationCard>
</template>
