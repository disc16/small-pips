<script setup>
import InputError from '@/Components/atom/InputError.vue';
import InputLabel from '@/Components/atom/InputLabel.vue';
import PrimaryButton from '@/Components/atom/PrimaryButton.vue';
import SecondaryButton from '@/Components/atom/SecondaryButton.vue';
import TextInput from '@/Components/atom/TextInput.vue';
import SelectInput from '@/Components/atom/SelectInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const props = defineProps({
    userTypes: {
        type: Array,
    },
    roles: {
        type: Array,
    },
});

console.log('user types', props.userTypes);
console.log('roles', props.roles);

const showProfileFormModal = ref(false);
const editForm = ref(false);

const form = useForm({
    user_type: '',
    journalMultipleAccounts: 0,
    accessMarketData: 0,
    pricing: '0',
});

const editItem = ((data) => {
    // showModal.value = true;
    editForm.value = true;

    console.log('editItem', data);

    let newForm = useForm({
        id: data.id,
        user_type: data.user_type,
        journalMultipleAccounts: hasPermission(data.roles[0].id, 'journal-multiple-accounts'),
        accessMarketData: hasPermission(data.roles[0].id, 'access-market-data'),
        pricing: data.pricing,
    });

    Object.assign(form, newForm);
});

const cancelEditing = (() => {
    let resetform = useForm({
        user_type: '',
        journalMultipleAccounts: 0,
        accessMarketData: 0,
        pricing: '0',
    });

    editForm.value = false;
    form.reset();
    Object.assign(form, resetform)

})

// const editUser = (data) => {
//     form = useForm({
//         id: data.id,
//         name: data.name,
//         email: data.email,
//         first_name: data.user_person.first_name,
//         last_name: data.user_person.last_name
//     });
// }

const openProfileModal = () => {
    showProfileFormModal.value = true;
}

const submitForm = (isEdit) => {

    if(isEdit)
    {
        form.patch(route('user-types.update'), {
            onSuccess: () => closeModal(),
            onError: () => form.email.focus(),
            onFinish: () => form.reset(),
        });
    }
    
}

const closeModal = () => {
    showProfileFormModal.value = false;
}

const hasPermission = (id, permission) => {
    let role = props.roles.filter(e => e.id == id)[0];

    if(role.permissions.some(e => e.name == permission))
    {
        return true;   
    }

    return false;
}

</script>

<template>
    <section>

        <div class="text-2xl text-blue-800 mb-4 text-center">
            User Types
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
            <div class="grid gap-4 mb-4 p-4 max-w-md m-auto">
                <div>
                    <InputLabel for="userType" value="User Type" />

                    <TextInput
                        id="userType"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.user_type"
                        required
                        autofocus
                        autocomplete="userType"
                    />

                    <InputError class="mt-2" :message="form.errors.user_type" />
                </div>

                <div>
                    <InputLabel for="journal" value="Journal Multiple Accounts" />

                    <SelectInput id="journal" v-model="form.journalMultipleAccounts" required  class="mt-1 block w-full" >
                        <option :value="true" >Yes</option>
                        <option :value="false" >No</option>
                    </SelectInput>

                    <InputError class="mt-2" :message="form.errors.journalMultipleAccounts" />
                </div>

                <div>
                    <InputLabel for="market" value="Access Market Data" />

                    <SelectInput id="market" v-model="form.accessMarketData" required  class="mt-1 block w-full" >
                        <option :value="true" >Yes</option>
                        <option :value="false" >No</option>
                    </SelectInput>

                    <InputError class="mt-2" :message="form.errors.user_type" />
                </div>

                <div>
                    <InputLabel for="pricing" value="Pricing" />

                    <TextInput
                        id="pricing"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.pricing"
                        required
                        autofocus
                        autocomplete="pricing"
                    />

                    <InputError class="mt-2" :message="form.errors.pricing" />
                </div>
                

            </div>

            <div class="flex items-center justify-center gap-4">
                <!-- Wont support for now -->
                <!-- <PrimaryButton 
                    v-if="!editForm"
                    class="bg-blue-800 hover:bg-blue-600 w-40 justify-center" 
                    :disabled="form.processing"
                >
                    Add
                </PrimaryButton> -->
                

                <PrimaryButton 
                    v-if="editForm"
                    class="bg-orange-800 hover:bg-orange-600 w-40 justify-center" 
                    :disabled="form.processing"
                >
                    Save
                </PrimaryButton>

                <SecondaryButton 
                    v-if="editForm"
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
                        <th scope="col" class="px-6 py-3">
                            User Type
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Journal Multiple Accounts
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Market Data
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Pricing
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr 
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                        v-for="(item, index) in userTypes"
                        :key="index"
                    >
                        
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ item.user_type }}
                        </th>
                        <td class="px-6 py-4">
                            {{ hasPermission(item.roles[0].id, 'journal-multiple-accounts') ? 'Yes' : 'No' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ hasPermission(item.roles[0].id, 'access-market-data') ? 'Yes' : 'No' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ item?.pricing }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <p
                                @click="() => editItem(item)"
                                href="#" 
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">Edit</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>  

    </section>
</template>
