<template>
    <div class="h-screen relative custom-bg-color">
        <!-- <div class="topbar">
            <div class="page-title">{{ currentPage }}</div>
            <Menubar :model="menuItems" />
          </div> -->
        <div class="card flex justify-right ">

            <Sidebar v-model:visible="visible" class=" md:w-20rem lg:w-30rem" dismissable @mouseleave="visible = false"
                :showCloseIcon="false">
                <div class="flex flex-col gap-[30px]">
                    <img src="/images/logo.png" />

                    <Link :class="{ 'highlight-page': $page.url === '/dashboard' }" href="/dashboard"
                        class="text-xl flex flex-row gap-[10px] items-center"><i
                        class="ml-4 mr-0 pi pi-home sidebar-icon"></i>Dashboard</Link>
                    <Link :class="{ 'highlight-page': $page.url === '/manajemen-akun' }" href="/manajemen-akun"
                        class="text-xl flex flex-row gap-[10px] items-center"><i
                        class="ml-4 mr-0 pi pi-users sidebar-icon"></i>Manajemen Akun</Link>
                    <Link :class="{ 'highlight-page': $page.url === '/tambah-akun-guru' }" href="/tambah-akun-guru"
                        class="text-xl flex flex-row gap-[10px] items-center"><i
                        class="ml-4 mr-0 pi pi-user-plus sidebar-icon"></i>Tambah Akun Guru</Link>
                    <Link :class="{ 'highlight-page': $page.url === '/tambah-akun-siswa' }" href="/tambah-akun-siswa"
                        class="text-xl flex flex-row gap-[10px] items-center"><i
                        class="ml-4 mr-0 pi pi-user-plus sidebar-icon"></i>Tambah Akun Siswa</Link>
                    <Link :class="{ 'highlight-page': $page.url === '/tambah-akun-admin' }" href="/tambah-akun-admin"
                        class="text-xl flex flex-row gap-[10px] items-center"><i
                        class="ml-4 mr-0 pi pi-user-plus sidebar-icon"></i>Tambah Akun Admin</Link>




                </div>
            </Sidebar>
            <Button class="bg-green-600 text-green-200 m-4" icon="pi pi-bars" @mouseover="visible = true" />
        </div>
    </div>
</template>

<script >
import Divider from 'primevue/divider';
import 'primeicons/primeicons.css';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Sidebar from 'primevue/sidebar';
import { ref } from 'vue';
import { Menubar } from 'primevue/menubar';


export default {
    components: {
        Button,
        Sidebar,
        // Menubar,
    },

    setup(props) {
        const visible = ref(false);
        return {
            visible: visible,
        }
    }

    // data() {
    //     return {
    //         currentPage: 'Dashboard', // Change this value according to your current page
    //         menuItems: [
    //             {
    //                 label: 'User',
    //                 icon: 'pi pi-fw pi-user',
    //                 items: [
    //                     { label: 'Profile', icon: 'pi pi-fw pi-user' },
    //                     { label: 'Settings', icon: 'pi pi-fw pi-cog' },
    //                     { label: 'Logout', icon: 'pi pi-fw pi-sign-out' },
    //                 ],
    //             },
    //         ],
    //     };
    // },
}
</script>
