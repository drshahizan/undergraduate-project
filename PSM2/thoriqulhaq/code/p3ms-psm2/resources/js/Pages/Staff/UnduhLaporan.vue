<template>
    <div class="bg-[url('/images/BG_P3MS.png')] bg-cover h-screen">
        <div class="pt-[39px] pb-[54px] pl-[54px] w-full h-full flex flex-col gap-[56px]">
            <Navbar />
            <div class="flex items-center">
                <Link class="rounded-full w-[43px] h-[43px] bg-[#525663] flex justify-center z-10" href="/dashboard">
                    <i class="pi pi-chevron-left text-white hover:text-gray-400 my-auto"></i>
                </Link>
                <div class="ml-[-30px] rounded-r-[18px] h-[36px] flex justify-center z-0" style="background: linear-gradient(270deg, #ADADAD 0%, rgba(196, 196, 196, 0) 93.22%);">
                    <h5 class="my-auto mr-[57px] ml-[79px] text-white font-semibold tracking-[0.1em]">UNDUH LAPORAN</h5>
                </div>
            </div>
            <div class="flex-1 flex gap-[56px]">
                <div class="flex flex-col flex-1 mr-[54px]">
                    <div class="flex gap-[53px]">
                        <div class="mb-[32px] min-w-[168px] w-full max-w-[400px]">
                            <p class="mb-[10px] font-semibold text-white tracking-[0.1em]">Tipe Pembangkit</p>
                            <Dropdown v-model="pembangkit" :options="tipe_pembangkit" optionLabel="name" placeholder="Pilih"
                                class="w-full md:w-14rem" :inputStyle="{ 'width': '100%' }" inputClass="p-inputtext-sm"
                                panelClass="text-[0.875rem]" />
                        </div>
                        <div class="mb-[32px] min-w-[168px] w-full max-w-[400px]">
                            <p class="mb-[10px] font-semibold text-white tracking-[0.1em]">Nama Pembangkit</p>
                            <Dropdown v-model="nama_pembangkit" :options="list_pembangkit" optionLabel="name" placeholder="Pilih"
                                class="w-full md:w-14rem" :inputStyle="{ 'width': '100%' }" inputClass="p-inputtext-sm"
                                panelClass="text-[0.875rem]" />
                        </div>
                    </div>
                    <div class="flex gap-[53px]">
                        <div class="mb-[32px] min-w-[168px] w-full max-w-[400px]">
                            <p class="mb-[10px] font-semibold text-white tracking-[0.1em]">Tanggal Mulai</p>
                            <Calendar v-model="date_start" showIcon class="w-full h-[44px]" inputClass="p-inputtext-sm"
                                panelClass="text-[0.875rem]" placeholder="Pilih" dateFormat="dd/mm/yy" />
                        </div>
                        <div class="mb-[32px] min-w-[168px] w-full max-w-[400px]">
                            <p class="mb-[10px] font-semibold text-white tracking-[0.1em]">Tanggal Akhir</p>
                            <Calendar v-model="date_end" showIcon class="w-full h-[44px]" inputClass="p-inputtext-sm"
                                panelClass="text-[0.875rem]" placeholder="Pilih" dateFormat="dd/mm/yy" />
                        </div>
                    </div>
                    <div class="flex gap-[53px]">
                        <div class="mb-[32px] min-w-[168px] w-full max-w-[400px]">
                            <p class="mb-[10px] font-semibold text-white tracking-[0.1em]">Tipe Laporan</p>
                            <Dropdown v-model="laporan" :options="tipe_laporan" optionLabel="name" placeholder="Pilih"
                                class="w-full md:w-14rem" :inputStyle="{ 'width': '100%' }" inputClass="p-inputtext-sm"
                                panelClass="text-[0.875rem]" />
                        </div>
                    </div>
                    <div class="flex gap-[53px] mt-[100px]">
                        <Link class="bg-[white] w-full max-w-[400px] h-[44px] flex justify-between items-center rounded-[6px] border-[1px] border-[#282A39] px-[12px]">
                            <i class="pi pi-eye text-[#282A39] mr-[12px]"></i>
                            <h5 class="tracking-[0.1em] text-[#282A39]">Pratinjau</h5>
                            <div class="m-[12px]"></div>
                        </Link>
                        <Link class="bg-[#282A39] w-full max-w-[400px] h-[44px] flex justify-between items-center rounded-[6px] border-[1px] border-[white] px-[12px]">
                            <i class="pi pi-download text-white mr-[12px]"></i>
                            <h5 class="tracking-[0.1em] text-white">Unduh</h5>
                            <div class="m-[12px]"></div>
                        </Link>
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

        const laporan = ref();
        const tipe_laporan = ref([
            { name: 'PLTS', code: 'plts' },
            { name: 'PLTD', code: 'pltd' },
        ]);

        const date_start = ref();
        const date_end = ref();


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
            laporan,
            tipe_laporan,
            date_start,
            date_end,
            chartData,
            chartOptions,
            setChartData,
            setChartOptions,
            changeChart
        }
    }
}
</script>