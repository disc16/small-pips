<script setup>
import { ref, onMounted } from 'vue';
import ApplicationLogo from '@/Components/atom/ApplicationLogo.vue';
import Dropdown from '@/Components/atom/Dropdown.vue';
import DropdownLink from '@/Components/atom/DropdownLink.vue';
import NavLink from '@/Components/atom/NavLink.vue';
import { Link } from '@inertiajs/vue3';
import {
  Dialog,
  DialogPanel,
  Disclosure,
  DisclosureButton,
  DisclosurePanel,
  Popover,
  PopoverButton,
  PopoverGroup,
  PopoverPanel,
} from '@headlessui/vue'
import {
  ArrowPathIcon,
  Bars3Icon,
  ChartPieIcon,
  CursorArrowRaysIcon,
  FingerPrintIcon,
  SquaresPlusIcon,
  XMarkIcon,
} from '@heroicons/vue/24/outline'
import { ChevronDownIcon, PhoneIcon, PlayCircleIcon } from '@heroicons/vue/20/solid'

const showingNavigationDropdown = ref(false);

const dashboardMenu = [
    { name: 'Trade Performace', description: '', href: route('trade-performance.show'), icon: ChartPieIcon },
    { name: 'Profit and Loss', description: 'Get a better understanding of your traffic', href: '#', icon: ChartPieIcon }
];

const tradeRecordsMenu = [
    { name: 'Entries', description: '', href: route('trade-records.show'), icon: ChartPieIcon },
];

const analysisMenu = [

];

const userMenu = [
    { name: 'User List', description: '', href: route('users.show'), icon: ChartPieIcon },
];

onMounted(() => {
    // console.log('HEADER', page);
})

</script>

