<script setup>
import { onMounted, ref } from 'vue';

const props = defineProps({
    disabled: {
        type: Boolean
    },
});

const model = defineModel({
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        :class="`rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 ${props.disabled ? 'bg-gray-200' : ''}`"
        v-model="model"
        ref="input"
        :disabled="disabled"
    />
</template>
