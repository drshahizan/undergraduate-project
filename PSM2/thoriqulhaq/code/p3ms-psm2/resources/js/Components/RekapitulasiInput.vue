<template>
    <div class="flex w-full items-center mb-[30px]">
        <p v-show="useLabel" class="text-[#A1A5B6] text-[14px] tracking-[0.1em] flex-1">{{ value }}</p>
        <div class="flex-1 gap-[6px] flex justify-evenly items-center bg-[#F8F9F8] px-[6px] py-[5px] rounded-[8px]">
            <InputText type="number" class="p-inputtext-sm h-[36px] text-[14px] flex-1 bg-white border-white text-[#6D757D]" 
                v-model="model.value" 
                @input="updateFormState(model, true)"
            />
            <div v-if="unit !== ''" class="flex-1 flex min-w-[49px]">
                <p class="text-[#6D757D] text-[14px] tracking-[0.1em] flex-1 text-center">{{ unit }}</p>
            </div>
        </div>
    </div>
</template>

<script>
import InputText from 'primevue/inputtext';

export default {
    components: {
        InputText
    },
    props: {
        value: String,
        model : String,
        updateFormState : Function,
        unit : {
            type: String,
            default: ''
        },
        useLabel : {
            type: Boolean,
            default: true
        }
    },
}
</script>