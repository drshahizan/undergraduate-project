<template>
    <div class="h-screen relative custom-bg-color">
        
        <TeacherSidebar/>  

        

        <div class="flex justify-center items-center mt-12 jadwal">
        <DataTable class="jadwal" v-model:filters="filters"  :value="products" 
         tableStyle="min-width: 90rem " dataKey="id" filterDisplay="row" :loading="loading"
            :globalFilterFields="['name', 'country.name', 'representative.name', 'status']"
            editMode="cell" @cell-edit-complete="onCellEditComplete" tableClass="editable-cells-table">
        
        <!-- <template #header>
            <div class="flex justify-end items-end">
                <span class="p-input-icon-left">
                    <i class="pi pi-search" />
                    <InputText  placeholder="Keyword Search" />
                </span>
            </div>
       </template> -->
       
        <Column class="" field="name" header="" ></Column>
        <Column field="matpel" header="1" ></Column>
        <Column field="matpel" header="2" ></Column>
        <Column field="matpel" header="3" ></Column>
        <Column field="matpel" header="4" ></Column>
        <Column field="matpel" header="5" ></Column>
        <Column field="matpel" header="6" ></Column>
        <Column field="matpel" header="7" ></Column>
        <Column field="matpel" header="8" ></Column>
        <Column  header="Action"> <template #body=""><Button type="button" label="Edit" severity="success" /></template> </Column>

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
                matpel: 'Matematika',

            },
            {
                id: '5',
                name: 'Jumat',
                matpel: 'Matematika',

            },
            {
                id: '6',
                name: 'Sabtu',
                matpel: 'Matematika',

            },
            {
                id: '7',
                name: 'Minggu',
                matpel: 'Matematika',

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
