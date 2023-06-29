<template>
    <StudentLayout :page-title="'Profil Siswa'" :student="student">
        <div class="flex justify-center py-8">
            <div class="wrapper-color rounded-lg mx-[2rem] pb-[3rem] shadow-xl px-16 py-10 w-8/12">
                <h1 class="flex justify-center text-2xl font-bold mb-4">Edit Profil</h1>
                <Divider class="border-black" />
                <form @submit.prevent="submitForm" class="mt-4">
                    <div class="p-grid">
                        <!-- Add class="rounded border-gray-300 p-2 mb-4" to each InputText component -->
                        <div class="p-col-12 p-md-6 flex justify-center ">
                            <InputText v-model="form.username" class="w-full rounded border-gray-300 p-2 mb-4"
                                placeholder="Nama Pengguna" />
                        </div>
                        <div class="p-col-12 p-md-6 flex justify-center ">
                            <InputText v-model="form.password" type="password"
                                class="w-full rounded border-gray-300 p-2 mb-4" placeholder="Kata Sandi" />
                        </div>
                        <div class="p-col-12 p-md-6 flex justify-center ">
                            <InputText v-model="form.password_confirmation" type="password"
                                class="w-full rounded border-gray-300 p-2 mb-4" placeholder="Masukkan Kembali Kata Sandi" />
                        </div>
                        <div class="p-col-12 p-md-6 flex justify-center ">
                            <InputText v-model="form.name" class="w-full rounded border-gray-300 p-2 mb-4"
                                placeholder="Nama Lengkap" />
                        </div>
                        <div class="p-col-12 p-md-6 flex justify-center ">
                            <InputText v-model="form.parentName" class="w-full rounded border-gray-300 p-2 mb-4"
                                placeholder="Nama Orang Tua" />
                        </div>
                        <div class="p-col-12 p-md-6 flex justify-center ">
                            <InputText v-model="form.parentPhoneNum" class="w-full rounded border-gray-300 p-2 mb-4"
                                placeholder="Nomor Telepon Orang Tua" />
                        </div>
                        <div class="p-col-12 p-md-6 flex justify-center ">
                            <InputText v-model="form.address" class="w-full rounded border-gray-300 p-2 mb-4"
                                placeholder="Alamat" />
                        </div>
                        <div class="p-col-12 p-md-6 flex justify-center ">
                            <InputText v-model="form.dob" class="w-full rounded border-gray-300 p-2 mb-4"
                                placeholder="Tanggal Lahir" />
                        </div>
                        <div class="p-col-12 p-md-6 flex justify-center ">
                            <InputText v-model="form.gender" class="w-full rounded border-gray-300 p-2 mb-4"
                                placeholder="Jenis Kelamin" />
                        </div>
                        <div class="p-col-12 p-md-6 flex justify-center ">
                            <InputText v-model="form.nis" class="w-full rounded border-gray-300 p-2 mb-4"
                                placeholder="Nomor Induk Siswa" />
                        </div>
                        <div class="p-col-12 p-md-6 flex justify-center ">
                            <InputText v-model="form.nisn" class="w-full rounded border-gray-300 p-2 mb-4"
                                placeholder="Nomor Induk Siswa Nasional" />
                        </div>
                        <div class="p-col-12 p-md-6 flex justify-center ">
                            <InputText v-model="form.peminatan" class="w-full rounded border-gray-300 p-2 mb-4"
                                placeholder="Peminatan" readonly />
                        </div>
                    </div>
                    <Divider class="my-4" />
                    <div class="p-grid ">
                        <div class="flex justify-center ">
                            <Button type="submit" class="w-full login-button py-2 px-4 rounded" label="Tambah" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </StudentLayout>
    <Dialog v-model:visible="showDialog" header="Berhasil" @hide="handleDialogHide">
        <p>Pengguna Berhasil Ditambahkan!</p>
    </Dialog>
</template>

<script>
import StudentLayout from '../../Layouts/StudentLayout.vue';
import { ref } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';   // optional
import Row from 'primevue/row';                   // optional
import Dialog from 'primevue/dialog';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Divider from 'primevue/divider';
import { useForm } from '@inertiajs/vue3'

export default {
    components: {
        StudentLayout,
        DataTable,
        Column,
        ColumnGroup,
        Row,
        Dialog,
        InputText,
        Button,
        Divider,

    },
    props: {
        student: Object,
        user: Object,
    },
    setup(props) {
        const showDialog = ref(false);
        const form = useForm({
            username: props.user.username || '',
            password: '',
            password_confirmation: '',
            name: props.student.name || '',
            parentName: props.student.parentName || '',
            parentPhoneNum: props.student.parentPhoneNum || '',
            address: props.student.address || '',
            dob: props.student.dob || '',
            gender: props.student.gender || '',
            nis: props.student.nis || null,
            nisn: props.student.nisn || '',
            peminatan: props.student.peminatan || '',
        });

        function submitForm() {
            form.post('/update-profil-siswa');
            showDialog.value = true;
        };

        function handleDialogHide() {
            // Reset the form fields
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
}
</script>
