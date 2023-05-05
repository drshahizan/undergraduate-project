<template>
    <div class="bg-[url('/images/BG_P3MS.png')] bg-cover min-h-screen">
        <div class="pt-[39px] pb-[54px] pl-[54px] w-full min-h-screen h-full flex flex-col gap-[56px]">
            <Navbar />
            <div class="flex items-center">
                <Link class="rounded-full w-[43px] h-[43px] bg-[#525663] flex justify-center z-10" href="/dashboard">
                    <i class="pi pi-chevron-left text-white hover:text-gray-400 my-auto"></i>
                </Link>
                <div class="ml-[-30px] rounded-r-[18px] h-[36px] flex justify-center z-0" style="background: linear-gradient(270deg, #ADADAD 0%, rgba(196, 196, 196, 0) 93.22%);">
                    <h5 class="my-auto mr-[57px] ml-[79px] text-white font-semibold tracking-[0.1em]">REKAP</h5>
                </div>
            </div>
            <div class="flex-1 flex gap-[56px]">
                <div class="flex flex-col flex-1">
                    <h5 class="text-white text-[24px] font-semibold tracking-[0.1em]">REKAPITULASI (16 APRIL 2023)</h5>
                    <p class="text-white mb-[25px] tracking-[0.1em]">PLTS TONDUK</p>
                    <div class="flex-1 rounded-[18px] flex justify-center items-center" style="background: linear-gradient(180deg, rgba(173, 173, 173, 0.5) -39.27%, rgba(173, 173, 173, 0) 100%);">
                        <component :is="rekapitulasi?.code"></component>
                    </div>
                </div>
                <div class="w-[302px] mr-[54px] flex flex-col gap-[32px]">
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
import Navbar from "../../Components/Navbar.vue";

import BBMPemakaian from '../../Layouts/RekapitulasiView/PLTD/BBMPemakaian.vue';
import BBMStok from '../../Layouts/RekapitulasiView/PLTD/BBMStok.vue';
import Beban from '../../Layouts/RekapitulasiView/PLTD/Beban.vue';
import FastMoving from '../../Layouts/RekapitulasiView/PLTD/FastMoving.vue';
import Gangguan from '../../Layouts/RekapitulasiView/PLTD/Gangguan.vue';
import HARRealisasi from '../../Layouts/RekapitulasiView/PLTD/HARRealisasi.vue';
import HARRencana from '../../Layouts/RekapitulasiView/PLTD/HARRencana.vue';
import KWH from '../../Layouts/RekapitulasiView/PLTD/KWH.vue';
import Pelumas from '../../Layouts/RekapitulasiView/PLTD/Pelumas.vue';
import Default from '../../Layouts/RekapitulasiView/PLTS/Default.vue';

export default {
    components: {
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
    props: {
        tipe_rekapitulasi : {
            type: String,
            required: true,
            default : ''
        }
    },
    setup(props) {
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
            { name: 'Default', code: Default },
        ]
        
        const rekapitulasi = ref(list_tipe_rekapitulasi[1]);
        
        return {
            rekapitulasi
        }
    }
}
</script>