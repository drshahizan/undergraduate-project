<template>
    <TeacherLayout :page-title="'Detail SPP'">
        <div class="spp-table-wrapper">

            <h1 class="mx-[2rem] text-2xl font-bold mb-4">{{ studentName }}</h1>

            <DataTable class="mx-[2rem] " v-model:filters="filters" :value="tuitionRecords" tableStyle="min-width: 70rem "
                dataKey="id" :loading="loading"
                :globalFilterFields="['name', 'country.name', 'representative.name', 'status']" editMode="cell"
                @cell-edit-complete="onCellEditComplete" tableClass="editable-cells-table">

                <Column style="min-width: 6rem" field="month" header="Bulan"></Column>
                <Column style="min-width: 6rem" field="paymentDate" header="Tanggal"></Column>
                <Column style="min-width: 6rem" field="paymentAmount" header="Total"></Column>
                <Column style="min-width: 6rem" field="paymentProof" header="Bukti"></Column>
                <Column style="min-width: 6rem" field="tuitionStatus.status" header="Status">
                    <template #body="slotProps">
                        <Dropdown v-model="slotProps.data.tuitionStatus_id" :options="statusOptions"
                            @change="updateStatus(slotProps.data)" optionLabel="status" optionValue="id" />
                    </template>
                </Column>

                <Column style="min-width: 6rem" class="" field="name" header=""></Column>

                <Column style="min-width: 6rem" header="Aksi">
                    <template #body="">
                        <Button type="button" label="Ubah" severity="success" />
                    </template>
                </Column>
            </DataTable>
        </div>
        <Toast ref="toast"></Toast>
    </TeacherLayout>
</template>


<style scoped>
.spp-table-wrapper {
    max-height: 40rem;
    overflow-y: auto;
}
</style>



<script >
import TeacherLayout from '../../Layouts/TeacherLayout.vue';
import Divider from 'primevue/divider';
import 'primeicons/primeicons.css';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Sidebar from 'primevue/sidebar';
import { ref } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';
import Dropdown from 'primevue/dropdown';
import { FilterMatchMode } from 'primevue/api';
import { Inertia } from '@inertiajs/inertia';
import Toast from 'primevue/toast';
import ToastService from 'primevue/toastservice';

export default {
    components: {
        Button,
        Sidebar,
        TeacherLayout,
        DataTable,
        Column,
        ColumnGroup,
        InputText,
        Divider,
        Dropdown,
        Toast,

    },
    props: {
        tuitionRecords: Array,
        studentId: String,
        studentName: String,
    },
    setup(props) {

        const statusOptions = [
            { status: 'Paid', id: 1 }, // replace 1 and 2 with the actual IDs of the statuses in your database
            { status: 'Unpaid', id: 2 },
        ];

        const toast = ref(null);

        const showErrorToast = (message) => {
            toast.value.add({
                severity: 'error',
                summary: 'Error',
                detail: message,
                life: 5000,
            });
        };

        const updateStatus = (record) => {
            Inertia.post(`/detail-spp/${props.studentId}/status`, {
                tuitionStatus_id: record.tuitionStatus_id,
            }, {
                preserveState: true,
                preserveScroll: true,
                onError: (errors) => {
                    if (errors.tuitionStatus_id) {
                        showErrorToast(errors.tuitionStatus_id);
                    } else {
                        showErrorToast("An error occurred while updating the status.");
                    }
                },
            });
        };
        const tuitionRecords = ref([]);
        return {

            tuitionRecords: props.tuitionRecords,
            loading: false,
            studentName: props.studentName,
            statusOptions: statusOptions,
            updateStatus: updateStatus,
            toast,
            showErrorToast,
        }
    }
}
</script>
