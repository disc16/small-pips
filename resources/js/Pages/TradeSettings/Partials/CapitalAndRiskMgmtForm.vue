<script setup>
import InputError from '@/Components/atom/InputError.vue';
import InputLabel from '@/Components/atom/InputLabel.vue';
import PrimaryButton from '@/Components/atom/PrimaryButton.vue';
import SecondaryButton from '@/Components/atom/SecondaryButton.vue';
import TextInput from '@/Components/atom/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { ref, reactive, computed, watch } from 'vue'

const props = defineProps({
    capitals: {
        type: Array
    },
    item: {
        type: Object
    },
    action: {
        type: String
    }
});

console.log('props', props, usePage().props);

const form = useForm(props.item);
// const form = useForm({
//     trading_account: '',
//     capital: 0,
//     risk_percentage: 0.025,
//     target1_rrr: 1,
//     target1_pips: 40,
//     target2_rrr: 1.5,
//     target2_pips: 30,
//     target3_rrr: 2,
//     target3_pips: 20
// });

const hasPermission = ((permission) => {
    return usePage().props.auth.rolesPermissions.some(e => {
        return e.permissions.some(p => p.name == permission);
    })
})

watch(
    () => props.item,
    (value) => {
        console.log('watchhh', JSON.parse(value.targets));
    },
    { deep: true }
)

</script>

<template>
    <section>
        <form
            @submit.prevent="form.post(route('capital-and-risk.store'))"
            class="mt-6 space-y-6"
        >
            <div class="grid gap-4 mb-4 p-4 grid-cols-3">
                <div>
                    <InputLabel for="crm-trading-account" value="Trading Account" />

                    <TextInput
                        id="crm-trading-account"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.trading_account"
                        autofocus
                        autocomplete="name"
                    />

                    <InputError class="mt-2" :message="form.errors.trading_account" />
                </div>

                <div>
                    <InputLabel for="crm-target1-rrr" value="Target 1 - Risk Ratio" />

                    <TextInput
                        id="crm-target1-rrr"
                        type="number"
                        steps="0.5"
                        class="mt-1 block w-full"
                        v-model="form.target1_rrr"
                        required
                        autofocus
                        autocomplete="name"
                    />

                    <InputError class="mt-2" :message="form.errors.target1_rrr" />
                </div>

                <div>
                    <InputLabel for="crm-target1-pips" value="Target Pips 1" />

                    <TextInput
                        id="crm-target1-pips"
                        type="number"
                        class="mt-1 block w-full"
                        v-model="form.target1_pips"
                    />

                    <InputError class="mt-2" :message="form.errors.target1_pips" />
                </div>

                <div>
                    <InputLabel for="crm-capital" value="Trading Capital" />

                    <TextInput
                        id="crm-capital"
                        type="number"
                        class="mt-1 block w-full"
                        v-model="form.capital"
                        required
                        autofocus
                        autocomplete="capital"
                    />

                    <InputError class="mt-2" :message="form.errors.capital" />
                </div>

                <div>
                    <InputLabel for="crm-target2-rrr" value="Target 2 - Risk Ratio" />

                    <TextInput
                        id="crm-target2-rrr"
                        type="number"
                        steps="0.5"
                        class="mt-1 block w-full"
                        v-model="form.target2_rrr"
                        required
                        autofocus
                        autocomplete="name"
                    />

                    <InputError class="mt-2" :message="form.errors.target12_rrr" />
                </div>

                <div>
                    <InputLabel for="crm-target2-pips" value="Target Pips 2" />

                    <TextInput
                        id="crm-target2-pips"
                        type="number"
                        class="mt-1 block w-full"
                        v-model="form.target2_pips"
                    />

                    <InputError class="mt-2" :message="form.errors.target2_pips" />
                </div>

                <div>
                    <InputLabel for="crm-risk-percentage" value="Risk Percentage(%)" />

                    <TextInput
                        id="crm-risk-percentage"
                        type="number"
                        steps="0.5"
                        class="mt-1 block w-full"
                        v-model="form.risk_percentage"
                        required
                        autofocus
                        autocomplete="risk_percentage"
                    />

                    <InputError class="mt-2" :message="form.errors.risk_percentage" />
                </div>

                <div>
                    <InputLabel for="crm-target3-rrr" value="Target 3 - Risk Ratio" />

                    <TextInput
                        id="crm-target3-rrr"
                        type="number"
                        steps="0.5"
                        class="mt-1 block w-full"
                        v-model="form.target3_rrr"
                        required
                        autofocus
                        autocomplete="name"
                    />

                    <InputError class="mt-2" :message="form.errors.target3_rrr" />
                </div>

                <div>
                    <InputLabel for="crm-target3-pips" value="Target Pips 3" />

                    <TextInput
                        id="crm-target3-pips"
                        type="number"
                        class="mt-1 block w-full"
                        v-model="form.target3_pips"
                    />

                    <InputError class="mt-2" :message="form.errors.target3_pips" />
                </div>

                

            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton 
                    v-if="props.actions == 'edit' || hasPermission('journal-multiple-accounts')"
                    class="bg-green-800 hover:bg-green-600 w-40 justify-center" 
                    :disabled="form.processing"
                >
                    Save
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
