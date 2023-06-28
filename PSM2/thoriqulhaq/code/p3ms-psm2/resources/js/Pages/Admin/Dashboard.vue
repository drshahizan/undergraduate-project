<template>
    <MainLayoutAdmin>
        <div class="flex justify-between items-center mb-[2rem]">
            <div class="flex flex-col">
                <p class="text-[#191D32] font-semibold text-[18px]">Dashboard</p>
                <!-- <p class="text-[12px]">Pengguna Staff</p> -->
            </div>
            <div>
                <!-- <div class="py-[0.5rem] px-[1rem] flex justify-center items-center bg-[#14A3B8] rounded-[0.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)]">
                    <p class="text-white text-[14px]">Tambah Akun</p>
                </div> -->
            </div>
        </div>
        <div class="flex flex-col flex-1 gap-[32px]">
            <div class="flex gap-[32px] flex-1">
                <div class="flex flex-col gap-[32px] flex-1">
                    <div class="flex-1 gap-[2rem] flex items-center bg-white rounded-[1.5rem] p-[1.5rem]">
                        <img src="/images/avatar/avatar_2.png" alt="Staff PIC" class="w-[100px] h-[100px]" />
                        <div class="flex flex-col mt-[0.75rem]">
                            <p class="text-[#BFC3CF] font-semibold">Staff PIC</p>
                            <p class="text-[48px] font-semibold text-[#616379]">{{ data.info_1.total_staff_pic }}</p>
                        </div>
                    </div>
                    <div class="flex-1 gap-[2rem] flex items-center bg-white rounded-[1.5rem] p-[1.5rem]">
                        <img src="/images/avatar/avatar_3.png" alt="Staff Operator" class="w-[100px] h-[100px]" />
                        <div class="flex flex-col mt-[0.75rem]">
                            <p class="text-[#BFC3CF] font-semibold">Staff Operator</p>
                            <p class="text-[48px] font-semibold text-[#616379]">{{ data.info_1.total_staff_operator }}</p>
                        </div>
                    </div>
                </div>
                <div class="flex-1 bg-white rounded-[1.5rem] flex flex-col">
                    <p class="my-[1.5rem] font-semibold text-[#616379] text-center">Info Material PLTS</p>
                    <div class="mb-[1.5rem] mx-[1.5rem] h-full">
                        <Chart type="bar" :data="barChartPLTSData" :options="barChartPLTSOptions" class="w-full h-full" />
                    </div>
                </div>
            </div>
            <div class="flex gap-[32px] flex-1">
                <div class="flex-1 bg-white rounded-[1.5rem] flex flex-col">
                    <p class="my-[1.5rem] font-semibold text-[#616379] text-center">Info Material PLTD</p>
                    <div class="mb-[1.5rem] mx-[1.5rem] h-full">
                        <Chart type="bar" :data="barChartPLTDData" :options="barChartPLTDOptions" class="w-full h-full" />
                    </div>
                </div>
                <div class="flex gap-[32px] flex-1">
                    <div class=" bg-[#F1416C] flex flex-col flex-1 rounded-[1.5rem] relative">
                        <img width="96" height="96" src="https://img.icons8.com/sf-regular/96/F97D95/city-buildings.png" alt="city-buildings" class="absolute top-[2rem] right-[1rem]"/>
                        <div class="flex justify-center items-center gap-[1rem] flex-1 rounded-b-[0.75rem] px-[1.5rem] pt-1.5rem bg-white rounded-t-[1.25rem]">
                            <p class="text-[84px] font-semibold text-[#F1416C] mt-[8rem]">{{ data.info_4.total_unit }}</p>
                        </div>
                        <div class="flex-1 px-[1rem] mx-[1rem] absolute top-[3rem] left-[0rem]">
                            <p class="text-[18px] font-semibold text-[#F1416C] mb-[0.75rem]">Jumlah <br> Unit</p>
                        </div>
                        <div class="h-[1.5rem] bg-[#F1416C] rounded-b-[1.25rem]">
                            
                        </div>
                    </div>
                    <div class=" bg-[#E88F34] flex flex-col flex-1 rounded-[1.5rem] relative">
                        <img width="96" height="96" src="https://img.icons8.com/sf-regular/96/F5B885/power-plant.png" alt="city-buildings" class="absolute top-[2rem] right-[1rem]"/>
                        <div class="flex justify-center items-center gap-[1rem] flex-1 rounded-b-[0.75rem] px-[1.5rem] pt-1.5rem bg-white rounded-t-[1.25rem]">
                            <p class="text-[84px] font-semibold text-[#E88F34] mt-[8rem]">{{ data.info_4.total_power_plant }}</p>
                        </div>
                        <div class="flex-1 px-[1rem] mx-[1rem] absolute top-[3rem] left-[0rem]">
                            <p class="text-[18px] font-semibold text-[#E88F34] mb-[0.75rem]">Jumlah <br> Pembangkit</p>
                        </div>
                        <div class="h-[1.5rem] bg-[#E88F34] rounded-b-[1.25rem]">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MainLayoutAdmin>
