<script>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";
import JetApplicationMark from "@/Jetstream/ApplicationMark.vue";
import JetBanner from "@/Jetstream/Banner.vue";
import JetDropdown from "@/Jetstream/Dropdown.vue";
import JetDropdownLink from "@/Jetstream/DropdownLink.vue";
import JetNavLink from "@/Jetstream/NavLink.vue";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink.vue";
import Pagination from "@/Components/Pagination.vue";
import { Popover, PopoverButton, PopoverPanel } from "@headlessui/vue";
import NotificationArea from "@/Components/NotificationArea";
import { data } from "browserslist";
export default {
    setup() {},
    props: {
        title: String,
    },
    components: {
        ref,
        Inertia,
        Head,
        Link,
        JetApplicationMark,
        JetBanner,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink,
        NotificationArea,
        Popover,
        PopoverButton,
        PopoverPanel,
        data,
    },
    data() {
        return {
            showingNavigationDropdown: false,
            // notifToClick:Object,
            notif: this.$inertia.form({
                id: Number,
                onRead: "",
            }),
        };
    },
    methods: {
        switchToTeam(team) {
            this.$inertia.put(
                route("current-team.update"),
                {
                    team_id: team.id,
                },
                {
                    preserveState: false,
                }
            );
        },
        logout() {
            this.$inertia.post(route("logout"));
        },

        submit(notif) {
            // console.log(notif);
            this.notif.id = notif.id;
            this.notif.onRead = true;
            if (this.$page.props.user.userType == 1) {
                this.notif.post(route("AdminNotification"), []);
            } else if (this.$page.props.user.userType == 2) {
                this.notif.post(route("UserNotification"), []);
            } else if (this.$page.props.user.userType == 3) {
                this.notif.post(route("MedicalNotification"), []);
            }
        },

        revisit(notification_type, universal_id) {
            console.log(notification_type, universal_id);
            if (notification_type == 1) {
                this.$inertia.get(route("contributions", universal_id));
            } else if (notification_type == 2) {
                this.$inertia.get(route("medicalProfile", universal_id));
            } else if (notification_type == 3) {
                this.$inertia.get(route("UserLoanView", universal_id));
            } else if (notification_type == 4) {
                this.$inertia.get(route("UserLoanView", universal_id));
            } else if (notification_type == 5) {
                this.$inertia.get(route("MedicalBreakdown", universal_id));
            } else if (notification_type == 6) {
                this.$inertia.get(route("MedicalBreakdown", universal_id));
            } else if (notification_type == 7) {
                this.$inertia.get(route("ReimbursementProfile", universal_id));
            }
        },
    },
};
</script>
>

