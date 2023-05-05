<template>
    <div class="flex w-full h-full px-[34px] py-[40px] gap-[61px]">
        <div class="flex-1">
            <h2 class="mb-[42px] tracking-[0.1em] text-white text-[28px] font-semibold">TANGKI HARIAN</h2>
            <RekapitulasiResult
                value="MESIN 1"
                data="100"
                unit="L"
            />
        </div>
        <div class="flex-1">
            <h2 class="mb-[42px] tracking-[0.1em] text-white text-[28px] font-semibold">MODULE PCC 3300</h2>
            <RekapitulasiResult
                value="MESIN 1"
                data="100"
                unit="L"
            />
        </div>
    </div>
</template>

<script>
import RekapitulasiResult from '../../../Components/RekapitulasiResult.vue'

export default {
    components: {
        RekapitulasiResult
    },
    props: {
        data: {
            type: Object,
        }
    },
}
</script>