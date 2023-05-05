<template>
    <div class="bg-[url('/images/BG_P3MS.png')] bg-cover h-screen">
            <div class="w-full h-full flex justify-between">
                <div>
                    <img src="/images/LOGO_1_P3MS.png" alt="P3MS" class="w-[114px] my-[39px] mx-[54px]"/>
                </div>
                <div class="bg-white w-[550px] flex flex-col justify-center items-center px-[96px]">
                    <h3 class="text-[30px] font-light">Selamat Datang di Torpedo !</h3>
                    <h5 class="text-[#ADADAD]">Kamu akan segera masuk sebagai staff.</h5>
                    <div class="my-[54px] w-full">
                        <div class="mb-[32px] w-full">
                            <p class="mb-[10px] font-semibold">Username</p>
                            <InputText type="text" v-model="formState.username" class="w-full p-inputtext-sm" required/>
                        </div>
                        <div class="mb-[32px] w-full">
                            <p class="mb-[10px] font-semibold">Password</p>
                            <Password class="w-full" v-model="formState.password" :feedback="false" :inputStyle="{ 'width': '100%' }" inputClass="p-inputtext-sm"
                                toggleMask required />
                        </div>
                        <Button label="Masuk" class="w-full bg-[#282A39] hover:bg-[#282A39] border-[#282A39] mt-[45px]" />
                    </div>
                    <h5 class="text-[#ADADAD] mt-[20px]">
                        Masuk sebagai admin ? <span class="text-[#282A39] font-semibold">Admin</span>
                    </h5>
            </div>
        </div>
    </div>
</template>

<script>
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Password from 'primevue/password';
import { ref } from "vue";

export default {
    components: {
        InputText,
        Button,
        Password
    },
    setup(props) {
        const formState = ref({
            username: '',
            password: ''
        });

        return {
            formState
        }
    }
}
</script>