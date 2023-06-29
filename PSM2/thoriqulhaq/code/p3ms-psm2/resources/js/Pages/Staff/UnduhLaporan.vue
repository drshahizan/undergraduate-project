<template>
    <MainLayoutStaff>
        <div class="bg-white flex-1 rounded-[1.5rem] px-[1.5rem] py-[1.75rem] flex flex-col mt-[1rem]">
            <div class="flex flex-col mr-[54px]">
                <div class="flex gap-[53px]">
                    <div class="mb-[32px] min-w-[168px] w-full max-w-[400px]">
                        <p class="mb-[10px] text-[#495157] tracking-[0.1em] text-[14px]">Tipe Pembangkit</p>
                        <Dropdown v-model="formState.power_plant_type" :options="optionPowerPlantType" optionLabel="name" placeholder="Pilih"
                            class="w-full md:w-14rem border-[1.5px] border-[#F8F8F9] bg-[#F8F8F9] rounded-[0.5rem]" :inputStyle="{ 'width': '100%' }" inputClass="p-inputtext-sm"
                            panelClass="text-[0.875rem]" 
                        />
                    </div>
                    <div class="mb-[32px] min-w-[168px] w-full max-w-[400px]">
                        <p class="mb-[10px] text-[#495157] tracking-[0.1em] text-[14px]">Nama Pembangkit</p>
                        <Dropdown v-model="formState.power_plant_id" :options="optionPowerPlant" optionLabel="name" placeholder="Pilih"
                            class="w-full md:w-14rem border-[1.5px] border-[#F8F8F9] bg-[#F8F8F9] rounded-[0.5rem]" :inputStyle="{ 'width': '100%' }" inputClass="p-inputtext-sm"
                            panelClass="text-[0.875rem]" />
                    </div>
                    <div class="mb-[32px] min-w-[168px] w-full max-w-[400px]">
                        <p class="mb-[10px] text-[#495157] tracking-[0.1em] text-[14px]">Tipe Laporan</p>
                        <Dropdown v-model="formState.report_type" :options="optionReportType" optionLabel="name" placeholder="Pilih"
                            class="w-full md:w-14rem border-[1.5px] border-[#F8F8F9] bg-[#F8F8F9] rounded-[0.5rem]" :inputStyle="{ 'width': '100%' }" inputClass="p-inputtext-sm"
                            panelClass="text-[0.875rem]" />
                    </div>
                </div>
                <div class="flex gap-[53px]">
                    <div class="mb-[32px] min-w-[168px] w-full max-w-[400px]">
                        <p class="mb-[10px] text-[#495157] tracking-[0.1em] text-[14px]">Tanggal Mulai</p>
                        <Calendar v-model="formState.date_start" showIcon class="w-full h-[44px] border-[1.5px] border-[#F8F8F9] rounded-[0.5rem]" inputClass="p-inputtext-sm bg-[#F8F8F9]"
                            panelClass="text-[0.875rem]" placeholder="Pilih" dateFormat="dd/mm/yy" />
                    </div>
                    <div class="mb-[32px] min-w-[168px] w-full max-w-[400px]">
                        <p class="mb-[10px] text-[#495157] tracking-[0.1em] text-[14px]">Tanggal Akhir</p>
                        <Calendar v-model="formState.date_end" showIcon class="w-full h-[44px] border-[1.5px] border-[#F8F8F9] rounded-[0.5rem]" inputClass="p-inputtext-sm bg-[#F8F8F9]"
                            panelClass="text-[0.875rem]" placeholder="Pilih" dateFormat="dd/mm/yy" />
                    </div>
                    <div class="mb-[32px] min-w-[168px] w-full max-w-[400px]">

                    </div>
                </div>
            </div>
            <div class="rounded-[1.25rem] border-[#E0E3EA] border-[1.5px] border-dashed relative flex flex-1">
                <div class="absolute flex gap-[0.5rem] top-0 right-0 p-[1rem] items-center text-[#BFC3CF] bg-[#F9F9F9] rounded-tr-[1.25rem] rounded-bl-[1.25rem]">
                    <i class="pi pi-eye"></i>
                    <p class="text-[14px]">Pratinjau</p>
                </div>
                <div :class="preview.length != 0 ? 'hidden' : ''" class="text-[#BFC3CF] flex flex-1 justify-center items-center">
                    <p class="text-[14px]">Pilih terlebih dahulu !</p>
                </div>
                <div class="absolute bottom-[0] right-[0] bg-white p-[1rem] rounded-tl-[1.25rem] rounded-br-[1.25rem]">
                    <a :href="route('report.download', formState)" preserve-state :class="preview.length == 0 ? 'hidden' : ''" class="flex gap-[0.5rem] px-[1rem] py-[0.5rem] items-center text-[#BFC3CF] bg-[#F9F9F9] rounded-[0.5rem]">
                        <p class="text-[14px]">Unduh</p>
                    </a>
                </div>
                <div :class="preview.length == 0 ? 'hidden' : ''"  class="flex flex-col flex-1 max-h-[390px] my-[0.5rem]">
                    <div class="px-[2rem] py-[1rem] flex-1 flex flex-col text-[#495157] overflow-y-scroll scrollbar-hide">
                        <p class="text-[14px] font-bold">LAPORAN - {{ filter.power_plant_id?.name }}</p>
                        <p class="text-[11px] mb-[1.5rem]">PERIODE: {{ filter.date_start != undefined ? formatDate(filter.date_start) : '' }} S.D {{ filter.date_end != undefined ? formatDate(filter.date_end) : '' }}</p>
                        <component :is="formState.report_type?.code" :datas="preview.data"></component>
                    </div>                    
                </div>
            </div>
        </div>
    </MainLayoutStaff>
