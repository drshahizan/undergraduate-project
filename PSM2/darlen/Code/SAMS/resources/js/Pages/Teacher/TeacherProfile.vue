<template>
    <TeacherLayout :page-title="'Profil Siswa'" :student="student">
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
    </TeacherLayout>
    <Dialog v-model:visible="showDialog" header="Berhasil" @hide="handleDialogHide">
        <p>Pengguna Berhasil Ditambahkan!</p>
    </Dialog>
</template>

<script>
import TeacherLayout from '../../Layouts/TeacherLayout.vue';
import 'primeicons/primeicons.css';
import { FilterMatchMode } from 'primevue/api';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import { ref } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';   // optional
import Row from 'primevue/row';                   // optional
import Dropdown from 'primevue/dropdown';


export default {
    components: {
        Button,
        InputText,
        DataTable,
        Column,
        ColumnGroup,
        Row,
        TeacherLayout,
        Dropdown,
    },

    setup(props) {
        const visible = ref(false);
        const products = [
            {
                id: '1',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },
            {
                id: '2',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',

            },
            {
                id: '3',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },
            {
                id: '4',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },
            {
                id: '5',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },
            {
                id: '6',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },
            {
                id: '7',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },
            {
                id: '8',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },
            {
                id: '9',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },
            {
                id: '14',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },
            {
                id: '15',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },
            {
                id: '16',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },
            {
                id: '115',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },
            {
                id: '116',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },
            {
                id: '115',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },
            {
                id: '1116',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },
            {
                id: '1115',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },
            {
                id: '1116',
                name: 'John Doe',
                nis: 111111111111,
                peminatan: 'MIPA',
            },

        ];

        const filters = ref({
            global: { value: null, matchMode: FilterMatchMode.CONTAINS },
            name: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
            'country.name': { value: null, matchMode: FilterMatchMode.STARTS_WITH },
            representative: { value: null, matchMode: FilterMatchMode.IN },
            status: { value: null, matchMode: FilterMatchMode.EQUALS },
            verified: { value: null, matchMode: FilterMatchMode.EQUALS }
        });

        return {
            visible: visible,
            products: products,
            filters: filters,
        }
    }
}
</script>
