<template>
        <div class="card flex justify-right ">

            <Sidebar v-model:visible="visible" class=" md:w-20rem lg:w-30rem" dismissable @mouseleave="visible = false"
                :showCloseIcon="false">
                <div class="flex flex-col gap-[30px]">
                    <img src="/images/logo.png" />

                    <Link :class="{ 'highlight-page': $page.url === '/dashboard-guru' }" href="/dashboard-guru"
                        class="text-xl flex flex-row gap-[10px] items-center"><i
                        class="ml-4 mr-0 pi pi-home sidebar-icon"></i>Dashboard</Link>

                        <Tree :value="nodes" class="w-full md:w-30rem bg-green-600">
                            <template v-slot:default="{ node }">
                        <Link :class="{ 'highlight-page': $page.url === node.url }" :href="node.url"
                            class="text-xl flex flex-row gap-[10px] items-center" 
                        >{{ node.label }}</Link>
                        </template>
                        </Tree>
                    
                    <Tree :value="nodes2" class="w-full md:w-30rem bg-green-600">
                                <template v-slot:default="{ node }">
                            <Link :class="{ 'highlight-page': $page.url === node.url }" :href="node.url"
                                class="text-xl flex flex-row gap-[10px] items-center" 
                            >{{ node.label }}</Link>
                            </template>
                            </Tree>

                    <Tree :value="nodes3" class="w-full md:w-30rem bg-green-600">
                                <template v-slot:default="{ node }">
                            <Link :class="{ 'highlight-page': $page.url === node.url }" :href="node.url"
                                class="text-xl flex flex-row gap-[10px] items-center" 
                            >{{ node.label }}</Link>
                            </template>
                            </Tree>

                        <Link :class="{ 'highlight-page': $page.url === '/daftar-siswa' }" href="/daftar-siswa"
                            class="text-xl flex flex-row gap-[10px] items-center"><i class="ml-4 mr-0 pi pi-user-plus sidebar-icon"></i>Daftar Siswa</Link>
                    <Link :class="{ 'highlight-page': $page.url === '/spp' }" href="/spp"
                            class="text-xl flex flex-row gap-[10px] items-center"><i class="ml-4 mr-0 pi pi-user-plus sidebar-icon"></i>SPP</Link>
                    <Link :class="{ 'highlight-page': $page.url === '/absensi' }" href="/absensi"
                            class="text-xl flex flex-row gap-[10px] items-center"><i class="ml-4 mr-0 pi pi-user-plus sidebar-icon"></i>Absensi</Link>
                </div>
            </Sidebar>
            <Button class="bg-green-500 text-green-200 m-4" icon="pi pi-bars" @mouseover="visible = true" />
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



export default{
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

    setup(props) {
        const visible = ref(false);
        return {
            visible: visible,
            nodes: [
                {
                    key: '0',
                    label: 'Rapor',
                    url: '/rapor',
                    icon: 'pi pi-file',
                    children: [
                        {
                            key: '0-0',
                            label: 'Buat Rapor',
                            url: '/buat-rapor',
                            icon: 'pi pi-file',
                        },
                    ],
                },
            ],
            nodes2:[
                {
                    key: '1',
                    label: 'Penilaian',
                    url: '/penilaian',
                    icon: 'pi pi-file',
                    children: [
                        {
                            key: '1-0',
                            label: 'Edit Penilaian',
                            url: '/edit-penilaian',
                            icon: 'pi pi-file',
                        },
                    ],
                }
            ],
            nodes3: [
                {
                    key: '2',
                    label: 'Jadwal Pelajaran',
                    url: '/jadwal-pelajaran',
                    icon: 'pi pi-file',
                    children: [
                        {
                            key: '2-0',
                            label: 'Ubah Jadwal Pelajaran',
                            url: '/ubah-jadwal-pelajaran',
                            icon: 'pi pi-file',
                        },
                    ],
                }
            ],
            menuItems: [
                {
                    label: 'User',
                    icon: 'pi pi-user',
                    items: [
                        { label: 'Profile', icon: 'pi pi-user' },
                        { label: 'Settings', icon: 'pi pi-cog' },
                        { label: 'Logout', icon: 'pi pi-sign-out' },
                    ],
                },
            ],
        }
    }
}
</script>