<template>
    <div class="mx-auto max-w-full px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex">
                <!-- Logo -->
                <div class="flex shrink-0 items-center">
                    <Link :href="route('dashboard')">
                        <ApplicationLogo
                            class="block h-9 w-auto fill-current text-gray-800"
                        />
                    </Link>
                </div>

                
            </div>

            <!-- Navigation Links -->
            <div
                class="hidden space-x-4 sm:-my-px sm:ms-10 sm:flex"
            >
                <PopoverGroup class="hidden lg:flex lg:gap-x-8">
                    <Popover class="relative inline-flex items-center">
                        <PopoverButton class="flex items-center gap-x-1 text-sm/6 font-semibold text-gray-900">
                            Dashboard
                            <ChevronDownIcon class="size-5 flex-none text-gray-400" aria-hidden="true" />
                        </PopoverButton>

                        <transition enter-active-class="transition ease-out duration-200" enter-from-class="opacity-0 translate-y-1" enter-to-class="opacity-100 translate-y-0" leave-active-class="transition ease-in duration-150" leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 translate-y-1">
                            <PopoverPanel class="absolute top-full -left-8 z-10 mt-3 w-screen max-w-md overflow-hidden rounded-3xl bg-white ring-1 shadow-lg ring-gray-900/5">
                            <div class="p-4">
                                <div v-for="item in dashboardMenu" :key="item.name" class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                                <div class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                    <component :is="item.icon" class="size-6 text-gray-600 group-hover:text-indigo-600" aria-hidden="true" />
                                </div>
                                <div class="flex-auto">
                                    <Link :href="item.href" class="block font-semibold text-gray-900">
                                    {{ item.name }}
                                    <span class="absolute inset-0" />
                                    </Link>
                                    <p class="mt-1 text-gray-600">{{ item.description }}</p>
                                </div>
                                </div>
                            </div>
                            </PopoverPanel>
                        </transition>
                    </Popover>

                    <Popover v-if="$page.props.auth.user.roles.some(e => e.name == 'User')" class="relative inline-flex items-center">
                        <PopoverButton class="flex items-center gap-x-1 text-sm/6 font-semibold text-gray-900">
                            Trade Records
                            <ChevronDownIcon class="size-5 flex-none text-gray-400" aria-hidden="true" />
                        </PopoverButton>

                        <transition enter-active-class="transition ease-out duration-200" enter-from-class="opacity-0 translate-y-1" enter-to-class="opacity-100 translate-y-0" leave-active-class="transition ease-in duration-150" leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 translate-y-1">
                            <PopoverPanel class="absolute top-full -left-8 z-10 mt-3 w-screen max-w-md overflow-hidden rounded-3xl bg-white ring-1 shadow-lg ring-gray-900/5">
                            <div class="p-4">
                                <div v-for="item in tradeRecordsMenu" :key="item.name" class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                                <div class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                    <component :is="item.icon" class="size-6 text-gray-600 group-hover:text-indigo-600" aria-hidden="true" />
                                </div>
                                <div class="flex-auto">
                                    <Link :href="item.href" class="block font-semibold text-gray-900">
                                    {{ item.name }}
                                    <span class="absolute inset-0" />
                                    </Link>
                                    <p class="mt-1 text-gray-600">{{ item.description }}</p>
                                </div>
                                </div>
                            </div>
                            </PopoverPanel>
                        </transition>
                    </Popover>
                    <Popover v-if="$page.props.auth.user.roles.some(e => e.name == 'User')" class="relative inline-flex items-center">
                        <PopoverButton class="flex items-center gap-x-1 text-sm/6 font-semibold text-gray-900">
                            Analysis
                            <ChevronDownIcon class="size-5 flex-none text-gray-400" aria-hidden="true" />
                        </PopoverButton>

                        <transition enter-active-class="transition ease-out duration-200" enter-from-class="opacity-0 translate-y-1" enter-to-class="opacity-100 translate-y-0" leave-active-class="transition ease-in duration-150" leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 translate-y-1">
                            <PopoverPanel class="absolute top-full -left-8 z-10 mt-3 w-screen max-w-md overflow-hidden rounded-3xl bg-white ring-1 shadow-lg ring-gray-900/5">
                            <div class="p-4">
                                <div v-for="item in analysisMenu" :key="item.name" class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                                <div class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                    <component :is="item.icon" class="size-6 text-gray-600 group-hover:text-indigo-600" aria-hidden="true" />
                                </div>
                                <div class="flex-auto">
                                    <Link :href="item.href" class="block font-semibold text-gray-900">
                                    {{ item.name }}
                                    <span class="absolute inset-0" />
                                    </Link>
                                    <p class="mt-1 text-gray-600">{{ item.description }}</p>
                                </div>
                                </div>
                            </div>
                            </PopoverPanel>
                        </transition>
                    </Popover>
                    <Popover v-if="$page.props.auth.user.roles.some(e => e.name == 'Admin')" class="relative inline-flex items-center">
                        <PopoverButton class="flex items-center gap-x-1 text-sm/6 font-semibold text-gray-900">
                            Users
                            <ChevronDownIcon class="size-5 flex-none text-gray-400" aria-hidden="true" />
                        </PopoverButton>

                        <transition enter-active-class="transition ease-out duration-200" enter-from-class="opacity-0 translate-y-1" enter-to-class="opacity-100 translate-y-0" leave-active-class="transition ease-in duration-150" leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 translate-y-1">
                            <PopoverPanel class="absolute top-full -left-8 z-10 mt-3 w-screen max-w-md overflow-hidden rounded-3xl bg-white ring-1 shadow-lg ring-gray-900/5">
                            <div class="p-4">
                                <div v-for="item in userMenu" :key="item.name" class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                                <div class="flex size-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                    <component :is="item.icon" class="size-6 text-gray-600 group-hover:text-indigo-600" aria-hidden="true" />
                                </div>
                                <div class="flex-auto">
                                    <Link :href="item.href" class="block font-semibold text-gray-900">
                                    {{ item.name }}
                                    <span class="absolute inset-0" />
                                    </Link>
                                    <p class="mt-1 text-gray-600">{{ item.description }}</p>
                                </div>
                                </div>
                            </div>
                            </PopoverPanel>
                        </transition>
                    </Popover>

                </PopoverGroup>
                

                <!-- <NavLink
                    :href="route('dashboard')"
                    :active="route().current('dashboard')"
                >
                    Dashboard
                </NavLink>
                
                <NavLink
                    v-if="$page.props.auth.user.roles.some(e => e.name == 'User')"
                    :href="route('trade-records.show')"
                    :active="route().current('trade-records.show')"
                >
                    Trade Records
                </NavLink>

                <NavLink
                    v-if="$page.props.auth.user.roles.some(e => e.name == 'Admin')"
                    :href="route('users.show')"
                    :active="route().current('users.show')"
                >
                    Users
                </NavLink> -->
            </div>

            <div class="hidden sm:ms-6 sm:flex sm:items-center">
                <!-- Settings Dropdown -->
                <div class="relative ms-3">
                    <Dropdown align="right" width="48">
                        <template #trigger>
                            <span class="inline-flex rounded-md">
                                <button
                                    type="button"
                                    class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                                >
                                    {{ $page.props.auth.user.name }}

                                    <svg
                                        class="-me-0.5 ms-2 h-4 w-4"
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
                            <DropdownLink
                                :href="route('profile.edit')"
                            >
                                Profile
                            </DropdownLink>
                            <DropdownLink
                                :href="route('trade-settings.edit')"
                            >
                                Trade Settings
                            </DropdownLink>
                            <DropdownLink
                                :href="route('logout')"
                                method="post"
                                as="button"
                            >
                                Log Out
                            </DropdownLink>
                        </template>
                    </Dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button
                    @click="
                        showingNavigationDropdown =
                            !showingNavigationDropdown
                    "
                    class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none"
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
</template>