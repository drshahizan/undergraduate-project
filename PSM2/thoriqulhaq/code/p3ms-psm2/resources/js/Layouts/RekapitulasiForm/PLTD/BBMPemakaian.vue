<template>
    <div class="flex w-full h-full px-[34px] py-[40px] gap-[61px]">
        <div class="flex-1">
            <h2 class="mb-[42px] tracking-[0.1em] text-white text-[28px] font-semibold">TANGKI HARIAN</h2>
            <RekapitulasiInput 
                value="MESIN 1" 
                :model="{
                    name: 'mesin_1_th',
                    value: formState.mesin_1_th
                }"
                :updateFormState="updateFormState"
                unit="L"
            />
        </div>
        <div class="flex-1">
            <h2 class="mb-[42px] tracking-[0.1em] text-white text-[28px] font-semibold">MODULE PCC 300</h2>
            <RekapitulasiInput 
                value="MESIN 1" 
                :model="{
                    name: 'mesin_1_mp3',
                    value: formState.mesin_1_mp3
                }"
                :updateFormState="updateFormState"
                unit="L"
            />
        </div>
    </div>
</template>

<script>
import { ref } from "vue";
import RekapitulasiInput from '../../../Components/RekapitulasiInput.vue';
export default {
    components: {
        RekapitulasiInput
    },
    props: {
        
    },
    setup(props) {
        const formState = ref({
            daya_terpasang : 0,
            daya_mampu : 0,
            beban : 0,
            stand_awal : 0,
            stand_akhir : 0,
            kwh_produksi : 0,
        })
        
        const updateFormState = (model, isNumber = false) => {
            if (isNumber) {
                formState.value[model.name] = Number(model.value);
            } else {
                formState.value[model.name] = model.value;
            }
        };
        
        return {
            formState,
            updateFormState
        }
    }
}
</script>