<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import UserInformation from './partials/UserInformation.vue';
import UserTypes from './partials/UserTypes.vue';

import { Head } from '@inertiajs/vue3';

defineProps({
    users: {
        type: Array,
    },
    userTypes: {
        type: Array,
    },
    roles: {
        type: Array,
    },
});


</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <!-- <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Trade Settings
            </h2>
        </template> -->

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div class="text-3xl text-blue-800 mb-4 text-center">
                    User Settings
                </div>

                <div
                    class="bg-white p-4 shadow sm:rounded-lg sm:p-8"
                >
                    <UserTypes
                        :userTypes="userTypes"
                        :roles="roles"
                    />
                </div>

                <div
                    class="bg-white p-4 shadow sm:rounded-lg sm:p-8"
                >
                    <UserInformation
                        :users="users"
                    />
                </div>


            </div>
        </div>
    </AuthenticatedLayout>
</template>
