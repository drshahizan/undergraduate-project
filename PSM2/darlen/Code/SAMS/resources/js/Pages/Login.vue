<template>
    <div class="custom-bg-color h-screen relative">
        <div class="absolute top-0 left-0 w-[400px] p-4">
            <img src="/images/logo.png" />
        </div>

        <div class="flex justify-center items-center h-full">
            <div class="bg-green-100 rounded-lg shadow-xl p-10">
                <h1 class="flex justify-center text-2xl font-bold mb-2">Login</h1>
                <p class=" mb-2"> Selamat datang di Student Academic Management System </p>
                <Divider class="border-black" />
                <div class="p-grid">
                    <div class="p-col-12 p-md-6 flex justify-center ">
                        <InputText class="w-full "  placeholder="Username" />
                    </div>
                    <br />
                    <div class="p-col-12 p-md-6 flex justify-center ">
                        <InputText class="w-full" placeholder="Password" />
                    </div>
                </div>
                <Divider />
                <div class="p-grid ">
                    <div  class="flex justify-center ">
                        <a class="w-full" href="/dashboard-guru"><Button  class="w-full" severity="success" raised label="Login" /></a>
                    </div>
                </div>
            </div>
        </div>
</div>
</template>

<script >
import Divider from 'primevue/divider';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import { ref } from 'vue';



export default {
    components: {
        Divider,
        InputText,
        Button
    },

    setup(props) {
        return {
        }
    }
}
</script>