<template>
    <div class="flex w-full h-full gap-[61px]">
        <div class="flex-[4_4_0%]">
            <RekapitulasiDropdown 
                value="UNIT" 
                :model="{
                    name: 'unit',
                    value: formState.unit
                }"
                :option="optionEngine"
                :updateFormState="updateFormState"
                unit="MW"
            />
        </div>
        <div class="flex-[5_5_0%]">
            <RekapitulasiTextArea 
                value="KEGIATAN HAR" 
                :model="{
                    name: 'activity',
                    value: formState.activity
                }"
                :updateFormState="updateFormState"
            />
        </div>
    </div>
</template>

<script>
import { ref } from "vue";
import { usePage } from '@inertiajs/vue3';
import RekapitulasiDropdown from "../../../Components/RekapitulasiDropdown.vue";
import RekapitulasiTextArea from "../../../Components/RekapitulasiTextArea.vue";

export default {
    components: {
        RekapitulasiDropdown,
        RekapitulasiTextArea
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
        
        const getCurrentUnit = () => {
            if(props.data.detail?.unit) {
                return {
                    name: `Mesin ${props.data.detail?.unit}`,
                    code: `${props.data.detail?.unit}`
                }
            } else {
                return ''
            }
        }
        
        const initialData = {
            unit : getCurrentUnit(),
            activity : props.data.detail?.activity ?? '',
        }
        
        const optionEngine = ref([]);

        for (let i = 1; i <= page.props.user.engine_quantity; i++) {
            optionEngine.value.push({
                name: `Mesin ${i}`,
                code: `${i}`
            })
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
            updateFormState,
            optionEngine
        }
    }
}
</script>