<template>
    <MainLayoutStaff>
        <div class="flex-1 flex flex-col gap-[32px] mt-[1rem]">
            <div class="flex-1 flex gap-[32px]">
                <div class="flex flex-col flex-1 gap-[32px]">
                    <div class="flex flex-1 gap-[32px]">
                        <div class=" bg-[#5CA7FC] flex-1 rounded-[1.5rem] flex flex-col drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)] relative">
                            <div class="flex items-end gap-[1rem] flex-1 px-[1.5rem] pt-1.5rem bg-white rounded-t-[1.25rem]">
                                <p class="text-[68px] font-semibold text-[#5CA7FC]">{{ data.info_1.total_created_recap }}</p>
                            </div>
                            <i class="text-[68px] text-[#EEF7FE] pi pi-file absolute top-[1.5rem] right-[1rem]"></i>
                            <div class="flex-1 px-[1.5rem] b-white rounded-b-[0.75rem] bg-white ">
                                <p v-if="$page.props.user.user_type == 'Staff Operator'" class="text-[18px] font-semibold text-[#5CA7FC] mb-[0.75rem]">Telah Dibuat</p>
                                <p v-if="$page.props.user.user_type == 'Staff PIC'" class="text-[18px] font-semibold text-[#5CA7FC] mb-[0.75rem]">Telah Masuk</p>
                            </div>
                            <div class="h-[1.5rem] bg-[#5CA7FC] rounded-b-[1.25rem]">
                                
                            </div>
                        </div>
                        <div class=" bg-[#E88E35] flex-1 rounded-[1.5rem] flex flex-col drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)] relative">
                            <div class="flex items-end gap-[1rem] flex-1 px-[1.5rem] pt-1.5rem bg-white rounded-t-[1.25rem]">
                                <p class="text-[68px] font-semibold text-[#E88E35]">{{ data.info_1.total_on_progress_evaluate_recap }}</p>
                            </div>
                            <i class="text-[68px] text-[#FDF2E9] pi pi-file-edit absolute top-[1.5rem] right-[1rem]"></i>
                            <div class="flex-1 px-[1.5rem] b-white rounded-b-[0.75rem] bg-white ">
                                <p class="text-[18px] font-semibold text-[#E88E35] mb-[0.75rem]">Sedang Dievaluasi</p>
                            </div>
                            <div class="h-[1.5rem] bg-[#E88E35] rounded-b-[1.25rem]">
                                
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-1 gap-[32px]">
                        <div class=" bg-[#77CC66] flex-1 rounded-[1.5rem] flex flex-col drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)] relative">
                            <div class="flex items-end gap-[1rem] flex-1 px-[1.5rem] pt-1.5rem bg-white rounded-t-[1.25rem]">
                                <p class="text-[68px] font-semibold text-[#77CC66]">{{ data.info_1.total_approved_recap }}</p>
                            </div>
                            <i class="text-[68px] text-[#ECFAEB] pi pi-check absolute top-[1.5rem] right-[1rem]"></i>
                            <div class="flex-1 px-[1.5rem] b-white rounded-b-[0.75rem] bg-white ">
                                <p class="text-[18px] font-semibold text-[#77CC66] mb-[0.75rem]">Telah Disetujui</p>
                            </div>
                            <div class="h-[1.5rem] bg-[#77CC66] rounded-b-[1.25rem]">
                                
                            </div>
                        </div>
                        <div class=" bg-[#F1416C] flex-1 rounded-[1.5rem] flex flex-col drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)] relative">
                            <div class="flex items-end gap-[1rem] flex-1 px-[1.5rem] pt-1.5rem bg-white rounded-t-[1.25rem]">
                                <p class="text-[68px] font-semibold text-[#F1416C]">{{ data.info_1.total_rejected_recap }}</p>
                            </div>
                            <i class="text-[68px] text-[#FEF5F9] pi pi-times absolute top-[1.5rem] right-[1rem]"></i>
                            <div class="flex-1 px-[1.5rem] b-white rounded-b-[0.75rem] bg-white ">
                                <p class="text-[18px] font-semibold text-[#F1416C] mb-[0.75rem]">Telah Ditolak</p>
                            </div>
                            <div class="h-[1.5rem] bg-[#F1416C] rounded-b-[1.25rem]">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div  class="gap-[2.5rem] bg-white rounded-[1.5rem] p-[1.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)] flex-1 items-center flex">
                    <div class="relative">
                        <div class="absolute w-full h-full top-1 left-0 flex flex-col justify-center items-center pb-[0.75rem]">
                            <p class="text-[48px] font-semibold text-[#606279]">{{ data.info_2.total_recap }}</p>
                            <p class="text-[16px] text-[#B4B5C2]">Rekap PLTD</p>
                        </div>
                        <Chart type="doughnut" :data="doughnutChartData" :options="doughnutChartOptions" class="max-w-[300px]" />
                    </div>
                    <div class="flex flex-col justify-center gap-[6px]">
                        <div class="flex gap-[1rem] items-center">
                            <div class="bg-[#5DA7FD] h-[0.5rem] w-[1rem] rounded-[0.25rem]">
                            </div>
                            <p class="text-[14px] text-[#B4B5C2]">BBM Pemakaian</p>
                        </div>  
                        <div class="flex gap-[1rem] items-center">
                            <div class="bg-[#E88E35] h-[0.5rem] w-[1rem] rounded-[0.25rem]">
                            </div>
                            <p class="text-[14px] text-[#B4B5C2]">BBM Stok</p>
                        </div> 
                        <div class="flex gap-[1rem] items-center">
                            <div class="bg-[#76CD66] h-[0.5rem] w-[1rem] rounded-[0.25rem]">
                            </div>
                            <p class="text-[14px] text-[#B4B5C2]">Beban</p>
                        </div> 
                        <div class="flex gap-[1rem] items-center">
                            <div class="bg-[#F1416C] h-[0.5rem] w-[1rem] rounded-[0.25rem]">
                            </div>
                            <p class="text-[14px] text-[#B4B5C2]">Fast Moving</p>
                        </div> 
                        <div class="flex gap-[1rem] items-center">
                            <div class="bg-[#B392DD] h-[0.5rem] w-[1rem] rounded-[0.25rem]">
                            </div>
                            <p class="text-[14px] text-[#B4B5C2]">Gangguan</p>
                        </div> 
                        <div class="flex gap-[1rem] items-center">
                            <div class="bg-[#FFD628] h-[0.5rem] w-[1rem] rounded-[0.25rem]">
                            </div>
                            <p class="text-[14px] text-[#B4B5C2]">HAR Realisasi</p>
                        </div> 
                        <div class="flex gap-[1rem] items-center">
                            <div class="bg-[#5AC3A7] h-[0.5rem] w-[1rem] rounded-[0.25rem]">
                            </div>
                            <p class="text-[14px] text-[#B4B5C2]">HAR Rencana</p>
                        </div> 
                        <div class="flex gap-[1rem] items-center">
                            <div class="bg-[#F6A8B9] h-[0.5rem] w-[1rem] rounded-[0.25rem]">
                            </div>
                            <p class="text-[14px] text-[#B4B5C2]">KWH</p>
                        </div> 
                        <div class="flex gap-[1rem] items-center">
                            <div class="bg-[#A2A2A3] h-[0.5rem] w-[1rem] rounded-[0.25rem]">
                            </div>
                            <p class="text-[14px] text-[#B4B5C2]">Pelumas</p>
                        </div> 
                    </div>
                </div>
            </div>
            <div v-on:mouseenter="isHovering = true" v-on:mouseleave="isHovering = false" class="bg-white flex-1 flex gap-[25px] rounded-[1.5rem] p-[1.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)]">
                <div class="flex-1">
                    <p class="font-semibold text-[24px] mb-[1rem]">Filter</p>
                    <p class="text-[14px] text-[#B4B5C2] my-[0.75rem]">Tanggal Input : </p>
                    <Calendar v-model="date" showIcon class="w-full h-[44px] border-[1.5px] border-[#F8F8F9] rounded-[0.5rem]" inputClass="p-inputtext-sm bg-[#F8F8F9]"
                    panelClass="text-[0.875rem]" placeholder="Pilih" dateFormat="dd/mm/yy" />
                    <p class="text-[14px] text-[#B4B5C2] my-[0.75rem]">Tipe Pembangkit : </p>
                    <Dropdown v-model="pembangkit" :options="tipe_pembangkit" optionLabel="name" placeholder="Pilih"
                    class="w-full md:w-14rem border-[1.5px] border-[#F8F8F9] bg-[#F8F8F9] rounded-[0.5rem]" :inputStyle="{ 'width': '100%' }" inputClass="p-inputtext-sm"
                    panelClass="text-[0.875rem]" />
                </div>
                <div class="h-full ml-[0.25rem]">
                    <div class="h-full flex bg-[#F8F8F9] border-[#F4F5F4] border-[1px] p-[2rem] rounded-[1.5rem]">
                        <div class="mr-[3rem] flex flex-col">
                            <div class="flex-1">
                                <p class="font-semibold text-[18px]">Grafik {{ data.info_3.chart[currentData].name }}</p>
                                <p class="text-[12px] text-[#B9BAC2]">11 Januari 2023</p>
                            </div>
                            <div>
                                <p class="bg-white rounded-[1rem] w-[5rem] h-[5rem] flex items-center justify-center text-[#F8F8F9] text-[54px] font-semibold">1</p>
                            </div>
                        </div>
                        <Chart type="bar" :data="barChartData" :options="barChartOptions" class="h-full min-w-[400px]" />
                    </div>
                </div>
                <div class="flex flex-col gap-[0.75rem] justify-center items-center mx-[0.25rem]">
                    <template v-for="(item, index) in data.info_3.chart" :key="index">
                        <div v-on:click="currentData = index" :class="currentData == index ? 'bg-[#757C85]' : 'bg-[#F8F8F9]'" class="w-[0.9rem] h-[0.9rem] rounded-full"> 
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </MainLayoutStaff>
</template>

