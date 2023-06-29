<template>
    <AdminLayout :page-title="'Manajemen Akun'">
        <div class="mx-[4rem] mb-4">
            <span>Current User Type: {{ displayUserType }}</span>
        </div>
        <DataTable class="mx-[4rem]" removableSort v-model:filters="filters" paginator :rows="5"
            :rowsPerPageOptions="[5, 10, 20, 50]" :value="users"
            :globalFilterFields="['username', 'nis', 'representative.name', 'status']" tableStyle="min-width: 70rem "
            dataKey="username" :loading="loading">

            <template #header>
                <div class="flex justify-end items-end">
                    <Dropdown v-model="selectedUserType" :options="userTypes" optionLabel="name" placeholder="Tipe Pengguna"
                        class="flex-1 w-[4rem] md:w-8rem mr-6" @update:modelValue="handleSelect" />


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
            <Column v-for="column in columns" :key="column.field" :field="column.field" :header="column.header" sortable
                style="min-width: 12rem"></Column>
            <Column style="min-width: 12rem" header="Action">
                <template #body="">
                    <Button class="mr-4" type="button" label="Delete" severity="danger" />
                </template>
            </Column>


        </DataTable>
    </AdminLayout>
</template>

<script >
import { Inertia } from '@inertiajs/inertia';
import { ref, watch, computed } from 'vue';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import AdminLayout from '../../Layouts/AdminLayout.vue';
import { FilterMatchMode } from 'primevue/api';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Dropdown from 'primevue/dropdown';


export default {
    props: {
        users: Array
    },

    components: {
        Button,
        InputText,
        AdminLayout,
        DataTable,
        Column,
        Dropdown,
    },

    setup(props) {
        const users = ref([]);
        const filters = ref({
            global: { value: null, matchMode: FilterMatchMode.CONTAINS },
            name: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
            'country.name': { value: null, matchMode: FilterMatchMode.STARTS_WITH },
            representative: { value: null, matchMode: FilterMatchMode.IN },
            status: { value: null, matchMode: FilterMatchMode.EQUALS },
            verified: { value: null, matchMode: FilterMatchMode.EQUALS }
        });
        const selectedUserType = ref(null);
        const userTypes = ref([
            { name: 'Admin', code: 'admin' },
            { name: 'Teacher', code: 'teacher' },
            { name: 'Student', code: 'student' }
        ]);



        const handleSelect = (selectedCode) => {
            console.log("handleSelect is triggered with value: ", selectedCode);
            let selectedObj = userTypes.value.find(ut => ut.code === selectedCode);
            if (selectedObj && selectedUserType.value !== selectedObj) {
                selectedUserType.value = selectedObj;
            }
        };


        const displayUserType = computed(() => {
            const userType = userTypes.value.find(type => type.code === selectedUserType.value);
            return userType ? userType.name : 'No User Type Selected';
        });



        watch(() => selectedUserType.value, (newValue, oldValue) => {
            console.log("Selected User Type: ", newValue);
        });

        watch(() => selectedUserType.value, (newValue, oldValue) => {
            if (newValue) {
                Inertia.get(`/users/${newValue.code}`).then(response => {
                    users.value = response.data;
                });
            } else {
                users.value = [];
            }
        });

        const columns = ref([]);
        watch(selectedUserType, (newValue) => {
            if (newValue) {
                if (newValue.code === 'student') {
                    columns.value = [
                        { field: 'nis_nisn', header: 'NIS/NISN' },
                        { field: 'peminatan', header: 'Peminatan' },

                    ];
                } else if (newValue.code === 'teacher') {
                    columns.value = [
                        { field: 'nip', header: 'NIP' },
                        { field: 'wali_kelas', header: 'Wali Kelas' },

                    ];
                } else {
                    columns.value = [];
                }
            } else {
                columns.value = [];
            }
        }, { immediate: true });

        return {
            selectedUserType,
            userTypes,
            displayUserType,
            handleSelect,
            filters,
            columns

        }
    }


}


</script>