<template>
    <MainLayoutAdmin sideBar="2">
        <div class="flex justify-between items-center mb-[2rem]">
            <div class="flex flex-col">
                <p class="text-[#14A3B8] font-semibold">Kelola Akun</p>
                <p class="text-[12px]">Pengguna Staff</p>
            </div>
            <div>
                <Link href="/admin/kelola-akun/staff/input" class="py-[0.5rem] px-[1rem] flex justify-center items-center bg-[#14A3B8] rounded-[0.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)]">
                    <p class="text-white text-[14px]">Tambah Akun</p>
                </Link>
            </div>
        </div>
        <div class="bg-white flex-1 rounded-[2rem] p-[0.5rem] relative">
            <div class="card h-full">
                <DataTable removableSort v-model:filters="filters" :value="data" paginator :rows="6" dataKey="id" :loading="loading" class="bg-white rounded-[1rem] flex flex-col h-full" headerClass="bg-white border-none" tableClass="border-none"
                        :globalFilterFields="['name']">
                    <template #header>
                        <div class="flex justify-between items-center">
                            <div class="flex gap-[1.5rem]">
                                <Dropdown v-model="selectedStaff" :options="optionStaff" optionLabel="name" placeholder="Pilih Staff"
                                class="w-full md:w-14rem border-[1.5px] border-[#F8F8F9] bg-[#F8F8F9] rounded-[0.5rem]" :inputStyle="{ 'width': '100%' }" inputClass="p-inputtext-sm  h-[42px]"
                                panelClass="text-[0.875rem]" />
                                <Dropdown v-model="selectedPowerPlantType" :options="optionPowerPlantType" optionLabel="name" placeholder="Pilih Pembangkit"
                                class="w-full md:w-14rem border-[1.5px] border-[#F8F8F9] bg-[#F8F8F9] rounded-[0.5rem]" :inputStyle="{ 'width': '100%' }" inputClass="p-inputtext-sm  h-[42px]"
                                panelClass="text-[0.875rem]" />
                            </div>
                            <span class="p-input-icon-right">
                                <InputText v-model="filters['global'].value" placeholder="Cari Staff" class="p-inputtext-sm border-[1.5px] border-[#F8F8F9] bg-[#F8F8F9] rounded-[0.5rem] h-[42px]"/>
                                <i class="pi pi-search" />
                            </span>
                        </div>
                    </template>
                    <template #empty> No data found. </template>
                    <template #loading> Loading data. Please wait. </template>
                    <Column sortable field="name" header="Nama" style="min-width: 9rem">
                        <template #body="{ data }">
                            {{ data.name }}
                        </template>
                    </Column>
                    <Column sortable field="username" header="Username" style="min-width: 9rem">
                        <template #body="{ data }">
                            {{ data.username }}
                        </template>
                    </Column>
                    <Column sortable field="pembangkit" header="Pembangkit" style="min-width: 9rem">
                        <template #body="{ data }">
                            {{ data.power_plant_name }}
                        </template>
                    </Column>
                    <Column sortable field="status" header="Tipe Staff" style="min-width: 9rem">
                        <template #body="{ data }">
                            <Tag :severity="data.user_type != 'Staff PIC' ? 'warning' : 'success'" :value="data.user_type"></Tag>
                        </template>
                    </Column>
                    <Column sortable field="tipe_rekap" header="Tanggal" style="width: 5rem">
                        <template #body="{ data }">
                            {{ formatReadableDate(data.created_at) }}
                        </template>
                    </Column>
                    <Column field="aksi" header="Aksi" style="width: 9rem">
                        <template #body="{ data }">
                            <div class="flex justify-center items-center gap-[1rem]">
                                <Link :href="'/admin/kelola-akun/staff/edit/' + data.id">
                                    <div class="py-[0.5rem] px-[1rem] flex justify-center items-center bg-[#5CA6FD] rounded-[0.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)]">
                                        <p class="text-white text-[14px]">Edit</p>
                                    </div>
                                </Link>
                                <button 
                                    v-on:click="() => { 
                                        modalHapusData = !modalHapusData 
                                        idHapusData = data.id
                                    }" 
                                    class="py-[0.5rem] px-[1rem] flex justify-center items-center bg-[#F1406D] rounded-[0.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)]"
                                >
                                    <p class="text-white text-[14px]">Hapus</p>
                                </button>
                            </div>
                        </template>
                    </Column>
                </DataTable>
            </div>
            <div v-if="modalHapusData" class="absolute flex justify-center items-center h-full w-full top-0 left-0 rounded-[1.5rem] bg-[#F1F4F5] bg-opacity-40">
                <div class="w-[30rem] h-[15rem] bg-white rounded-[1.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)] flex flex-col">
                    <div class="px-[2rem] py-[1.25rem] flex justify-between items-center bg-[#EF406C] rounded-tr-[1.5rem] rounded-tl-[1.5rem] mb-[1rem]">
                        <p class="font-semibold text-white">Hapus Data</p>
                    </div>
                    <div class="flex-1 px-[2rem] py-[1.25rem]">
                        <p class="text-[#A0A4B6] text-[14px]">Dengan menekan tombol <span class="font-semibold">Ya</span> dibawah, berarti anda telah yakin menghapus data ini.</p>
                    </div>
                    <div class="flex justify-end items-center px-[2rem] py-[1.25rem] gap-[1rem]">
                        <button 
                            v-on:click="() => { 
                                modalHapusData = !modalHapusData 
                                idHapusData = null
                            }" 
                            class="py-[0.5rem] px-[1rem] flex justify-center items-center bg-white rounded-[0.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.15)]"
                        >
                            <p class="text-[#EF406C] text-[14px]">Tidak</p>
                        </button>
                        <Link :href="'/admin/kelola-akun/staff/delete/' + idHapusData" class="py-[0.5rem] px-[1rem] flex justify-center items-center bg-[#EF406C] rounded-[0.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)]">
                            <p class="text-white text-[14px]">Ya</p>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </MainLayoutAdmin>