<script>
import { ref, onMounted } from "vue";
import InputText from 'primevue/inputtext';
import Dropdown from 'primevue/dropdown';
import Calendar from 'primevue/calendar';
import Chart from 'primevue/chart';
import MainLayoutStaff from '../../Layouts/Staff/MainLayout.vue';

export default {
    components: {
        InputText,
        Dropdown,
        Calendar,
        Chart,
        MainLayoutStaff
    },
    props: {
        data: {
            type: Object,
            default: () => ({})
        }
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


        const barChartData = ref();
        const barChartOptions = ref();
        
        const doughnutChartData = ref();
        const doughnutChartOptions = ref({
            cutout: '60%',
            plugins: {
                legend: {
                    display: false,
                }
            }
        });

        const currentData = ref(0);
        const isHovering = ref(false);

        onMounted(() => {
            setInterval(() => {
                if (!isHovering.value && currentData.value < props.data.info_3.chart.length - 1) {
                    currentData.value++;
                } else {
                    currentData.value = 0;
                }
            }, 10000);
        });
    
        const recapitulationData = ref([
            {
                labels: props.data.info_3.chart[currentData.value].label,
                datasets: [
                    {
                        backgroundColor: ['#5CA7FC','#E88E35','#77CC66','#F1416C','#B293DD'],
                        borderColor: ['#5CA7FC','#E88E35','#77CC66','#F1416C','#B293DD'],
                        data: props.data.info_3.chart[currentData.value].data,
                        borderRadius: 11
                    },
                ]
            },
        ]);

        const setBarChartData = () => {
            return recapitulationData.value[currentData.value];
        };
        const setBarChartOptions = () => {

            return {
                maintainAspectRatio: false,
                aspectRatio: 0.8,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: '#BFC3CF',
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
                            color: '#BFC3CF'
                        },
                        grid: {
                            color: '#BFC3CF',
                            drawBorder: false
                        }
                    }
                }
            };
        }
        
        const setDoughnutChartData = () => {
            return {
                labels: props.data.info_2.chart.label,
                datasets: [
                    {
                        data: props.data.info_2.chart.data,
                        backgroundColor: ['#5CA7FC', '#E88E35', '#77CC66', '#F1416C', '#B293DD', '#FFD700', '#59C3A7', '#F7A8B8', '#A3A3A3'],
                        hoverBackgroundColor: ['#5CA7FC', '#E88E35', '#77CC66', '#F1416C', '#B293DD', '#FFD700', '#59C3A7', '#F7A8B8', '#A3A3A3'],
                        borderRadius: 11                        
                    }
                ]
            };
        };

        barChartData.value = setBarChartData();
        barChartOptions.value = setBarChartOptions();
        
        doughnutChartData.value = setDoughnutChartData();

        const changeBarChart = (state) => {
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
            barChartData.value = setBarChartData();
            barChartOptions.value = setBarChartOptions();
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
            barChartData,
            barChartOptions,
            setBarChartData,
            setBarChartOptions,
            changeBarChart,
            getStringDate,
            doughnutChartData,
            doughnutChartOptions,
            currentData,
            isHovering
        }
    }
}
</script>