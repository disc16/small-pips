<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TradeRecordsHeader from './TradeRecordsHeader.vue';
import NavLink from '@/Components/atom/NavLink.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
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
    },
    tradingTime: {
        type: Array
    }
});

const activeItem = ref(null);
const modalAction = ref(null);

const editViewedForm = (data) => {
    console.log('editViewedForm');
    setTimeout(() => {
        editItem(data);
    }, 500);
}

const editItem = (data) => {
    activeItem.value = data;
    modalAction.value = "edit"
}

const viewItem = (data) => {
    activeItem.value = data;
    modalAction.value = 'view'
}

const onRowClick = () => {
    console.log('aaahhh');
}

const clearActiveItem = () => {
    activeItem.value = null;
}

const getPercentControl = (item) => {
    const targets = JSON.parse(item.targets);

    return targets.percent_control;
}

const getPLPips = (item) => {
    const { entry_price, actual_exit_price, position, ticker_pair: { pip_multiplier } } = item;

    if(actual_exit_price)
    {
        if(position == "Long")
        {
            return ((actual_exit_price - entry_price) / pip_multiplier).toFixed(2);
        }
        else
        {
            return ((entry_price - actual_exit_price) / pip_multiplier).toFixed(2);
        }
    }
    
    return 0;
}

const rowColor = (item) => {
    let color = '';

    switch (item.actual_status) {
        case 'WIN':
            return 'text-green-600'
            
            break;

        case 'LOSE':
            return 'text-red-600'

            break;

        case 'INVALID':
            return 'text-gray-600'
            
            break;
            
        case 'OPEN':
            return 'text-orange-600'
            
            break;
    
        default:
            return 'text-orange-600'
            break;
    }

}

const gotoPage = (key) => {
    console.log('go to page', key);
    this.$inertia.post(`/trade-records/entries?page=${key}`);
}

onMounted(() => {
    console.log('Entries Mounted', props);

    // if (document.getElementById("default-table") && typeof simpleDatatables.DataTable !== 'undefined') {
        // const dataTable = new DataTable("#default-table", {
        //     searchable: false,
        //     // searchQuerySeparator: " ",
        //     perPageSelect: false,
        //     // perPageSelect: [5, 10, 20, 50],
        // });
    // }

})

</script>

<template>
    <Head title="Entries" />

    <AuthenticatedLayout>
        <!-- <TradeRecordsHeader /> -->
        <!-- <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Entries
            </h2>
        </template> -->
        <div class="py-12">
            <div class="mx-auto max-w-full sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <div>
                            <div>
                                <h2
                                    class="text-xl font-semibold leading-tight text-gray-800"
                                >
                                    Trade Entries
                                </h2>
                            </div>
                            {{ modalAction }}
                            <AddEntry 
                                :record="activeItem" 
                                :tickers="tickers" 
                                :capital="capital" 
                                :strategies="strategies" 
                                :user="user"
                                :action="modalAction"
                                :tradingTime="tradingTime"
                                @clearForm="clearActiveItem"
                                @editViewedForm="editViewedForm"
                            />
                        </div>
                        


                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            <span class="flex items-center">
                                                No
                                            </span>
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Session
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
                                            Entry Price
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Stop Price
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Exit Price
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Vol/Lot
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Risk Value
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            % Control
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Profit(Loss) Pips
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Profit(Loss) Amount
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            % P/L
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Risk Reward Ratio
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Reason
                                        </th>
                                        <th data-sortable="false" scope="col" class="px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr 
                                        v-for="(item, index) in entries.data"
                                        :class="`bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 ${rowColor(item)}`"
                                        :key="index"
                                    >
                                        
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ item.id }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ item.session }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <!-- {{ item.ticker_pair.ticker }} -->
                                            <p
                                                @click="() => viewItem(item)"
                                                href="#" 
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">
                                                {{ item.ticker_pair.ticker }}
                                            </p>
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ item.position }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ item.entry_date }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ item.entry_time }}
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
                                            {{ item.lots }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ item.risk_value }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ getPercentControl(item) }}
                                        </td>
                                        <td class="px-6 py-4">
                                           {{ getPLPips(item) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ item.actual_profit_loss }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ item.actual_percent_profit_loss }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ item.actual_reward_ratio }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ item.actual_status }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ item.reason }}
                                        </td>
                                        <td  class="px-6 py-4 text-right">
                                            <p
                                                @click="() => editItem(item)"
                                                href="#" 
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">
                                                Update
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="relative h-16">
                                <nav 
                                    class="fixed flex items-center flex-column flex-wrap md:flex-row justify-between p-4"
                                    style="width: calc(100% - 112px)"
                                    aria-label="Table navigation"
                                >
                                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">Showing <span class="font-semibold text-gray-900 dark:text-white">{{entries.from}}-{{entries.to}}</span> of <span class="font-semibold text-gray-900 dark:text-white">{{entries.total}}</span></span>
                                    <!-- <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                                        <li>
                                            <a :href="`${entries.prev_page_url}`" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                                        </li>

                                        <li v-for="key in (entries.total / entries.per_page)">
                                            <p
                                                class="cursor-pointer flex items-center justify-center px-3 h-8 leading-tight dark:hover:bg-gray-700 dark:hover:text-white"
                                                :class="{'text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700': key == entries.current_page, 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700': key != entries.current_page}"
                                            >
                                                <Link :href="`/trade-records/entries?page=${key}`" method="post" >{{ key }}</Link>
                                            </p>
                                        </li>

                                        <li>
                                            <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                                        </li>
                                        <li>
                                            <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                                        </li>
                                        <li>
                                            <a href="#" aria-current="page" class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
                                        </li>
                                        <li>
                                            <a :href="`${entries.next_page_url}`" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                                        </li>
                                    </ul> -->
                                </nav>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
