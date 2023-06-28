<template>
    <div class="flex w-full h-full gap-[61px]">
        <div class="flex-[4_4_0%]">
            <RekapitulasiInput 
                value="Daya Terpasang" 
                :model="{
                    name: 'installed_power',
                    value: formState.installed_power
                }"
                :updateFormState="updateFormState"
                unit="MW"
            />
            <RekapitulasiInput 
                value="Daya Mampu" 
                :model="{
                    name: 'ability',
                    value: formState.ability
                }"
                :updateFormState="updateFormState"
                unit="MW"
            />
            <RekapitulasiInput 
                value="Beban" 
                :model="{
                    name: 'load',
                    value: formState.load
                }"
                :updateFormState="updateFormState"
                unit="KW"
            />
            <RekapitulasiInput 
                value="Stand Awal" 
                :model="
                {
                    name: 'early_stand',
                    value: formState.early_stand
                }"
                :updateFormState="updateFormState"
                unit="KW"
            />
            <RekapitulasiInput 
                value="Stand Akhir" 
                :model="{
                    name: 'final_stand',
                    value: formState.final_stand
                }"
                :updateFormState="updateFormState"
                unit="KWH"
            />
            <RekapitulasiInput 
                value="KHW Produksi" 
                :model="{
                    name: 'kwh_production',
                    value: formState.kwh_production
                }"
                :updateFormState="updateFormState"
                unit="KWH"
            />
        </div>
        <div class="flex-[5_5_0%]">
            <RekapitulasiTextArea 
                value="Kegiatan HAR" 
                :model="{
                    name: 'har_activity',
                    value: formState.har_activity
                }"
                :updateFormState="updateFormState"
            />
            <RekapitulasiTextArea 
                value="Gangguan" 
                :model="{
                    name: 'maintenance',
                    value: formState.maintenance
                }"
                :updateFormState="updateFormState"
            />
        </div>
    </div>
</template>

<script>
import RekapitulasiInput from '../../../Components/RekapitulasiInput.vue';
import RekapitulasiTextArea from "../../../Components/RekapitulasiTextArea.vue";

export default {
    components: {
        RekapitulasiInput,
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
        const initialData = {
            installed_power : props.data.detail?.installed_power ?? 0,
            ability : props.data.detail?.ability ?? 0,
            load : props.data.detail?.load ?? 0,
            early_stand :props.data.detail?.early_stand ??  0,
            final_stand : props.data.detail?.final_stand ?? 0,
            kwh_production : props.data.detail?.kwh_production ?? 0,
            har_activity : props.data.detail?.har_activity ?? '',
            maintenance : props.data.detail?.maintenance ?? ''
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