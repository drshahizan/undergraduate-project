<template>
    <div class="h-screen relative flex flex-col">
        <div class="flex flex-1 h-full w-full ">


            <div class="flex flex-col gap-[30px] max-w-[20rem] wrapper-color">
                <img class="pt-6 pb-4" src="/images/logo.png" />

                <Link :class="{ 'highlight-page': $page.url === '/beranda-siswa' }" href="/beranda-siswa"
                    class="text-xl flex flex-row gap-[10px] items-center"><i
                    class="ml-4 mr-0 pi pi-home sidebar-icon"></i>Beranda</Link>
                <Link :class="{ 'highlight-page': $page.url === '/rapor-siswa' }" href="/rapor-siswa"
                    class="text-xl flex flex-row gap-[10px] items-center"><i
                    class="ml-4 mr-0 pi pi-users sidebar-icon"></i>Rapor</Link>
                <Link :class="{ 'highlight-page': $page.url === '/jadwal-pelajaran-siswa' }" href="/jadwal-pelajaran-siswa"
                    class="text-xl flex flex-row gap-[10px] items-center"><i
                    class="ml-4 mr-0 pi pi-user-plus sidebar-icon"></i>Jadwal Pelajaran</Link>
                <Link :class="{ 'highlight-page': $page.url === '/spp-siswa' }" href="/spp-siswa"
                    class="text-xl flex flex-row gap-[10px] items-center"><i
                    class="ml-4 mr-0 pi pi-user-plus sidebar-icon"></i>SPP</Link>
                <Link :class="{ 'highlight-page': $page.url === '/absensi-siswa' }" href="/absensi-siswa"
                    class="text-xl flex flex-row gap-[10px] items-center"><i
                    class="ml-4 mr-0 pi pi-user-plus sidebar-icon"></i>Absensi</Link>
                <Link :class="{ 'highlight-page': $page.url === '/daftar-guru' }" href="/daftar-guru"
                    class="text-xl flex flex-row gap-[10px] items-center"><i
                    class="ml-4 mr-0 pi pi-user-plus sidebar-icon"></i>Daftar Guru</Link>
            </div>


            <div class="flex flex-col flex-1 gap-[3rem]">
                <div class="flex  items-center pl-[2rem] justify-between">
                    <div class="text-xl ">{{ pageTitle }}</div>
                    <Menubar class="p-[0.45rem] wrapper-color m-6" :model="menuItems" />
                </div>
                <div class="flex flex-1 flex-col overflow-y-scroll">
                    <slot />
                </div>
            </div>
        </div>
        <div class="text-center py-2 footer-color text-white absolute bottom-0 left-0 w-screen">
            &copy; 2023 SMA Muhammadiyah 1 Banda Aceh. All rights reserved.
        </div>
    </div>
</template>

<script >
import Divider from 'primevue/divider';
import Menubar from 'primevue/menubar';
import 'primeicons/primeicons.css';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import { ref } from 'vue';
import Tree from 'primevue/tree';
import { Inertia } from '@inertiajs/inertia'
export default {
    props: {
        pageTitle: {
            type: String,
            required: false,
            default: 'Default Title'
        }
    },

    components: {
        Button,
        InputText,
        Divider,
        Menubar,
        Tree,

    },

    setup(props) {
        const visible = ref(false);
        const logout = () => {
            Inertia.post('/logout')
        }

        return {
            logout,
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
            nodes2: [
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
                        {
                            label: 'Profile', icon: 'pi pi-user', command: () => {
                                Inertia.visit('/profil-siswa');
                            }
                        },
                        { label: 'Settings', icon: 'pi pi-cog' },
                        { label: 'Logout', icon: 'pi pi-sign-out', command: logout },
                    ],
                },
            ],
        }
    }
}
</script>
