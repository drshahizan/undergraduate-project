<template>
    <TeacherLayout :page-title="'Buat Rapor'">

        <div class="wrapper-color rounded-lg mx-[2rem] p-[1rem] pb-[3rem]">

            <h1 class="text-2xl font-bold text-center my-6">John Doe</h1>

            <div class="mt-6 mb-6">
                <h2 class="text-2xl font-bold text-center mb-6">Ekstrakulikuler</h2>

                <div class="mt-4 flex flex-1 gap-4 mx-32">
                    <!-- Modified grid layout and adjusted column sizes -->

                    <div class="w-full flex justify-center">
                        <InputText class="flex-1" id="username" v-model="value" placeholder="Nama Ekstrakulikuler" />
                    </div>
                    <div class="w-full flex justify-center">
                        <Dropdown class="flex-1" v-model="selectedCity" :options="cities" optionLabel="name"
                            placeholder="Nilai" />
                    </div>
                </div>

                <div class="mt-4 w-full flex justify-center">
                    <Textarea v-model="value" rows="5" placeholder="Deskripsi" class="w-[80%]">
                                                                                                        </Textarea>
                </div>
            </div>

            <div class="mt-6 mb-6">
                <h2 class="text-2xl font-bold text-center mb-6">Prestasi</h2>

                <div class="mt-4 w-full flex justify-center">
                    <InputText class="w-[80%]" id="username" v-model="value" placeholder="Nama Prestasi" />
                </div>

                <div class="mt-4 w-full flex justify-center">
                    <Textarea v-model="value" rows="5" placeholder="Deskripsi" class="w-[80%]">
                                                                                                        </Textarea>
                </div>
            </div>
        </div>
    </TeacherLayout>
</template>




<script >
import Textarea from 'primevue/textarea';
import Dropdown from 'primevue/dropdown';
import Divider from 'primevue/divider';
import Menubar from 'primevue/menubar';
import 'primeicons/primeicons.css';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import TeacherLayout from '../../Layouts/TeacherLayout.vue';
import { ref } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';   // optional
import Row from 'primevue/row';


export default {
    components: {
        Textarea,
        Dropdown,
        Button,
        TeacherLayout,
        InputText,
        Divider,
        DataTable,
        Column,
        ColumnGroup,
        Row,
        Menubar,
    },

    setup(props) {
        const visible = ref(false);

        return {
            visible: visible,


        }
    }
}
</script>
