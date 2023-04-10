<template>
    <div class="flex w-full h-full px-[34px] py-[40px] gap-[61px]">
        <div class="flex-[4_4_0%]">
            <RekapitulasiDropdown 
                value="UNIT" 
                :model="{
                    name: 'unit_mesin',
                    value: formState.unit_mesin
                }"
                :option="list_mesin"
                :updateFormState="updateFormState"
                unit="MW"
            />
        </div>
        <div class="flex-[5_5_0%]">
            <RekapitulasiTextArea 
                value="KEGIATAN HAR" 
                :model="{
                    name: 'kegiatan_har',
                    value: formState.kegiatan_har
                }"
                :updateFormState="updateFormState"
            />
        </div>
    </div>
</template>

<script>
import { ref } from "vue";
import RekapitulasiDropdown from "../../../Components/RekapitulasiDropdown.vue";
import RekapitulasiTextArea from "../../../Components/RekapitulasiTextArea.vue";

export default {
    components: {
        RekapitulasiDropdown,
        RekapitulasiTextArea
    },
    props: {
        
    },
    setup(props) {
        const formState = ref({
            unit_mesin : '',
            kegiatan_har : '',
        })
        
        const list_mesin = ref([
            { name: 'Mesin 1', code: '1' },
            { name: 'Mesin 2', code: '2' },
        ]);
        
        const updateFormState = (model, isNumber = false) => {
            if (isNumber) {
                formState.value[model.name] = Number(model.value);
            } else {
                formState.value[model.name] = model.value;
            }
        };
        
        return {
            formState,
            updateFormState,
            list_mesin
        }
    }
}
</script>