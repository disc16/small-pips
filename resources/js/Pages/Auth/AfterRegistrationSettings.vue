<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
// import DeleteUserForm from './Partials/DeleteUserForm.vue';
// import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
// import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import MarketInformation from '../TradeSettings/Partials/MarketInformation.vue';
import CapitalAndRiskManagement from '../TradeSettings/Partials/CapitalAndRiskManagement.vue';
import TradingStrategy from '../TradeSettings/Partials/TradingStrategy.vue';
import PrimaryButton from '@/Components/atom/PrimaryButton.vue';

import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue'


const step = ref(1);

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

const nextStep = (() => {
    step.value++;
    console.log('current step', step.value);
});

const done = (() => {
    router.get(route("dashboard"));
})
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
                    v-if="step == 1"
                    class="bg-white p-4 shadow sm:rounded-lg sm:p-8"
                >
                    <MarketInformation
                        :user="user"
                        :currencies="currencies"
                        :accounts="accounts"
                    />

                    <div class="mt-4">
                        <PrimaryButton 
                            class="bg-blue-800 hover:bg-blue-600 w-full justify-center"
                            @click="nextStep"
                        >
                            Next
                        </PrimaryButton>
                    </div>
                </div>

                <div
                    v-if="step == 2"
                    class="bg-white p-4 shadow sm:rounded-lg sm:p-8"
                >
                    <CapitalAndRiskManagement
                        :capitals="capitals"
                    />

                    <div class="mt-8">
                        <PrimaryButton 
                            class="bg-blue-800 hover:bg-blue-600 w-full justify-center" 
                            @click="nextStep"
                        >
                            Next
                        </PrimaryButton>
                    </div>
                </div>

                <div
                    v-if="step == 3"
                    class="bg-white p-4 shadow sm:rounded-lg sm:p-8"
                >
                    <TradingStrategy
                        :user="user"
                        :strategies="strategies"
                    />

                    <div class="mt-8">
                        <PrimaryButton 
                            class="bg-blue-800 hover:bg-blue-600 w-full justify-center" 
                            @click="done"
                        >
                            Done
                        </PrimaryButton>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
