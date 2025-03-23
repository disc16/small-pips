<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    required: true,
});

const props = defineProps({
    options: {
        type: Array,
    },
    disabled: {
        type: Boolean
    }
});

const input = ref(null);

onMounted(() => {

});

</script>

<template>
    <select 
        v-model="model" 
        :class="`mt-1 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 ${props.disabled ? 'bg-gray-200' : 'bg-gray-50 '}`"
        :disabled="disabled"    
    >
        <slot />
    </select>
</template>
