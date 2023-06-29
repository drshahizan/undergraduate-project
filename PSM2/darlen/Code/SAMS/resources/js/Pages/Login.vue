<template>
    <div class="custom-bg-color h-screen relative">
        <div class="absolute top-0 left-0 w-[400px] p-4">
            <img src="/images/logo.png" />
        </div>

        <div class="flex justify-center items-center h-full">
            <div class="wrapper-color rounded-lg shadow-xl p-10">
                <h1 class="flex justify-center text-2xl font-bold mb-2">Login</h1>
                <p class="mb-2">Selamat datang di Student Academic Management System</p>
                <Divider class="border-black" />
                <div class="p-grid">
                    <div class="p-col-12 p-md-6 flex justify-center">
                        <InputText v-model="form.username" class="w-full" placeholder="Username" />
                    </div>
                    <br />
                    <div class="p-col-12 p-md-6 flex justify-center">
                        <InputText v-model="form.password" type="password" class="w-full" placeholder="Password" />
                    </div>
                </div>
                <Divider />
                <div class="p-grid">
                    <div class="flex justify-center">
                        <Button @click="submitForm" class="w-full login-button" raised label="Login" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Divider from 'primevue/divider';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import { useForm } from '@inertiajs/vue3';

export default {
    components: {
        Divider,
        InputText,
        Button,
    },

    setup() {
        const form = useForm({
            username: '',
            password: '',
        });

        function submitForm() {
            form.post('/login');
        }

        return {
            form,
            submitForm,
        };
    },
};
</script>
