<template>
    <div class="bg-[url('/images/BG_P3MS.png')] bg-cover min-h-screen">
        <div class="pt-[39px] pb-[54px] pl-[54px] w-full min-h-screen h-full flex flex-col gap-[56px]">
            <Navbar />
            <div class="flex items-center">
                <Link class="rounded-full w-[43px] h-[43px] bg-[#525663] flex justify-center z-10" href="/dashboard">
                    <i class="pi pi-chevron-left text-white hover:text-gray-400 my-auto"></i>
                </Link>
                <div class="ml-[-30px] rounded-r-[18px] h-[36px] flex justify-center z-0" style="background: linear-gradient(270deg, #ADADAD 0%, rgba(196, 196, 196, 0) 93.22%);">
                    <h5 class="my-auto mr-[57px] ml-[79px] text-white font-semibold tracking-[0.1em]">INPUT REKAP</h5>
                </div>
            </div>
            <div class="flex-1 flex gap-[56px]">
                <div class="flex flex-col flex-1">
            <div class="flex gap-[53px]">
                <div class="mb-[32px] min-w-[168px] w-full flex-1">
                    <p class="mb-[10px] font-semibold text-white tracking-[0.1em]">Tipe Pembangkit</p>
                    <Dropdown v-model="pembangkit" :options="tipe_pembangkit" optionLabel="name" placeholder="Pilih"
                        class="w-full md:w-14rem" :inputStyle="{ 'width': '100%' }" inputClass="p-inputtext-sm"
                        panelClass="text-[0.875rem]" />
                </div>
                <div class="mb-[32px] min-w-[168px] w-full flex-[2_2_0%]">
                    <p class="mb-[10px] font-semibold text-white tracking-[0.1em]">Nama Pembangkit</p>
                    <Dropdown v-model="nama_pembangkit" :options="list_pembangkit" optionLabel="name" placeholder="Pilih"
                        class="w-full md:w-14rem" :inputStyle="{ 'width': '100%' }" inputClass="p-inputtext-sm"
                        panelClass="text-[0.875rem]" />
                </div>
                <div class="mb-[32px] min-w-[168px] w-full flex-[3_3_0%]">
                    <p class="mb-[10px] font-semibold text-white tracking-[0.1em]">Tanggal Input</p>
                    <Calendar v-model="date" showIcon class="w-full h-[44px]" inputClass="p-inputtext-sm"
                        panelClass="text-[0.875rem]" placeholder="Pilih" dateFormat="dd/mm/yy" />
                </div>
                <div class="mb-[32px] min-w-[168px] w-full flex-[2_2_0%]">
                    <p class="mb-[10px] font-semibold text-white tracking-[0.1em]">Tipe Rekapitulasi</p>
                    <Dropdown v-model="rekapitulasi" :options="tipe_rekapitulasi[pembangkit?.id]" optionLabel="name" placeholder="Pilih"
                        class="w-full md:w-14rem" :inputStyle="{ 'width': '100%' }" inputClass="p-inputtext-sm"
                        panelClass="text-[0.875rem]" />
                </div>
            </div>
            <div v-if="rekapitulasi" class="flex-1 rounded-[18px] flex justify-center items-center" style="background: linear-gradient(180deg, rgba(173, 173, 173, 0.5) -39.27%, rgba(173, 173, 173, 0) 100%);">
                <component :is="rekapitulasi?.code"></component>
            </div>
            <div v-else class="flex-1 rounded-[18px] flex justify-center items-center" style="background: linear-gradient(180deg, rgba(173, 173, 173, 0.5) -39.27%, rgba(173, 173, 173, 0) 100%);">
                <h5 class="text-white font-semibold tracking-[0.1em]">PILIH TERLEBIH DAHULU !</h5>
            </div>
            </div>
                <div class="w-[302px] mr-[54px] mt-[32px] flex flex-col gap-[32px]">
                    <!-- Option Menu -->
                    <Link class="bg-[#6EB452] w-full h-[44px] flex justify-between items-center rounded-[6px] border-[1px] border-[#6EB452] px-[12px]">
                        <i class="pi pi-save text-white mr-[12px]"></i>
                        <h5 class="tracking-[0.1em] text-white">Simpan</h5>
                        <div class="m-[12px]"></div>
                    </Link>
                    <Link class="bg-[#282A39] w-full h-[44px] flex justify-between items-center rounded-[6px] border-[1px] border-[white] px-[12px]">
                        <i class="pi pi-send text-white mr-[12px]"></i>
                        <h5 class="tracking-[0.1em] text-white">Kirim</h5>
                        <div class="m-[12px]"></div>
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from "vue";
import InputText from 'primevue/inputtext';
import Dropdown from 'primevue/dropdown';
import Calendar from 'primevue/calendar';
import Chart from 'primevue/chart';
import Navbar from "../../Components/Navbar.vue";

import BBMPemakaian from '../../Layouts/RekapitulasiForm/PLTD/BBMPemakaian.vue';
import BBMStok from '../../Layouts/RekapitulasiForm/PLTD/BBMStok.vue';
import Beban from '../../Layouts/RekapitulasiForm/PLTD/Beban.vue';
import FastMoving from '../../Layouts/RekapitulasiForm/PLTD/FastMoving.vue';
import Gangguan from '../../Layouts/RekapitulasiForm/PLTD/Gangguan.vue';
import HARRealisasi from '../../Layouts/RekapitulasiForm/PLTD/HARRealisasi.vue';
import HARRencana from '../../Layouts/RekapitulasiForm/PLTD/HARRencana.vue';
import KWH from '../../Layouts/RekapitulasiForm/PLTD/KWH.vue';
import Pelumas from '../../Layouts/RekapitulasiForm/PLTD/Pelumas.vue';
import Default from '../../Layouts/RekapitulasiForm/PLTS/Default.vue'; 


export default {
    components: {
        InputText,
        Dropdown,
        Calendar,
        Chart,
        Navbar,
        BBMPemakaian,
        BBMStok,
        Beban,
        FastMoving,
        Gangguan,
        HARRealisasi,
        HARRencana,
        KWH,
        Pelumas,
        Default,
    },
    setup(props) {
        const formState = ref({
            username: '',
        });

        const pembangkit = ref();
        const tipe_pembangkit = ref([
            { name: 'PLTS', code: 'plts', id: 0 },
            { name: 'PLTD', code: 'pltd', id: 1 },
        ]);

        const nama_pembangkit = ref();
        const list_pembangkit = ref([
            { name: 'Mandangin', code: 'mandangin' },
            { name: 'Masa Lembu', code: 'masa_lembu' },
        ]);

        const rekapitulasi = ref();
        const tipe_rekapitulasi = ref([
            [
                { name: 'Default', code: Default },
            ],
            [
                { name: 'BBM Pemakaian', code: BBMPemakaian },
                { name: 'BBM Stok', code: BBMStok },
                { name: 'Beban', code: Beban },
                { name: 'Fast Moving', code: FastMoving },
                { name: 'Gangguan', code: Gangguan },
                { name: 'HAR Realisasi', code: HARRealisasi },
                { name: 'HAR Rencana', code: HARRencana },
                { name: 'KWH', code: KWH },
                { name: 'Pelumas', code: Pelumas },
            ]
        ]);

        const date = ref();


        return {
            formState,
            pembangkit,
            tipe_pembangkit,
            nama_pembangkit,
            list_pembangkit,
            rekapitulasi,
            tipe_rekapitulasi,
            date
        }
    }
}
</script>