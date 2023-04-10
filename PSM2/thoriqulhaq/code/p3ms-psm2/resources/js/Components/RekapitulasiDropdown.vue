<template>
    <div class="flex w-full items-center mb-[30px]">
        <p v-show="useLabel" class="text-white tracking-[0.1em] flex-1">{{ value }}</p>
        <Dropdown type="number" class="flex-1 p-inputtext-sm border-[#E8E8E8]" 
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