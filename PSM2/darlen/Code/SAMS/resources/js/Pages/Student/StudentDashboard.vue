<template>
    <div class="h-screen relative custom-bg-color">

        <StudentSidebar />



        <div class="flex justify-center items-center mt-12 flex-col">
            <h1 class="text-2xl font-bold">
                Selamat Datang di Student Academic Management System
            </h1> <br><br><br><br><br>
            <img src="/images/logo.png" class="h-30 w-96" />
            <h1 class="text-2xl font-bold">
                Silahkan menggunakan menu navigasi di samping untuk mengakses berbagai fitur
            </h1>
        </div> <br><br><br>
        <div class="mx-[20rem] p-[2rem] flex justify-center items-center flex-row bg-slate-100 rounded-md">
            <Chart type="pie" :data="chartData" :options="chartOptions" class="w-[40rem] md:w-[30rem]" />
            <Chart type="bar" :data="chartData" :options="chartOptions" class="w-[40rem] md:w-[30rem]" />
            <Chart type="doughnut" :data="chartData" :options="chartOptions" class="w-[40rem] md:w-[30rem]" />
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
import StudentSidebar from "../../Components/StudentSidebar";
import { ref } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';   // optional
import Row from 'primevue/row';                   // optional


export default {
    components: {
        Button,
        StudentSidebar,
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
