<template>
    <TeacherLayout :page-title="'Ubah Jadwal Pelajaran'">
        <DataTable class="mx-[2rem]" v-model:filters="filters" paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]"
            :value="products" tableStyle="min-width: 70rem " dataKey="id" :loading="loading"
            :globalFilterFields="['name', 'country.name', 'representative.name', 'status']">

            <template #header>
                <div class="flex justify-end items-end">
                    <span class="p-input-icon-left">
                        <i class="pi pi-search" />
                        <InputText v-model="filters['global'].value" placeholder="Keyword Search" />
                    </span>
                </div>
            </template>
            <Column field="name" header="Nama" sortable style="min-width: 12rem"></Column>
            <Column field="nis_nisn" header="NIS/NISN" sortable style="min-width: 12rem"></Column>
            <Column field="peminatan" header="Peminatan" sortable style="min-width: 12rem"></Column>
            <Column style="min-width: 12rem" header="Action">
                <template #body="">
                    <Button type="button" label="View" severity="success" />
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
    },

    setup(props) {
        const visible = ref(false);
        const products = [
            {
                id: '1',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },
            {
                id: '2',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',

            },
            {
                id: '3',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },
            {
                id: '4',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },
            {
                id: '5',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },
            {
                id: '6',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },
            {
                id: '7',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },
            {
                id: '8',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },
            {
                id: '9',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },
            {
                id: '14',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },
            {
                id: '15',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },
            {
                id: '16',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },
            {
                id: '115',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },
            {
                id: '116',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },
            {
                id: '115',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },
            {
                id: '1116',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },
            {
                id: '1115',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },
            {
                id: '1116',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },

        ];

        const filters = ref({
            global: { value: null, matchMode: FilterMatchMode.CONTAINS },
            name: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
            'country.name': { value: null, matchMode: FilterMatchMode.STARTS_WITH },
            representative: { value: null, matchMode: FilterMatchMode.IN },
            status: { value: null, matchMode: FilterMatchMode.EQUALS },
            verified: { value: null, matchMode: FilterMatchMode.EQUALS }
        });

        return {
            visible: visible,
            products: products,
            filters: filters,
        }
    }
}
</script>
