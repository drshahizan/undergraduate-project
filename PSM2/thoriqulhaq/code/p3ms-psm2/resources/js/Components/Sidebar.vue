<template>
    <div class="bg-[#FEFEFF] h-full rounded-[1.5rem] w-[390px] flex flex-col drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)]">
        <div class=" py-[2rem] px-[1.5rem] flex justify-between relative">
            <img src="/images/LOGO_PLN.svg" alt="P3MS" class="w-[90px]" />
            <img v-on:click="isUserOpen = !isUserOpen" :src="'/images/avatar/avatar_' + userType[$page.props.user.user_type] + '.png'" alt="P3MS" class="w-[45px]" />
            <div v-if="isUserOpen" class="absolute top-[6rem] right-[1.5rem] bg-white rounded-[1.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)] w-[200px] h-[150px] z-10">
                
            </div>
        </div>
        <div class="flex-1 py-[0.5rem] px-[2rem] flex flex-col gap-[2rem]">
            <div class="rounded-[0.75rem] flex flex-col items-centers  gap-[0.2rem]">
                <p class="text-[12px] text-[#616278] tracking-[0.025rem]">Selamat datang,</p>
                <p class="text-[12px] text-[#616278] tracking-[0.075rem] font-bold">{{ $page.props.user.name}}</p>
                <div v-if="$page.props.user.user_type == 'Staff Operator'" class="m-[0.05rem] pb-[0.75rem] rounded-[0.5rem]">
                    <div class="flex justify-between items-center mb-[3rem] mt-[3rem] relative">
                        <hr class="h-[1px] w-full bg-[#E1E2EA]">
                        <div class="absolute right-0 top-[-0.5rem] w-full flex justify-center">
                            <p class="text-[12px] font-semibold text-[#616278] tracking-[0.075rem] bg-[#FEFFFE] px-[1rem]">REKAP ANDA</p>
                        </div>
                    </div>
                    <div class="flex rounded-[0.85rem] h-[1.20rem] bg-[#ACE2EA] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.1)] mx-[0.75rem]">
                        <div :style="'width: '+$page.props.user.short_info.percentage_of_evaluated+'% !important'" class="bg-[#14A3B8] rounded-[0.85rem] px-[1rem] flex items-center justify-center">
                            <p class="text-white text-[9px]"> {{ $page.props.user.short_info.percentage_of_evaluated }}%</p>
                        </div>
                    </div>
                    <p class="text-[#14A3B8] text-[11px] mt-[0.8rem] text-center drop-shadow-[0px_12px_24px_rgba(0,0,0,0.1)]"><span class="mr-[0.75rem]">{{ $page.props.user.short_info.evaluated_recap }} / {{ $page.props.user.short_info.total_recap }}</span>rekap anda telah dievaluasi</p>
                </div>
                <div v-if="$page.props.user.user_type == 'Staff PIC'" class="m-[0.05rem] pb-[0.75rem] rounded-[0.5rem]">
                    <div class="flex justify-between items-center mb-[3rem] mt-[3rem] relative">
                        <hr class="h-[1px] w-full bg-[#E1E2EA]">
                        <div class="absolute right-0 top-[-0.5rem] w-full flex justify-center">
                            <p class="text-[12px] font-semibold text-[#616278] tracking-[0.075rem] bg-[#FEFFFE] px-[1rem]">REKAP MASUK</p>
                        </div>
                    </div>
                    <div class="flex rounded-[0.85rem] h-[1.20rem] bg-[#ACE2EA] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.1)] mx-[0.75rem]">
                        <div :style="'width: '+$page.props.user.short_info.percentage_of_evaluated+'% !important'" class="bg-[#14A3B8] rounded-[0.85rem] px-[1rem] flex items-center justify-center">
                            <p class="text-white text-[9px]"> {{ $page.props.user.short_info.percentage_of_evaluated }}%</p>
                        </div>
                    </div>
                    <p class="text-[#14A3B8] text-[11px] mt-[0.8rem] text-center drop-shadow-[0px_12px_24px_rgba(0,0,0,0.1)]"><span class="mr-[0.75rem]">{{ $page.props.user.short_info.evaluated_recap }} / {{ $page.props.user.short_info.total_recap }}</span>Rekap sudah dilakukan evaluasi</p>
                </div>
            </div>

            <div v-if="$page.props.user.user_type == 'Staff Operator' && $page.props.user.power_plant_type == 'PLTD'">
                <div class="flex justify-between items-center mb-[3rem] mt-[1px] relative">
                    <hr class="h-[1px] w-full bg-[#E1E2EA]">
                    <div class="absolute right-0 top-[-0.5rem] w-full flex justify-center">
                        <p class="text-[12px] font-semibold text-[#616278] tracking-[0.075rem] bg-[#FEFFFE] px-[1rem]">INPUT REKAP</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-[19.5px]">
                    <OpsiLaporan item="BBM Pemakaian" icon="pi-filter" />
                    <OpsiLaporan item="BBM Stok" icon="pi-box" />
                    <OpsiLaporan item="Beban" icon="pi-exclamation-triangle" />
                    <OpsiLaporan item="Fast Moving" icon="pi-list" />
                    <OpsiLaporan item="Gangguan" icon="pi-wrench" />
                    <OpsiLaporan item="HAR Realisasi" icon="pi-file-import" />
                    <OpsiLaporan item="HAR Rencana" icon="pi-file-export" />
                    <OpsiLaporan item="KWH" icon="pi-bolt" />
                    <OpsiLaporan item="Pelumas" icon="pi-cog" />
                </div>
            </div>
            <div v-if="$page.props.user.user_type == 'Staff Operator' && $page.props.user.power_plant_type == 'PLTS'">
                <div class="flex justify-between items-center mb-[45px] mt-[13px] relative">
                    <hr class="h-[1px] w-full bg-[#E1E2EA]">
                    <div class="absolute right-0 top-[-0.5rem] w-full flex justify-center">
                        <p class="text-[12px] font-semibold text-[#616278] tracking-[0.075rem] bg-[#FEFFFE] px-[1rem]">INPUT REKAP</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-[19.5px]">
                    <OpsiLaporan item="Utama" icon="pi-folder" />
                </div>
            </div>
        </div>
        <div class="flex justify-center items-center m-[0.5rem]">
            <Link :href="route('logout')" method="post" class="py-[1.25rem] px-[2rem] hover:bg-[#F9F9F9] flex justify-center items-center gap-[0.25rem] w-full h-full rounded-bl-[1.25rem] rounded-br-[1.25rem]">
                <i class="pi pi-sign-out text-[#BFC2CE] mx-[0.5rem]"></i>
                <p class="text-[#BFC2CE] text-[14px]">Keluar</p>
            </Link>
        </div>
    </div>
</template>

<script>
import { ref } from "vue";
import Badge from 'primevue/badge';
import OpsiLaporan from './OpsiLaporan.vue';

export default {
    components: {
        OpsiLaporan,
        Badge
    },
    props: {
        
    },
    setup(props) {
        const isUserOpen = ref(false)
        const userType = {
            'Admin': 1,
            'Staff PIC': 2,
            'Staff Operator': 3
        };
        
        const formatName = (name) => {
            let words = name.split(' ');

            for (let i = 0; i < words.length; i++) {
                if (words[i] !== 'PLTD' && words[i] !== 'PLTS') {
                    words[i] = words[i][0].toUpperCase() + words[i].slice(1).toLowerCase();
                }
            }
            return words.join(' ');
        }
        
        return {
            isUserOpen,
            userType,
            formatName
        }
    }
}
</script>