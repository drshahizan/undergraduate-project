<template>
    <div class="flex flex-col w-full mb-[30px]">
        <p class="text-[#A1A5B6] text-[14px] tracking-[0.1em] flex-1 mb-[19px]">{{ value }}</p>
        <div class="flex-1 bg-[#F8F9F8] px-[5px] py-[5px] rounded-[8px]">
            <Textarea class="p-inputtext-sm w-full min-h-[120px] bg-white border-white text-[#6D757D]" 
                v-model="model.value" 
                @input="updateFormState(model)"
                placeholder="Tulis disini . . ."
                maxlength="150"
            />
            <div class="flex justify-end">
                <p class="text-[14px] tracking-[0.1em] text-[#6D757D] ">{{ textCount }} / 150</p>
            </div>
        </div>
    </div>
</template>

<script>
import Textarea from 'primevue/textarea';
import { ref } from "vue";

export default {
    components: {
        Textarea
    },
    props: {
        value: String,
        model : String,
        updateFormState : Function,
    },
    setup(props) {
        const textCount = ref(0)
        
        return {
            textCount
        }
    },
    watch: {
        model: {
            handler: function (val) {
                this.textCount = val.value.length
            },
            deep: true
        }
    }
}
</script>