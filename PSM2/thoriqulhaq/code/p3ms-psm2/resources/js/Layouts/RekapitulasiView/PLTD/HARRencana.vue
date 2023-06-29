<template>
    <div class="flex w-full h-full p-[20px] gap-[61px]">
        <div class="flex-1">
            <RekapitulasiResult
                value="Unit"
                :data="'Mesin ' + data?.detail?.unit"
                unit=""
            />
        </div>
        <div class="flex-1">
            <RekapitulasiResult
                value="Kegiatan HAR"
                :data="data?.detail?.activity"
                type="2"
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