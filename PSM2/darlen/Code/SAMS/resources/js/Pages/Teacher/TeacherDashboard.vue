<template>
    
    <div class="h-screen relative custom-bg-color">
        
        <TeacherSidebar/>  

        

        <div class="flex justify-center items-center mt-12 flex-col">
        <h1 class="text-2xl font-bold mb-4">
            Selamat Datang di Student Academic Management System
        </h1> 
        <img src="/images/logo.png" class="h-30 w-96 mb-4" />
        <h1 class="text-2xl font-bold">
            Silahkan menggunakan menu navigasi di samping untuk mengakses berbagai fitur 
        </h1>
        </div> <br><br><br>
        <div class="flex flex-row mx-[2rem] p-[1rem]">
        <div class="mx-[4rem] p-[1rem] flex justify-start items-start flex-1 bg-green-200 rounded-lg">
                <Chart type="pie" :data="chartData" :options="chartOptions" class="w-[40rem] md:w-[20rem]" />
               
             
            </div>
              <div class="mx-[4rem] p-[2rem] flex justify-center items-center flex-1 bg-green-200 rounded-lg">
                    
                          <Chart type="doughnut" :data="chartData" :options="chartOptions" class="w-[40rem] md:w-[20rem]" />
                   
                    </div>
        <div class="mx-[4rem] p-[2rem] flex justify-center items-center flex-1 bg-green-200 rounded-lg">
                    
                    <Chart type="bar" :data="chartData" :options="chartOptions" class="w-[40rem] md:w-[20rem]" />
                   
                </div>
                </div>
    </div>
</template>

<script >
import Chart from 'primevue/chart';
import Divider from 'primevue/divider';
import Menubar from 'primevue/menubar';
import 'primeicons/primeicons.css';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import TeacherSidebar from "../../Components/TeacherSidebar";
import { ref } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';   // optional
import Row from 'primevue/row';                   // optional


export default {
    components: {
        Button,
        TeacherSidebar,
        InputText,
        Divider,
        DataTable,
        Column,
        ColumnGroup,
        Row,
        Menubar,
        Chart,  
    },
    
    setup(props) {
        const visible = ref(true); 
       const chartData = ref();
        const chartOptions = ref({
            plugins: {
                legend: {
                    labels: {
                        usePointStyle: true
                    }
                }
            }
        });

        const setChartData = () => {

            return {
                labels: ['Student', 'Teacher', 'Class'],
                datasets: [
                    {
                        data: [540, 325, 702],
                        backgroundColor: ["blue", "yellow", "green"],
                        hoverBackgroundColor: ["blue", "yellow", "green"]
                    }
                ]
            };
        };

        chartData.value = setChartData();
        

        return {
            visible: visible,
            chartData: chartData,
            chartOptions: chartOptions,
            setChartData: setChartData

            
        }
    }
}
</script>
