<template>
    <StudentLayout :page-title="'Daftar Guru'">
        <div class="flex-1 ">
            <DataTable class="mx-[2rem] mb-16" v-model:filters="filters" paginator :rows="5"
                :rowsPerPageOptions="[5, 10, 20, 50]" :value="teachers" tableStyle="min-width: 70rem" dataKey="id"
                :loading="loading" :globalFilterFields="['username', 'nis', 'representative.name', 'status']">
                <template #header>
                    <div class="flex justify-end items-end">
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


                <Column field="nis_nisn" header="NIS/NISN" sortable style="min-width: 12rem" />
                <Column field="peminatan" header="Peminatan" sortable style="min-width: 12rem" />
                <Column style="min-width: 12rem" header="Action">
                    <template #body="">
                        <Button class="mr-4" type="button" label="Delete" severity="danger" />
                    </template>
                </Column>
            </DataTable>
        </div>
    </StudentLayout>
</template>

<script>
import StudentLayout from '../../Layouts/StudentLayout.vue';
import { FilterMatchMode } from 'primevue/api';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import { ref, onMounted } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import { Inertia } from '@inertiajs/inertia';

export default {
    components: {
        Button,
        InputText,
        DataTable,
        Column,
        StudentLayout,
    },
    props: {
        teachers: Array,
    },
    setup() {
        const filters = ref({
            global: { value: null, matchMode: FilterMatchMode.CONTAINS },
            name: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
            'country.name': { value: null, matchMode: FilterMatchMode.STARTS_WITH },
            representative: { value: null, matchMode: FilterMatchMode.IN },
            status: { value: null, matchMode: FilterMatchMode.EQUALS },
            verified: { value: null, matchMode: FilterMatchMode.EQUALS }
        });
        return {
            filters,
        };
    },
};
</script>

