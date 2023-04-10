<template>
    <div class="bg-[url('/images/BG_P3MS.png')] bg-cover h-screen">
        <div class="pt-[39px] pb-[54px] pl-[54px] w-full h-full flex flex-col gap-[56px]">
            <Navbar />
            <div class="flex items-center">
                <Link class="rounded-full w-[43px] h-[43px] bg-[#525663] flex justify-center z-10" href="/dashboard">
                    <i class="pi pi-chevron-left text-white hover:text-gray-400 my-auto"></i>
                </Link>
                <div class="ml-[-30px] rounded-r-[18px] h-[36px] flex justify-center z-0" style="background: linear-gradient(270deg, #ADADAD 0%, rgba(196, 196, 196, 0) 93.22%);">
                    <h5 class="my-auto mr-[57px] ml-[79px] text-white font-semibold tracking-[0.1em]">PERMINTAAN REKAP</h5>
                </div>
            </div>
            <div class="flex-1 flex gap-[56px] mr-[54px]">
                <div class="flex flex-col flex-1">
            <div class="flex gap-[70px] justify-between mb-[46px]">
                <Link class="bg-[#282A39] w-full h-[44px] flex justify-center items-center rounded-[6px] border-[1px] border-[white] px-[12px]">
                    <h5 class="tracking-[0.1em] text-white font-semibold">BELUM DIEVALUASI</h5>
                </Link>
                <Link class="bg-[white] w-full h-[44px] flex justify-center items-center rounded-[6px] border-[1px] border-[white] px-[12px]">
                    <h5 class="tracking-[0.1em] text-[#282A39] font-semibold">SEDANG DIEVALUASI</h5>
                </Link>
                <Link class="bg-[white] w-full h-[44px] flex justify-center items-center rounded-[6px] border-[1px] border-[white] px-[12px]">
                    <h5 class="tracking-[0.1em] text-[#282A39] font-semibold">TELAH DIEVALUASI</h5>
                </Link>
                <Link class="bg-[white] w-full h-[44px] flex justify-center items-center rounded-[6px] border-[1px] border-[white] px-[12px]">
                    <h5 class="tracking-[0.1em] text-[#282A39] font-semibold">DITOLAK</h5>
                </Link>
            </div>
            <div class="flex-1 rounded-[18px] flex flex-col p-[43px]" style="background: linear-gradient(180deg, rgba(173, 173, 173, 0.5) -39.27%, rgba(173, 173, 173, 0) 100%);">
                <div class="flex flex-1 flex-col gap-[26px]">
                    <p class="text-white font-semibold tracking-[0.1em]">Hari ini</p>
                    <div class="h-[68px] bg-white rounded-[10px] mb-[26px] flex justify-between p-[16px]">
                        <div class="flex gap-[13px] items-center">
                            <div class="rounded-full w-[35px] h-[35px] bg-[#0075FF] border-black border-[1px]">
                            </div>
                            <div>
                                <h5 class="tracking-[0.1em] text-[14px]">REKAPITULASI (16 Maret 2023)</h5>
                                <p class="tracking-[0.1em] text-[12px]">PLTD MANDANGIN - BBM PEMAKAIAN</p>
                            </div>
                        </div>
                        <div class="flex gap-[28px] items-center mr-[6px]">
                            <i class="pi pi-eye text-[22px] text-[#282A39] hover:text-gray-400 my-auto"></i>
                            <i class="pi pi-file-edit text-[22px] text-[#4FAC16] hover:text-gray-400 my-auto"></i>
                            <i class="pi pi-trash text-[22px] text-[#E0686B] hover:text-gray-400 my-auto"></i>
                        </div>
                    </div>
                </div>
                <div class="flex flex-1 flex-col gap-[26px]">
                    <p class="text-white font-semibold tracking-[0.1em]">Kemarin</p>
                    <div class="h-[68px] bg-white rounded-[10px] mb-[26px] flex justify-between p-[16px]">
                        <div class="flex gap-[13px] items-center">
                            <div class="rounded-full w-[35px] h-[35px] bg-[#0075FF] border-black border-[1px]">
                            </div>
                            <div>
                                <h5 class="tracking-[0.1em] text-[14px]">REKAPITULASI (16 Maret 2023)</h5>
                                <p class="tracking-[0.1em] text-[12px]">PLTD MANDANGIN - BBM PEMAKAIAN</p>
                            </div>
                        </div>
                        <div class="flex gap-[28px] items-center mr-[6px]">
                            <i class="pi pi-eye text-[22px] text-[#282A39] hover:text-gray-400 my-auto"></i>
                            <i class="pi pi-file-edit text-[22px] text-[#4FAC16] hover:text-gray-400 my-auto"></i>
                            <i class="pi pi-trash text-[22px] text-[#E0686B] hover:text-gray-400 my-auto"></i>
                        </div>
                    </div>
                </div>
                <div class="flex flex-1 flex-col gap-[26px]">
                    <p class="text-white font-semibold tracking-[0.1em]">Lusa</p>
                    <div class="h-[68px] bg-white rounded-[10px] mb-[26px] flex justify-between p-[16px]">
                        <div class="flex gap-[13px] items-center">
                            <div class="rounded-full w-[35px] h-[35px] bg-[#0075FF] border-black border-[1px]">
                            </div>
                            <div>
                                <h5 class="tracking-[0.1em] text-[14px]">REKAPITULASI (16 Maret 2023)</h5>
                                <p class="tracking-[0.1em] text-[12px]">PLTD MANDANGIN - BBM PEMAKAIAN</p>
                            </div>
                        </div>
                        <div class="flex gap-[28px] items-center mr-[6px]">
                            <i class="pi pi-eye text-[22px] text-[#282A39] hover:text-gray-400 my-auto"></i>
                            <i class="pi pi-file-edit text-[22px] text-[#4FAC16] hover:text-gray-400 my-auto"></i>
                            <i class="pi pi-trash text-[22px] text-[#E0686B] hover:text-gray-400 my-auto"></i>
                        </div>
                    </div>
                </div>
            </div>
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


