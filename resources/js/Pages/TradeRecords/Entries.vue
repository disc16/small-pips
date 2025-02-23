<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TradeRecordsHeader from './TradeRecordsHeader.vue';
import NavLink from '@/Components/atom/NavLink.vue';
import { Head, useForm } from '@inertiajs/vue3';
import Modal from '@/Components/molecule/Modal.vue';
import AddEntry from './AddEntry.vue';
import { onMounted, ref } from 'vue';

import { DataTable } from 'simple-datatables';
import 'simple-datatables/dist/style.css';

const props = defineProps({
    user: {
        type: Object
    },
    entries: {
        type: Array,
    },
    tickers: {
        type: Array,
    },
    capital: {
        type: Object
    },
    strategies: {
        type: Array
    }
});

const activeItem = ref(null);

const editItem = (data) => {
    console.log('edit item', data);
    activeItem.value = data;

    console.log('woo', activeItem.value);
}

const clearActiveItem = () => {
    activeItem.value = null;
}

onMounted(() => {
    console.log('Entries Mounted', props);

    // if (document.getElementById("default-table") && typeof simpleDatatables.DataTable !== 'undefined') {
        const dataTable = new DataTable("#default-table", {
            searchable: false,
            searchQuerySeparator: " ",
            perPageSelect: false
            // perPageSelect: [5, 10, 20, 50]
        });
    // }

})

</script>

<template>
    <Head title="Entries" />

    <AuthenticatedLayout>
        <!-- <TradeRecordsHeader /> -->
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Entries
            </h2>

            
        </template>

        

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <AddEntry 
                            :record="activeItem" 
                            :tickers="tickers" 
                            :capital="capital" 
                            :strategies="strategies" 
                            :user="user" 
                            @clearForm="clearActiveItem"
                        />


                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table id="default-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            <span class="flex items-center">
                                                Entry Date
                                            </span>
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            <span class="flex items-center">
                                                Entry Time
                                            </span>
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            <span class="flex items-center">
                                                Ticker Pair
                                            </span>
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Position
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Stock Sentiment
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Entry Price
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Stop Price
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Actual Exit Price
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Actual Profit/Loss
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            %
                                        </th>
                                        <th data-sortable="false" scope="col" class="px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr 
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                                        v-for="(item, index) in entries"
                                        :key="index"
                                    >
                                        
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ item.entry_date }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ item.entry_time }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ item.ticker_pair.ticker }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ item.position }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ item.stock_sentiment }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ item.entry_price }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ item.stop_price }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ item.actual_exit_price }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ item.actual_profit_loss }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ item.actual_percent_profit_loss }}
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
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
