<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Modal from '@/Components/molecule/Modal.vue'
import NavLink from '@/Components/atom/NavLink.vue';
import InputError from '@/Components/atom/InputError.vue';
import InputLabel from '@/Components/atom/InputLabel.vue';
import PrimaryButton from '@/Components/atom/PrimaryButton.vue';
import TextInput from '@/Components/atom/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

defineProps({
    users: {
        type: Array,
    },
});


const showProfileFormModal = ref(false);

let form = null;

const editUser = (data) => {
    form = useForm({
        id: data.id,
        name: data.name,
        email: data.email,
        first_name: data.user_person.first_name,
        last_name: data.user_person.last_name
    });

    openProfileModal();
}

const openProfileModal = () => {
    showProfileFormModal.value = true;
}

const updateForm = () => {
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
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Users
            </h2>

            <!-- Modal toggle -->
            <Modal :show="showProfileFormModal" @close="closeModal">
                <div class="relative p-4 w-full max-w-full max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Edit User
                            </h3>
                            <button @click="closeModal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->                            
                        <form
                            @submit.prevent="updateForm"
                            class="mt-6 space-y-6"
                        >
                            <div class="grid gap-4 mb-4 p-4">

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

                                <div class="flex justify-end items-center gap-4">
                                    <PrimaryButton
                                        :class="{ 'opacity-25': form.processing }"
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
                                            Saved.
                                        </p>
                                    </Transition>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </Modal>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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
                                            {{ user.user_person.first_name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ user.user_person.last_name }}
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

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
