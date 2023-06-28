<template>
    <div class="flex w-full h-full p-[20px] gap-[61px]">
        <div class="flex-1">
            <RekapitulasiResult
                value="Daya Pasang"
                :data="data?.detail?.installed_power"
                unit="MW"
            />
            <RekapitulasiResult
                value="Daya Mampu"
                :data="data?.detail?.ability"
                unit="MW"
            />
            <RekapitulasiResult
                value="Beban"
                :data="data?.detail?.load"
                unit="MW"
            />
            <RekapitulasiResult
                value="Stand Awal"
                :data="data?.detail?.early_stand"
                unit="MW"
            />
            <RekapitulasiResult
                value="Stand Akhir"
                :data="data?.detail?.final_stand"
                unit="MW"
            />
            <RekapitulasiResult
                value="KWH Produksi"
                :data="data?.detail?.kwh_production"
                unit="MW"
            />
        </div>
        <div class="flex-1">
            <RekapitulasiResult
                value="Kegiatan HAR"
                :data="data?.detail?.har_activity"
                type=2
            />
            <RekapitulasiResult
                value="Gangguan"
                :data="data?.detail?.maintenance"
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