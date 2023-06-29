<template>
    <TeacherLayout :page-title="'Absensi'">
        <DataTable class="mx-[2rem]" v-model:filters="filters" paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]"
            :value="students" tableStyle="min-width: 70rem " dataKey="id" :loading="loading"
            :globalFilterFields="['classroom_id', 'name', 'country.name', 'representative.name', 'status']">

            <template #header>
                <div class="flex justify-end items-end">
                    <Dropdown v-model="selectedCity" :options="cities" optionLabel="name" placeholder="Tanggal"
                        class="flex-1 w-[12rem] md:w-8rem mr-6" />
                    <Dropdown v-model="selectedCity" :options="cities" optionLabel="name" placeholder="Total Jam"
                        class="flex-1 w-[10rem] md:w-8rem mr-6" />
                    <Dropdown v-model="selectedClassroom" :options="classrooms" optionLabel="grade" placeholder="Kelas"
                        class="flex-1 w-[10rem] md:w-8rem mr-6" />
                    <span class="p-input-icon-left">
                        <i class="pi pi-search" />
                        <InputText v-model="filters['global'].value" placeholder="Keyword Search" />
                    </span>

                </div>
            </template>
            <Column field="name" header="Nama" sortable style="min-width: 12rem">
                <template #body="{ data }">
                    {{ data.name }}
                </template>
            </Column>
            <Column field="nis_nisn" header="NIS/NISN" sortable style="min-width: 12rem"></Column>
            <Column style="min-width: 12rem" header="Sakit/Izin/Alpha/Hadir">
                <template #body="">
                    <Dropdown v-model="selectedCity" :options="cities" optionLabel="name" placeholder="Sebab"
                        class="flex-1 w-[10rem] md:w-8rem mr-6" />
                </template>
            </Column>
            <Column style="min-width: 12rem" header="Keterangan">
                <template #body="">
                    <InputText placeholder="Keterangan" />
                </template>
            </Column>

        </DataTable>
    </TeacherLayout>
</template>

<script >
import { FilterMatchMode } from 'primevue/api';
import TeacherLayout from '../../Layouts/TeacherLayout.vue';
import Divider from 'primevue/divider';
import Menubar from 'primevue/menubar';
import 'primeicons/primeicons.css';
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
        TeacherLayout,
        InputText,
        Divider,
        DataTable,
        Column,
        ColumnGroup,
        Row,
        Menubar,
        Dropdown,

    },
    props: {
        students: Array,
        classrooms: Array,
    },
    setup(props) {
        const selectedClassroom = ref(null);

        const filters = ref({
            classroom_id: { value: null, matchMode: FilterMatchMode.EQUALS },
            global: { value: null, matchMode: FilterMatchMode.CONTAINS },
            name: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
            'country.name': { value: null, matchMode: FilterMatchMode.STARTS_WITH },
            representative: { value: null, matchMode: FilterMatchMode.IN },
            status: { value: null, matchMode: FilterMatchMode.EQUALS },
            verified: { value: null, matchMode: FilterMatchMode.EQUALS }
        });

        return {
            selectedClassroom: selectedClassroom,
            filters: filters,
        }
    },

    watch: {
        selectedClassroom: function (val) {
            this.filters.classroom_id.value = val ? val.id : null; // Change this line
        },
    },
}
</script>
