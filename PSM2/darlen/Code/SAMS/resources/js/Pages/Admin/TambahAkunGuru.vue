<template>
    <AdminLayout :page-title="'Tambah Akun Guru'">
        <div class="flex justify-center">
            <div class="wrapper-color rounded-lg mx-[2rem] pb-[3rem] shadow-xl p-16 w-8/12">
                <h1 class="flex justify-center text-2xl font-bold mb-2">Tambah Akun Guru</h1>
                <Divider class="border-black" />
                <form @submit.prevent="submitForm">
                    <div class="p-grid">
                        <div class="p-col-12 p-md-6 flex justify-center ">
                            <InputText v-model="form.username" class="w-full" placeholder="Nama Pengguna" />
                        </div>
                        <br />
                        <div class="p-col-12 p-md-6 flex justify-center ">
                            <InputText v-model="form.password" type="password" class="w-full" placeholder="Kata Sandi" />
                        </div>
                        <br />
                        <div class="p-col-12 p-md-6 flex justify-center ">
                            <InputText v-model="form.password_confirmation" type="password" class="w-full"
                                placeholder="Masukkan Kembali Kata Sandi" />
                        </div>
                    </div>
                    <Divider />
                    <div class="p-grid ">
                        <div class="flex justify-center ">
                            <Button type="submit" class="w-full login-button" label="Tambah" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
    <Dialog v-model:visible="showDialog" header="Berhasil" @hide="handleDialogHide">
        <p>Pengguna Berhasil Ditambahkan!</p>
    </Dialog>
</template>

<script>
import Dialog from 'primevue/dialog';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Divider from 'primevue/divider';
import AdminLayout from '../../Layouts/AdminLayout.vue';
import { useForm } from '@inertiajs/vue3'
import { ref } from 'vue';

export default {
    components: {
        InputText,
        Button,
        Divider,
        AdminLayout,
        Dialog,

    },

    setup() {
        const showDialog = ref(false);
        const form = useForm({
            username: '',
            password: '',
            password_confirmation: '',
            userType: 2, // 2 is for TEACHER
        });

        function submitForm() {
            form.post('/teacher-create');
            showDialog.value = true
        }

        function handleDialogHide() {
            // Reset the form fields
            form.username = '';
            form.password = '';
            form.password_confirmation = '';

            // Hide the dialog
            showDialog.value = false;
        }

        return {
            form,
            submitForm,
            showDialog,
            handleDialogHide,
        };
    }

};
</script>
