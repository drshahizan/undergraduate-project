<template>
    <div class="h-screen relative custom-bg-color">
        
        <TeacherSidebar/>  
        <div class="bg-green-200 mt-[2.5rem] mx-[4rem] p-[1rem] pb-[6rem]">
         <div class="flex justify-left items-left mt-12 ml-[10rem] mr-12 flex-row">
                <h1 class="text-2xl font-bold">
                    John Doe
                </h1>
                </div>

        <div class="w-[60%] flex justify-left items-left mt-12 ml-[10rem] mr-12 flex-row">
            <h1 class="flex-1 text-2xl font-bold ">
                        Ekstrakulikuler
                    </h1>
        <span class="flex flex-1 gap-[1.5rem] p-float-label ">
        <InputText class="flex-1 ml-[0p]" id="username" v-model="value" />
        <label for="Nama Ekstrakulikuler">Nama Ekstrakulikuler</label>
          <Dropdown v-model="selectedCity" :options="cities" optionLabel="name" placeholder="Nilai" class="flex-1 w-[10rem] md:w-14rem" />
    </span>
    
  
        </div>
      
        <div class="w-[60%] flex justify-left items-left mt-12 ml-[10rem] mr-12 flex-row">
            <div class="flex-1"></div>
                    <span class="w-full p-float-label flex-1 m-[0px] p-[0px]">
                    <Textarea class=" w-full"  v-model="value" rows="5" cols="30" />
                    <label>Deskripsi</label>
                    </span>
            </div>



      <!-- abc -->
            <div class="w-[60%] flex justify-left items-left mt-12 ml-[10rem] mr-12 flex-row">
                <h1 class="flex-1 text-2xl font-bold ">
                            Prestasi
                        </h1>
            <span class="flex flex-1 gap-[1.5rem] p-float-label ">
            <InputText class="flex-1 ml-[0p]" id="username" v-model="value" />
            <label for="Nama Ekstrakulikuler">Nama Prestasi</label>
        </span>
    
  
            </div>

            <div class="w-[60%] flex justify-left items-left mt-12 ml-[10rem] mr-12 flex-row">
                <div class="flex-1"></div>
                <span class="w-full p-float-label flex-1 m-[0px] p-[0px]">
                <Textarea class="w-full "  v-model="value" rows="5" cols="30" />
                <label>Deskripsi</label>
                </span>
                </div>
    </div>
    </div>
</template>

<script >
import Textarea from 'primevue/textarea';
import Dropdown from 'primevue/dropdown';
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
        Textarea,
        Dropdown,
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