<template>
    <div>
        <Head :title="title" />

        <JetBanner />

        <div class="min-h-screen bg-gray-100">
            <notification-area :messages="$page.props.flash.message" />
            <nav class="bg-[#9d0a10] border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div
                    class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-[#9d0a10]"
                >
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div
                                v-if="$page.props.user.userType != 2"
                                class="shrink-0 flex items-center"
                            >
                                <Link :href="route('dashboard')">
                                    <JetApplicationMark class="block w-16" />
                                </Link>
                            </div>
                            <div
                                v-if="$page.props.user.userType == 2"
                                class="shrink-0 flex items-center"
                            >
                                <Link :href="route('userDashboard')">
                                    <JetApplicationMark class="block w-16" />
                                </Link>
                            </div>

                            <!--Admin Navigation -->
                            <div
                                v-if="$page.props.user.userType == 1"
                                class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"
                            >
                                <!-- Dashboard -->
                                <JetNavLink
                                    :href="route('dashboard')"
                                    :active="route().current('dashboard')"
                                >
                                    Home
                                </JetNavLink>
                                <!-- Users -->
                                <JetNavLink
                                    :href="route('users')"
                                    :active="route().current('users')"
                                >
                                    Users
                                </JetNavLink>
                                <JetNavLink
                                    :href="route('adminLoansView')"
                                    :active="route().current('adminLoansView')"
                                >
                                    Loans
                                </JetNavLink>
                                <JetNavLink
                                    :href="route('ReimbursementView')"
                                    :active="
                                        route().current('ReimbursementView')
                                    "
                                >
                                    Reimbursement
                                </JetNavLink>
                                <JetNavLink
                                    :href="route('archive')"
                                    :active="
                                        route().current('archive')
                                    "
                                >
                                    User Archives
                                </JetNavLink>
                            </div>

                            <!-- User Navigation -->
                            <div
                                v-if="$page.props.user.userType == 2"
                                class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"
                            >
                                <!-- Dashboard -->
                                <JetNavLink
                                    :href="route('userDashboard')"
                                    :active="route().current('userDashboard')"
                                >
                                    Dashboard
                                </JetNavLink>
                                <!-- Current Loans -->
                                <JetNavLink
                                    :href="route('loansView')"
                                    :active="route().current('loansView')"
                                >
                                    Current Loan
                                </JetNavLink>
                                <!-- Users Loan -->

                                <JetNavLink
                                    :href="route('medicalView')"
                                    :active="route().current('medicalView')"
                                >
                                    Medical
                                </JetNavLink>

                                <!-- Medical Dashboard -->
                            </div>
                            <div
                                v-if="$page.props.user.userType == 3"
                                class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"
                            >
                                <!-- Dashboard -->
                                <JetNavLink
                                    :href="route('dashboard')"
                                    :active="route().current('dashboard')"
                                >
                                    Home
                                </JetNavLink>
                                <!-- Medical Reimbursement List -->
                                <JetNavLink
                                    :href="route('medicalList')"
                                    :active="route().current('medicalList')"
                                >
                                    Medical
                                </JetNavLink>
                            </div>
                            <div
                                v-if="$page.props.user.userType == 4"
                                class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"
                            >
                                <!-- Dashboard -->
                                <JetNavLink
                                    :href="route('dashboard')"
                                    :active="route().current('dashboard')"
                                >
                                    Home
                                </JetNavLink>
                                <!-- Medical Reimbursement List -->
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <div class="ml-3 relative">
                                <!-- Teams Dropdown -->
                                <JetDropdown
                                    v-if="$page.props.jetstream.hasTeamFeatures"
                                    align="right"
                                    width="60"
                                >
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition"
                                            >
                                                {{
                                                    $page.props.user
                                                        .current_team.name
                                                }}

                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <div class="w-60">
                                            <!-- Team Management -->
                                            <template
                                                v-if="
                                                    $page.props.jetstream
                                                        .hasTeamFeatures
                                                "
                                            >
                                                <div
                                                    class="block px-4 py-2 text-xs text-gray-400"
                                                >
                                                    Manage Team
                                                </div>

                                                <!-- Team Settings -->
                                                <JetDropdownLink
                                                    :href="
                                                        route(
                                                            'teams.show',
                                                            $page.props.user
                                                                .current_team
                                                        )
                                                    "
                                                >
                                                    Team Settings
                                                </JetDropdownLink>

                                                <JetDropdownLink
                                                    v-if="
                                                        $page.props.jetstream
                                                            .canCreateTeams
                                                    "
                                                    :href="
                                                        route('teams.create')
                                                    "
                                                >
                                                    Create New Team
                                                </JetDropdownLink>

                                                <div
                                                    class="border-t border-gray-100"
                                                />

                                                <!-- Team Switcher -->
                                                <div
                                                    class="block px-4 py-2 text-xs text-gray-400"
                                                >
                                                    Switch Teams
                                                </div>

                                                <template
                                                    v-for="team in $page.props
                                                        .user.all_teams"
                                                    :key="team.id"
                                                >
                                                    <form
                                                        @submit.prevent="
                                                            switchToTeam(team)
                                                        "
                                                    >
                                                        <JetDropdownLink
                                                            as="button"
                                                        >
                                                            <div
                                                                class="flex items-center"
                                                            >
                                                                <svg
                                                                    v-if="
                                                                        team.id ==
                                                                        $page
                                                                            .props
                                                                            .user
                                                                            .current_team_id
                                                                    "
                                                                    class="mr-2 h-5 w-5 text-green-400"
                                                                    fill="none"
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    stroke="currentColor"
                                                                    viewBox="0 0 24 24"
                                                                >
                                                                    <path
                                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                                                    />
                                                                </svg>
                                                                <div>
                                                                    {{
                                                                        team.name
                                                                    }}
                                                                </div>
                                                            </div>
                                                        </JetDropdownLink>
                                                    </form>
                                                </template>
                                            </template>
                                        </div>
                                    </template>
                                </JetDropdown>
                            </div>

                            <!-- Settings Dropdown -->
                            <div
                                class="flex space-x-5 items-center ml-3 relative"
                            >
                                <Popover class="relative">
                                    <PopoverButton>
                                        <span
                                            class="inline-block cursor-pointer"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                aria-hidden="true"
                                                role="img"
                                                class="w-6 h-6 text-yellow-300 fill-current"
                                                preserveAspectRatio="xMidYMid meet"
                                                viewBox="0 0 20 20"
                                            >
                                                <path
                                                    fill="currentColor"
                                                    d="M16 7a5.38 5.38 0 0 0-4.46-4.85C11.6 1.46 11.53 0 10 0S8.4 1.46 8.46 2.15A5.38 5.38 0 0 0 4 7v6l-2 2v1h16v-1l-2-2zm-6 13a3 3 0 0 0 3-3H7a3 3 0 0 0 3 3z"
                                                />
                                            </svg>
                                            <span
                                                v-if="
                                                    this.$page.props
                                                        .notification.length > 0
                                                "
                                                class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full"
                                            >
                                                {{ this.$page.props.count }}
                                            </span>
                                        </span>
                                    </PopoverButton>

                                    <PopoverPanel
                                        class="absolute z-10 w-64 right-[0rem]"
                                    >
                                        <div
                                            class="flex flex-col bg-white/30 backdrop-blur-md rounded-xl shadow-xl py-5 px-3"
                                        >
                                            <div
                                                class="flex justify-between h-6"
                                            >
                                                <span class="mb-5"
                                                    >Notifications</span
                                                >
                                                <div
                                                    class="flex items-center justify-center bg-slate-700 rounded-full px-3 py-1 space-x-2 cursor-pointer"
                                                >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        aria-hidden="true"
                                                        role="img"
                                                        class="h-4 w-4 text-white"
                                                        preserveAspectRatio="xMidYMid meet"
                                                        viewBox="0 0 28 28"
                                                    >
                                                        <path
                                                            fill="currentColor"
                                                            d="M21.75 3A3.25 3.25 0 0 1 25 6.25v15.5A3.25 3.25 0 0 1 21.75 25H6.25A3.25 3.25 0 0 1 3 21.75V6.25A3.25 3.25 0 0 1 6.25 3h15.5Zm0 1.5H6.25A1.75 1.75 0 0 0 4.5 6.25V15h6a.75.75 0 0 1 .743.648l.007.102a2.75 2.75 0 1 0 5.5 0a.75.75 0 0 1 .648-.743L17.5 15h6V6.25a1.75 1.75 0 0 0-1.75-1.75Z"
                                                        />
                                                    </svg>
                                                    <span
                                                        class="text-white text-sm"
                                                    >
                                                        {{
                                                            this.$page.props
                                                                .count
                                                        }}
                                                        unread</span
                                                    >
                                                </div>
                                            </div>
                                            <div
                                                v-if="
                                                    this.$page.props
                                                        .notification.length > 0
                                                "
                                                class="flex flex-col space-y-2 max-h-60 overflow-y-scroll p-1 mt-2"
                                            >
                                                <div
                                                    v-for="notif in this.$page
                                                        .props.notification"
                                                    v-bind:key="notif.id"
                                                    class="flex flex-col p-2 hover:bg-slate-700 hover:text-slate-100 rounded-xl cursor-pointer"
                                                >
                                                    <div
                                                        v-if="notif.onRead == 0"
                                                        class="flex flex-col bg-slate-700 rounded-xl p-1 text-white"
                                                        @click="submit(notif)"
                                                    >
                                                        <span
                                                            class="font-semibold"
                                                            >{{
                                                                notif.type == 1
                                                                    ? "Loan"
                                                                    : ""
                                                            }}</span
                                                        >
                                                        <span
                                                            class="font-semibold"
                                                            >{{
                                                                notif.type == 2
                                                                    ? "Applying"
                                                                    : ""
                                                            }}</span
                                                        >
                                                        <span
                                                            class="font-semibold"
                                                            >{{
                                                                notif.type == 3
                                                                    ? "Medical"
                                                                    : ""
                                                            }}</span
                                                        >
                                                        <span
                                                            class="font-semibold"
                                                            >{{
                                                                notif.type == 4
                                                                    ? "Medical"
                                                                    : ""
                                                            }}</span
                                                        >
                                                        <span
                                                            class="text-sm overflow-hidden text-ellipsis font-semibold"
                                                            >{{
                                                                notif.notification_type ==
                                                                1
                                                                    ? "Loan Register"
                                                                    : ""
                                                            }}</span
                                                        >
                                                        <span
                                                            class="text-sm overflow-hidden text-ellipsis font-semibold"
                                                            >{{
                                                                notif.notification_type ==
                                                                2
                                                                    ? "Medical Register"
                                                                    : ""
                                                            }}</span
                                                        >
                                                        <span
                                                            class="text-sm overflow-hidden text-ellipsis font-semibold"
                                                            >{{
                                                                notif.notification_type ==
                                                                3
                                                                    ? "Loan Update"
                                                                    : ""
                                                            }}</span
                                                        >
                                                        <span
                                                            class="text-sm overflow-hidden text-ellipsis font-semibold"
                                                            >{{
                                                                notif.notification_type ==
                                                                4
                                                                    ? "Denied Loan"
                                                                    : ""
                                                            }}</span
                                                        >
                                                        <span
                                                            class="text-sm overflow-hidden text-ellipsis font-semibold"
                                                            >{{
                                                                notif.notification_type ==
                                                                5
                                                                    ? "Medical Update"
                                                                    : ""
                                                            }}</span
                                                        >
                                                        <span
                                                            class="text-sm overflow-hidden text-ellipsis font-semibold"
                                                            >{{
                                                                notif.notification_type ==
                                                                6
                                                                    ? "Denied Medical"
                                                                    : ""
                                                            }}</span
                                                        >
                                                        <span
                                                            class="text-sm overflow-hidden text-ellipsis font-semibold"
                                                            >{{
                                                                notif.notification_type ==
                                                                7
                                                                    ? "Approved Medical"
                                                                    : ""
                                                            }}</span
                                                        >
                                                        <span
                                                            class="text-sm overflow-hidden text-ellipsis h-10"
                                                            >{{
                                                                notif.value
                                                            }}</span
                                                        >
                                                        <span class="text-sm">{{
                                                            new Date(
                                                                notif.created_at
                                                            ).toLocaleDateString() +
                                                            " " +
                                                            new Date(
                                                                notif.created_at
                                                            ).toLocaleTimeString(
                                                                "en-US"
                                                            )
                                                        }}</span>
                                                    </div>
                                                    <div
                                                        v-if="notif.onRead == 1"
                                                        class="flex flex-col p-1"
                                                        @click="
                                                            revisit(
                                                                notif.notification_type,
                                                                notif.universal_id
                                                            )
                                                        "
                                                    >
                                                        <span
                                                            class="font-semibold"
                                                            >{{
                                                                notif.type == 1
                                                                    ? "Loan"
                                                                    : ""
                                                            }}</span
                                                        >
                                                        <span
                                                            class="font-semibold"
                                                            >{{
                                                                notif.type == 2
                                                                    ? "Applying"
                                                                    : ""
                                                            }}</span
                                                        >
                                                        <span
                                                            class="font-semibold"
                                                            >{{
                                                                notif.type == 3
                                                                    ? "Medical"
                                                                    : ""
                                                            }}</span
                                                        >
                                                        <span
                                                            class="font-semibold"
                                                            >{{
                                                                notif.type == 4
                                                                    ? "Medical"
                                                                    : ""
                                                            }}</span
                                                        >
                                                        <span
                                                            class="text-sm overflow-hidden text-ellipsis font-semibold"
                                                            >{{
                                                                notif.notification_type ==
                                                                1
                                                                    ? "Loan Register"
                                                                    : ""
                                                            }}</span
                                                        >
                                                        <span
                                                            class="text-sm overflow-hidden text-ellipsis font-semibold"
                                                            >{{
                                                                notif.notification_type ==
                                                                2
                                                                    ? "Medical Register"
                                                                    : ""
                                                            }}</span
                                                        >
                                                        <span
                                                            class="text-sm overflow-hidden text-ellipsis font-semibold"
                                                            >{{
                                                                notif.notification_type ==
                                                                3
                                                                    ? "Loan Update"
                                                                    : ""
                                                            }}</span
                                                        >
                                                        <span
                                                            class="text-sm overflow-hidden text-ellipsis font-semibold"
                                                            >{{
                                                                notif.notification_type ==
                                                                4
                                                                    ? "Denied Loan"
                                                                    : ""
                                                            }}</span
                                                        >
                                                        <span
                                                            class="text-sm overflow-hidden text-ellipsis font-semibold"
                                                            >{{
                                                                notif.notification_type ==
                                                                5
                                                                    ? "Medical Update"
                                                                    : ""
                                                            }}</span
                                                        >
                                                        <span
                                                            class="text-sm overflow-hidden text-ellipsis font-semibold"
                                                            >{{
                                                                notif.notification_type ==
                                                                6
                                                                    ? "Denied Medical"
                                                                    : ""
                                                            }}</span
                                                        >
                                                        <span
                                                            class="text-sm overflow-hidden text-ellipsis font-semibold"
                                                            >{{
                                                                notif.notification_type ==
                                                                7
                                                                    ? "Approved Medical"
                                                                    : ""
                                                            }}</span
                                                        >

                                                        <span
                                                            class="text-sm overflow-hidden text-ellipsis h-10"
                                                            >{{
                                                                notif.value
                                                            }}</span
                                                        >
                                                        <span class="text-sm">{{
                                                            new Date(
                                                                notif.created_at
                                                            ).toLocaleDateString() +
                                                            " " +
                                                            new Date(
                                                                notif.created_at
                                                            ).toLocaleTimeString(
                                                                "en-US"
                                                            )
                                                        }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div
                                                v-else
                                                class="flex flex-col space-y-2 p-1 mt-2 text-base text-slate-500"
                                            >
                                                You dont have any notifications
                                                at the moment. 😢
                                            </div>
                                        </div>
                                    </PopoverPanel>
                                </Popover>
                                <JetDropdown align="right" width="48">
                                    <template #trigger>
                                        <button
                                            v-if="
                                                $page.props.jetstream
                                                    .managesProfilePhotos
                                            "
                                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"
                                        >
                                            <img
                                                class="h-8 w-8 rounded-full object-cover"
                                                :src="
                                                    $page.props.user
                                                        .profile_photo_url
                                                "
                                                :alt="$page.props.user.name"
                                            />
                                        </button>

                                        <span
                                            v-else
                                            class="inline-flex rounded-md"
                                        >
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-red-800 bg-white hover:text-red-700 focus:outline-none transition"
                                            >
                                                {{ $page.props.user.name }}

                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <!-- Account Management -->
                                        <div
                                            class="block px-4 py-2 text-xs text-red-400"
                                        >
                                            Manage Account
                                        </div>

                                        <JetDropdownLink
                                            :href="route('profile.show')"
                                        >
                                            Profile
                                        </JetDropdownLink>

                                        <JetDropdownLink
                                            v-if="
                                                $page.props.jetstream
                                                    .hasApiFeatures
                                            "
                                            :href="route('api-tokens.index')"
                                        >
                                            API Tokens
                                        </JetDropdownLink>

                                        <div class="border-t border-gray-100" />

                                        <!-- Authentication -->
                                        <form @submit.prevent="logout">
                                            <JetDropdownLink as="button">
                                                Log Out
                                            </JetDropdownLink>
                                        </form>
                                    </template>
                                </JetDropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <Popover class="relative">
                                <PopoverButton>
                                    <span class="inline-block cursor-pointer">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            aria-hidden="true"
                                            role="img"
                                            class="w-6 h-6 mt-2 text-yellow-300 fill-current"
                                            preserveAspectRatio="xMidYMid meet"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill="currentColor"
                                                d="M16 7a5.38 5.38 0 0 0-4.46-4.85C11.6 1.46 11.53 0 10 0S8.4 1.46 8.46 2.15A5.38 5.38 0 0 0 4 7v6l-2 2v1h16v-1l-2-2zm-6 13a3 3 0 0 0 3-3H7a3 3 0 0 0 3 3z"
                                            />
                                        </svg>
                                        <span
                                            v-if="
                                                this.$page.props.notification
                                                    .length > 0
                                            "
                                            class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full"
                                        >
                                            {{ this.$page.props.count }}
                                        </span>
                                    </span>
                                </PopoverButton>

                                <PopoverPanel
                                    class="absolute z-10 w-64 right-[0rem]"
                                >
                                    <div
                                        class="flex flex-col bg-white/30 backdrop-blur-md rounded-xl shadow-xl py-5 px-3"
                                    >
                                        <div class="flex justify-between h-6">
                                            <span class="mb-5"
                                                >Notifications</span
                                            >
                                            <div
                                                class="flex items-center justify-center bg-slate-700 rounded-full px-3 py-1 space-x-2 cursor-pointer"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    aria-hidden="true"
                                                    role="img"
                                                    class="h-4 w-4 text-white"
                                                    preserveAspectRatio="xMidYMid meet"
                                                    viewBox="0 0 28 28"
                                                >
                                                    <path
                                                        fill="currentColor"
                                                        d="M21.75 3A3.25 3.25 0 0 1 25 6.25v15.5A3.25 3.25 0 0 1 21.75 25H6.25A3.25 3.25 0 0 1 3 21.75V6.25A3.25 3.25 0 0 1 6.25 3h15.5Zm0 1.5H6.25A1.75 1.75 0 0 0 4.5 6.25V15h6a.75.75 0 0 1 .743.648l.007.102a2.75 2.75 0 1 0 5.5 0a.75.75 0 0 1 .648-.743L17.5 15h6V6.25a1.75 1.75 0 0 0-1.75-1.75Z"
                                                    />
                                                </svg>
                                                <span
                                                    class="text-white text-sm"
                                                >
                                                    {{ this.$page.props.count }}
                                                    unread</span
                                                >
                                            </div>
                                        </div>
                                        <div
                                            v-if="
                                                this.$page.props.notification
                                                    .length > 0
                                            "
                                            class="flex flex-col space-y-2 max-h-60 overflow-y-scroll p-1 mt-2"
                                        >
                                            <div
                                                v-for="notif in this.$page.props
                                                    .notification"
                                                v-bind:key="notif.id"
                                                class="flex flex-col p-2 hover:bg-slate-700 hover:text-slate-100 rounded-xl cursor-pointer"
                                            >
                                                <div
                                                    v-if="notif.onRead == 0"
                                                    class="flex flex-col bg-slate-700 rounded-xl p-1 text-white"
                                                    @click="submit(notif)"
                                                >
                                                    <span
                                                        class="font-semibold"
                                                        >{{
                                                            notif.type == 1
                                                                ? "Loan"
                                                                : ""
                                                        }}</span
                                                    >
                                                    <span
                                                        class="font-semibold"
                                                        >{{
                                                            notif.type == 2
                                                                ? "Applying"
                                                                : ""
                                                        }}</span
                                                    >
                                                    <span
                                                        class="font-semibold"
                                                        >{{
                                                            notif.type == 3
                                                                ? "Medical"
                                                                : ""
                                                        }}</span
                                                    >
                                                    <!-- <span  class="font-semibold">{{notif.type == 4? 'Medical':''}}</span> -->
                                                    <span
                                                        class="text-sm overflow-hidden text-ellipsis font-semibold"
                                                        >{{
                                                            notif.notification_type ==
                                                            1
                                                                ? "Loan Register"
                                                                : ""
                                                        }}</span
                                                    >
                                                    <span
                                                        class="text-sm overflow-hidden text-ellipsis font-semibold"
                                                        >{{
                                                            notif.notification_type ==
                                                            2
                                                                ? "Medical Register"
                                                                : ""
                                                        }}</span
                                                    >
                                                    <span
                                                        class="text-sm overflow-hidden text-ellipsis font-semibold"
                                                        >{{
                                                            notif.notification_type ==
                                                            3
                                                                ? "Loan Update"
                                                                : ""
                                                        }}</span
                                                    >
                                                    <span
                                                        class="text-sm overflow-hidden text-ellipsis font-semibold"
                                                        >{{
                                                            notif.notification_type ==
                                                            4
                                                                ? "Denied Loan"
                                                                : ""
                                                        }}</span
                                                    >
                                                    <span
                                                        class="text-sm overflow-hidden text-ellipsis font-semibold"
                                                        >{{
                                                            notif.notification_type ==
                                                            5
                                                                ? "Medical Update"
                                                                : ""
                                                        }}</span
                                                    >
                                                    <span
                                                        class="text-sm overflow-hidden text-ellipsis font-semibold"
                                                        >{{
                                                            notif.notification_type ==
                                                            6
                                                                ? "Denied Medical"
                                                                : ""
                                                        }}</span
                                                    >
                                                    <span
                                                        class="text-sm overflow-hidden text-ellipsis font-semibold"
                                                        >{{
                                                            notif.notification_type ==
                                                            7
                                                                ? "Approved Medical"
                                                                : ""
                                                        }}</span
                                                    >

                                                    <span
                                                        class="text-sm overflow-hidden text-ellipsis h-10"
                                                        >{{ notif.value }}</span
                                                    >
                                                    <span class="text-sm">{{
                                                        new Date(
                                                            notif.created_at
                                                        ).toLocaleDateString() +
                                                        " " +
                                                        new Date(
                                                            notif.created_at
                                                        ).toLocaleTimeString(
                                                            "en-US"
                                                        )
                                                    }}</span>
                                                </div>
                                                <div
                                                    v-if="notif.onRead == 1"
                                                    class="flex flex-col p-1"
                                                    @click="
                                                        revisit(
                                                            notif.notification_type,
                                                            notif.universal_id
                                                        )
                                                    "
                                                >
                                                    <span
                                                        class="font-semibold"
                                                        >{{
                                                            notif.type == 1
                                                                ? "Loan"
                                                                : ""
                                                        }}</span
                                                    >
                                                    <span
                                                        class="font-semibold"
                                                        >{{
                                                            notif.type == 2
                                                                ? "Applying"
                                                                : ""
                                                        }}</span
                                                    >
                                                    <span
                                                        class="font-semibold"
                                                        >{{
                                                            notif.type == 3
                                                                ? "Medical"
                                                                : ""
                                                        }}</span
                                                    >
                                                    <!-- <span  class="font-semibold">{{notif.type == 4? 'Medical':''}}</span> -->
                                                    <span
                                                        class="text-sm overflow-hidden text-ellipsis font-semibold"
                                                        >{{
                                                            notif.notification_type ==
                                                            1
                                                                ? "Loan Register"
                                                                : ""
                                                        }}</span
                                                    >
                                                    <span
                                                        class="text-sm overflow-hidden text-ellipsis font-semibold"
                                                        >{{
                                                            notif.notification_type ==
                                                            2
                                                                ? "Medical Register"
                                                                : ""
                                                        }}</span
                                                    >
                                                    <span
                                                        class="text-sm overflow-hidden text-ellipsis font-semibold"
                                                        >{{
                                                            notif.notification_type ==
                                                            3
                                                                ? "Loan Update"
                                                                : ""
                                                        }}</span
                                                    >
                                                    <span
                                                        class="text-sm overflow-hidden text-ellipsis font-semibold"
                                                        >{{
                                                            notif.notification_type ==
                                                            4
                                                                ? "Denied Loan"
                                                                : ""
                                                        }}</span
                                                    >
                                                    <span
                                                        class="text-sm overflow-hidden text-ellipsis font-semibold"
                                                        >{{
                                                            notif.notification_type ==
                                                            5
                                                                ? "Medical Update"
                                                                : ""
                                                        }}</span
                                                    >
                                                    <span
                                                        class="text-sm overflow-hidden text-ellipsis font-semibold"
                                                        >{{
                                                            notif.notification_type ==
                                                            6
                                                                ? "Denied Medical"
                                                                : ""
                                                        }}</span
                                                    >
                                                    <span
                                                        class="text-sm overflow-hidden text-ellipsis font-semibold"
                                                        >{{
                                                            notif.notification_type ==
                                                            7
                                                                ? "Approved Medical"
                                                                : ""
                                                        }}</span
                                                    >

                                                    <span
                                                        class="text-sm overflow-hidden text-ellipsis h-10"
                                                        >{{ notif.value }}</span
                                                    >
                                                    <span class="text-sm">{{
                                                        new Date(
                                                            notif.created_at
                                                        ).toLocaleDateString() +
                                                        " " +
                                                        new Date(
                                                            notif.created_at
                                                        ).toLocaleTimeString(
                                                            "en-US"
                                                        )
                                                    }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            v-else
                                            class="flex flex-col space-y-2 p-1 mt-2 text-base text-slate-500"
                                        >
                                            You dont have any notifications at
                                            the moment. 😢
                                        </div>
                                    </div>
                                </PopoverPanel>
                            </Popover>
                            <button
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition"
                                @click="
                                    showingNavigationDropdown =
                                        !showingNavigationDropdown
                                "
                            >
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex':
                                                !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex':
                                                showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class="sm:hidden"
                >
                    <div
                        v-if="$page.props.user.userType == 2"
                        class="pt-2 pb-3 space-y-1"
                    >
                        <JetResponsiveNavLink
                            :href="route('userDashboard')"
                            :active="route().current('dashboard')"
                        >
                            Dashboard
                        </JetResponsiveNavLink>
                        <JetResponsiveNavLink
                            :href="route('loansView')"
                            :active="route().current('loansView')"
                        >
                            Current Loan
                        </JetResponsiveNavLink>
                        <JetResponsiveNavLink
                            :href="route('medicalView')"
                            :active="route().current('medicalView')"
                        >
                            Medical
                        </JetResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="flex items-center px-4">
                            <div
                                v-if="
                                    $page.props.jetstream.managesProfilePhotos
                                "
                                class="shrink-0 mr-3"
                            >
                                <img
                                    class="h-10 w-10 rounded-full object-cover"
                                    :src="$page.props.user.profile_photo_url"
                                    :alt="$page.props.user.name"
                                />
                            </div>

                            <div>
                                <div class="font-medium text-base text-white">
                                    {{ $page.props.user.name }}
                                </div>
                                <div class="font-medium text-sm text-white">
                                    {{ $page.props.user.email }}
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <JetResponsiveNavLink
                                :href="route('profile.show')"
                                :active="route().current('profile.show')"
                            >
                                Profile
                            </JetResponsiveNavLink>

                            <JetResponsiveNavLink
                                v-if="$page.props.jetstream.hasApiFeatures"
                                :href="route('api-tokens.index')"
                                :active="route().current('api-tokens.index')"
                            >
                                API Tokens
                            </JetResponsiveNavLink>

                            <!-- Authentication -->
                            <form method="POST" @submit.prevent="logout">
                                <JetResponsiveNavLink as="button">
                                    Log Out
                                </JetResponsiveNavLink>
                            </form>

                            <!-- Team Management -->
                            <template
                                v-if="$page.props.jetstream.hasTeamFeatures"
                            >
                                <div class="border-t border-gray-200" />

                                <div
                                    class="block px-4 py-2 text-xs text-gray-400"
                                >
                                    Manage Team
                                </div>

                                <!-- Team Settings -->
                                <JetResponsiveNavLink
                                    :href="
                                        route(
                                            'teams.show',
                                            $page.props.user.current_team
                                        )
                                    "
                                    :active="route().current('teams.show')"
                                >
                                    Team Settings
                                </JetResponsiveNavLink>

                                <JetResponsiveNavLink
                                    v-if="$page.props.jetstream.canCreateTeams"
                                    :href="route('teams.create')"
                                    :active="route().current('teams.create')"
                                >
                                    Create New Team
                                </JetResponsiveNavLink>

                                <div class="border-t border-gray-200" />

                                <!-- Team Switcher -->
                                <div
                                    class="block px-4 py-2 text-xs text-gray-400"
                                >
                                    Switch Teams
                                </div>

                                <template
                                    v-for="team in $page.props.user.all_teams"
                                    :key="team.id"
                                >
                                    <form @submit.prevent="switchToTeam(team)">
                                        <JetResponsiveNavLink as="button">
                                            <div class="flex items-center">
                                                <svg
                                                    v-if="
                                                        team.id ==
                                                        $page.props.user
                                                            .current_team_id
                                                    "
                                                    class="mr-2 h-5 w-5 text-green-400"
                                                    fill="none"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                                    />
                                                </svg>
                                                <div>{{ team.name }}</div>
                                            </div>
                                        </JetResponsiveNavLink>
                                    </form>
                                </template>
                            </template>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
