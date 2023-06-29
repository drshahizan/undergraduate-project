<template>
    <TeacherLayout :page-title="'Daftar Siswa'">
        <div class="flex-1 ">
            <DataTable class="mx-[2rem]" v-model:filters="filters" paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]"
                :value="students" tableStyle="min-width: 70rem " dataKey="id" :loading="loading"
                :globalFilterFields="['semester', 'academicYear', 'name', 'country.name', 'representative.name', 'status', 'classroom_id']">
                <template #header>
                    <div class="flex justify-end items-end">
                        <Dropdown v-model="selectedacademicYear" :options="academicYears" optionLabel="name"
                            placeholder="Tahun Ajaran" class="flex-1 w-[12rem] md:w-8rem mr-6" />
                        <Dropdown v-model="selectedSemester" :options="semesters" optionLabel="name" placeholder="Semester"
                            class="flex-1 w-[10rem] md:w-8rem mr-6" />
                        <Dropdown v-model="selectedClassroom" :options="classrooms" optionLabel="grade" placeholder="Kelas"
                            class="flex-1 w-[10rem] md:w-8rem mr-6" />
                        <span class="p-input-icon-left">
                            <i class="pi pi-search" />
                            <InputText v-model="filters['global'].value" placeholder="Keyword Search" />
                        </span>
                        <Button severity="danger" class="flex-1 w-[10rem] md:w-8rem mr-6 ml-6" label="Reset Filters"
                            @click="resetFilters" />
                    </div>
                </template>
                <Column field="name" header="Nama" sortable style="min-width: 12rem">
                    <template #body="{ data }">
                        {{ data.name }}
                    </template>
                </Column>

                <Column field="nis_nisn" header="NIS/NISN" sortable style="min-width: 12rem"></Column>
                <Column field="peminatan" header="Peminatan" sortable style="min-width: 12rem"></Column>
                <Column style="min-width: 12rem" header="Action">
                    <template #body="slotProps">
                        <Button type="button" label="Lihat SPP" severity="success"
                            @click="viewTuitionDetails(slotProps.data.id)" />
                    </template>
                </Column>



            </DataTable>
        </div>
    </TeacherLayout>
</template>

<script>
import TeacherLayout from '../../Layouts/TeacherLayout.vue';
import 'primeicons/primeicons.css';
import { FilterMatchMode } from 'primevue/api';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import { ref } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';   // optional
import Row from 'primevue/row';                   // optional
import Dropdown from 'primevue/dropdown';
import { Inertia } from '@inertiajs/inertia';

export default {
    components: {
        Button,
        InputText,
        DataTable,
        Column,
        ColumnGroup,
        Row,
        TeacherLayout,
        Dropdown,

    },
    methods: {
        resetFilters() {
            this.selectedSemester = null;
            this.selectedacademicYear = null;
            this.selectedClassroom = null;
            this.filters.semester.value = null;
            this.filters.academicYear.value = null;
            this.filters.classroom_id.value = null;
            this.filters.global.value = null;
        },
        viewTuitionDetails(studentId) {
            this.$inertia.visit(`/detail-spp/${studentId}`);
        },

    },
    props: {
        students: Array,
        classrooms: Array,
    },
    setup(props) {
        const academicYears = [
            { name: '2018/2019' },
            { name: '2019/2020' },
            { name: '2020/2021' },
            { name: '2021/2022' },
            { name: '2022/2023' },
        ];

        const semesters = [
            { name: 'Ganjil' },
            { name: 'Genap' },

        ];

        const selectedSemester = ref(null);
        const selectedacademicYear = ref(null);
        const selectedClassroom = ref(null);
        const filters = ref({
            classroom_id: { value: null, matchMode: FilterMatchMode.EQUALS },
            semester: { value: null, matchMode: FilterMatchMode.CONTAINS },
            academicYear: { value: null, matchMode: FilterMatchMode.CONTAINS },
            global: { value: null, matchMode: FilterMatchMode.CONTAINS },
            name: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
            'country.name': { value: null, matchMode: FilterMatchMode.STARTS_WITH },
            representative: { value: null, matchMode: FilterMatchMode.IN },
            status: { value: null, matchMode: FilterMatchMode.EQUALS },
            verified: { value: null, matchMode: FilterMatchMode.EQUALS }
        });

        return {
            academicYears: academicYears,
            filters: filters,
            semesters: semesters,
            selectedSemester: selectedSemester,
            selectedacademicYear: selectedacademicYear,
            selectedClassroom: selectedClassroom,
        }
    },
    watch: {
        selectedSemester: function (val) {
            this.filters.semester.value = val ? val.name : null;
        },
        selectedacademicYear: function (val) {
            this.filters.academicYear.value = val ? val.name : null;
        },
        selectedClassroom: function (val) {
            this.filters.classroom_id.value = val ? val.id : null; // Change this line
        },
    },
}
</script>
