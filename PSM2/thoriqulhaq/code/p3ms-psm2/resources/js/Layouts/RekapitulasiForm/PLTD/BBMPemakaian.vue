<template>
    <div class="flex flex-col w-full h-full ">
        <div class="flex flex-1 gap-[61px]">
            <div class="flex-1">
                <h2 class="mb-[42px] tracking-[0.1em] text-[#A1A5B6] text-[18px] font-semibold">TANGKI HARIAN</h2>
                <template v-for="(engine) in $page.props.user.engine_quantity" :key="engine">
                    <RekapitulasiInput 
                        :value="'Mesin '+engine" 
                        :model="{
                            name: 'engine_'+engine+'_th',
                            value: formState['engine_'+engine+'_th']
                        }"
                        :updateFormState="updateFormState"
                        unit="L"
                    />
                </template>
            </div>
            <div class="flex-1">
                <h2 class="mb-[42px] tracking-[0.1em] text-[#A1A5B6]  text-[18px] font-semibold">MODULE PCC 300</h2>
                <template v-for="(engine) in $page.props.user.engine_quantity" :key="engine">
                    <RekapitulasiInput 
                        :value="'Mesin '+engine" 
                        :model="{
                            name: 'engine_'+engine+'_mp3',
                            value: formState['engine_'+engine+'_mp3']
                        }"
                        :updateFormState="updateFormState"
                        unit="L"
                    />
                </template>
            </div>
        </div>
        <h2 class="mb-[42px] tracking-[0.1em] text-[#A1A5B6] text-[18px] font-semibold">FLOW METER</h2>
        <div class="flex flex-1 gap-[61px]">
            <div class="flex-1">
                <template v-for="(engine) in $page.props.user.engine_quantity" :key="engine">
                    <RekapitulasiInput 
                        :value="'Mesin '+engine" 
                        :model="{
                            name: 'engine_'+engine+'_fm',
                            value: formState['engine_'+engine+'_fm']
                        }"
                        :updateFormState="updateFormState"
                        unit="L"
                    />
                </template>
            </div>
            <div class="flex-1">
                <RekapitulasiInput 
                    :value="'Induk'" 
                    :model="{
                        name: 'master_flow_meter',
                        value: formState['master_flow_meter']
                    }"
                    :updateFormState="updateFormState"
                    unit="L"
                />
            </div>
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
            master_flow_meter : props.data.detail?.master_flow_meter ?? 0,
        }
        
        for (let i = 1; i <= page.props.user.engine_quantity; i++) {
            initialData['engine_'+i+'_th'] = props.data.detail?.['engine_'+i+'_th'] ?? 0;
            initialData['engine_'+i+'_mp3'] = props.data.detail?.['engine_'+i+'_mp3'] ?? 0;
            initialData['engine_'+i+'_fm'] = props.data.detail?.['engine_'+i+'_fm'] ?? 0;
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