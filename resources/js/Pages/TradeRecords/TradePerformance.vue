<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TradeRecordsHeader from './TradeRecordsHeader.vue';
import NavLink from '@/Components/atom/NavLink.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Trade Performance" />

    <AuthenticatedLayout>
        <!-- <TradeRecordsHeader /> -->

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        Trade Performance
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
