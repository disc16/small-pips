<script setup>
import InputError from '@/Components/atom/InputError.vue';
import InputLabel from '@/Components/atom/InputLabel.vue';
import PrimaryButton from '@/Components/atom/PrimaryButton.vue';
import SecondaryButton from '@/Components/atom/SecondaryButton.vue';
import TextInput from '@/Components/atom/TextInput.vue';
import SelectInput from '@/Components/atom/SelectInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import Modal from '@/Components/molecule/Modal.vue';
import { nextTick, ref, onMounted, watch, onUpdated, computed, onBeforeMount } from 'vue';

import { lightFormat, differenceInDays, differenceInHours, differenceInMinutes } from "date-fns";
import { initFlowbite } from 'flowbite'

const emit = defineEmits(['clearForm'])

const props = defineProps({
    user: {
        type: Object
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
    record: {
        type: Object
    },
    action: {
        type: String
    },
    tradingTime: {
        type: Array
    }
});

const showFormModal = ref(false);
const activeTicker = ref(null);
const pipValue = ref(0);
const formAction = ref(props.action)

const formData = {
        id: null,
        user_id: props.user.id,
        processing: false,
        title: 'New Trade',
        entry_date: lightFormat(new Date(), 'yyyy-MM-dd'),
        entry_time: lightFormat(new Date(), 'HH:mm'),
        ticker: null,
        analysis: '2',
        order_type: 'Market',
        economic_indicator_id: '',
        economic_indicator: '',
        ec_result: '',
        stock_sentiment: '', // default ''
        position: 'Long',
        trade_sentiment: '',
        acct_curr_pair_price: '0', // default 0.6198
        entry_price: '0', // default 0.8916
        stop_price: '0', // default 0.8896
        // manual_risk_value: props.capital.risk_amount,
        manual_risk_value: 0, // 9.73
        lots: '',
        risk_value: props.capital.risk_amount,
        risk_pips: 0,
        target_reco: '',
        target_price_1: '',
        target_price_2: '',
        target_price_3: '',
        percent_control: '',
        actual_exit_date: lightFormat(new Date(), 'yyyy-MM-dd'),
        actual_exit_time: lightFormat(new Date(), 'HH:mm'),
        actual_exit_price: 0, //0.8946
        actual_profit_loss: 0,
        actual_actual_profit_loss: 0,
        actual_status: 'OPEN',
        actual_holding_period: 0,
        actual_percent_profit_loss: 0,
        actual_reward_ratio: 0,
        actual_remarks: '',
        system_exit_date: lightFormat(new Date(), 'yyyy-MM-dd'),
        system_exit_time: lightFormat(new Date(), 'HH:mm'),
        system_exit_price: 0,
        system_profit_loss: 0,
        system_actual_profit_loss: 0,
        system_status: 'OPEN',
        system_holding_period: 0,
        system_percent_profit_loss: 0,
        system_reward_ratio: 0,
        system_remarks: '',
        open_chart: '',
        exit_chart: '',
        note: '',
        session: ''
    };

let form = useForm(formData);


const orderTypes = ['Setup', 'Market', 'Impulse'];
const positions = ['Long', 'Short'];
const sentiments = ['Risk On', 'Risk Off', 'Mixed'];
const analysisList = [];

const showField = computed(() => {
    return form.id;
});

const enableField = computed(() => {

    if(formAction.value == 'edit' || formAction.value == 'new')
    {
        return true;   
    }

    return false;
});

const AddEntry = () => {
    openFormModal();

    let newform = useForm(formData);

    Object.assign(form, newform)
    formAction.value = 'new';
}

const editEntry = (value) => {
    let targets = JSON.parse(value.targets);

    let concatEntryDate = `${value.entry_date} ${value.entry_time}`;
    let concatActualExitDate = value.actual_exit_date ? new Date(`${value.actual_exit_date} ${value.entry_time}`) : new Date();
    let concatSystemExitDate = value.system_exit_date ? new Date(`${value.system_exit_date} ${value.entry_time}`) : new Date();

    let newform = useForm({
            ...value,
            ...targets,
            ticker: value.ticker_id,
            analysis: value.trading_strategy_id,
            title: 'Update Trade',
            entry_time: lightFormat(new Date(concatEntryDate), 'HH:mm'),
            actual_exit_time: lightFormat(concatActualExitDate, 'HH:mm'),
            system_exit_time: lightFormat(concatSystemExitDate, 'HH:mm'),
            actual_exit_price: 0.8946
        });
    Object.assign(
        form,
        newform
    )


    openFormModal();
}

const viewEntry = (value) => {
    let targets = JSON.parse(value.targets);

    let concatEntryDate = `${value.entry_date} ${value.entry_time}`;
    let concatActualExitDate = value.actual_exit_date ? new Date(`${value.actual_exit_date} ${value.entry_time}`) : new Date();
    let concatSystemExitDate = value.system_exit_date ? new Date(`${value.system_exit_date} ${value.entry_time}`) : new Date();

    let newform = useForm({
            ...value,
            ...targets,
            ticker: value.ticker_id,
            analysis: value.trading_strategy_id,
            title: 'View Trade',
            entry_time: lightFormat(new Date(concatEntryDate), 'HH:mm'),
            actual_exit_time: lightFormat(concatActualExitDate, 'HH:mm'),
            system_exit_time: lightFormat(concatSystemExitDate, 'HH:mm'),
        });
    Object.assign(
        form,
        newform
    )


    openFormModal();
}

const openFormModal = () => {
    showFormModal.value = true;
}

const closeModal = () => {
    emit('clearForm');
    showFormModal.value = false;
}

const submit = () => {
    console.log('Submitting form ...');

    if(form.id)
    {
        console.log('Update form');
        updateForm();   
    }
    else
    {
        console.log('Save form');
        submitForm();
    }
}

const submitForm = () => {
    
    form.post(route('trade-records.store'), {
        onSuccess: () => {console.log('sucess');closeModal();},
        onError: () => form.ticker.focus(),
        onFinish: () => form.reset(),
    });
}

const updateForm = () => {
    form.patch(route('trade-records.update'), {
        onSuccess: () => closeModal(),
        onError: () => form.ticker.focus(),
        onFinish: () => form.reset(),
    });
}

const computeSentiment = (value) => {
    form.trade_sentiment = value == 'Short' ? activeTicker.value.sentiment_short : activeTicker.value.sentiment_long;
    // form.trade_sentiment = form.stock_sentiment;
}

const getRiskPips = (ticker) => {
    const { pip_multiplier} = ticker;

    let risk_pips = form.position == 'Long' ? (form.entry_price - form.stop_price) / pip_multiplier
        : (form.stop_price - form.entry_price) / pip_multiplier;
    return risk_pips.toFixed(0)
}

const computeShareLots = (ticker) => {
    const { with_account_currency_pair, pip_multiplier, account_base_currency, board_lot } = ticker;
    const { account_type } = props.user.market_information;

    let units = account_type == 'Standard' ? ticker.standard_lot : account_type == 'Mini'
        ? ticker.mini_lot : account_type == 'Micro' ? ticker.micro_lot : 0;

    let pip_value = 0;

    if(account_base_currency.toLowerCase() == 'yes')
    {
        pip_value = ((pip_multiplier * units) / form.entry_price).toFixed(4);   
    }
    else
    {
        // pip_value = (((pip_multiplier * units) / form.entry_price) * form.acct_curr_pair_price).toFixed(4);
        pip_value = (((pip_multiplier * units) / form.entry_price));
        if(with_account_currency_pair.toLowerCase() == 'yes')
        {
            pip_value = (pip_value * form.acct_curr_pair_price).toFixed(4);
        }
        else
        {
            pip_value =  (pip_value * (1/form.acct_curr_pair_price)).toFixed(4);
        }
    }

    let risk_pips = getRiskPips(ticker);

    let volume_lot = form.manual_risk_value / (risk_pips * pip_value);
    volume_lot = ceiling(volume_lot, board_lot);
    volume_lot = volume_lot.toFixed(2)

    // Call to compute Risk Value and Percent Control
    computeRiskValue(risk_pips, volume_lot, pip_value);

    pipValue.value = pip_value;
    form.lots = volume_lot;
    form.risk_pips = risk_pips;
    form.pip_value = pipValue;
}

const ceiling = (number, significance) => {
      return Math.ceil(number / significance) * significance;
    }

const computeRiskValue = (risk_pips, volume_lot, pip_value) => {
    const { capital } = props.user.capital_and_risk_mgmt;

    let risk_value = ((risk_pips * volume_lot) * pip_value).toFixed(2);
    let control = ((parseFloat(risk_value) / parseFloat(capital)) * 100).toFixed(1);

    form.risk_value = risk_value;
    form.percent_control = control;
}

const computeTargets = (ticker) => {
    const { market_type, pip_multiplier } = ticker;

    let risk_pips = getRiskPips(ticker);
    let userTargets = JSON.parse(props.user.capital_and_risk_mgmt.targets);
    let target1 = 0;
    let target2 = 0;
    let target3 = 0;
    let target_reco = 'target1';

    if(form.position == 'Long')
    {
        target1 = ((risk_pips * pip_multiplier) * userTargets.target1.rrr);
        target1 = parseFloat(form.entry_price) + parseFloat(target1);

        target2 = ((risk_pips * pip_multiplier) * userTargets.target2.rrr);
        target2 = parseFloat(form.entry_price) + parseFloat(target2);

        target3 = ((risk_pips * pip_multiplier) * userTargets.target3.rrr);
        target3 = parseFloat(form.entry_price) + parseFloat(target3);
    }
    else
    {
        target1 = ((risk_pips * pip_multiplier) * userTargets.target1.rrr);
        target1 = parseFloat(form.entry_price) - parseFloat(target1);

        target2 = ((risk_pips * pip_multiplier) * userTargets.target2.rrr);
        target2 = parseFloat(form.entry_price) - parseFloat(target2);

        target3 = ((risk_pips * pip_multiplier) * userTargets.target3.rrr);
        target3 = parseFloat(form.entry_price) - parseFloat(target3);
    }

    // let target1 = form.postion == 'Long' ? parseFloat(form.entry_price) + parseFloat(((risk_pips * pip_multiplier) * 1.5))
    //     : parseFloat(form.entry_price) - parseFloat(((risk_pips * pip_multiplier) * 1.5));
    

    // Get Target recomendation
    if(market_type == 'FOREX')
    {
        let keys = Object.keys(userTargets);

        keys.map(e => {
            let condition = userTargets[e];

            if(risk_pips >= condition.min_pips && risk_pips <= condition.pips)
            {
                target_reco = e;
            }
        })
    }

    form.target_price_1 = target1;
    form.target_price_2 = target2;
    form.target_price_3 = target3;
    form.target_reco = target_reco;
    
}

const computeActualProfitOrLoss = (ticker) => {
    const { pip_multiplier} = ticker;
    const { capital } = props.user.capital_and_risk_mgmt;

    let pips = 0;
    let pl = 0;
    let days = 0;
    let percentLoss = 0;
    let rrr = 0;
    let status = 'OPEN';

    if(form.position == 'Long')
    {
          pips = ((form.actual_exit_price - form.entry_price) / pip_multiplier); 
    }
    else
    {
        pips = ((form.entry_price - form.actual_exit_price) / pip_multiplier);
    }

    pl = pips * form.lots * pipValue.value;

    // Get holding period
    if(form.actual_exit_date)
    {
        days = differenceInDays(new Date(form.actual_exit_date), new Date(form.entry_date));
    }

    // Get percent profit loss
    percentLoss = (pl / capital) * 100;

    // Get Risk Reward ratio or RRR
    rrr = pl / form.risk_value;

    // Get status
    if(rrr > -0.5 && rrr < 0.5)
    {
        status = "Invalid";
    }
    else
    {
        if(form.actual_exit_price > 0 && pl > 0)
        {
            status = 'WIN';   
        }
        else
        {
            status = 'LOSE';
        }
    }


    form.actual_profit_loss = pl.toFixed(2);
    form.actual_holding_period = days;
    form.actual_percent_profit_loss = percentLoss.toFixed(2);
    form.actual_reward_ratio = rrr.toFixed(2);

    form.actual_status = status;

}

const computeSystemProfitOrLoss = (ticker) => {
    const { pip_multiplier} = ticker;
    const { capital } = props.user.capital_and_risk_mgmt;

    let pips = 0;
    let pl = 0;
    let days = 0;
    let percentLoss = 0;
    let rrr = 0;
    let status = 'OPEN';

    if(form.position == 'Long')
    {
          pips = ((form.system_exit_price - form.entry_price) / pip_multiplier); 
    }
    else
    {
        pips = ((form.entry_price - form.system_exit_price) / pip_multiplier);
    }

    pl = pips * form.lots * pipValue.value;

    // Get holding period
    if(form.system_exit_date)
    {
        days = differenceInDays(new Date(form.system_exit_date), new Date(form.entry_date));
    }

    // Get percent profit loss
    percentLoss = (pl / capital) * 100;

    // Get Risk Reward ratio or RRR
    rrr = pl / form.risk_value;

    // Get status
    if(rrr > -0.5 && rrr < 0.5)
    {
        status = "Invalid";
    }
    else
    {
        if(form.system_exit_price > 0 && pl > 0)
        {
            status = 'WIN';   
        }
        else
        {
            status = 'LOSE';
        }
    }


    form.system_profit_loss = pl.toFixed(2);
    form.system_holding_period = days;
    form.system_percent_profit_loss = percentLoss.toFixed(2);
    form.system_reward_ratio = rrr.toFixed(2);
    form.system_status = status;

}

const getSession = (value) => {
    let current = new Date(`2000-01-01 ${value}`);

    props.tradingTime.map(e => {
        let time = new Date(`2000-01-01 ${e.ph_time}`);
        let diff = differenceInMinutes(current, time);


        if(diff >= 0 && diff <= 30)
        {
            form.session = e.session
        }
    })

}

// onBeforeMount(() => {
//     console.log('onBeforeMount');
//     if(!props.isNew)
//     {
//         console.log('Updating entry');
//     }
// })

onMounted(() => {
    initFlowbite();
})

onUpdated(() => {
    // console.log('updated', form);
})

watch(
    () => form.position,
    (value) => {

        if(activeTicker)
        {
            computeSentiment(value);
        }
    },
    { deep: true }
)

watch(
    () => form.entry_time,
    (value) => {

        getSession(value);
    },
    { deep: true }
)

watch(
    () => form.ticker,
    (value) => {

        let getTicker = props.tickers.filter(e => e.id == value);
        activeTicker.value = getTicker[0];

               
    },
    { deep: true }
)

watch(
    () => form,
    (value) => {

        if(value.entry_time)
        {
            getSession(value.entry_time);
        }

        if(!value.processing && value.isDirty)
        {
            if(activeTicker.value)
            {
                computeShareLots(activeTicker.value);
                computeTargets(activeTicker.value);

                if(form.position)
                {
                    computeSentiment(form.position)   
                }
                
                if(form.actual_exit_price)
                {
                    computeActualProfitOrLoss(activeTicker.value);
                }

                if(form.system_exit_price)
                {
                    computeSystemProfitOrLoss(activeTicker.value);
                }
            }   

            
        }

        
        
    },
    { deep: true }
)

watch(
    () => props.record,
    (value) => {

        if(value)
        {
            if(props.action == 'edit')
            {
                editEntry(value);   
            }
            else {
                viewEntry(value);
            }
        }
    },
    { deep: true }
)

// watch(
//     () => props.action,
//     (value) => {

//         if(value == 'edit' || value == 'new')
//         {
//             formAction.value =    
//         }
               
//     },
//     { deep: true }
// )

</script>

<template>
    <div class="mb-4 flex justify-end">
        <SecondaryButton
            @click="() => AddEntry()"
        >
            New Trade
        </SecondaryButton>

        <!-- Modal toggle -->
        <Modal :maxWidth="`6xl`" :show="showFormModal" @close="closeModal">
            <div class="relative p-4 w-full max-w-full max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ form.title }}
                        </h3>
                        <button @click="closeModal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->                            
                    <form
                        @submit.prevent="submit"
                        class="mt-6 space-y-6"
                    >
                        <div class="grid gap-4 mb-4 p-4 grid-cols-5">
                            <div class="flex justify-start items-center gap-4 col-span-5 ">
                                <h2><strong>Entry Data + Criteria</strong></h2>
                            </div>

                            <div>
                                <InputLabel for="entry_date" value="Entry Date + Time" />

                                <div class="relative max-w-sm">
                                    <input 
                                        type="date" 
                                        id="entry_date" 
                                        v-model="form.entry_date" 
                                        :class="`rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 mt-1 block w-full mb-2 ${!enableField ? 'bg-gray-200' : ''}`"
                                        :disabled="!enableField" 
                                    />
                                    <input 
                                        type="time" 
                                        id="entry_date" 
                                        v-model="form.entry_time" 
                                        :class="`rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 mt-1 block w-full  ${!enableField ? 'bg-gray-200' : ''}`" 
                                        :disabled="!enableField" 
                                    />
                                </div>

                                <InputError class="mt-2" :message="form.errors.first_name" />
                            </div>

                            <div>
                                <InputLabel for="tickers" value="Ticker/Pair" />

                                <!-- <select v-model="form.ticker" id="tickers" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option v-for="(ticker, index) in tickers" :key="index" :value="ticker.id" >{{ ticker.ticker }}</option>
                                </select> -->

                                <SelectInput id="tickers" v-model="form.ticker" required :disabled="!enableField" :class="` ${!enableField ? 'bg-gray-200' : ''}`" >
                                    <!-- <option disabled value="" selected>Please select Ticker</option> -->
                                    <option v-for="(ticker, index) in tickers" :key="index" :value="ticker.id" >{{ ticker.ticker }}</option>
                                </SelectInput>

                                <InputError class="mt-2" :message="form.errors.ticker" />
                            </div>

                            <div>
                                <InputLabel for="orderType" value="Order Type" />

                                <SelectInput id="orderType" v-model="form.order_type" required :disabled="!enableField" >
                                    <!-- <option disabled value="" selected>Please select Ticker</option> -->
                                    <option v-for="(type, index) in orderTypes" :key="index"  >{{ type }}</option>
                                </SelectInput>

                                <InputError class="mt-2" :message="form.errors.order_type" />
                            </div>

                            <div>
                                <InputLabel for="positon" value="Position" />

                                <SelectInput id="position" v-model="form.position" required :disabled="!enableField" >
                                    <!-- <option disabled value="" selected>Please select Ticker</option> -->
                                    <option v-for="(position, index) in positions" :key="index" >{{ position }}</option>
                                </SelectInput>

                                <InputError class="mt-2" :message="form.errors.position" />
                            </div>

                            <div>
                                <InputLabel for="stockSentiment" value="Stock Market Sentiment" />

                                <SelectInput id="stockSentiment" v-model="form.stock_sentiment" required :disabled="!enableField" >
                                    <!-- <option disabled value="" selected>Please select Ticker</option> -->
                                    <option v-for="(sentiment, index) in sentiments" :key="index"  >{{ sentiment }}</option>
                                </SelectInput>

                                <InputError class="mt-2" :message="form.errors.stock_sentiment" />
                            </div>

                            <div>
                                <InputLabel for="purrchasePrice" value="Account Currency Pair Price" />

                                <TextInput
                                    id="purrchasePrice"
                                    name="purrchasePrice"
                                    type="number"
                                    step="any"
                                    class="mt-1 block w-full"
                                    v-model="form.acct_curr_pair_price"
                                    required
                                    autofocus
                                    autocomplete="purrchasePrice"
                                    :disabled="!enableField" 
                                />

                                <InputError class="mt-2" :message="form.errors.acct_curr_pair_price" />
                            </div>

                            <div>
                                <InputLabel for="analysis" value="Analysis/Setup" />

                                <SelectInput id="analysis" v-model="form.analysis" :disabled="!enableField" >
                                    <!-- <option disabled value="" selected>Please select Ticker</option> -->
                                    <option v-for="(strat, index) in strategies" :key="index" :value="strat.id"  >{{ strat.strategy }}</option>
                                </SelectInput>

                                <InputError class="mt-2" :message="form.errors.analysis" />
                            </div>

                            <div>
                                <InputLabel for="economicIndicator" value="Economic Calendar" />
                                <TextInput
                                    id="economicIndicator"
                                    name="economicIndicator"
                                    type="text"
                                    class="mt-1 block w-full bg-gray-200"
                                    v-model="form.economic_indicator"
                                    disabled
                                />

                                <InputError class="mt-2" :message="form.errors.acct_curr_pair_price" />
                            </div>

                            <div>
                                <InputLabel for="ecResult" value="EC Result" />

                                <TextInput
                                    id="ecResult"
                                    name="ecResult"
                                    type="text"
                                    class="mt-1 block w-full bg-gray-200"
                                    v-model="form.ec_result"
                                    disabled
                                />

                                <InputError class="mt-2" :message="form.errors.ec_result" />
                            </div>

                            <div>
                                <InputLabel for="tradeSentiment" value="Trade Sentiment" />

                                <TextInput
                                    id="tradeSentiment"
                                    name="tradeSentiment"
                                    type="text"
                                    class="mt-1 block w-full bg-gray-200"
                                    v-model="form.trade_sentiment"
                                    disabled
                                />

                                <InputError class="mt-2" :message="form.errors.trade_sentiment" />
                            </div>


        <!-- *************** -->
        <!-- Risk Management -->
        <!-- *************** -->


                            <div class="flex my-4 justify-start items-center gap-4 col-span-5 ">
                                <h2><strong>Risk Management</strong></h2>
                            </div>

                            <div>
                                <InputLabel for="entryPrice" value="Entry Price" />

                                <TextInput
                                    id="entryPrice"
                                    name="entryPrice"
                                    type="number"
                                    step="any"
                                    class="mt-1 block w-full"
                                    v-model="form.entry_price"
                                    required
                                    autofocus
                                    autocomplete="purrchasePrice"
                                    :disabled="!enableField" 
                                />

                                <InputError class="mt-2" :message="form.errors.entry_price" />
                            </div>

                            <div>
                                <InputLabel for="stopPrice" value="Stop Price" />

                                <TextInput
                                    id="stopPrice"
                                    name="stopPrice"
                                    type="number"
                                    step="any"
                                    class="mt-1 block w-full"
                                    v-model="form.stop_price"
                                    required
                                    autofocus
                                    autocomplete="purrchasePrice"
                                    :disabled="!enableField" 
                                />

                                <InputError class="mt-2" :message="form.errors.stop_price" />
                            </div>

                            <div>
                                <InputLabel for="manualRiskValue" value="Manual Risk Value" />

                                <TextInput
                                    id="manualRiskValue"
                                    name="manualRiskValue"
                                    type="number"
                                    :max="props.capital.risk_amount"
                                    step="any"
                                    class="mt-1 block w-full"
                                    v-model="form.manual_risk_value"
                                    required
                                    autofocus
                                    autocomplete="purrchasePrice"
                                    :disabled="!enableField" 
                                />

                                <InputError class="mt-2" :message="form.errors.manual_risk_value" />
                            </div>

                            <div>
                                <InputLabel for="lots" value="Shares/Lots" />

                                <TextInput
                                    id="lots"
                                    name="lots"
                                    type="text"
                                    class="mt-1 block w-full bg-gray-200"
                                    v-model="form.lots"
                                    disabled
                                />

                                <InputError class="mt-2" :message="form.errors.lots" />
                            </div>

                            <div>
                                <InputLabel for="riskValue" value="Risk Value" />

                                <TextInput
                                    id="riskValue"
                                    name="riskValue"
                                    type="number"
                                    step="any"
                                    class="mt-1 block w-full bg-gray-200"
                                    v-model="form.risk_value"
                                    disabled
                                />

                                <InputError class="mt-2" :message="form.errors.risk_value" />
                            </div>

                            <div>
                                <InputLabel for="targetRecommend" value="Target Recommendation" />

                                <TextInput
                                    id="targetRecommend"
                                    name="targetRecommend"
                                    type="text"
                                    class="mt-1 block w-full bg-gray-200"
                                    v-model="form.target_reco"
                                    disabled
                                />

                                <InputError class="mt-2" :message="form.errors.target_reco" />
                            </div>

                            <div>
                                <InputLabel for="targetPrice1" value="Target Price 1" />

                                <TextInput
                                    id="targetPrice1"
                                    name="targetPrice1"
                                    type="text"
                                    class="mt-1 block w-full bg-gray-200"
                                    v-model="form.target_price_1"
                                    disabled
                                />

                                <InputError class="mt-2" :message="form.errors.target_price_1" />
                            </div>

                            <div>
                                <InputLabel for="targetPrice1" value="Target Price 2" />

                                <TextInput
                                    id="targetPrice2"
                                    name="targetPrice2"
                                    type="text"
                                    class="mt-1 block w-full bg-gray-200"
                                    v-model="form.target_price_2"
                                    disabled
                                />

                                <InputError class="mt-2" :message="form.errors.target_price_2" />
                            </div>

                            <div>
                                <InputLabel for="targetPrice3" value="Target Price 3" />

                                <TextInput
                                    id="targetPrice3"
                                    name="targetPrice3"
                                    type="text"
                                    class="mt-1 block w-full bg-gray-200"
                                    v-model="form.target_price_3"
                                    disabled
                                />

                                <InputError class="mt-2" :message="form.errors.target_price_3" />
                            </div>

                            <div>
                                <InputLabel for="percentControl" value="% Control" />

                                <TextInput
                                    id="percentControl"
                                    name="percentControl"
                                    type="text"
                                    class="mt-1 block w-full bg-gray-200"
                                    v-model="form.percent_control"
                                    disabled
                                />

                                <InputError class="mt-2" :message="form.errors.percent_control" />
                            </div>


        <!-- *************** -->
        <!-- Exit Data (Actual) -->
        <!-- *************** -->

        
                            <div v-show="showField" class="flex my-4 justify-start items-center gap-4 col-span-5 ">
                                <h2><strong>Exit Data (Actual)</strong></h2>
                            </div>

                            <div v-show="showField" >
                                <InputLabel for="acutal_exit_date" value="Exit Date" />

                                <div class="relative max-w-sm">
                                    <input type="date" id="entry_date" v-model="form.actual_exit_date" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 mt-1 block w-full mb-2" />
                                </div>

                                <InputError class="mt-2" :message="form.errors.acutla_exit_date" />
                            </div>

                            <div v-show="showField" >
                                <InputLabel for="actualExitPrice" value="Exit Price" />

                                <TextInput
                                    id="actualExitPrice"
                                    type="number"
                                    step="any"
                                    class="mt-1 block w-full"
                                    v-model="form.actual_exit_price"
                                    required
                                    autofocus
                                    autocomplete="purrchasePrice"
                                    :disabled="!enableField" 
                                />

                                <InputError class="mt-2" :message="form.errors.actual_exit_price" />
                            </div>

                            <div v-show="showField" >
                                <InputLabel for="actualProfitLoss" value="Profit/Loss Amount" />

                                <TextInput
                                    id="actualProfitLoss"
                                    type="number"
                                    step="any"
                                    class="mt-1 block w-full bg-gray-200"
                                    v-model="form.actual_profit_loss"
                                    required
                                    disabled
                                />

                                <InputError class="mt-2" :message="form.errors.actual_profit_loss" />
                            </div v-show="showField" >

                            <div v-show="showField" >
                                <InputLabel for="actualActualProfitLoss" value="Actual Profit/Loss Amount" />

                                <TextInput
                                    id="actualActualProfitLoss"
                                    type="number"
                                    step="any"
                                    class="mt-1 block w-full"
                                    v-model="form.actual_actual_profit_loss"
                                    required
                                    :disabled="!enableField" 
                                />

                                <InputError class="mt-2" :message="form.errors.actual_actual_profit_loss" />
                            </div>

                            <div v-show="showField" >
                                <InputLabel for="actual_status" value="Status" />

                                <TextInput
                                    id="actual_status"
                                    type="text"
                                    class="mt-1 block w-full bg-gray-200"
                                    v-model="form.actual_status"
                                    required
                                    disabled
                                />

                                <InputError class="mt-2" :message="form.errors.actual_status" />
                            </div>

                            <div v-show="showField" >
                                <InputLabel for="acutal_exit_time" value="Exit Time" />

                                <div class="relative max-w-sm">
                                    <input type="time" id="acutal_exit_time" v-model="form.actual_exit_time" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 mt-1 block w-full" />
                                </div>

                                <InputError class="mt-2" :message="form.errors.actual_exit_time" />
                            </div>

                            <div v-show="showField" >
                                <InputLabel for="actual_holding_period" value="Holding Period" />

                                <TextInput
                                    id="actual_holding_period"
                                    type="number"
                                    step="any"
                                    class="mt-1 block w-full bg-gray-200"
                                    v-model="form.actual_holding_period"
                                    required
                                    disabled
                                />

                                <InputError class="mt-2" :message="form.errors.actual_holding_period" />
                            </div>

                            <div v-show="showField" >
                                <InputLabel for="actual_percent_profit_loss" value="% Profit/Loss" />

                                <TextInput
                                    id="actual_percent_profit_loss"
                                    type="number"
                                    step="any"
                                    class="mt-1 block w-full bg-gray-200"
                                    v-model="form.actual_percent_profit_loss"
                                    required
                                    disabled
                                />

                                <InputError class="mt-2" :message="form.errors.actual_percent_profit_loss" />
                            </div>

                            <div v-show="showField" >
                                <InputLabel for="actual_reward_ratio" value="Risk Reward Ratio" />

                                <TextInput
                                    id="actual_reward_ratio"
                                    type="number"
                                    step="any"
                                    class="mt-1 block w-full bg-gray-200"
                                    v-model="form.actual_reward_ratio"
                                    required
                                    disabled
                                />

                                <InputError class="mt-2" :message="form.errors.actual_reward_ratio" />
                            </div>

                            <div v-show="showField" >
                                <InputLabel for="actual_remarks" value="Remarks" />

                                <TextInput
                                    id="actual_remarks"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.actual_remarks"
                                    :disabled="!enableField" 
                                />

                                <InputError class="mt-2" :message="form.errors.actual_remarks" />
                            </div>


        <!-- *************** -->
        <!-- Exit Data (System) -->
        <!-- *************** -->

        
                            <div v-show="showField"  class="flex my-4 justify-start items-center gap-4 col-span-5 ">
                                <h2><strong>Exit Data (System)</strong></h2>
                            </div>

                            <div v-show="showField" >
                                <InputLabel for="system_exit_date" value="Exit Date" />

                                <div class="relative max-w-sm">
                                    <input type="date" id="system_exit_date" v-model="form.system_exit_date" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 mt-1 block w-full mb-2" :disabled="!enableField" />
                                </div>

                                <InputError class="mt-2" :message="form.errors.acutla_exit_date" />
                            </div>

                            <div v-show="showField" >
                                <InputLabel for="systemExitPrice" value="Exit Price" />

                                <TextInput
                                    id="systemExitPrice"
                                    type="number"
                                    step="any"
                                    class="mt-1 block w-full"
                                    v-model="form.system_exit_price"
                                    required
                                    autofocus
                                    autocomplete="purrchasePrice"
                                    :disabled="!enableField" 
                                />

                                <InputError class="mt-2" :message="form.errors.system_exit_price" />
                            </div>

                            <div v-show="showField" >
                                <InputLabel for="systemProfitLoss" value="Profit/Loss Amount" />

                                <TextInput
                                    id="systemProfitLoss"
                                    type="number"
                                    step="any"
                                    class="mt-1 block w-full bg-gray-200"
                                    v-model="form.system_profit_loss"
                                    required
                                    disabled
                                />

                                <InputError class="mt-2" :message="form.errors.system_profit_loss" />
                            </div>

                            <!-- <div v-show="showField" >
                                <InputLabel for="systemActualProfitLoss" value="Actual Profit/Loss Amount" />

                                <TextInput
                                    id="systemActualProfitLoss"
                                    type="number"
                                    step="any"
                                    class="mt-1 block w-full"
                                    v-model="form.system_actual_profit_loss"
                                    required
                                />

                                <InputError class="mt-2" :message="form.errors.system_actual_profit_loss" />
                            </div> -->

                            <div v-show="showField" >
                                <InputLabel for="system_status" value="Status" />

                                <TextInput
                                    id="system_status"
                                    type="text"
                                    class="mt-1 block w-full bg-gray-200"
                                    v-model="form.system_status"
                                    required
                                    disabled
                                />

                                <InputError class="mt-2" :message="form.errors.system_status" />
                            </div>

                            <div v-show="showField" >
                                <div>
                                    <!-- Leave empty -->
                                </div>
                            </div>

                            <div v-show="showField" >
                                <InputLabel for="system_exit_time" value="Exit Time" />

                                <div class="relative max-w-sm">
                                    <input type="time" id="system_exit_time" v-model="form.system_exit_time" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 mt-1 block w-full" :disabled="!enableField" />
                                </div>

                                <InputError class="mt-2" :message="form.errors.system_exit_time" />
                            </div>

                            <div v-show="showField" >
                                <InputLabel for="system_holding_period" value="Holding Period" />

                                <TextInput
                                    id="system_holding_period"
                                    type="number"
                                    step="any"
                                    class="mt-1 block w-full bg-gray-200"
                                    v-model="form.system_holding_period"
                                    required
                                    disabled
                                />

                                <InputError class="mt-2" :message="form.errors.system_holding_period" />
                            </div>

                            <div v-show="showField" >
                                <InputLabel for="system_percent_profit_loss" value="% Profit/Loss" />

                                <TextInput
                                    id="system_percent_profit_loss"
                                    type="number"
                                    step="any"
                                    class="mt-1 block w-full bg-gray-200"
                                    v-model="form.system_percent_profit_loss"
                                    required
                                    disabled
                                />

                                <InputError class="mt-2" :message="form.errors.system_percent_profit_loss" />
                            </div>

                            <div v-show="showField" >
                                <InputLabel for="system_reward_ratio" value="Risk Reward Ratio" />

                                <TextInput
                                    id="system_reward_ratio"
                                    type="number"
                                    step="any"
                                    class="mt-1 block w-full bg-gray-200"
                                    v-model="form.system_reward_ratio"
                                    required
                                    disabled
                                />

                                <InputError class="mt-2" :message="form.errors.system_reward_ratio" />
                            </div>

                            <div v-show="showField" >
                                <div>
                                    <!-- Leave empty -->
                                </div>
                            </div>

                            


        <!-- *************** -->
        <!-- Charting and Execution -->
        <!-- *************** -->

        
                            <div class="flex my-2 justify-start items-center gap-4 col-span-5 ">
                                <h2><strong>Charting and Execution</strong></h2>
                            </div>

                            <div>
                                <InputLabel for="openChart" value="Plan/Open Chart Link" />

                                <TextInput
                                    v-if="enableField"
                                    id="openChart"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.open_chart"
                                />
                                <div v-else  class="max-w-full overflow-hidden text-blue-600">
                                    <a :href="form.open_chart" target="_blank">{{ form.open_chart }}</a>
                                </div>

                                <InputError class="mt-2" :message="form.errors.open_chart" />
                            </div>

                            <div>
                                <InputLabel for="exitChart" value="Exit Chart Link" />

                                <TextInput
                                    v-if="enableField"
                                    id="exitChart"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.exit_chart"
                                />
                                <div v-else class="max-w-full overflow-hidden text-blue-600">
                                    <a :href="form.exit_chart" target="_blank" class="break-all">{{ form.exit_chart }}</a>
                                </div>

                                <InputError class="mt-2" :message="form.errors.exit_chart" />
                            </div>

                            <div class="col-span-2">
                                <InputLabel for="note" value="Note" />

                                <TextInput
                                    id="note"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.note"
                                />

                                <InputError class="mt-2" :message="form.errors.note" />
                            </div>

                            <div>
                                <InputLabel for="session" value="Session" />

                                <TextInput
                                    id="session"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.session"
                                />

                                <InputError class="mt-2" :message="form.errors.session" />
                            </div>
                            

                            <!-- <div>
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
                            </div> -->

                            <!-- <div>
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
                            </div> -->

                            <div class="flex justify-end items-center gap-4 col-span-5 ">
                                <PrimaryButton
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Save
                                </PrimaryButton>

                                <!-- <Transition
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
                                </Transition> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </Modal>
    </div>
</template>