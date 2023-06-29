
<template>
    <AdminLayout :page-title="'Dashboard'">
        <div
            class="flex-1 mb-[4rem] mx-[2rem] p-[1rem] flex justify-center items-center flex-col  rounded-lg wrapper-color">
            <h1 class="text-2xl font-bold mb-4">
                Selamat Datang di Student Academic Management System
            </h1>
            <img src="/images/logo.png" class="h-[5rem] w-[20rem] mb-4" />
            <h1 class="text-2xl font-bold">
                Silahkan menggunakan menu navigasi di samping untuk mengakses berbagai fitur
            </h1>
        </div> <br><br><br>

        <div class="flex flex-row ">

            <div class="mx-[2rem] p-[2rem] flex justify-center items-center flex-1 wrapper-color rounded-lg flex-col">

                <Chart type="pie" :data="chartData" :options="chartOptions" class=" md:w-[20rem]" />


            </div>
            <div class="mx-[2rem] p-[2rem] flex justify-center items-center flex-1 wrapper-color rounded-lg">

                <Chart type="doughnut" :data="chartData" :options="chartOptions" class="md:w-[20rem]" />

            </div>

            <div class="mx-[2rem] p-[2rem] flex justify-center items-center flex-1 wrapper-color rounded-lg">

                <Chart type="bar" :data="chartData" :options="chartOptions" class=" md:w-[20rem]" />

            </div>
        </div>
    </AdminLayout>
</template>

<script>
import AdminLayout from '../../Layouts/AdminLayout.vue';
import Chart from 'primevue/chart';
import { ref } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';   // optional
import Row from 'primevue/row';                   // optional


export default {
    components: {
        AdminLayout,
        DataTable,
        Column,
        ColumnGroup,
        Row,
        Chart,
    },

    setup(props) {
        const visible = ref(true);
        const chartData = ref();
        const chartOptions = ref({
            plugins: {
                legend: {
                    labels: {
                        usePointStyle: true,
                        color: '#000000'
                    }
                }
            }
        });

        const setChartData = () => {

            return {
                labels: ['Student', 'Teacher', 'Admin'],
                datasets: [
                    {
                        data: [540, 325, 702],
                        backgroundColor: ["blue", "yellow", "green"],
                        hoverBackgroundColor: ["blue", "yellow", "green"],
                        borderWidth: 0
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
