<script setup>
import { computed, onMounted, onUnmounted, ref, watch } from 'vue';

const props = defineProps({
    
});

const emit = defineEmits(['close']);
const dialog = ref();
const showSlot = ref(props.show);


onUnmounted(() => {
    document.removeEventListener('keydown', closeOnEscape);

    document.body.style.overflow = '';
});

</script>

<template>
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
</template>