</template>

<script>
import { ref } from "vue";
import MainLayoutAdmin from '../../Layouts/Admin/MainLayout.vue';
import Chart from 'primevue/chart';

export default {
    components: {
        MainLayoutAdmin,
        Chart
    },
    props: {
        data: {
            type: Object,
            default: () => ({})
        },
    },
    setup(props) {
        const barChartPLTDData = ref();
        const barChartPLTDOptions = ref();
        
        const materialPLTDData = ref(
            {
                labels: props.data.info_3.chart_info_material_pltd.label,
                datasets: [
                    {
                        label: 'Tersedia',
                        backgroundColor: ['#5CA7FC','#E88E35','#77CC66','#F1416C','#B293DD'],
                        borderColor: ['#5CA7FC','#E88E35','#77CC66','#F1416C','#B293DD'],
                        data: props.data.info_3.chart_info_material_pltd.data.tersedia,
                        borderRadius: 11
                    },
                    {
                        label: 'Tidak Tersedia',
                        backgroundColor: ['#A9D7FF', '#F5B885', '#A4DCAA', '#F97D95', '#D6C9E4'],
                        borderColor: ['#A9D7FF', '#F5B885', '#A4DCAA', '#F97D95', '#D6C9E4'],
                        data: props.data.info_3.chart_info_material_pltd.data.tidak_tersedia,
                        borderRadius: 11
                    },
                ]
            }
        );
        const setbarChartPLTDData = () => {
            return materialPLTDData.value;
        };
        const setbarChartPLTDOptions = () => {
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
                    stacked: true,
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
                    stacked: true,
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
        
        barChartPLTDData.value = setbarChartPLTDData();
        barChartPLTDOptions.value = setbarChartPLTDOptions();
        
        const barChartPLTSData = ref();
        const barChartPLTSOptions = ref();
        
        const materialPLTSData = ref(
            {
                labels: props.data.info_2.chart_info_material_plts.label,
                datasets: [
                    {
                        label: 'Tersedia',
                        backgroundColor: ['#5CA7FC','#E88E35','#77CC66','#F1416C','#B293DD'],
                        borderColor: ['#5CA7FC','#E88E35','#77CC66','#F1416C','#B293DD'],
                        data: props.data.info_2.chart_info_material_plts.data.tersedia,
                        borderRadius: 11
                    },
                    {
                        label: 'Tidak Tersedia',
                        backgroundColor: ['#A9D7FF', '#F5B885', '#A4DCAA', '#F97D95', '#D6C9E4'],
                        borderColor: ['#A9D7FF', '#F5B885', '#A4DCAA', '#F97D95', '#D6C9E4'],
                        data: props.data.info_2.chart_info_material_plts.data.tidak_tersedia,
                        borderRadius: 11
                    },
                ]
            }
        );
        const setbarChartPLTSData = () => {
            return materialPLTSData.value;
        };
        const setbarChartPLTSOptions = () => {
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
                    stacked: true,
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
                    stacked: true,
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
        
        barChartPLTSData.value = setbarChartPLTSData();
        barChartPLTSOptions.value = setbarChartPLTSOptions();
        
        return {
            barChartPLTDData,
            barChartPLTDOptions,
            barChartPLTSData,
            barChartPLTSOptions,
        }
    }
}
</script>