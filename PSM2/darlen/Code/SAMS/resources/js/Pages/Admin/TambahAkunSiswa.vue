<template>
    <AdminLayout :page-title="'Tambah Akun Siswa'">
        <div class="flex justify-center  ">
            <div class="wrapper-color rounded-lg mx-[2rem] pb-[3rem] shadow-xl p-16 w-8/12 ">

                <h1 class="flex justify-center text-2xl font-bold mb-2">Tambah Akun Siswa</h1>
                <Divider class="border-black" />
                <form @submit.prevent="submitForm">
                    <div class="p-grid">
                        <div class="p-col-12 p-md-6 flex justify-center ">
                            <InputText v-model="form.username" class="w-full " placeholder="Nama Pengguna" />
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
                        <br />
                        <div class="p-col-12 p-md-6 flex justify-center ">
                            <Dropdown v-model="form.selectedYear" :options="academicYears" optionLabel="name"
                                optionValue="value" placeholder="Tahun Ajaran" class="flex-1 w-[10rem] md:w-14rem" />
                        </div>
                        <br />
                        <div class="p-col-12 p-md-6 flex justify-center ">
                            <Dropdown v-model="form.selectedSemester" :options="semesters" optionLabel="name"
                                placeholder="Semester" optionValue="value" class="flex-1 w-[10rem] md:w-14rem" />
                        </div>
                        <br />
                        <div class="p-col-12 p-md-6 flex justify-center ">
                            <Dropdown v-model="form.selectedPeminatan" :options="peminatan" optionLabel="name"
                                placeholder="Peminatan" optionValue="value" class="flex-1 w-[10rem] md:w-14rem" />
                        </div>
                        <div class="p-col-12 p-md-6 flex justify-center ">
                            <Dropdown v-model="form.selectedClassroom" :options="grade" optionLabel="name"
                                placeholder="Kelas" optionValue="value" class="flex-1 w-[10rem] md:w-14rem" />
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

<script >
import Textarea from 'primevue/textarea';
import Dropdown from 'primevue/dropdown';
import Divider from 'primevue/divider';
import Menubar from 'primevue/menubar';
import 'primeicons/primeicons.css';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import AdminLayout from '../../Layouts/AdminLayout.vue';
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';   // optional
import Row from 'primevue/row';
import Dialog from 'primevue/dialog';



export default {
    components: {
        Textarea,
        Dropdown,
        Button,
        AdminLayout,
        InputText,
        Divider,
        DataTable,
        Column,
        ColumnGroup,
        Row,
        Menubar,
        Dialog,

    },

    setup() {
        const showDialog = ref(false);
        const form = useForm({
            username: '',
            password: '',
            password_confirmation: '',
            userType: 3, // 3 is for STUDENT
            selectedYear: null,
            selectedSemester: null,
            selectedPeminatan: null,
            selectedClassroom: null,
        });

        const academicYears = [
            { name: '2019/2020', value: '2019/2020' },
            { name: '2020/2021', value: '2020/2021' },

        ];

        const semesters = [
            { name: 'Ganjil', value: 'Ganjil' },
            { name: 'Genap', value: 'Genap' },

        ];

        const peminatan = [
            { name: 'MIPA', value: 'MIPA' },
            { name: 'IPS', value: 'IPS' },

        ];

        const grade = [
            { name: 'X MIPA', value: 'X MIPA' },
            { name: 'X IPS', value: 'X IPS' },
            { name: 'XI MIPA', value: 'XI MIPA' },
            { name: 'XI IPS', value: 'XI IPS' },
            { name: 'XII MIPA', value: 'XII MIPA' },
            { name: 'XII IPS', value: 'XII IPS' },

        ];
        function submitForm() {

            form.post('/student-create');
            showDialog.value = true
        }

        function handleDialogHide() {
            form.username = '';
            form.password = '';
            form.password_confirmation = '';
            form.selectedYear = null;
            form.selectedSemester = null;
            form.selectedPeminatan = null;
            form.selectedClassroom = null;
            showDialog.value = false;
        }

        return {
            form,
            submitForm,
            showDialog,
            handleDialogHide,
            academicYears,
            semesters,
            peminatan,
            grade,
        };
    },
};
</script>