</template>

<script>
import { ref } from "vue";
import MainLayoutAdmin from '../../Layouts/Admin/MainLayout.vue';
import InputText from 'primevue/inputtext';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup'; 
import Row from 'primevue/row';
import { FilterMatchMode } from 'primevue/api';
import Tag from 'primevue/tag';
import Dropdown from 'primevue/dropdown';

export default {
    components: {
        MainLayoutAdmin,
        InputText,
        DataTable,
        Column,
        ColumnGroup,
        Row,
        Tag,
        Dropdown
    },
    props: {
        listData: {
            type: Array,
            default: () => []
        }
    },
    setup(props) {
        const modalHapusData = ref(false);
        const idHapusData = ref();
        const selectedPowerPlantType = ref(null);
        const selectedStaff = ref(null);
        
        const data = ref(props.listData);
        const optionPowerPlantType = [
            { name : 'PLTD' },
            { name : 'PLTS' },
        ]
        const optionStaff = [
            { name : 'PIC' },
            { name : 'Operator' },
        ]
        
        const filters = ref({
            global: { value: null, matchMode: FilterMatchMode.CONTAINS },
            power_plant_name: { value: null, matchMode: FilterMatchMode.CONTAINS },
            user_type : { value: null, matchMode: FilterMatchMode.CONTAINS },
        });
        
        const formatDate = (value) => {
            return value.toLocaleDateString('en-US', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            });
        };
        
        const formatReadableDate = (value) => {
            const date = new Date(value);
            const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
            const formatter = new Intl.DateTimeFormat('id-ID', options);
            const formattedDate = formatter.format(date);
            
            return formattedDate;
        }
        
        return {
            data,
            filters,
            formatDate,
            modalHapusData,
            idHapusData,
            formatReadableDate,
            optionPowerPlantType,
            optionStaff,
            selectedPowerPlantType,
            selectedStaff
        }
    },
    watch: {
        selectedPowerPlantType(newValue) {
            this.filters['power_plant_name'].value = newValue ? newValue.name : null;
        },
        selectedStaff(newValue) {
            this.filters['user_type'].value = newValue ? newValue.name : null;
        }
    },
}
</script>