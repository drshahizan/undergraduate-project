<template>
    <TeacherLayout :page-title="'Penilaian'">
        <div class="wrapper-color rounded-lg mx-[2rem] p-[1rem] pb-[3rem]">
            <h1 class="flex-1 text-2xl font-bold text-center my-6">
                Data Siswa
            </h1>
            <div class="mt-8 mb-8">
                <div class="w-full flex justify-center ">
                    <Dropdown v-model="selectedCity" :options="cities" optionLabel="name" placeholder="Kelas"
                        class="w-[60%] mx-6" />
                    <Dropdown v-model="selectedSemester" :options="semesters" optionLabel="name" placeholder="Semester"
                        class="w-[60%] mx-6" />
                    <Dropdown v-model="selectedCity" :options="cities" optionLabel="name" placeholder="Tahun Pelajaran"
                        class="w-[60%] mx-6" />
                </div>
            </div>

            <div class="mt-8 mb-8">
                <div class="w-full flex justify-center ">
                    <Dropdown v-model="selectedCity" :options="cities" optionLabel="name" placeholder="Nama Siswa"
                        class="w-[60%] mx-6" />
                    <Dropdown v-model="selectedCity" :options="cities" optionLabel="name" placeholder="Mata Pelajaran"
                        class="w-[60%] mx-6" />
                    <Dropdown v-model="selectedCity" :options="cities" optionLabel="name" placeholder="Keterampilan"
                        class="w-[60%] mx-6" />
                </div>
            </div>

            <br>

            <div class="mt-8 mb-8">
                <div class="w-full flex justify-center ">

                    <InputText class="w-[38%] mx-6" id="username" v-model="value" placeholder="KKM" />
                    <InputText class="w-[38%] mx-6" id="username" v-model="value" placeholder="Nilai" />

                </div>
            </div>
            <br>
            <div class="mt-8 mb-8">
                <div class="mt-4 w-full flex justify-center">
                    <Textarea v-model="value" rows="5" placeholder="Deskripsi" class="w-[80%]">
                                                                                                                </Textarea>
                </div>
            </div>
        </div>
    </TeacherLayout>
</template>


<script >
import Textarea from 'primevue/textarea';
import Dropdown from 'primevue/dropdown';
import 'primeicons/primeicons.css';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import TeacherLayout from '../../Layouts/TeacherLayout.vue';
import { ref } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';   // optional
import Row from 'primevue/row';                       // optional


export default {
    components: {
        Textarea,
        Dropdown,
        Button,
        TeacherLayout,
        InputText,
        DataTable,
        Column,
        ColumnGroup,
        Row,
    },

    setup(props) {
        const visible = ref(false);
        const semesters = [
            { name: 'Ganjil' },
            { name: 'Genap' },

        ];
        return {
            visible: visible,
            semesters: semesters,

        }
    }
}
</script>
