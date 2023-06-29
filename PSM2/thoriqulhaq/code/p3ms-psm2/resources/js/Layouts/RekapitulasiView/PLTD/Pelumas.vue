<template>
    <div class="flex w-full h-full p-[20px] gap-[61px]">
        <div class="flex-1">
            <h2 class="mb-[42px] tracking-[0.1em] text-[#A1A5B6] text-[18px] font-semibold">Pemakaian Pelumas</h2>
            <template v-for="(engine) in $page.props.user.engine_quantity" :key="engine">
                <RekapitulasiResult
                :value="'Mesin '+engine" 
                    :data="data?.detail?.['engine_'+engine]"
                    unit="L"
                />
            </template>
        </div>
        <div class="flex-1">
            <h2 class="mb-[42px] tracking-[0.1em] text-[#A1A5B6] text-[18px] font-semibold">Stok Pelumas</h2>
            <RekapitulasiResult
                value="Stok Awal"
                :data="data?.detail?.first_lubricant_stock"
                unit="L"
            />
            <RekapitulasiResult
                value="Stok Penerimaan"
                :data="data?.detail?.receipt_lubricant_stock"
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