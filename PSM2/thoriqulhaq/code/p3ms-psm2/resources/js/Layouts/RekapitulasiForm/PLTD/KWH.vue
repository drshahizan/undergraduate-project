<template>
    <div class="flex w-full h-full gap-[61px]">
        <div class="flex-1">
            <h2 class="mb-[42px] tracking-[0.1em] text-[#A1A5B6] text-[18px] font-semibold">ENGINE MODULE</h2>
            <template v-for="(engine) in $page.props.user.engine_quantity" :key="engine">
                <RekapitulasiInput 
                    :value="'Mesin '+engine" 
                    :model="{
                        name: 'engine_'+engine+'_em',
                        value: formState['engine_'+engine+'_em']
                    }"
                    :updateFormState="updateFormState"
                    unit="KWH"
                />
            </template>
        </div>
        <div class="flex-1">
            <h2 class="mb-[42px] tracking-[0.1em] text-[#A1A5B6] text-[18px] font-semibold">KWH METER PEMBANDING</h2>
            <template v-for="(engine) in $page.props.user.engine_quantity" :key="engine">
                <RekapitulasiInput 
                    :value="'Mesin '+engine" 
                    :model="{
                        name: 'engine_'+engine+'_kmp',
                        value: formState['engine_'+engine+'_kmp']
                    }"
                    :updateFormState="updateFormState"
                    unit="KWH"
                />
            </template>
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
        
        const initialData = {}
        
        for (let i = 1; i <= page.props.user.engine_quantity; i++) {
            initialData['engine_'+i+'_em'] = props.data.detail?.['engine_'+i+'_em'] ?? 0
        }
        
        for (let i = 1; i <= page.props.user.engine_quantity; i++) {
            initialData['engine_'+i+'_kmp'] = props.data.detail?.['engine_'+i+'_kmp'] ?? 0
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