</template>

<script>
import { ref } from "vue";
import InputText from 'primevue/inputtext';
import Dropdown from 'primevue/dropdown';
import Calendar from 'primevue/calendar';
import MainLayoutStaff from '../../Layouts/Staff/MainLayout.vue';
import { router } from '@inertiajs/vue3';

import BBMPemakaian from "../../Layouts/LaporanPreview/PLTD/BBMPemakaian.vue";
import BBMStok from "../../Layouts/LaporanPreview/PLTD/BBMStok.vue";
import Beban from '../../Layouts/LaporanPreview/PLTD/Beban.vue';
import FastMoving from '../../Layouts/LaporanPreview/PLTD/FastMoving.vue';
import Gangguan from '../../Layouts/LaporanPreview/PLTD/Gangguan.vue';
import HARRealisasi from '../../Layouts/LaporanPreview/PLTD/HARRealisasi.vue';
import HARRencana from '../../Layouts/LaporanPreview/PLTD/HARRencana.vue';
import KWH from '../../Layouts/LaporanPreview/PLTD/KWH.vue';
import Pelumas from '../../Layouts/LaporanPreview/PLTD/Pelumas.vue';
import Utama from "../../Layouts/LaporanPreview/PLTS/Utama.vue";


export default {
    components: {
        InputText,
        Dropdown,
        Calendar,
        MainLayoutStaff,
        BBMPemakaian,
        BBMStok,
        Beban,
        FastMoving,
        Gangguan,
        HARRealisasi,
        HARRencana,
        KWH,
        Pelumas,
        Utama
    },
    props: {
        listPowerPlant: {
            type: Array,
            default: () => []
        },
        filter : {
            type: Object,
            default: () => {}
        },  
        preview: {
            type: Object,
        }
    },
    setup(props) {
        const optionPowerPlantType = ref([
            { name: 'PLTS', code: 'plts' },
            { name: 'PLTD', code: 'pltd' },
        ]);
        
        const optionPowerPlant = ref([]);

        const filterPowerPlant = () => {
            formState.value.power_plant_id = '';
            
            optionPowerPlant.value = props.listPowerPlant.filter((item) => {
                return item.type == formState.value.power_plant_type.name;
            });
        }
        
        const reportType = [
            { name: 'BBM Pemakaian', id: 1, type: 'pltd', code: BBMPemakaian },
            { name: 'BBM Stok', id: 2, type: 'pltd', code: BBMStok },
            { name: 'Beban', id: 3, type: 'pltd', code: Beban },
            { name: 'Fast Moving', id: 4, type: 'pltd', code: FastMoving },
            { name: 'Gangguan', id: 5, type: 'pltd', code: Gangguan },
            { name: 'HAR Realisasi', id: 6, type: 'pltd', code: HARRealisasi },
            { name: 'HAR Rencana', id: 7, type: 'pltd', code: HARRencana },
            { name: 'KWH', id: 8, type: 'pltd', code: KWH },
            { name: 'Pelumas', id: 9, type: 'pltd', code: Pelumas },
            { name: 'Utama', id: 10, type: 'plts', code: Utama },
        ];
        
        const optionReportType = ref([]);
        
        const filterReportType = () => {
            formState.value.report_type = '';
            
            optionReportType.value = reportType.filter((item) => {
                return item.type == formState.value.power_plant_type.code;
            });
        };
        
        const date_start = ref();
        const date_end = ref();
        
        const formState = ref({
            power_plant_type: props.filter.power_plant_type ?? '',
            power_plant_id: props.filter.power_plant_id ?? '',
            report_type: props.filter.report_type ?? '',
            date_start: props.filter.date_start ?? '',
            date_end: props.filter.date_end ?? '',
        })
        
        const formatDate = (value) => {
            const date = new Date(value);
            return date.toLocaleDateString('en-GB', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            });
        };
        
        return {
            optionPowerPlantType,
            optionPowerPlant,
            optionReportType,
            date_start,
            date_end,
            formState,
            filterPowerPlant,
            filterReportType,
            formatDate,
        }
    },
    watch: {
        'formState.power_plant_type': function (val) {
            this.filterPowerPlant();
            this.filterReportType();
        },
        formState: {
            handler: function () {
                if (this.formState.power_plant_type && this.formState.power_plant_id && this.formState.report_type && this.formState.date_start && this.formState.date_end) {
                    router.post(route('report.generate'), this.formState);
                }
            },
            deep: true
        },
    }
}
</script>