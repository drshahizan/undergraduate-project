<template>
    <div class="bg-[#F4F4F5] bg-cover h-screen relative">
        <div class="w-full h-full flex justify-center">
            <div class="bg-white rounded-[2rem] w-[550px] my-[6rem] flex flex-col justify-center items-center px-[96px]">
                <div>
                    <img src="/images/LOGO_PLN.svg" alt="P3MS" class="w-[220px] my-[39px] mx-[54px]"/>
                </div>
                <p class="text-[#ADADAD] text-[14px]">Sistem Pemantau Performa Pembangkit Listrik</p>
                <form 
                    @submit.prevent="formState.post(route('login.post'))" 
                    class="my-[54px] w-full"
                >
                    <div class="mb-[1.5rem] w-full">
                        <p class="mb-[10px] text-[14px] font-semibold text-[#616278]">Username</p>
                        <InputText type="text" v-model="formState.username" class="w-full p-inputtext-sm bg-[#F8F8F9] border-[1.5px] border-[#F8F8F9] rounded-[0.5rem] h-[42px]" required/>
                    </div>
                    <div class="mb-[1.5rem] w-full">
                        <p class="mb-[10px] text-[14px] font-semibold text-[#616278]">Password</p>
                        <Password class="w-full border-[1.5px] border-[#F8F8F9] rounded-[0.5rem]" v-model="formState.password" :feedback="false" :inputStyle="{ 'width': '100%' }" inputClass="p-inputtext-sm bg-[#F8F8F9] border-[1.5px] border-[#F8F8F9] rounded-[0.5rem] h-[42px]"
                            toggleMask required />
                    </div>
                    <button type="submit" class="text-[14px] text-white  rounded-[0.5rem] w-full bg-[#14A3B8] hover:bg-[#14A3B8] border-[#14A3B8] mt-[2rem] h-[42px]">
                        Masuk
                    </button>
                </form>
                <h5 class="text-[#ADADAD] mt-[20px] text-[14px]">
                    Masuk sebagai admin ? <span class="text-[#14A3B8] font-semibold"><Link href="/admin/login">Admin</Link></span>
                </h5>
            </div>
        </div>
    </div>
</template>

<script>
import InputText from 'primevue/inputtext';
import Password from 'primevue/password';
import { useForm } from '@inertiajs/vue3';

export default {
    components: {
        InputText,
        Password
    },
    props: {
        errors: Object
    },
    setup(props) {
        const formState = useForm({
            username: '',
            password: '',
            user_type: ['Staff PIC','Staff Operator'],
        })
        
        return {
            formState
        }
    }
}
</script>