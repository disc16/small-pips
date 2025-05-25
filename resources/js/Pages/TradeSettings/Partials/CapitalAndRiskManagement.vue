<script setup>
import InputError from '@/Components/atom/InputError.vue';
import InputLabel from '@/Components/atom/InputLabel.vue';
import PrimaryButton from '@/Components/atom/PrimaryButton.vue';
import SecondaryButton from '@/Components/atom/SecondaryButton.vue';
import TextInput from '@/Components/atom/TextInput.vue';
import SelectInput from '@/Components/atom/SelectInput.vue';
import Modal from '@/Components/molecule/Modal.vue';
// import CapitalAndRiskMgmtForm from './CapitalAndRiskMgmtForm.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { ref, reactive, computed, watch } from 'vue'

const props = defineProps({
    capitals: {
        type: Array
    }
});

const activeItem = ref(null);
const showModal = ref(false);
const editForm = ref(false);

const form = useForm({
    trading_account: '',
    capital: 0,
    risk_percentage: 2.5,
    target1_rrr: 1,
    target1_pips: 40,
    target1_min_pips: 0,
    target2_rrr: 1.5,
    target2_pips: 30,
    target2_min_pips: 0,
    target3_rrr: 2,
    target3_pips: 20,
    target3_min_pips: 0
});

const formatTargets = (data, index, pos) => {
    let parseData = JSON.parse(data);
    let key = `target${index}`;
    // return '';
    return parseData[key][pos];

};

const hasPermission = ((permission) => {
    return usePage().props.auth.rolesPermissions.some(e => {
        return e.permissions.some(p => p.name == permission);
    })
})

const editItem = ((data) => {
    // showModal.value = true;
    editForm.value = true;

    let newForm = useForm({
        id: data.id,
        trading_account: data.trading_account,
        capital: data.capital,
        risk_percentage: data.risk_percentage * 100,
        target1_rrr: formatTargets(data.targets, 1, 'rrr'),
        target1_pips: formatTargets(data.targets, 1, 'pips'),
        target2_rrr: formatTargets(data.targets, 2, 'rrr'),
        target2_pips: formatTargets(data.targets, 2, 'pips'),
        target3_rrr: formatTargets(data.targets, 3, 'rrr'),
        target3_pips: formatTargets(data.targets, 3, 'pips')
    });

    Object.assign(form, newForm);
});

const cancelEditing = (() => {
    let resetform = useForm({
        trading_account: '',
        capital: 0,
        risk_percentage: 2.5,
        target1_rrr: 1,
        target1_pips: 40,
        target1_min_pips: 0,
        target2_rrr: 1.5,
        target2_pips: 30,
        target2_min_pips: 0,
        target3_rrr: 2,
        target3_pips: 20,
        target3_min_pips: 0
    });

    editForm.value = false;
    form.reset();
    Object.assign(form, resetform)

})

const closeModal = (() => {
    showModal.value = false;
})

const submitForm = ((isEditing) => {
    if(!isEditing)
    {
        form.transform((data) => ({
            ...data,
            target1_min_pips: data.target2_pips + 1,
            target2_min_pips: data.target3_pips + 1,
            target3_min_pips: 0,
            risk_percentage: data.risk_percentage / 100,
            risk_amount: data.capital * data.risk_percentage
        })).post(route('capital-and-risk.store'));
    }
    else
    {
        form.transform((data) => ({
            ...data,
            target1_min_pips: data.target2_pips + 1,
            target2_min_pips: data.target3_pips + 1,
            target3_min_pips: 0,
            risk_percentage: data.risk_percentage / 100,
            risk_amount: data.capital * (data.risk_percentage / 100)
        })).patch(route('capital-and-risk.update'));

        cancelEditing();
        
    }

    
})

</script>

