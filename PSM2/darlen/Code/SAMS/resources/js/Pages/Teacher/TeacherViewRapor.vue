<template>
    <TeacherLayout :page-title="'Rapor'">




        <div class="flex justify-center items-center mt-12">
            <img class="w-1/2" src="/images/rapor.png" alt="">
        </div>

    </TeacherLayout>
</template>

<script >

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
import Row from 'primevue/row';                   // optional


export default {
    components: {
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


        return {


        }
    }
}
</script>
