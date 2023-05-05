<template>
    <div class="flex w-full h-full px-[34px] py-[40px] gap-[61px]">
        <div class="flex-[4_4_0%]">
            <RekapitulasiInput 
                value="DAYA TERPASANG" 
                :model="{
                    name: 'daya_terpasang',
                    value: formState.daya_terpasang
                }"
                :updateFormState="updateFormState"
                unit="MW"
            />
            <RekapitulasiInput 
                value="DAYA MAMPU" 
                :model="{
                    name: 'daya_mampu',
                    value: formState.daya_mampu
                }"
                :updateFormState="updateFormState"
                unit="MW"
            />
            <RekapitulasiInput 
                value="BEBAN" 
                :model="{
                    name: 'beban',
                    value: formState.beban
                }"
                :updateFormState="updateFormState"
                unit="KW"
            />
            <RekapitulasiInput 
                value="STAND AWAL" 
                :model="
                {
                    name: 'stand_awal',
                    value: formState.stand_awal
                }"
                :updateFormState="updateFormState"
                unit="KW"
            />
            <RekapitulasiInput 
                value="STAND AKHIR" 
                :model="{
                    name: 'stand_akhir',
                    value: formState.stand_akhir
                }"
                :updateFormState="updateFormState"
                unit="KWH"
            />
            <RekapitulasiInput 
                value="KWH PRODUKSI" 
                :model="{
                    name: 'kwh_produksi',
                    value: formState.kwh_produksi
                }"
                :updateFormState="updateFormState"
                unit="KWH"
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
            <RekapitulasiTextArea 
                value="GANGGUAN" 
                :model="{
                    name: 'gangguan',
                    value: formState.gangguan
                }"
                :updateFormState="updateFormState"
            />
        </div>
    </div>
</template>

<script>
import { ref } from "vue";
import RekapitulasiInput from '../../../Components/RekapitulasiInput.vue';
import RekapitulasiTextArea from "../../../Components/RekapitulasiTextArea.vue";

export default {
    components: {
        RekapitulasiInput,
        RekapitulasiTextArea
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
            kegiatan_har : '',
            gangguan : ''
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