<template>
    <section>

        <div class="text-2xl text-blue-800 mb-4 text-center">
            Capital and Risk Management
        </div>

        <!-- <CapitalAndRiskMgmtForm
            :item="form"
            :capitals="capitals"
            action="add"
        /> -->

        <form
            @submit.prevent="submitForm(editForm)"
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
                        required
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
                        step="0.5"
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
                        step="0.5"
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
                        step="0.5"
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
                        step="0.5"
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
                    v-if="!editForm && hasPermission('journal-multiple-accounts')"
                    class="bg-blue-800 hover:bg-blue-600 w-40 justify-center" 
                    :disabled="form.processing"
                >
                    Add
                </PrimaryButton>
                

                <PrimaryButton 
                    v-else-if="editForm && hasPermission('journal-multiple-accounts')"
                    class="bg-orange-800 hover:bg-orange-600 w-40 justify-center" 
                    :disabled="form.processing"
                >
                    Save
                </PrimaryButton>

                <SecondaryButton 
                    v-if="editForm && hasPermission('journal-multiple-accounts')"
                    class="outline-2 outline-offset-2 outline-solid outline-orange-800 hover:bg-blue-600 w-40 justify-center" 
                    :disabled="form.processing"
                    @click="cancelEditing"
                >
                    Cancel
                </SecondaryButton>

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
                        Saved.
                    </p>
                </Transition>
            </div>
        </form>

        <!-- Table -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-12">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-3 py-3">
                            <span class="flex items-center">
                                No
                            </span>
                        </th>
                        <th scope="col" class="px-3 py-3">
                            Trading Account
                        </th>
                        <th scope="col" class="px-3 py-3">
                            Trading Capital
                        </th>
                        <th scope="col" class="px-3 py-3">
                            Risk Percentage
                        </th>
                        <th scope="col" class="px-3 py-3">
                            Risk Amount
                        </th>
                        <th scope="col" class="px-3 py-3">
                            Target 1 - RRR
                        </th>
                        <th scope="col" class="px-3 py-3">
                            Target 2 - RRR
                        </th>
                        <th scope="col" class="px-3 py-3">
                            Target 3 - RRR
                        </th>
                        <th scope="col" class="px-3 py-3">
                            Target 1 - Pips
                        </th>
                        <th scope="col" class="px-3 py-3">
                            Target 2 - Pips
                        </th>
                        <th scope="col" class="px-3 py-3">
                            Target 3 - Pips
                        </th>
                        <th scope="col" class="px-3 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(item, index) in capitals"
                        :class="`bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 `"
                        :key="index"
                    >
                        <th scope="row" class="px-3 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ item.id }}
                        </th>
                        <td class="px-3 py-4">
                            {{ item.trading_account }}
                        </td>
                        <td class="px-3 py-4">
                            {{ item.capital }}
                        </td>
                        <td class="px-3 py-4">
                            {{ item.risk_percentage * 100 }}
                        </td>
                        <td class="px-3 py-4">
                            {{ item.risk_amount }}
                        </td>
                        <td class="px-3 py-4">
                            {{ formatTargets(item.targets, 1, 'rrr') }}
                        </td>
                        <td class="px-3 py-4">
                            {{ formatTargets(item.targets, 2, 'rrr') }}
                        </td>
                        <td class="px-3 py-4">
                            {{ formatTargets(item.targets, 3, 'rrr') }}
                        </td>
                        <td class="px-3 py-4">
                            {{ formatTargets(item.targets, 1, 'pips') }}
                        </td>
                        <td class="px-3 py-4">
                            {{ formatTargets(item.targets, 2, 'pips') }}
                        </td>
                        <td class="px-3 py-4">
                            {{ formatTargets(item.targets, 3, 'pips') }}
                        </td>
                        <td class="px-3 py-4">
                           <div class="flex justify-center gap-2">
                                <div class="text-green-800 cursor-pointer" @click="editItem(item)">
                                    Update
                                </div>

                                <div class="text-red-800 cursor-pointer">
                                    Delete
                                </div>
                           </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>  

        <!-- Modal toggle -->
        <!-- <Modal :show="showModal" @close="closeModal">
            <div class="relative p-4 w-full max-w-full max-h-full">
                <CapitalAndRiskMgmtForm
                    :item="activeItem"
                    :capitals="capitals"
                    action="edit"
                />
            </div>
        </Modal> -->
    </section>
</template>
