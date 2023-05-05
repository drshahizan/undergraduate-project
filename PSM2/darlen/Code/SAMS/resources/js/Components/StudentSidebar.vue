<template>
    
        <div class="card flex justify-right ">

            <Sidebar v-model:visible="visible" class=" md:w-20rem lg:w-30rem" dismissable @mouseleave="visible = false"
                :showCloseIcon="false">
                <div class="flex flex-col gap-[30px]">
                    <img src="/images/logo.png" />
                    
                    <Link :class="{ 'highlight-page': $page.url === '/dashboard-siswa' }" href="/dashboard-siswa"
                        class="text-xl flex flex-row gap-[10px] items-center"><i
                        class="ml-4 mr-0 pi pi-home sidebar-icon"></i>Dashboard</Link>
                    <Link :class="{ 'highlight-page': $page.url === '/rapor-siswa' }" href="/rapor-siswa"
                        class="text-xl flex flex-row gap-[10px] items-center"><i
                        class="ml-4 mr-0 pi pi-users sidebar-icon"></i>Rapor</Link>
                    <Link :class="{ 'highlight-page': $page.url === '/jadwal-pelajaran-siswa' }" href="/jadwal-pelajaran-siswa"
                        class="text-xl flex flex-row gap-[10px] items-center"><i
                        class="ml-4 mr-0 pi pi-user-plus sidebar-icon"></i>jadwal-pelajaran</Link>
                    <Link :class="{ 'highlight-page': $page.url === '/spp-siswa' }" href="/spp-siswa"
                        class="text-xl flex flex-row gap-[10px] items-center"><i
                        class="ml-4 mr-0 pi pi-user-plus sidebar-icon"></i>SPP</Link>
                    <Link :class="{ 'highlight-page': $page.url === '/absensi-siswa' }" href="/absensi-siswa"
                        class="text-xl flex flex-row gap-[10px] items-center"><i
                        class="ml-4 mr-0 pi pi-user-plus sidebar-icon"></i>Absensi</Link>
                    <Link :class="{ 'highlight-page': $page.url === '/daftar-guru' }" href="/daftar-guru"
                            class="text-xl flex flex-row gap-[10px] items-center"><i
                            class="ml-4 mr-0 pi pi-user-plus sidebar-icon"></i>Daftar Guru</Link>
     <!-- <Menubar :model="menuItems" /> -->



                </div>
            </Sidebar>
            <Button class="bg-green-600 text-green-200 m-4" icon="pi pi-bars" @mouseover="visible = true" />
            <div class="flex w-full justify-end items-end mr-12">
                    <div class="justify-left">
                        <Menubar class="p-[0.45rem] bg-green-500" :model="menuItems" />
                    </div>
                </div>
        </div>
</template>

<script >
import Divider from 'primevue/divider';
import Menubar from 'primevue/menubar';
import 'primeicons/primeicons.css';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Sidebar from 'primevue/sidebar';
import { ref } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';   // optional
import Row from 'primevue/row';                   // optional
import Tree from 'primevue/tree';


export default {
    components: {
        Button,
        Sidebar,
        InputText,
        Divider,
        DataTable,
        Column,
        ColumnGroup,
        Row,
        Menubar,
        Tree,
    },

    // setup(props) {
    //     const visible = ref(false);
    //     return {
    //         visible: visible,
    //     }
    // }

    data() {
        const visible = ref(false);
        return {
            visible: visible,
            homeLink: 'SAMS', // Change this value according to your current page
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
        };
    },
}
</script>
