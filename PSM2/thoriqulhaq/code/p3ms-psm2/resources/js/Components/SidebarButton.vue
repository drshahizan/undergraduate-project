<template>
    <Link :href="url" class="flex-1 bg-white rounded-[18px] flex justify-center hover:bg-gray-200">
    <h5 class="my-auto font-semibold tracking-[0.1em]">{{ item }}</h5>
    </Link>
</template>

<script>
export default {
    components: {
    },
    props: {
        item: {
            type: String,
            required: true
        },
        url: {
            type: String,
            required: true
        }
    },
}
</script>