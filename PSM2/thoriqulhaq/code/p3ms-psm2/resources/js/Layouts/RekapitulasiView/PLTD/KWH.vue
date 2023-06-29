<template>
    <div class="flex w-full h-full p-[20px] gap-[61px]">
        <div class="flex-1">
            <h2 class="mb-[42px] tracking-[0.1em] text-[#A1A5B6] text-[18px] font-semibold">Engine Module</h2>
            <template v-for="(engine) in $page.props.user.engine_quantity" :key="engine">
                <RekapitulasiResult
                :value="'Mesin '+engine" 
                    :data="data?.detail?.['engine_'+engine+'_em']"
                    unit="KWH"
                />
            </template>
        </div>
        <div class="flex-1">
            <h2 class="mb-[42px] tracking-[0.1em] text-[#A1A5B6] text-[18px] font-semibold">KWH Meter Pembanding</h2>
            <template v-for="(engine) in $page.props.user.engine_quantity" :key="engine">
                <RekapitulasiResult
                :value="'Mesin '+engine" 
                    :data="data?.detail?.['engine_'+engine+'_kmp']"
                    unit="KWH"
                />
            </template>
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