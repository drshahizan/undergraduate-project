<template>
    <div class="flex w-full h-full px-[34px] py-[40px] gap-[61px]">
        <div class="flex-1">
            <RekapitulasiResult
                value="DAYA PASANG"
                data="100"
                unit="MW"
            />
            <RekapitulasiResult
                value="DAYA MAMPU"
                data="100"
                unit="MW"
            />
            <RekapitulasiResult
                value="BEBAN"
                data="100"
                unit="MW"
            />
            <RekapitulasiResult
                value="STAND AWAL"
                data="100"
                unit="MW"
            />
            <RekapitulasiResult
                value="STAND AKHIR"
                data="100"
                unit="MW"
            />
            <RekapitulasiResult
                value="KEGIATAN HAR"
                data="100"
                unit="MW"
            />
        </div>
        <div class="flex-1">
            <RekapitulasiResult
                value="KWH PRODUKSI"
                data="Perawatan berkala pembangkit"
                type=2
            />
            <RekapitulasiResult
                value="GANGGUAN"
                data="Terjadi kerusakan pada bagian kabel penghubung"
                type=2
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