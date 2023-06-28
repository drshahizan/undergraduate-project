<template>
    <div :class="type == 1 ?'flex mb-[35px]' : 'flex flex-col mb-[30px] gap-[16px]'">
        <div class="flex flex-[3_3_0%] justify-between">
            <p :class="type == 1 ?'text-[14px] text-[#A1A5B6] tracking-[0.1em] flex-1': 'text-[14px] text-[#A1A5B6] tracking-[0.1em]'">{{ value }}</p>
            <p class="text-[14px] text-[#A1A5B6] tracking-[0.1em] ml-[20px] flex-1">:</p>
        </div>
        <p class="text-[#616379] flex-[2_2_0%] text-[14px] tracking-[0.1em]" :class="type == 1 ? 'text-right' : ''">
            <span v-html="data"></span>
            {{ unit }}
        </p>
    </div>
</template>

<script>
export default {
    components: {
        
    },
    props: {
        type : {
            type: Number,
            required: true,
            default : 1
        },
        value: String,
        data : String,
        unit : {
            type: String,
            default: ''
        }
    },
}
</script>