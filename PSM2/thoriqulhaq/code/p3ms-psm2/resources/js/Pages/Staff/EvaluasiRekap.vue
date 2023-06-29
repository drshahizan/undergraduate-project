<template>
    <SecondaryLayoutStaff >
        <template #header>
            <div>
                <p class="text-[#14A3B8] font-semibold">Evaluasi Rekap ({{ data.power_plant_type }})</p>
                <p class="text-[12px]">{{ data.recapitulation_type }}</p>
            </div>
            <div class="flex gap-[1rem]">
                <Link href="/rekap/permintaan">
                    <div class="py-[0.5rem] px-[1rem] flex justify-center items-center bg-white border-[#14A3B8] rounded-[0.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)]">
                        <p class="text-[#14A3B8] text-[14px]">{{ data.status == 'Disetujui' || data.status == 'Ditolak' ? 'Selesai' : 'Kembali'}}</p>
                    </div>
                </Link>
                <Link v-if="data.status != 'Disetujui' && data.status != 'Ditolak'" :href="'/rekap/edit/' + data.id" class="py-[0.5rem] px-[1rem] flex justify-center items-center bg-[#14A3B8] rounded-[0.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)]">
                    <p class="text-white text-[14px]">Koreksi</p>
                </Link>
            </div>
        </template>
        <div class="overflow-hidden bg-white flex-1 rounded-[1.5rem] px-[1.5rem] py-[1.75rem] relative flex flex-col">
            <div class="flex justify-between items-center mb-[5rem] mt-[1rem] relative">
                <hr class="h-[1px] w-full bg-[#E1E2EA]">
                <div class="absolute right-0 top-[-1.25rem] w-full flex justify-around">
                    <div class="text-[12px] font-semibold text-[#616278] tracking-[0.075rem] flex flex-col justify-center items-center gap-[1rem]">
                        <div class="border-[1px] rounded-full flex h-[2.5rem] w-[2.5rem] justify-center items-center text-[#606279] bg-[#E4E7EC] px-[1rem]">
                            <p>1</p>
                        </div>
                        <p>Rekap Dibuat</p>
                    </div>
                    <div class="text-[12px] font-semibold text-[#616278] tracking-[0.075rem] flex flex-col justify-center items-center gap-[1rem]">
                        <div  :class="data.status != 'Dibuat' ? 'bg-[#E4E7EC] text-[#606279]' : 'bg-[#FEFFFE] text-[#616278]'"  class="border-[1px] rounded-full flex h-[2.5rem] w-[2.5rem] justify-center items-center px-[1rem]">
                            <p>2</p>
                        </div>
                        <p>Sedang Dievaluasi</p>
                    </div>
                    <div class="text-[12px] font-semibold text-[#616278] tracking-[0.075rem] flex flex-col justify-center items-center gap-[1rem]">
                        <div  :class="data.status != 'Dibuat' &&  data.status != 'Dievaluasi'? 'bg-[#E4E7EC] text-[#606279]' : 'bg-[#FEFFFE] text-[#616278]'"  class="border-[1px] rounded-full flex h-[2.5rem] w-[2.5rem] justify-center items-center px-[1rem]">
                            <p>3</p>
                        </div>
                        <p>Telah Dievaluasi</p>
                    </div>
                </div>
            </div>
            <div class="overflow-y-scroll scrollbar-hide flex-1 flex flex-col">
                <div class="flex gap-[1.5rem] mb-[1.5rem]">
                    <div class="rounded-[1.25rem] border-[#E0E3EA] border-[1.5px] border-dashed p-[1rem] flex flex-col gap-[0.5rem] flex-1">
                        <p class="font-semibold text-[14px] text-[#A1A5B6]">Pembangkit</p>
                        <p class="text-[14px]">{{ data.power_plant_name }}</p>
                    </div>
                    <div class="rounded-[1.25rem] border-[#E0E3EA] border-[1.5px] border-dashed p-[1rem] flex flex-col gap-[0.5rem] flex-1">
                        <p class="font-semibold text-[14px] text-[#A1A5B6]">Tanggal</p>
                        <p class="text-[14px]">{{ data.date_time}}</p>
                    </div>
                    <div class="rounded-[1.25rem] border-[#E0E3EA] border-[1.5px] border-dashed p-[1rem] flex flex-col gap-[0.5rem] flex-1">
                        <p class="font-semibold text-[14px] text-[#A1A5B6]">Hasil Evaluasi</p>
                        <div class="flex items-center gap-[0.3rem]">
                            <p class="text-[14px]">{{ data.status == 'Disetujui' || data.status == 'Ditolak' ? data.status : '-' }}</p>
                            <p v-if="data.status == 'Ditolak'" v-tooltip.right="{ value: `<p class='text-white text-[12px] my-[-5px]'>${data?.log?.message}</p>`, escape: true}" class="pi pi-exclamation-circle text-[#F0406C] text-[14px]"></p>
                        </div>
                    </div>
                </div>
                <div class="">
                    <component :is="rekapitulasi?.code" :data="data"></component>
                </div>
            </div>
            <div class="flex justify-end items-center  gap-[1rem]">
                <template v-if="data.status == 'Disetujui' || data.status == 'Ditolak'">
                    <button v-on:click="modalBatalRekap = !modalBatalRekap" class="py-[0.5rem] px-[1rem] flex justify-center items-center bg-[#EF406C] rounded-[0.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)]">
                        <p class="text-white text-[14px]">Batalkan Status Evaluasi</p>
                    </button>
                </template>
                <template v-else>
                    <button v-on:click="modalTolakRekap = !modalTolakRekap" class="py-[0.5rem] px-[1rem] flex justify-center items-center bg-[#EF406C] rounded-[0.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)]">
                        <p class="text-white text-[14px]">Tolak</p>
                    </button>
                    <button v-on:click="modalSetujuRekap = !modalSetujuRekap" class="py-[0.5rem] px-[1rem] flex justify-center items-center bg-[#76CC66] rounded-[0.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)]">
                        <p class="text-white text-[14px]">Setuju</p>
                    </button>
                </template>
            </div>
            <!-- Modal -->
            <div v-if="modalBatalRekap" class="absolute flex justify-center items-center h-full w-full top-0 left-0 rounded-[1.5rem] bg-[#F1F4F5] bg-opacity-40">
                <div class="w-[40rem] h-[15rem] bg-white rounded-[1.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)] flex flex-col">
                    <div class="px-[2rem] py-[1.25rem] flex justify-between items-center bg-[#EF406C] rounded-tr-[1.5rem] rounded-tl-[1.5rem] mb-[1rem]">
                        <p class="font-semibold text-white">Batalkan Status Evaluasi Rekap</p>
                    </div>
                    <div class="flex-1 px-[2rem] py-[1.25rem]">
                        <p class="text-[#A0A4B6] text-[14px]">Dengan menekan tombol <span class="font-semibold">Ya</span> dibawah, berarti anda telah membatalkan status evaluasi pada rekap ini. Pastikan anda telah yakin.</p>
                    </div>
                    <div class="flex justify-end items-center px-[2rem] py-[1.25rem] gap-[1rem]">
                        <button v-on:click="modalBatalRekap = !modalBatalRekap" class="py-[0.5rem] px-[1rem] flex justify-center items-center bg-white rounded-[0.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.15)]">
                            <p class="text-[#EF406C] text-[14px]">Tidak</p>
                        </button>
                        <Link v-on:click="modalBatalRekap = !modalBatalRekap" method="post" :href="route('recap.evaluate.save', {
                            id : data.id,
                            status : 'Dievaluasi',
                        })" class="py-[0.5rem] px-[1rem] flex justify-center items-center bg-[#EF406C] rounded-[0.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)]">
                            <p class="text-white text-[14px]">Ya</p>
                        </Link>
                    </div>
                </div>
            </div>
            <div v-if="modalSetujuRekap" class="absolute flex justify-center items-center h-full w-full top-0 left-0 rounded-[1.5rem] bg-[#F1F4F5] bg-opacity-40">
                <div class="w-[40rem] h-[15rem] bg-white rounded-[1.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)] flex flex-col">
                    <div class="px-[2rem] py-[1.25rem] flex justify-between items-center bg-[#76CC66] rounded-tr-[1.5rem] rounded-tl-[1.5rem] mb-[1rem]">
                        <p class="font-semibold text-white">Setujui Rekap</p>
                    </div>
                    <div class="flex-1 px-[2rem] py-[1.25rem]">
                        <p class="text-[#A0A4B6] text-[14px]">Dengan menekan tombol <span class="font-semibold">Ya</span> dibawah, berarti anda telah menyetujui rekap ini. Pastikan anda telah mengevaluasi keseluruhan rekap ini.</p>
                    </div>
                    <div class="flex justify-end items-center px-[2rem] py-[1.25rem] gap-[1rem]">
                        <button v-on:click="modalSetujuRekap = !modalSetujuRekap" class="py-[0.5rem] px-[1rem] flex justify-center items-center bg-white rounded-[0.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.15)]">
                            <p class="text-[#76CC66] text-[14px]">Tidak</p>
                        </button>
                        <Link v-on:click="modalSetujuRekap = !modalSetujuRekap" method="post" :href="route('recap.evaluate.save', {
                            id : data.id,
                            status : 'Disetujui',
                        })" class="py-[0.5rem] px-[1rem] flex justify-center items-center bg-[#76CC66] rounded-[0.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)]">
                            <p class="text-white text-[14px]">Ya</p>
                        </Link>
                    </div>
                </div>
            </div>
            <div v-if="modalTolakRekap" class="absolute flex justify-center items-center h-full w-full top-0 left-0 rounded-[1.5rem] bg-[#F1F4F5] bg-opacity-40">
                <div class="w-[40rem] h-[27rem] bg-white rounded-[1.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)] flex flex-col">
                    <div class="px-[2rem] py-[1.25rem] flex justify-between items-center bg-[#EF406C] rounded-tr-[1.5rem] rounded-tl-[1.5rem] mb-[1rem]">
                        <p class="font-semibold text-white">Tolak Rekap</p>
                    </div>
                    <div class="flex-1 px-[2rem] py-[1.25rem]">
                        <p class="text-[#A0A4B6] text-[14px]">Dengan menekan tombol <span class="font-semibold">Ya</span> dibawah, berarti anda telah menolak rekap ini. Pastikan anda telah mengevaluasi keseluruhan rekap ini dan mengisi kolom komentar dibawah.</p>
                        <Textarea class="mt-[2rem] w-full text-[14px]" v-model="messageTolakRekap" rows="5" cols="30" />
                    </div>
                    <div class="flex justify-end items-center px-[2rem] py-[1.25rem] gap-[1rem]">
                        <button v-on:click="modalTolakRekap = !modalTolakRekap" class="py-[0.5rem] px-[1rem] flex justify-center items-center bg-white rounded-[0.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.15)]">
                            <p class="text-[#EF406C] text-[14px]">Tidak</p>
                        </button>
                        <Link v-on:click="modalTolakRekap = !modalTolakRekap" method="post" :href="route('recap.evaluate.save', {
                            id : data.id,
                            status : 'Ditolak',
                            message : messageTolakRekap,
                        })" class="py-[0.5rem] px-[1rem] flex justify-center items-center bg-[#EF406C] rounded-[0.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)]">
                            <p class="text-white text-[14px]">Ya</p>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </SecondaryLayoutStaff>
</template>

<script>
import { ref } from "vue";
import SecondaryLayoutStaff from "../../Layouts/Staff/SecondaryLayout.vue";
import Steps from 'primevue/steps';

import BBMPemakaian from '../../Layouts/RekapitulasiView/PLTD/BBMPemakaian.vue';
import BBMStok from '../../Layouts/RekapitulasiView/PLTD/BBMStok.vue';
import Beban from '../../Layouts/RekapitulasiView/PLTD/Beban.vue';
import FastMoving from '../../Layouts/RekapitulasiView/PLTD/FastMoving.vue';
import Gangguan from '../../Layouts/RekapitulasiView/PLTD/Gangguan.vue';
import HARRealisasi from '../../Layouts/RekapitulasiView/PLTD/HARRealisasi.vue';
import HARRencana from '../../Layouts/RekapitulasiView/PLTD/HARRencana.vue';
import KWH from '../../Layouts/RekapitulasiView/PLTD/KWH.vue';
import Pelumas from '../../Layouts/RekapitulasiView/PLTD/Pelumas.vue';
import Utama from '../../Layouts/RekapitulasiView/PLTS/Utama.vue';

import Textarea from 'primevue/textarea';

export default {
    components: {
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
        SecondaryLayoutStaff,
        Steps,
        Textarea
    },
    props: {
        tipe_rekapitulasi : {
            type: String,
            required: true,
            default : ''
        },
        data : {
            type: Object,
            required: true,
            default : {}
        }
    },
    setup(props) {
        const modalTolakRekap = ref(false);
        const modalSetujuRekap = ref(false);
        const modalBatalRekap = ref(false);
        
        const messageTolakRekap = ref("");
        
        const list_tipe_rekapitulasi = [
            { name: 'BBM Pemakaian', code: BBMPemakaian },
            { name: 'BBM Stok', code: BBMStok },
            { name: 'Beban', code: Beban },
            { name: 'Fast Moving', code: FastMoving },
            { name: 'Gangguan', code: Gangguan },
            { name: 'HAR Realisasi', code: HARRealisasi },
            { name: 'HAR Rencana', code: HARRencana },
            { name: 'KWH', code: KWH },
            { name: 'Pelumas', code: Pelumas },
            { name: 'Utama', code: Utama },
        ]
        
        const rekapitulasi = ref(list_tipe_rekapitulasi[list_tipe_rekapitulasi.findIndex((item) => item.name == props.data.recapitulation_type)]);
        
        const items = ref([
            {
                label: 'Rekap Dibuat',
            },
            {
                label: 'Sedang Dievaluasi',
            },
            {
                label: 'Telah Dievaluasi',
            }
        ]);
        
        return {
            rekapitulasi,
            items,
            modalTolakRekap,
            modalSetujuRekap,
            modalBatalRekap,
            messageTolakRekap
        }
    }
}
</script>