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
    users: {
        type: Array,
    },
});


const showProfileFormModal = ref(false);
const editForm = ref(false);

const form = useForm({
    name: '',
    email: '',
    first_name: '',
    last_name: '',
    user_type: 'Basic'
});

const editUser = ((data) => {
    // showModal.value = true;
    editForm.value = true;

    console.log('edit user', data);

    let newForm = useForm({
        id: data.id,
        // name: data.name,
        email: data.email,
        first_name: data.user_person.first_name,
        last_name: data.user_person.last_name,
        user_type: data.roles[1].name
    });

    Object.assign(form, newForm);
});

const cancelEditing = (() => {
    let resetform = useForm({
        name: '',
        email: '',
        first_name: '',
        last_name: '',
        user_type: 'basic'
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

const submitForm = () => {
    form.patch(route('users.update'), {
        onSuccess: () => closeModal(),
        onError: () => form.email.focus(),
        onFinish: () => form.reset(),
    });
}

const closeModal = () => {
    showProfileFormModal.value = false;
}

</script>

<template>
    <section>

        <div class="text-2xl text-blue-800 mb-4 text-center">
            User Information
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
                    <InputLabel for="email" value="Email" />

                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                        autocomplete="username"
                    />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div>
                    <InputLabel for="first_name" value="Firstname" />

                    <TextInput
                        id="first_name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.first_name"
                        required
                        autofocus
                        autocomplete="first_name"
                    />

                    <InputError class="mt-2" :message="form.errors.first_name" />
                </div>

                <div>
                    <InputLabel for="last_name" value="Lastname" />

                    <TextInput
                        id="last_name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.last_name"
                        required
                        autofocus
                        autocomplete="last_name"
                    />

                    <InputError class="mt-2" :message="form.errors.last_name" />
                </div>

                <div>
                    <InputLabel for="user_type" value="User Type" />

                    <SelectInput id="user_type" v-model="form.user_type" required  class="mt-1 block w-full" >
                        <option disabled value="" selected>Please select Role</option>
                        <option value="Basic" >Basic</option>
                        <option value="Standard" >Standard</option>
                        <option value="Premium" >Premium</option>
                    </SelectInput>

                    <InputError class="mt-2" :message="form.errors.user_type" />
                </div>
                

            </div>

            <div class="flex items-center justify-center gap-4">
                <!-- Wont support adding user in admin for now -->
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
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            First name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Last name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            User type
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr 
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                        v-for="(user, index) in users"
                        :key="index"
                    >
                        
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ user.email }}
                        </th>
                        <td class="px-6 py-4">
                            {{ user?.user_person?.first_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ user?.user_person?.last_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ user?.roles[1].name }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <p
                                @click="() => editUser(user)"
                                href="#" 
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">Edit</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>  

    </section>
</template>
