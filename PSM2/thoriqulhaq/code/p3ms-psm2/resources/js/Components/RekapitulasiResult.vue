<template>
    <div :class="type == 1 ?'flex mb-[50px]' : 'flex flex-col mb-[50px] gap-[16px]'">
        <div class="flex flex-[3_3_0%] justify-between">
            <p :class="type == 1 ?'text-white tracking-[0.1em] flex-1': 'text-white tracking-[0.1em]'">{{ value }}</p>
            <p class="text-white tracking-[0.1em] ml-[20px] flex-1">:</p>
        </div>
        <p class="text-white tracking-[0.1em] flex-1">{{ data }} {{ unit }}</p>
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