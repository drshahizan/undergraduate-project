<template>
    <StudentLayout :page-title="'SPP'">
        <div class="spp-table-wrapper ">
            <DataTable class="mx-[2rem] " v-model:filters="filters" :value="tuitionRecords" tableStyle="min-width: 70rem "
                dataKey="id" :loading="loading"
                :globalFilterFields="['name', 'country.name', 'representative.name', 'status']" editMode="cell"
                @cell-edit-complete="onCellEditComplete" tableClass="editable-cells-table">

                <Column style="min-width: 6rem" field="month" header="Bulan"></Column>
                <Column style="min-width: 6rem" field="paymentDate" header="Tanggal">
                    <template #body="slotProps">
                        <Calendar v-model="slotProps.data.paymentDate" :showIcon="true" />
                    </template>
                </Column>
                <Column style="min-width: 6rem" field="paymentAmount" header="Total">
                    <template #body="slotProps">
                        <InputText v-model="slotProps.data.paymentAmount" type="number" />
                    </template>
                </Column>
                <Column style="min-width: 6rem" field="paymentProof" header="Bukti">
                    <template #body="slotProps">
                        <input type="file" @change="onFileChange($event, slotProps.data)" />
                    </template>
                </Column>
                <Column style="min-width: 6rem" field="tuitionStatus.status" header="Status">
                </Column>

                <Column style="min-width: 6rem" class="" field="name" header=""></Column>

                <Column style="min-width: 6rem" header="Aksi">
                    <template #body="slotProps">
                        <Button type="button" label="Simpan" severity="success" @click="saveRecord(slotProps.data)" />
                    </template>
                </Column>
            </DataTable>
        </div>
    </StudentLayout>
</template>


<style scoped>
.spp-table-wrapper {
    max-height: 40rem;
    overflow-y: auto;
}
</style>



<script >
import StudentLayout from '../../Layouts/StudentLayout.vue';
import Divider from 'primevue/divider';
import 'primeicons/primeicons.css';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Sidebar from 'primevue/sidebar';
import Calendar from 'primevue/calendar'; // Add this line
import { ref } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';
import Dropdown from 'primevue/dropdown';
import { FilterMatchMode } from 'primevue/api';
import { Inertia } from '@inertiajs/inertia';


export default {
    components: {
        Button,
        Sidebar,
        StudentLayout,
        DataTable,
        Column,
        ColumnGroup,
        InputText,
        Divider,
        Calendar,
        Dropdown,

    },
    props: {
        tuitionRecords: Array,

    },
    setup(props) {
        const onFileChange = (e, record) => {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            let reader = new FileReader();
            reader.onload = (e) => {
                record.paymentProof = e.target.result;
            };
            reader.readAsDataURL(files[0]);
        };

        const saveRecord = (record) => {
            let formData = new FormData();
            formData.append('paymentDate', record.paymentDate);
            formData.append('paymentAmount', record.paymentAmount);
            formData.append('paymentProof', record.paymentProof);

            Inertia.post(`/student/spp/${record.id}`, formData);
        };



        return {
            tuitionRecords: props.tuitionRecords,
            onFileChange,
            saveRecord,
        }
    }
}
</script>
