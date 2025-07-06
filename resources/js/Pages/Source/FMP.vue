<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    all: {
        type: Number
    },
    today: {
        type: Number
    },
    todayData: {
        type: Array
    },
    allData: {
        type: Array
    }
});

console.log('datas', props.todayData, props.allData);
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <!-- <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard

            </h2>
        </template> -->

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        FMP source updated:
                        <div>
                            Currency price today: {{ props.today }}
                        </div>
                        <div>
                            Currency price all: {{ props.all }}
                        </div>

                    </div>
                </div>

                <!-- Today Prices table -->
                 <div class="mt-8 p-4">
                    Currency Price Today
                 </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    <span class="flex items-center">
                                        Base Currency
                                    </span>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Qoute Currency
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Ticker Pair
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Right Pair
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Orig Pair
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    JPY Pair
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Close Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Prev Close
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Pcnt Chg
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Prev Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Open Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    High Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Low Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Close Price 2
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr 
                                v-for="(item, index) in todayData"
                                :class="`bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 `"
                                :key="index"
                            >
                                
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ item.base_currency }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ item.qoute_currency }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ item.ticker_pai }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ item.right_pair }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ item.orig_pair }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ item.jpy_pair }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ item.close_price }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ item.prev_close }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ item.percent_change }} %
                                </td>
                                <td class="px-6 py-4">
                                    {{ item.prev_date }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ item.open_price }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ item.high_price }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ item.low_price }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ item.close_price_2 }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- <div class="relative h-16">
                        <nav 
                            class="fixed flex items-center flex-column flex-wrap md:flex-row justify-between p-4"
                            style="width: calc(100% - 112px)"
                            aria-label="Table navigation"
                        >
                            <span class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">Showing <span class="font-semibold text-gray-900 dark:text-white">{{entries.from}}-{{entries.to}}</span> of <span class="font-semibold text-gray-900 dark:text-white">{{entries.total}}</span></span>
                            <ul v-if="computePages" class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                                <li>
                                    <Link 
                                        class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                        :href="`/trade-records/entries?page=${previousButtonPageNumber}`" 
                                        method="get" 
                                    >
                                        Previous
                                    </Link>
                                </li>
                                <li v-for="key in computePages">
                                    <p
                                        class="cursor-pointer flex items-center justify-center px-3 h-8 leading-tight dark:hover:bg-gray-700 dark:hover:text-white"
                                        :class="{'text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700': key == entries.current_page, 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700': key != entries.current_page}"
                                    >
                                        <Link :href="`/trade-records/entries?page=${key}`" method="get" >{{ key }}</Link>
                                    </p>
                                </li>

                                <li>
                                    <Link 
                                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                        :href="`/trade-records/entries?page=${nextButtonPageNumber}`" 
                                        method="get" 
                                    >
                                        Next
                                    </Link>
                                </li>
                            </ul>
                        </nav>
                    </div> -->
                    
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
