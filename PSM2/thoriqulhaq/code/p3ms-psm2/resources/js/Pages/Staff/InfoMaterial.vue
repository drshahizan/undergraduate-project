<template>
    <MainLayoutStaff>
        <div class="flex-1 flex flex-col gap-[2rem] mt-[1rem]">
            <div class="flex gap-[2rem] h-[15%]">
                <div class="bg-white flex-1 rounded-[1.5rem] flex items-center">
                    <i class="pi pi-th-large mx-[2rem] text-[48px] text-[#86D277]"></i>
                    <div class="flex-1 flex flex-col justify-center mb-[0.5rem]">
                        <p class="text-[24px] font-semibold text-[#606378]">{{ info.available_material }} Material</p>
                        <p class="text-[14px] text-[#606378]">Tersedia</p>
                    </div>
                </div>
                <div class="bg-white flex-1 rounded-[1.5rem] flex items-center">
                    <i class="pi pi-th-large mx-[2rem] text-[48px] text-[#EE406D]"></i>
                    <div class="flex-1 flex flex-col justify-center mb-[0.5rem]">
                        <p class="text-[24px] font-semibold text-[#606378]">{{ info.unavailable_material }} Material</p>
                        <p class="text-[14px] text-[#606378]">Tidak tersedia</p>
                    </div>
                </div>
            </div>
            <div class="bg-white flex-1 rounded-[1.5rem] p-[0.5rem]">
                <div class="card h-full">
                    <DataTable removableSort v-model:filters="filters" :value="data" paginator :rows="5" dataKey="id" :loading="loading" class="bg-white rounded-[1rem] flex flex-col h-full" headerClass="bg-white"
                            :globalFilterFields="['description']">
                        <template #header>
                            <div class="flex justify-end">
                                <span class="p-input-icon-right">
                                    <InputText v-model="filters['global'].value" placeholder="Keyword Search" class="p-inputtext-sm border-[1.5px] border-[#F8F8F9] bg-[#F8F8F9] rounded-[0.5rem] h-[42px]"/>
                                    <i class="pi pi-search" />
                                </span>
                            </div>
                        </template>
                        <template #empty> No data found. </template>
                        <template #loading> Loading data. Please wait. </template>
                        <Column sortable field="description" header="Material" style="min-width: 12rem">
                            <template #body="{ data }">
                                {{ data.description }}
                            </template>
                        </Column>
                        <Column sortable field="quantity" header="Jumlah" style="min-width: 12rem">
                            <template #body="{ data }">
                                {{ data.quantity }}
                            </template>
                        </Column>
                        <Column sortable field="status" header="Status" style="width: 12rem">
                            <template #body="{ data }">
                                <Tag :severity="data.quantity == 0 ? 'danger' : 'success'" :value="data.quantity == 0 ? 'Tidak Tersedia' : 'Tersedia'" class="w-full"></Tag>
                            </template>
                        </Column>
                    </DataTable>
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
import Chart from 'primevue/chart';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup'; 
import Row from 'primevue/row';   
import MainLayoutStaff from '../../Layouts/Staff/MainLayout.vue';
import { FilterMatchMode } from 'primevue/api';
import Tag from 'primevue/tag';


export default {
    components: {
        InputText,
        Dropdown,
        Calendar,
        Chart,
        DataTable,
        Column,
        ColumnGroup,
        Row,
        MainLayoutStaff,
        Tag
    },
    props: {
        info: {
            type: Object,
            default: () => ({})
        },
        listData: {
            type: Array,
            default: () => []
        }
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
        
        const data = ref(props.listData);
        
        const filters = ref({
            global: { value: null, matchMode: FilterMatchMode.CONTAINS },
            name: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
            'country.name': { value: null, matchMode: FilterMatchMode.STARTS_WITH },
            representative: { value: null, matchMode: FilterMatchMode.IN },
            status: { value: null, matchMode: FilterMatchMode.EQUALS },
            verified: { value: null, matchMode: FilterMatchMode.EQUALS }
        });
        
        const statuses = ref(['unqualified', 'qualified', 'new', 'negotiation', 'renewal', 'proposal']);
        const loading = ref(false);  
        const formatDate = (value) => {
            return value.toLocaleDateString('en-US', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            });
        };
        const formatCurrency = (value) => {
            return value.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
        };
        const getSeverity = (status) => {
            switch (status) {
                case 'unqualified':
                    return 'danger';

                case 'qualified':
                    return 'success';

                case 'new':
                    return 'info';

                case 'negotiation':
                    return 'warning';

                case 'renewal':
                    return null;
            }
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
            changeChart,
            products,
            data,
            filters,
            statuses,
            loading,
            formatDate,
            formatCurrency,
            getSeverity,
        }
    }
}
</script>