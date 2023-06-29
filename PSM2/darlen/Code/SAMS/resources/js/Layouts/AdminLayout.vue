<template>
    <div class="h-screen relative flex flex-col">
        <div class="flex flex-1 h-full w-full">

            <div v-if="visible" class="flex flex-col gap-[30px] max-w-[20rem] wrapper-color shadow-xl">

                <img class="pt-6 pb-4" src="/images/logo.png" />

                <Link :class="{ 'highlight-page': $page.url === '/beranda-admin' }" href="/beranda-admin"
                    class="text-xl flex flex-row gap-[10px] items-center"><i
                    class="ml-4 mr-0 pi pi-home sidebar-icon"></i>Beranda</Link>
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
            <!-- <Button v-if="visible" @click="visible = !visible" icon="pi pi-arrow-left"
                class="p-button-rounded p-button-warning" style="position: absolute; top: 50%; left: 18.5rem;"></Button>
            <Button v-else @click="visible = !visible" icon="pi pi-arrow-right" class="p-button-rounded wrapper-color"
                style="position: absolute; top: 50%; left: 0;"></Button> -->

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
        <div class="text-center py-2 footer-color text-white">
            &copy; 2023 SMA Muhammadiyah 1 Banda Aceh. All rights reserved.
        </div>
    </div>
</template>

<script >
import 'primeicons/primeicons.css';
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
        const visible = ref(true);
        const logout = () => {
            Inertia.post('/logout')
        }

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

            logout,
            menuItems: [
                {
                    label: 'User',
                    icon: 'pi pi-user',
                    items: [
                        { label: 'Profile', icon: 'pi pi-user' },
                        { label: 'Settings', icon: 'pi pi-cog' },
                        { label: 'Logout', icon: 'pi pi-sign-out', command: logout },
                    ],
                },
            ],
        }
    }
}
</script>
