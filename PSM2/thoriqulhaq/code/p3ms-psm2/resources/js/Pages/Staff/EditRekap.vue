<template>
    <SecondaryLayoutStaff>
        <template #header>
            <div class="flex items-center gap-[1.5rem]">
                <!-- <div class="flex gap-[3rem] text-[15px] text-[#5F6279] font-semibold">
                    <Link href="/" class="p-overlay-badge h-[2.75rem] w-[2.75rem] flex justify-center items-center bg-white rounded-full drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)]">
                        <i class="pi pi-home text-[#BFC3CF] "></i>
                    </Link>
                </div> -->
                <div>
                    <p class="text-[#14A3B8] font-semibold">Edit Rekap ({{ $page.props.user.power_plant_type }})</p>
                    <p class="text-[12px]">{{ rekapitulasi?.name }}</p>
                </div>
            </div>
            <form
                @submit.prevent="submitForm()"
                class="flex gap-[1rem]"
            >
                <Link :href="'/rekap/'+ ($page.props.user.user_type == 'Staff Operator' ? 'detail' : 'evaluasi') +'/' + data.id" class="py-[0.5rem] px-[1rem] flex justify-center items-center bg-white border-[#14A3B8] rounded-[0.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)]">
                    <p class="text-[#14A3B8] text-[14px]">Batal</p>
                </Link>
                <button type="submit" class="py-[0.5rem] px-[1rem] flex justify-center items-center bg-[#14A3B8] rounded-[0.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)]">
                    <p class="text-white text-[14px]">Simpan Perubahan</p>
                </button>
            </form>
        </template>
        <div class="overflow-y-scroll scrollbar-hide flex-1 flex flex-col">
            <div class="mb-[1.5rem] font-semibold text-[#616379] flex justify-between items-center">
                <p>Informasi Dasar</p>
                <p v-tooltip.left="{ value: `<p class='text-white text-[12px] my-[-5px]'>Hello World</p>`, escape: true}" class="pi pi-info-circle"></p>
            </div>
            <div class="bg-white rounded-[1.25rem] px-[1.4rem] pt-[1.25rem] mb-[32px]">
                <div class="flex gap-[2rem]">
                    <div class="mb-[1.5rem] min-w-[168px] w-full flex-[3_3_0%]">
                        <p class="mb-[10px] text-[#A1A5B6] tracking-[0.1em] text-[14px]">Nama Pembangkit</p>
                        <Dropdown v-model="formState.power_plant_id" :options="optionPowerPlant" optionLabel="name" placeholder="Pilih"
                            class="w-full md:w-14rem border-[1.5px] border-[#F8F8F9] rounded-[0.5rem] bg-[#F8F8F9]" :inputStyle="{ 'width': '100%' }" inputClass="p-inputtext-sm"
                            panelClass="text-[0.875rem]" />
                    </div>
                    <div class="mb-[1.5rem] min-w-[168px] flex-[1.25_1.25_0%]">
                        <p class="mb-[10px] text-[#A1A5B6] tracking-[0.1em] text-[14px]">Tanggal Input</p>
                        <Calendar showTime hourFormat="24" v-model="formState.date_time" showIcon class="w-full h-[44px] border-[1.5px] border-[#F8F8F9] rounded-[0.5rem]" inputClass="p-inputtext-sm bg-[#F8F8F9]"
                            panelClass="text-[0.875rem]" placeholder="Pilih" dateFormat="dd/mm/yy" />
                    </div>
                </div>
            </div>
            <div class="mb-[1.5rem] font-semibold text-[#616379] flex justify-between items-center">
                <p>Hasil Rekap</p>
                <p v-tooltip.left="{ value: `<p class='text-white text-[12px] my-[-5px]'>Hello World</p>`, escape: true}" class="pi pi-info-circle"></p>
            </div>
            <div class="bg-white flex-1 rounded-[1.25rem] px-[1.4rem] pt-[1.75rem]">
                <div>
                    <component :is="rekapitulasi?.code" :formState="formState" :data="data"></component>
                </div>
            </div>
        </div>
    </SecondaryLayoutStaff>
</template>

<script>
import { ref } from "vue";
import InputText from 'primevue/inputtext';
import Dropdown from 'primevue/dropdown';
import Calendar from 'primevue/calendar';
import SecondaryLayoutStaff from "../../Layouts/Staff/SecondaryLayout.vue";
import { useForm } from '@inertiajs/vue3';

import BBMPemakaian from '../../Layouts/RekapitulasiForm/PLTD/BBMPemakaian.vue';
import BBMStok from '../../Layouts/RekapitulasiForm/PLTD/BBMStok.vue';
import Beban from '../../Layouts/RekapitulasiForm/PLTD/Beban.vue';
import FastMoving from '../../Layouts/RekapitulasiForm/PLTD/FastMoving.vue';
import Gangguan from '../../Layouts/RekapitulasiForm/PLTD/Gangguan.vue';
import HARRealisasi from '../../Layouts/RekapitulasiForm/PLTD/HARRealisasi.vue';
import HARRencana from '../../Layouts/RekapitulasiForm/PLTD/HARRencana.vue';
import KWH from '../../Layouts/RekapitulasiForm/PLTD/KWH.vue';
import Pelumas from '../../Layouts/RekapitulasiForm/PLTD/Pelumas.vue';
import Utama from '../../Layouts/RekapitulasiForm/PLTS/Utama.vue'; 


export default {
    components: {
        InputText,
        Dropdown,
        Calendar,
        BBMPemakaian,
        BBMStok,
        Beban,
        FastMoving,
        Gangguan,
        HARRealisasi,
        HARRencana,
        KWH,
        Pelumas,
        Utama,
        SecondaryLayoutStaff
    },
    props: {
        type: {
            type: String,
            required: true
        },
        listPowerPlant: {
            type: Array,
            default: () => []
        },
        data: {
            type: Object,
            required: true
        }
    },
    setup(props) {
        const optionPowerPlant = ref(props.listPowerPlant);

        const tipe_rekapitulasi = [
                { name: 'BBM Pemakaian', code: BBMPemakaian },
                { name: 'BBM Stok', code: BBMStok },
                { name: 'Beban', code: Beban },
                { name: 'Fast Moving', code: FastMoving },//
                { name: 'Gangguan', code: Gangguan },//
                { name: 'HAR Realisasi', code: HARRealisasi },//
                { name: 'HAR Rencana', code: HARRencana },
                { name: 'KWH', code: KWH },
                { name: 'Pelumas', code: Pelumas },
                { name: 'Utama', code: Utama },
        ];
        
        const rekapitulasi = ref(tipe_rekapitulasi[tipe_rekapitulasi.findIndex((item) => item.name === props.type)]);

        const getCurrentPowerPlant = (id) => {
            return optionPowerPlant.value.find(powerPlant => powerPlant.id == id);
        };
        
        const getCurrentDateTime = (date) => {
            return new Date(date);
        };
        
        const formState = ref({
            power_plant_id: getCurrentPowerPlant(props.data.power_plant_id),
            date_time: getCurrentDateTime(props.data.date_time),
            recapitulation_type: rekapitulasi
        });
        
        const submitForm = () => {
            const data = useForm({
                ...formState.value
            })
            
            data.post(route('recap.update', { id: props.data.id }));
        }
        
        return {
            formState,
            optionPowerPlant,
            rekapitulasi,
            tipe_rekapitulasi,
            submitForm
        }
    }
}
</script>