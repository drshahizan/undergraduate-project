<template>
    <div class="flex flex-col mt-[20px]">
        <div class="flex w-full h-full px-[20px] gap-[61px]">
        <div class="flex-1">
            <RekapitulasiResult
                :value="'Penerimaan DO'" 
                :data="data?.detail?.['do_reception']"
                unit="L"
            />
        </div>
        <div class="flex-1">
            <RekapitulasiResult
                :value="'Penerimaan Fisik'" 
                :data="data?.detail?.['physical_reception']"
                unit="L"
            />
        </div>
    </div>
    <div class="flex w-full h-full px-[20px] gap-[61px]">
        <div class="flex-1">
            <h2 class="mb-[42px] tracking-[0.1em] text-[#A1A5B6] text-[18px] font-semibold">Tangki Induk</h2>
            <template v-for="(engine) in $page.props.user.engine_quantity" :key="engine">
                <RekapitulasiResult
                :value="'Mesin '+engine" 
                    :data="data?.detail?.['engine_'+engine+'_ti']"
                    unit="L"
                />
            </template>
        </div>
        <div class="flex-1">
            <h2 class="mb-[42px] tracking-[0.1em] text-[#A1A5B6] text-[18px] font-semibold">Tangki Harian</h2>
            <template v-for="(engine) in $page.props.user.engine_quantity" :key="engine">
                <RekapitulasiResult
                :value="'Mesin '+engine" 
                    :data="data?.detail?.['engine_'+engine+'_th']"
                    unit="L"
                />
            </template>
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