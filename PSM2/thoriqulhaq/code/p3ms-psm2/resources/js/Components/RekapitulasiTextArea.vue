<template>
    <div class="flex flex-col w-full mb-[30px]">
        <p class="text-white tracking-[0.1em] flex-1 mb-[19px]">{{ value }}</p>
        <div class="flex-1 bg-white px-[6px] py-[5px] rounded-[8px]">
            <Textarea class="p-inputtext-sm w-full min-h-[120px] bg-[#E8E8E8] border-[#E8E8E8]" 
                v-model="model.value" 
                @input="updateFormState(model)"
                placeholder="Tulis disini . . ."
                maxlength="150"
            />
            <div class="flex justify-end">
                <p class="tracking-[0.1em]">{{ textCount }} / 150</p>
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