<template>
    <TeacherLayout :page-title="'Jadwal Pelajaran'">
        <div class="flex-1 ">
            <Dropdown v-model="selectedClassroom" :options="classrooms" optionLabel="grade" placeholder="Kelas"
                class="flex-1 w-[10rem] md:w-8rem mr-6 mx-[2rem] mb-6" @update:modelValue="getClassTimetable" />
            <DataTable class="mx-[2rem] mb-4" v-model:filters="filters" :value="timetable" tableStyle="min-width: 70rem"
                dataKey="id" :loading="loading" :globalFilterFields="['classroom_id']" editMode="cell"
                @cell-edit-complete="onCellEditComplete" tableClass="editable-cells-table">

                <Column style="min-width: 6rem" class="" field="day" header="Hari"></Column>

                <Column field="hour_1_subject_id" style="min-width: 6rem" header="1">
                    <template #body="slotProps">
                        <Dropdown :modelValue="getSubject(slotProps.data.hour_1_subject_id)" :options="subjects"
                            optionLabel="subjectName" @update:modelValue="getSubject(slotProps.data.hour_1_subject_id)">
                        </Dropdown>
                    </template>
                </Column>

                <Column field="hour_2_subject_id" style="min-width: 6rem" header="2">
                    <template #body="slotProps">
                        <Dropdown :modelValue="getSubject(slotProps.data.hour_2_subject_id)" :options="subjects"
                            optionLabel="subjectName" @update:modelValue="getSubject(slotProps.data.hour_2_subject_id)">
                        </Dropdown>
                    </template>
                </Column>

                <Column field="hour_3_subject_id" style="min-width: 6rem" header="3">
                    <template>
                        <Dropdown :modelValue="slotProps.data.hour_3_subject_id" :options="subjects"
                            optionLabel="subjectName"
                            @update:modelValue="slotProps.data.hour_3_subject_id = $event === -1 ? null : $event">
                        </Dropdown>
                    </template>
                </Column>
                <Column field="hour_4_subject_id" style="min-width: 6rem" header="4">
                    <template>
                        <Dropdown :modelValue="slotProps.data.hour_4_subject_id" :options="subjects"
                            optionLabel="subjectName"
                            @update:modelValue="slotProps.data.hour_4_subject_id = $event === -1 ? null : $event">
                        </Dropdown>
                    </template>
                </Column>
                <Column field="hour_5_subject_id" style="min-width: 6rem" header="5">
                    <template>
                        <Dropdown :modelValue="slotProps.data.hour_5_subject_id" :options="subjects"
                            optionLabel="subjectName"
                            @update:modelValue="slotProps.data.hour_5_subject_id = $event === -1 ? null : $event">
                        </Dropdown>
                    </template>
                </Column>
                <Column field="hour_6_subject_id" style="min-width: 6rem" header="6">
                    <template>
                        <Dropdown :modelValue="slotProps.data.hour_6_subject_id" :options="subjects"
                            optionLabel="subjectName"
                            @update:modelValue="slotProps.data.hour_6_subject_id = $event === -1 ? null : $event">
                        </Dropdown>
                    </template>
                </Column>
                <Column field="hour_7_subject_id" style="min-width: 6rem" header="7">
                    <template>
                        <Dropdown :modelValue="slotProps.data.hour_7_subject_id" :options="subjects"
                            optionLabel="subjectName"
                            @update:modelValue="slotProps.data.hour_7_subject_id = $event === -1 ? null : $event">
                        </Dropdown>
                    </template>
                </Column>
                <Column field="hour_8_subject_id" style="min-width: 6rem" header="8">
                    <template>
                        <Dropdown :modelValue="slotProps.data.hour_8_subject_id" :options="subjects"
                            optionLabel="subjectName"
                            @update:modelValue="slotProps.data.hour_8_subject_id = $event === -1 ? null : $event">
                        </Dropdown>
                    </template>
                </Column>
                <Column style="min-width: 6rem" header="Action">
                    <template #body="">
                        <Button type="button" label="Edit" severity="success" />
                        <Button type="button" label="Save" severity="info" @click="saveTimetable(slotProps.data)" />
                    </template>
                </Column>
            </DataTable>
        </div>
    </TeacherLayout>
</template>

<script >

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
import { Inertia } from '@inertiajs/inertia';
import { FilterMatchMode } from 'primevue/api';
import Dropdown from 'primevue/dropdown';


export default {
    components: {
        Button,
        TeacherLayout,
        InputText,
        DataTable,
        Column,
        ColumnGroup,
        Row,
        Menubar,
        Dropdown,

    },
    props: {
        classrooms: Array,
        timetable: Array,
        subjects: Array,
    },
    setup(props) {
        const selectedClassroom = ref(null);
        const classrooms = ref(props.classrooms);
        const timetable = ref(props.timetable);
        const subjects = ref(props.subjects);
        const filters = ref({
            classroom_id: { value: null, matchMode: FilterMatchMode.EQUALS },
            semester: { value: null, matchMode: FilterMatchMode.CONTAINS },
            academicYear: { value: null, matchMode: FilterMatchMode.CONTAINS },
            global: { value: null, matchMode: FilterMatchMode.CONTAINS },
            name: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
        });

        const getSubject = (id) => { return subjects.value.find(subject => subject.id === id) };

        const getClassTimetable = () => {
            if (selectedClassroom.value) {
                Inertia.visit('/jadwal-pelajaran/' + selectedClassroom.value.id);
            }
        };


        return {
            selectedClassroom,
            classrooms,
            timetable,
            subjects,
            getClassTimetable,
            filters,
            getSubject,

        }
    },

    watch: {
        selectedClassroom() {
            this.getClassTimetable();
        },
    },
}
</script>
