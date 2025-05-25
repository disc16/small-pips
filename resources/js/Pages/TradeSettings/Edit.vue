<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
// import DeleteUserForm from './Partials/DeleteUserForm.vue';
// import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
// import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import MarketInformation from './Partials/MarketInformation.vue';
import CapitalAndRiskManagement from './Partials/CapitalAndRiskManagement.vue';
import TradingStrategy from './Partials/TradingStrategy.vue';

import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    currencies: {
        type: Array,
    },
    accounts: {
        type: Array,
    },
    user: {
        type: Object
    },
    capitals: {
        type: Array
    },
    strategies: {
        type: Array
    }
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
                <div
                    class="bg-white p-4 shadow sm:rounded-lg sm:p-8"
                >
                    <!-- <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        :data="data"
                        class="max-w-xl"
                    /> -->
                    <MarketInformation
                        :user="user"
                        :currencies="currencies"
                        :accounts="accounts"
                    />
                </div>

                <div
                    class="bg-white p-4 shadow sm:rounded-lg sm:p-8"
                >
                    <CapitalAndRiskManagement
                        :capitals="capitals"
                    />
                </div>

                <div
                    class="bg-white p-4 shadow sm:rounded-lg sm:p-8"
                >
                    <TradingStrategy
                        :user="user"
                        :strategies="strategies"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
