<template>
    <div class="h-screen relative custom-bg-color">
        
        <TeacherSidebar/>  

        

        <div class="flex justify-center items-center mt-12">
        <DataTable class="rounded-md border-2 border-zinc-50" v-model:filters="filters" paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]" :value="products" 
        showGridlines tableStyle="min-width: 90rem " dataKey="id" filterDisplay="row" :loading="loading"
            :globalFilterFields="['name', 'country.name', 'representative.name', 'status']">
        
        <template #header>
            <div class="flex justify-end items-end">
                <span class="p-input-icon-left">
                    <i class="pi pi-search" />
                    <InputText  placeholder="Keyword Search" />
                </span>
            </div>
       </template>
        <Column field="name" header="Nama" sortable style="width: 25%"></Column>
        <Column field="nis" header="NIS/NISN" sortable style="width: 25%"></Column>
        <Column field="peminatan" header="Peminatan" sortable style="width: 25%"></Column>
        <Column  header="Action"> <template #body=""><Button type="button" label="View" severity="success" /></template> </Column>

        </DataTable>
        </div>
    </div>
</template>

<script >

import Divider from 'primevue/divider';
import Menubar from 'primevue/menubar';
import 'primeicons/primeicons.css';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import TeacherSidebar from "../../Components/TeacherSidebar";
import { ref } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';   // optional
import Row from 'primevue/row';                   // optional


export default {
    components: {
        Button,
        TeacherSidebar,
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
            
        ]
        return {
            visible: visible,
            products: products,
            menuItems: [
                {
                    label: 'User',
                    icon: 'pi pi-fw pi-user',
                    items: [
                        { label: 'Profile', icon: 'pi pi-fw pi-user' },
                        { label: 'Settings', icon: 'pi pi-fw pi-cog' },
                        { label: 'Logout', icon: 'pi pi-fw pi-sign-out' },
                    ],
                },
            ],
        }
    }
}
</script>
