<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/atom/InputError.vue';
import InputLabel from '@/Components/atom/InputLabel.vue';
import PrimaryButton from '@/Components/atom/PrimaryButton.vue';
import SecondaryButton from '@/Components/atom/SecondaryButton.vue';
import TextInput from '@/Components/atom/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { ref, reactive, computed, watch } from 'vue'

import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    indicators: {
        type: Array,
    },
});

const editForm = ref(false);

const form = useForm({
    name: '',
    group: ''
})

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
        name: data.name,
        group: data.group
    });

    Object.assign(form, newForm);
});

const cancelEditing = (() => {
    let resetform = useForm({
        name: '',
        group: ''
    });

    editForm.value = false;
    form.reset();
    Object.assign(form, resetform)

})

const submitForm = ((isEditing) => {
    if(!isEditing)
    {
        form.transform((data) => ({
            ...data,
        })).post(route('economic-indicators.store'));
    }
    else
    {
        form.transform((data) => ({
            ...data,
        })).patch(route('economic-indicators.update'));

        cancelEditing();
        
    }
})

</script>

<template>
    <Head title="Trading Indicators" />

    <AuthenticatedLayout>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div
                    class="bg-white p-4 shadow sm:rounded-lg sm:p-8"
                >
                    <section>
                        <div class="text-2xl text-blue-800 mb-4 text-center">
                            Trading Indicators
                        </div>
                    

                        <!-- Form -->
                        <form
                            @submit.prevent="submitForm(editForm)"
                            class="mt-6 space-y-6"
                        >
                            <div class="grid gap-4 mb-4 p-4 grid-cols-1 max-w-md m-auto" >
                                <div>
                                    <InputLabel for="ti-econ-ind" value="Econimic Indicator" />

                                    <TextInput
                                        id="ti-econ-ind"
                                        class="mt-1 block w-full"
                                        v-model="form.name"
                                        required
                                        autofocus
                                        autocomplete="name"
                                    />

                                    <InputError class="mt-2" :message="form.errors.name" />
                                </div>

                                <div>
                                    <InputLabel for="ti-ind-group" value="Indicator Group" />

                                    <TextInput
                                        id="ti-ind-group"
                                        class="mt-1 block w-full"
                                        v-model="form.group"
                                        required
                                        autofocus
                                        autocomplete="group"
                                    />

                                    <InputError class="mt-2" :message="form.errors.group" />
                                </div>
                            </div>

                            <div class="flex items-center gap-4  max-w-md m-auto">
                                <PrimaryButton 
                                    v-if="!editForm"
                                    class="bg-blue-800 hover:bg-blue-600 w-full justify-center" 
                                    :disabled="form.processing"
                                >
                                    Add
                                </PrimaryButton>
                                

                                <PrimaryButton 
                                    v-else-if="editForm"
                                    class="bg-orange-800 hover:bg-orange-600 w-full justify-center" 
                                    :disabled="form.processing"
                                >
                                    Save
                                </PrimaryButton>

                                <SecondaryButton 
                                    v-if="editForm"
                                    class="outline-2 outline-offset-2 outline-solid outline-orange-800 hover:bg-blue-600 w-full justify-center" 
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
                                            Economic Indicator
                                        </th>
                                        <th scope="col" class="px-3 py-3">
                                            Indicator Group
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(item, index) in indicators"
                                        :class="`bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 `"
                                        :key="index"
                                    >
                                        <th scope="row" class="px-3 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ item.id }}
                                        </th>
                                        <td class="px-3 py-4">
                                            {{ item.name }}
                                        </td>
                                        <td class="px-3 py-4">
                                            {{ item.group }}
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
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
