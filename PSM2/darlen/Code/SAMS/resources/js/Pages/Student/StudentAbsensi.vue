<template>
    <StudentLayout :page-title="'Absensi'">
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

            <Column style="min-width: 6rem" field="matpel" header="Total Sakit"></Column>
            <Column style="min-width: 6rem" field="matpel" header="Total Izin"></Column>
            <Column style="min-width: 6rem" field="matpel" header="Total Alpha"></Column>



        </DataTable>
    </StudentLayout>
</template>

<script >
import StudentLayout from '../../Layouts/StudentLayout.vue';
import Divider from 'primevue/divider';
import 'primeicons/primeicons.css';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Sidebar from 'primevue/sidebar';
import { ref } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Dropdown from 'primevue/dropdown';
import { FilterMatchMode } from 'primevue/api';


export default {
    components: {
        Button,
        Sidebar,
        StudentLayout,
        InputText,
        Divider,
        DataTable,
        Column,
        Dropdown,
    },

    setup(props) {
        const visible = ref(false);
        const products = [
            {
                id: '1',
                name: 'Senin',
                matpel: '3 Hari',

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
