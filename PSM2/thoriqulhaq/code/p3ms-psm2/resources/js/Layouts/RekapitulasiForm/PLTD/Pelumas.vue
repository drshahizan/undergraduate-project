<template>
    <div class="flex w-full h-full gap-[61px]">
        <div class="flex-1">
            <h2 class="mb-[42px] tracking-[0.1em] text-[#A1A5B6] text-[18px] font-semibold">Pemakaian Pelumas</h2>
            <template v-for="(engine) in $page.props.user.engine_quantity" :key="engine">
                <RekapitulasiInput 
                    :value="'Mesin '+engine" 
                    :model="{
                        name: 'engine_'+engine,
                        value: formState['engine_'+engine]
                    }"
                    :updateFormState="updateFormState"
                    unit="L"
                />
            </template>
        </div>
        <div class="flex-1">
            <h2 class="mb-[42px] tracking-[0.1em] text-[#A1A5B6] text-[18px] font-semibold">Stok Pelumas</h2>
            <RekapitulasiInput 
                value="STOK AWAL" 
                :model="{
                    name: 'first_lubricant_stock',
                    value: formState.first_lubricant_stock
                }"
                :updateFormState="updateFormState"
                unit="L"
            />
            <RekapitulasiInput 
                value="STOK PENERIMAAN" 
                :model="{
                    name: 'receipt_lubricant_stock',
                    value: formState.receipt_lubricant_stock
                }"
                :updateFormState="updateFormState"
                unit="L"
            />
        </div>
    </div>
</template>

<script>
import { usePage } from '@inertiajs/vue3';
import RekapitulasiInput from '../../../Components/RekapitulasiInput.vue';

export default {
    components: {
        RekapitulasiInput
    },
    props: {
        formState: {
            type: Object,
            required: true
        },
        data : {
            type: Object,
            default : {}
        }
    },
    setup(props) {
        const page = usePage();
        
        const initialData = {
            first_lubricant_stock : props.data.detail?.first_lubricant_stock ?? 0,
            receipt_lubricant_stock : props.data.detail?.receipt_lubricant_stock ?? 0,
        }
        
        for (let i = 1; i <= page.props.user.engine_quantity; i++) {
            initialData['engine_'+i] = props.data.detail?.['engine_'+i] ?? 0
        }
        
        Object.assign(props.formState, initialData);
        
        const updateFormState = (model, isNumber = false) => {
            if (isNumber) {
                props.formState[model.name] = Number(model.value);
            } else {
                props.formState[model.name] = model.value;
            }
        };
        
        return {
            updateFormState
        }
    }
}
</script>