export default {
    components: {
        InputText,
        Dropdown,
        Calendar,
        Chart,
        Navbar,
    },
    setup(props) {
        const formState = ref({
            username: '',
        });

        const pembangkit = ref();
        const tipe_pembangkit = ref([
            { name: 'PLTS', code: 'plts' },
            { name: 'PLTD', code: 'pltd' },
        ]);

        const nama_pembangkit = ref();
        const list_pembangkit = ref([
            { name: 'PLTS', code: 'plts' },
            { name: 'PLTD', code: 'pltd' },
        ]);

        const rekapitulasi = ref();
        const tipe_rekapitulasi = ref([
            { name: 'PLTS', code: 'plts' },
            { name: 'PLTD', code: 'pltd' },
        ]);

        const date = ref();


        const chartData = ref();
        const chartOptions = ref();

        const currentData = ref(0);
        const recapitulationData = ref([
            {
                labels: ['MDG', 'GLG', 'GLY', 'SPD', 'RAAS', 'KGN', 'SPK', 'GLR', 'SPJ', 'PGRK', 'PGRB', 'MSL'],
                datasets: [
                    {
                        label: '',
                        backgroundColor: '#FFFF',
                        borderColor: '#FFFF',
                        data: [65, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56]
                    },
                ]
            },
            {
                labels: ['MDG', 'GLG', 'GLY', 'SPD', 'RAAS', 'KGN', 'SPK', 'GLR', 'SPJ', 'PGRK', 'PGRB', 'MSL'],
                datasets: [
                    {
                        label: '',
                        backgroundColor: '#FFFF',
                        borderColor: '#FFFF',
                        data: [56, 55, 40, 65, 59, 80, 81, 56, 65, 59, 80, 81]
                    },
                ]
            }
        ]);

        const setChartData = () => {
            return recapitulationData.value[currentData.value];
        };
        const setChartOptions = () => {

            return {
                maintainAspectRatio: false,
                aspectRatio: 0.8,
                plugins: {
                    legend: {
                        labels: {
                            fontColor: '#FFFF'
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: '#FFFF',
                            font: {
                                weight: 500
                            }
                        },
                        grid: {
                            display: false,
                            drawBorder: false
                        }
                    },
                    y: {
                        ticks: {
                            color: '#FFFF'
                        },
                        grid: {
                            color: '#FFFF',
                            drawBorder: false
                        }
                    }
                }
            };
        }

        chartData.value = setChartData();
        chartOptions.value = setChartOptions();

        const changeChart = (state) => {
            if (state === 'next') {
                if (currentData.value < recapitulationData.value.length - 1) {
                    currentData.value++;
                } else {
                    return 0
                }
            } else if (state === 'prev') {
                if (currentData.value > 0) {
                    currentData.value--;
                } else {
                    return 0
                }
            }
            chartData.value = setChartData();
            chartOptions.value = setChartOptions();
        }

        return {
            formState,
            pembangkit,
            tipe_pembangkit,
            nama_pembangkit,
            list_pembangkit,
            rekapitulasi,
            tipe_rekapitulasi,
            date,
            chartData,
            chartOptions,
            setChartData,
            setChartOptions,
            changeChart
        }
    }
}
</script>