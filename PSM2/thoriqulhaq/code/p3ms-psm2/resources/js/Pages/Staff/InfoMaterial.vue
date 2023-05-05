<template>
    <div class="bg-[url('/images/BG_P3MS.png')] bg-cover h-screen">
        <div class="pt-[39px] pb-[54px] pl-[54px] w-full h-full flex flex-col gap-[56px]">
            <Navbar />
            <div class="flex items-center">
                <Link class="rounded-full w-[43px] h-[43px] bg-[#525663] flex justify-center z-10" href="/dashboard">
                    <i class="pi pi-chevron-left text-white hover:text-gray-400 my-auto"></i>
                </Link>
                <div class="ml-[-30px] rounded-r-[18px] h-[36px] flex justify-center z-0" style="background: linear-gradient(270deg, #ADADAD 0%, rgba(196, 196, 196, 0) 93.22%);">
                    <h5 class="my-auto mr-[57px] ml-[79px] text-white font-semibold tracking-[0.1em]">INFO MATERIAL</h5>
                </div>
            </div>
            <div class="flex gap-[56px] mt-[32px]">
                <div class="flex flex-col flex-1 mr-[54px] pb-[30px] px-[30px] rounded-[30px]" style="background: linear-gradient(180deg, rgba(173, 173, 173, 0) 18.97%, rgba(173, 173, 173, 0.5) 65.62%);">
                    <DataTable :value="products" tableStyle="min-width: 50rem">
                        <Column headerClass="bg-[#282A39] text-white" field="id" header="ID"></Column>
                        <Column headerClass="bg-[#282A39] text-white" field="material" header="Material"></Column>
                        <Column headerClass="bg-[#282A39] text-white" field="jumlah" header="Jumlah"></Column>
                    </DataTable>
                </div>
                <div class="w-[302px] mr-[54px] flex flex-col gap-[32px]">
                    
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
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup'; 
import Row from 'primevue/row';   


export default {
    components: {
        InputText,
        Dropdown,
        Calendar,
        Chart,
        Navbar,
        DataTable,
        Column,
        ColumnGroup,
        Row
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
        
        const products = [
            {
                id: '1',
                material: 'Fuel Filter',
                jumlah: 24,
            },
            {
                id: '2',
                material: 'Oil Filter',
                jumlah: 24,
            },
        ]
        

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
            changeChart,
            products
        }
    }
}
</script>