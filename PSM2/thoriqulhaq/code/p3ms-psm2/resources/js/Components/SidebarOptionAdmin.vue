<template>
    <Link :href="url" class="flex items-center gap-[1.5rem] hover:drop-shadow-[0px_12px_24px_rgba(0,0,0,0.2)]">
        <div class="bg-[#F8F8F9] rounded-[0.75rem] w-[3rem] h-[3rem] flex justify-center items-center">
            <i :class='icon + " pi text-[18px] text-[#BFC2CE] mx-[0.5rem]"'></i>
        </div>
        <div class="flex flex-col">
            <p class="text-[12px] text-[#BFC2CE] font-semibold">{{ category }}</p>
            <p class="text-[16px]">{{item}}</p>
        </div>
    </Link>
</template>

<script>
export default {
    components: {
    },
    props: {
        category: {
            type: String,
            required: true
        },
        item: {
            type: String,
            required: true
        },
        url: {
            type: String,
            required: true
        },
        icon: {
            type: String,
            required: true
        }
    },
}
</script>