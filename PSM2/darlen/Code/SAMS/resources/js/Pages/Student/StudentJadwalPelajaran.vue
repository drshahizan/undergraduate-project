<template>
    <StudentLayout :page-title="'Jadwal Pelajaran'">
        <DataTable class="mx-[2rem] " v-model:filters="filters" :value="products" tableStyle="min-width: 70rem "
            dataKey="id" :loading="loading" :globalFilterFields="['name', 'country.name', 'representative.name', 'status']"
            editMode="cell" @cell-edit-complete="onCellEditComplete" tableClass="editable-cells-table">

            <template #header>
                <div class="flex justify-end items-end">
                    <Dropdown v-model="selectedCity" :options="cities" optionLabel="name" placeholder="Tahun Ajaran"
                        class="flex-1 w-[12rem] md:w-8rem mr-6" />
                    <Dropdown v-model="selectedCity" :options="cities" optionLabel="name" placeholder="Semester"
                        class="flex-1 w-[10rem] md:w-8rem mr-6" />
                    <Dropdown v-model="selectedCity" :options="cities" optionLabel="name" placeholder="Kelas"
                        class="flex-1 w-[10rem] md:w-8rem mr-6" />

                </div>
            </template>

            <Column style="min-width: 6rem" class="" field="name" header=""></Column>
            <Column style="min-width: 6rem" field="matpel" header="1"></Column>
            <Column style="min-width: 6rem" field="matpel" header="2"></Column>
            <Column style="min-width: 6rem" field="matpel" header="3"></Column>
            <Column style="min-width: 6rem" field="matpel" header="4"></Column>
            <Column style="min-width: 6rem" field="matpel" header="5"></Column>
            <Column style="min-width: 6rem" field="matpel" header="6"></Column>
            <Column style="min-width: 6rem" field="matpel" header="7"></Column>
            <Column style="min-width: 6rem" field="matpel" header="8"></Column>

        </DataTable>

    </StudentLayout>
</template>

<script >

import Divider from 'primevue/divider';
import Menubar from 'primevue/menubar';
import 'primeicons/primeicons.css';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import StudentLayout from '../../Layouts/StudentLayout.vue';
import { ref } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';   // optional
import Row from 'primevue/row';                   // optional
import Dropdown from 'primevue/dropdown';
import { FilterMatchMode } from 'primevue/api';

export default {
    components: {
        Button,
        StudentLayout,
        InputText,
        Divider,
        DataTable,
        Column,
        ColumnGroup,
        Row,
        Menubar,
        Dropdown,
    },

    setup(props) {
        const visible = ref(false);
        const products = [
            {
                id: '1',
                name: 'Senin',
                matpel: 'Matematika',

            },
            {
                id: '2',
                name: 'Selasa',
                matpel: 'Matematika',


            },
            {
                id: '3',
                name: 'Rabu',
                matpel: 'Matematika',

            },
            {
                id: '4',
                name: 'Kamis',
                matpel: 'Fisika',

            },
            {
                id: '5',
                name: 'Jumat',
                matpel: 'Fisika',

            },
            {
                id: '6',
                name: 'Sabtu',
                matpel: 'Fisika',

            },
            {
                id: '7',
                name: 'Minggu',
                matpel: 'Biologi',

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
