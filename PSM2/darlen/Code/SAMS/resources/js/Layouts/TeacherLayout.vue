<template>
    <div class="h-screen relative flex flex-col">
        <div class="flex flex-1 h-full w-full ">


            <div class="flex flex-col gap-[30px] max-w-[20rem] wrapper-color">
                <img class="pt-6 pb-4" src="/images/logo.png" />

                <Link :class="{ 'highlight-page': $page.url === '/beranda-guru' }" href="/beranda-guru"
                    class="text-xl flex flex-row gap-[10px] items-center"><i
                    class="ml-4 mr-0 pi pi-home sidebar-icon"></i>Beranda</Link>

                <Link :class="{ 'highlight-page': $page.url === '/rapor' }" href="/rapor"
                    class="text-xl flex flex-row gap-[10px] items-center"><i
                    class="ml-4 mr-0 pi pi pi-file sidebar-icon"></i>Rapor</Link>

                <Tree :value="nodes2" class="w-full md:w-30rem wrapper-color">
                    <template v-slot:default="{ node }">
                        <Link :class="{ 'highlight-page': $page.url === node.url }" :href="node.url"
                            class="text-xl flex flex-row gap-[10px] items-center">{{ node.label }}</Link>
                    </template>
                </Tree>

                <Tree :value="nodes3" class="w-full md:w-30rem wrapper-color">
                    <template v-slot:default="{ node }">
                        <Link :class="{ 'highlight-page': $page.url === node.url }" :href="node.url"
                            class="text-xl flex flex-row gap-[10px] items-center">{{ node.label }}</Link>
                    </template>
                </Tree>

                <Link :class="{ 'highlight-page': $page.url === '/daftar-siswa' }" href="/daftar-siswa"
                    class="text-xl flex flex-row gap-[10px] items-center"><i
                    class="ml-4 mr-0 pi pi-user-plus sidebar-icon"></i>Daftar Siswa</Link>
                <Link :class="{ 'highlight-page': $page.url === '/spp' }" href="/spp"
                    class="text-xl flex flex-row gap-[10px] items-center"><i
                    class="ml-4 mr-0 pi pi-user-plus sidebar-icon"></i>SPP</Link>
                <Link :class="{ 'highlight-page': $page.url === '/absensi' }" href="/absensi"
                    class="text-xl flex flex-row gap-[10px] items-center"><i
                    class="ml-4 mr-0 pi pi-user-plus sidebar-icon"></i>Absensi</Link>
            </div>


            <div class="flex flex-col flex-1 gap-[3rem]">
                <div class="flex  items-center pl-[2rem] justify-between">
                    <div class="text-xl ">{{ pageTitle }}</div>
                    <Menubar class="p-[0.45rem] wrapper-color m-6" :model="menuItems" />
                </div>
                <div class="flex flex-1 flex-col overflow-y-scroll overflow-x-scroll w-[1350px]">
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
            nodes2: [
                {
                    key: '1',
                    label: 'Penilaian',
                    url: '/penilaian',
                    icon: 'pi pi-file',
                    children: [
                        {
                            key: '1-0',
                            label: 'Ubah Penilaian',
                            url: '/ubah-penilaian',
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
                                Inertia.visit('/profil-guru');
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
