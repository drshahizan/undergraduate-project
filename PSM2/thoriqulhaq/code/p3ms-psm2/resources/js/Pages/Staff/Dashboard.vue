<template>
    <div class="bg-[url('/images/BG_P3MS.png')] bg-cover h-screen">
            <div class="pt-[39px] pb-[54px] pl-[54px] w-full h-full flex flex-col gap-[56px]">
        <Navbar />
        <div class="flex flex-1 gap-[34px]">
            <div class="w-full flex flex-col">
                <h2 class="text-[32px] text-white font-semibold tracking-[0.1em] mb-[31px]">Informasi Laporan</h2>
                <div class="flex gap-[53px]">
                    <div class="mb-[32px] w-[384px]">
                        <p class="mb-[10px] font-semibold text-white tracking-[0.1em]">Tanggal Input</p>
                        <Calendar v-model="date" showIcon class="w-full h-[44px]" inputClass="p-inputtext-sm"
                            panelClass="text-[0.875rem]" placeholder="Pilih" dateFormat="dd/mm/yy" />
                </div>
                <div class="mb-[32px] w-[169px]">
                    <p class="mb-[10px] font-semibold text-white tracking-[0.1em]">Tipe Pembangkit</p>
                    <Dropdown v-model="pembangkit" :options="tipe_pembangkit" optionLabel="name" placeholder="Pilih"
                        class="w-full md:w-14rem" :inputStyle="{ 'width': '100%' }" inputClass="p-inputtext-sm"
                        panelClass="text-[0.875rem]" />
                </div>
            </div>
            <div class="card flex-1 rounded-[18px] flex justify-center"
                style="background: linear-gradient(180deg, rgba(173, 173, 173, 0) 0%, rgba(173, 173, 173, 0.5) 138.25%);">
                <div class="flex justify-between flex-1">
                    <div class="mx-[40px] my-auto" v-on:click="changeChart('prev')">
                        <i class="pi pi-chevron-left text-[48px] text-white hover:text-gray-400"></i>
                    </div>
                    <div class="flex flex-col pb-[58px]">
                        <div class="ml-[-60px] mt-[50px] mb-[30px]">
                            <h4 class="text-white text-[20px] tracking-[0.1em]">Grafik SFC <span
                                    class="text-white text-[12px] tracking-[0.1em]">({{ getStringDate() }})</span></h4>
                            <p class="text-white text-[14px] tracking-[0.1em]">PLTD</p>
                        </div>
                        <Chart type="bar" :data="chartData" :options="chartOptions" class="flex-1 min-w-[526px]" />
                    </div>
                    <div class=" mx-[40px] my-auto" v-on:click="changeChart('next')">
                        <i class="pi pi-chevron-right text-[48px] text-white hover:text-gray-400"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-[404px] flex flex-col gap-[20px] p-[30px] rounded-l-[24px]"
            style="background: linear-gradient(90deg, rgba(173, 173, 173, 0.5) 63.02%, rgba(173, 173, 173, 0) 100%);">
            <SidebarButton item="INPUT REKAP" url="/rekap/input" />
            <SidebarButton item="RIWAYAT REKAP" url="/rekap/riwayat" />
            <SidebarButton item="INFO MATERIAL" url="/info-material" />
            <SidebarButton item="UNDUH LAPORAN" url="/laporan/unduh" />
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
import SidebarButton from "../../Components/SidebarButton.vue";
import Navbar from "../../Components/Navbar.vue";


export default {
    components: {
        InputText,
        Dropdown,
        Calendar,
        Chart,
        SidebarButton,
        Navbar,
    },
    setup(props) {
        const formState = ref({
            username: '',
        });

        const pembangkit = ref({ name: 'PLTD', code: 'pltd' });
        const tipe_pembangkit = ref([
            { name: 'PLTS', code: 'plts' },
            { name: 'PLTD', code: 'pltd' },
        ]);

        const date = ref(new Date());


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

        const getStringDate = () => {
            const dateStr = date.value.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });
            const dateArr = dateStr.split('/');
            const dateFormat = new Date(dateArr[2], dateArr[1] - 1, dateArr[0]);
            const options = { day: 'numeric', month: 'long', year: 'numeric' };
            const formattedDate = dateFormat.toLocaleDateString('id-ID', options);
            return formattedDate;
        }

        return {
            formState,
            pembangkit,
            tipe_pembangkit,
            date,
            chartData,
            chartOptions,
            setChartData,
            setChartOptions,
            changeChart,
            getStringDate
        }
    }
}
</script>