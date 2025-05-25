<script setup>
import InputError from '@/Components/atom/InputError.vue';
import InputLabel from '@/Components/atom/InputLabel.vue';
import PrimaryButton from '@/Components/atom/PrimaryButton.vue';
import SecondaryButton from '@/Components/atom/SecondaryButton.vue';
import TextInput from '@/Components/atom/TextInput.vue';
import SelectInput from '@/Components/atom/SelectInput.vue';
import Modal from '@/Components/molecule/Modal.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { ref, reactive, computed, watch } from 'vue'

const props = defineProps({
    user: {
        type: Object
    },
    strategies: {
        type: Array
    }
});

const activeItem = ref(null);
const showModal = ref(false);
const editForm = ref(false);

const form = useForm({
    strategy: '',
    type: '',
});

const editItem = ((data) => {
    // showModal.value = true;
    editForm.value = true;

    let newForm = useForm({
        id: data.id,
        strategy: data.strategy,
        type: data.type,
    });

    Object.assign(form, newForm);
});

const cancelEditing = (() => {
    let resetform = useForm({
        strategy: '',
        type: '',
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
        })).post(route('trading-strategy.store'));
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
        })).patch(route('trading-strategy.update'));

        cancelEditing();
        
    }

    
})

</script>

<template>
    <section>

        <div class="text-2xl text-blue-800 mb-4 text-center">
            Trading Strategy
        </div>

        <form
            @submit.prevent="submitForm(editForm)"
            class="mt-6 space-y-6"
        >
            <div class="grid gap-4 mb-4 p-4 grid-cols-3">
                <div>

                </div>
                <div>
                    <InputLabel for="ts-trading-strategy" value="Strategy" />

                    <TextInput
                        id="ts-trading-strategy"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.strategy"
                        required
                        autofocus
                        autocomplete="strategy"
                    />

                    <InputError class="mt-2" :message="form.errors.strategy" />
                </div>
                <div>

                </div>

                <div></div>
                <div>
                    <InputLabel for="ts-type" value="Type" />

                    <TextInput
                        id="ts-type"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.type"
                        required
                        autofocus
                        autocomplete="type"
                    />

                    <InputError class="mt-2" :message="form.errors.type" />
                </div>
                

            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton 
                    v-if="!editForm"
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
                            Strategy
                        </th>
                        <th scope="col" class="px-3 py-3">
                            Type
                        </th>
                        <th scope="col" class="px-3 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(item, index) in strategies"
                        :class="`bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 `"
                        :key="index"
                    >
                        <th scope="row" class="px-3 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ item.id }}
                        </th>
                        <td class="px-3 py-4">
                            {{ item.strategy }}
                        </td>
                        <td class="px-3 py-4">
                            {{ item.type }}
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

    </section>
</template>
