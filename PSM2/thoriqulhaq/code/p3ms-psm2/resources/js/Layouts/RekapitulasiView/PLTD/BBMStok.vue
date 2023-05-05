<template>
    <div class="flex flex-col w-full h-full px-[34px] py-[40px] ">
        <div class="flex flex-1 gap-[61px]">
            <div class="flex-1">
                <RekapitulasiResult
                    value="PENERIMAAN DO"
                    data="100"
                    unit="JAM"
                />
                <RekapitulasiResult
                    value="PENERIMAAN FISIK"
                    data="100"
                    unit="JAM"
                />
            </div>
            <div class="flex-1">
            </div>
        </div>
        <div class="flex flex-1 gap-[61px]">
            <div class="flex-1">
                <h2 class="mb-[42px] tracking-[0.1em] text-white text-[28px] font-semibold">BEBAN</h2>
                <RekapitulasiResult
                    value="MESIN 1"
                    data="100"
                    unit="KW"
                />
            </div>
            <div class="flex-1">
                <h2 class="mb-[42px] tracking-[0.1em] text-white text-[28px] font-semibold">JAM OPERASI BEBAN</h2>
                <RekapitulasiResult
                    value="MESIN 1"
                    data="100"
                    unit="JAM"
                />
            </div>
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