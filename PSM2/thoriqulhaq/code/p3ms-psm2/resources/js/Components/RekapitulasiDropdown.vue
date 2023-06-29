<template>
    <div class="flex w-full items-center mb-[30px]">
        <p v-show="useLabel" class="text-[#A1A5B6] text-[14px]  tracking-[0.1em] flex-1">{{ value }}</p>
        <Dropdown type="number" class="flex-1 p-inputtext-sm border-[1.5px] border-[#F8F8F9] rounded-[0.5rem] bg-[#F8F8F9]"
            inputClass="p-inputtext-sm"
            panelClass="text-[0.875rem]"
            v-model="model.value" 
            :options="option"
            optionLabel="name"
            @change="updateFormState(model)"
            placeholder="Pilih"
        />
    </div>
</template>

<script>
import InputText from 'primevue/inputtext';
import Dropdown from 'primevue/dropdown';

export default {
    components: {
        InputText,
        Dropdown
    },
    props: {
        value: String,
        model : String,
        option : Object,
        updateFormState : Function,
        unit : String,
        useLabel : {
            type: Boolean,
            default: true
        }
    },
}
</script>