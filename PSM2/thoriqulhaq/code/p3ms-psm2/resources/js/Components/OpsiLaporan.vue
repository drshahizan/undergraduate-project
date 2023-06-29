<template>
    <Link :href="'/rekap/input/' + convertUrlAbleFormat(item)">
        <div class="flex items-center gap-[0.5rem] bg-[#F8F8F9] py-[1rem] px-[0.5rem] rounded-[0.85rem] hover:bg-white  hover:drop-shadow-[0px_12px_24px_rgba(0,0,0,0.2)]">
            <i :class="'pi ' + icon + ' text-[#BFC2CE] mx-[0.5rem]'"></i>
            <p class="text-[0.675rem] text-center">{{ item }}</p>
        </div>
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
        icon: {
            type: String,
            required: true
        }
    },
    setup(props) {
        const convertUrlAbleFormat = (str) => {
            var lowercaseStr = str.toLowerCase();
            var dashedStr = lowercaseStr.replace(/\s+/g, '-');
            return dashedStr;
        }
        
        return {
            convertUrlAbleFormat
        }
    }
}
</script>