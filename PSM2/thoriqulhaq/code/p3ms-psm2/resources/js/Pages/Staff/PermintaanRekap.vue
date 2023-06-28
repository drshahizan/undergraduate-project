<template>
    <MainLayoutStaff>
        <div class="bg-white flex-1 rounded-[1.5rem] p-[0.5rem] mt-[1rem]">
            <div class="card h-full">
                <DataTable removableSort v-model:filters="filters" :value="data" paginator :rows="6" dataKey="id" :loading="loading" class="bg-white rounded-[1rem] flex flex-col h-full" headerClass="bg-white"
                        :globalFilterFields="['recapitulation_type', 'status']">
                    <template #header>
                        <div class="flex justify-end">
                            <span class="p-input-icon-right">
                                <InputText v-model="filters['global'].value" placeholder="Keyword Search" class="p-inputtext-sm border-[1.5px] border-[#F8F8F9] bg-[#F8F8F9] rounded-[0.5rem] h-[42px]"/>
                                <i class="pi pi-search" />
                            </span>
                        </div>
                    </template>
                    <template #empty>
                        <div class="flex justify-center items-center">
                            <p class="italic text-[#A7ACB0]">Data tidak ditemukan</p>
                        </div>
                    </template>
                    <template #loading>
                        <div class="flex justify-center items-center">
                            <p class="italic text-[#A7ACB0]">Sedang memuat data, harap tunggu</p>
                        </div>
                    </template>
                    <Column sortable field="power_plant_name" header="Pembangkit" style="min-width: 12rem">
                        <template #body="{ data }">
                            {{ data.power_plant_name }}
                        </template>
                    </Column>
                    <Column sortable field="recapitulation_type" header="Tipe Rekap" style="min-width: 12rem">
                        <template #body="{ data }">
                            {{ data.recapitulation_type }}
                        </template>
                    </Column>
                    <Column sortable field="date_time" header="Tanggal" style="min-width: 12rem">
                        <template #body="{ data }">
                            {{ formatReadableDate(data.date_time) }}
                        </template>
                    </Column>
                    <Column sortable field="status" header="Status" dataType="boolean" style="width: 12rem">
                        <template #body="{ data }">
                            <Tag :severity="getSeverityStatus(data.status)" :value="data.status" class="w-full"></Tag>
                        </template>
                    </Column>
                    <Column field="aksi" header="Aksi" style="width: 6rem">
                        <template #body="{ data }">
                            <div class="flex justify-center items-center">
                                <Link :href="'/rekap/evaluasi/' + data.id">
                                    <div class="py-[0.5rem] px-[1rem] flex justify-center items-center bg-[#14A3B8] rounded-[0.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)]">
                                        <p class="text-white text-[14px]">Evaluasi</p>
                                    </div>
                                </Link>
                            </div>
                        </template>
                    </Column>
                </DataTable>
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
import MainLayoutStaff from '../../Layouts/Staff/MainLayout.vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup'; 
import Row from 'primevue/row';
import { FilterMatchMode } from 'primevue/api';
import Tag from 'primevue/tag';


export default {
    components: {
        InputText,
        Dropdown,
        Calendar,
        Chart,
        MainLayoutStaff,
        DataTable,
        Column,
        ColumnGroup,
        Row,
        Tag
    },
    props: {
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

        const formatReadableDate = (value) => {
            const date = new Date(value);
            const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
            const formatter = new Intl.DateTimeFormat('id-ID', options);
            const formattedDate = formatter.format(date);
            
            return formattedDate;
        }
        
        const getSeverityStatus = (status) => {
            switch (status) {
                case 'Disetujui':
                    return 'success';

                case 'Ditolak':
                    return 'danger';

                case 'Dievaluasi':
                    return 'warning';
                case 'Dibuat':
                    return 'info';
            }
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
            changeChart,
            currentData,
            recapitulationData, 
            data,
            filters,
            statuses,
            loading,
            formatDate,
            formatCurrency,
            getSeverity,
            formatReadableDate,
            getSeverityStatus
        }
    }
}
</script>