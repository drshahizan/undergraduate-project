<template>
    <MainLayoutAdmin sideBar="2">
        <form 
            @submit.prevent="formState.post(route('admin.create'))"
            class="flex flex-col flex-1" 
        >
            <div class="flex justify-between items-center mb-[2rem]">
                <div class="flex flex-col">
                    <p class="text-[#14A3B8] font-semibold">Tambah Akun</p>
                    <p class="text-[12px]">Pengguna Admin</p>
                </div>
                <div class="flex items-center gap-[1rem]">
                    <Link href="/admin/kelola-akun/admin" class="py-[0.5rem] px-[1rem] flex justify-center items-center bg-white rounded-[0.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)]">
                        <p class="text-[#14A3B8]  text-[14px]">Batal</p>
                    </Link>
                    <button type="submit" class="py-[0.5rem] px-[1rem] flex justify-center items-center bg-[#14A3B8] rounded-[0.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)]">
                        <p class="text-white text-[14px]">Simpan</p>
                    </button>
                </div>
            </div>
            <div class="mb-[1.5rem] font-semibold text-[#616379] flex justify-between items-center">
                <p>Informasi Dasar</p>
                <p v-tooltip.left="{ value: `<p class='text-white text-[12px] my-[-5px]'>Hello World</p>`, escape: true}" class="pi pi-info-circle"></p>
            </div>
            <div class="bg-white rounded-[1.25rem] p-[0.5rem] px-[1.4rem] pt-[1.25rem]">
                <div class="flex flex-col mr-[54px] w-full">
                    <div class="flex gap-[53px]">
                        <div class="mb-[1.5rem] min-w-[168px] w-full">
                            <p class="mb-[10px] text-[#A1A5B6] tracking-[0.1em] text-[14px]">Username</p>
                            <InputText v-model="formState.username" placeholder="" class="p-inputtext-sm border-[1.5px] border-[#F8F8F9] bg-[#F8F8F9] rounded-[0.5rem] h-[42px] w-full"/>
                        </div>
                        <div class="mb-[1.5rem] min-w-[168px] w-full">
                            <p class="mb-[10px] text-[#A1A5B6] tracking-[0.1em] text-[14px]">Password</p>
                            <Password v-model="formState.password" :feedback="false" toggleMask placeholder="" class="w-full" inputClass="p-inputtext-sm border-[1.5px] border-[#F8F8F9] bg-[#F8F8F9] rounded-[0.5rem] h-[42px] w-full"/>
                        </div>
                    </div>
                    <div class="flex gap-[53px]">
                        <div class="mb-[1.5rem] min-w-[168px] w-full">
                            <p class="mb-[10px] text-[#A1A5B6] tracking-[0.1em] text-[14px]">Ketik Ulang Password</p>
                            <Password v-model="formState.password" :feedback="false" toggleMask placeholder="" class="w-full" inputClass="p-inputtext-sm border-[1.5px] border-[#F8F8F9] bg-[#F8F8F9] rounded-[0.5rem] h-[42px] w-full"/>
                        </div>
                        <div class="mb-[1.5rem] min-w-[168px] w-full">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-[1.5rem] font-semibold text-[#616379] flex justify-between items-center">
                <p>Detail Pengguna</p>
                <p v-tooltip.left="{ value: `<p class='text-white text-[12px] my-[-5px]'>Hello World</p>`, escape: true}" class="pi pi-info-circle"></p>
            </div>
            <div class="bg-white rounded-[1.25rem] p-[0.5rem] px-[1.4rem] pt-[1.25rem] flex-1">
                <div class="flex flex-col mr-[54px] w-full">
                    <div class="flex gap-[53px]">
                        <div class="mb-[1.5rem] min-w-[168px] w-full flex-1">
                            <p class="mb-[10px] text-[#A1A5B6] tracking-[0.1em] text-[14px]">Nama</p>
                            <InputText v-model="formState.name" placeholder="" class="p-inputtext-sm border-[1.5px] border-[#F8F8F9] bg-[#F8F8F9] rounded-[0.5rem] h-[42px] w-full"/>
                        </div>
                        <div class="flex-1">
                            
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </MainLayoutAdmin>
</template>

<script>
import MainLayoutAdmin from '../../Layouts/Admin/MainLayout.vue';
import Dropdown from 'primevue/dropdown';
import InputText from 'primevue/inputtext';
import Password from 'primevue/password';
import { useForm } from '@inertiajs/vue3';

export default {
    components: {
        MainLayoutAdmin,
        Dropdown,
        InputText,
        Password,
    },
    props: {
        
    },
    setup(props) {
        const formState = useForm({
            name: '',
            username: '',
            password: '',
        })
        
        return {
            formState,
        }
    }
}
</script>