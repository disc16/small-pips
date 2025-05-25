<script setup>
import InputError from '@/Components/atom/InputError.vue';
import InputLabel from '@/Components/atom/InputLabel.vue';
import PrimaryButton from '@/Components/atom/PrimaryButton.vue';
import TextInput from '@/Components/atom/TextInput.vue';
import SelectInput from '@/Components/atom/SelectInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    user: {
        type: Object,
    },
    currencies: {
        type: Array,
    },
    accounts: {
        type: Array
    }
});

const user = props.user;
const currencies = props.currencies;
const accounts = props.accounts;

console.log('props', props, usePage().props);

const form = useForm({
    account_type: user.market_information.account_type_id,
    currency: user.market_information.currency_id,
    user_type: usePage().props.auth.roles.filter(e => e != 'User')[0]
});

console.log('form', form);

</script>

<template>
    <section>
        <!-- <header>
            <h2 class="text-lg font-medium text-gray-900">
                Profile Information
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Update your account's profile information and email address.
            </p>
        </header> -->

        <div class="text-2xl text-blue-800 mb-4 text-center">
            Market Information
        </div>

        <form
            @submit.prevent="form.patch(route('market-information.update'))"
            class="mt-6 space-y-6"
        >
        <div>
                <InputLabel for="market-information.account-type" value="Account type" />

                <SelectInput id="market-information.currency" v-model="form.account_type" required  class="" >
                    <option v-for="(type, index) in accounts" :key="index" :value="type.id" >{{ type.name }}</option>
                </SelectInput>

                <InputError class="mt-2" :message="form.errors.currency" />
            </div>

            <div>
                <InputLabel for="market-information.currency" value="Currency" />

                <!-- <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                /> -->
                <SelectInput id="market-information.currency" v-model="form.currency" required  class="" >
                    <option v-for="(currency, index) in currencies" :key="index" :value="currency.id" >{{ currency.currency }}</option>
                </SelectInput>

                <InputError class="mt-2" :message="form.errors.currency" />
            </div>

            <div>
                <InputLabel for="market_information.user_type" value="User Type" />

                <TextInput
                    id="market_information.user_type"
                    class="mt-1 block w-full"
                    v-model="form.user_type"
                    disabled
                />

                <InputError class="mt-2" :message="form.errors.user_type" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton 
                    class="bg-green-800 hover:bg-green-600 w-full justify-center" 
                    :disabled="form.processing">Update
                </PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-gray-600"
                    >
                        Updated.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
