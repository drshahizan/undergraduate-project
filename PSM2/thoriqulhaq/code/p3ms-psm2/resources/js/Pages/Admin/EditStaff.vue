<template>
    <MainLayoutAdmin sideBar="2">
        <form 
        @submit.prevent="formState.post(route('staff.update',  { id: data.id }))"
            class="flex flex-col flex-1" 
        >
            <div class="flex justify-between items-center mb-[2rem]">
                <div class="flex flex-col">
                    <p class="text-[#14A3B8] font-semibold">Edit Akun</p>
                    <p class="text-[12px]">Pengguna Staff</p>
                </div>
                <div class="flex items-center gap-[1rem]">
                    <Link href="/admin/kelola-akun/staff" class="py-[0.5rem] px-[1rem] flex justify-center items-center bg-white rounded-[0.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)]">
                        <p class="text-[#14A3B8]  text-[14px]">Batal</p>
                    </Link>
                    <button type="submit" class="py-[0.5rem] px-[1rem] flex justify-center items-center bg-[#14A3B8] rounded-[0.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)]">
                        <p class="text-white text-[14px]">Simpan Perubahan</p>
                    </button>
                </div>
            </div>
            <div class="mb-[1.5rem] font-semibold text-[#616379] flex justify-between items-center">
                <p>Informasi Dasar</p>
                <p v-tooltip.left="{ value: `<p class='text-white text-[12px] my-[-5px]'>Hello World</p>`, escape: true}" class="pi pi-info-circle"></p>
            </div>
            <div class="bg-white rounded-[1.25rem] p-[0.5rem] px-[1.4rem] pt-[1.25rem]">
                <div class="flex flex-col mr-[54px] w-full">
                    <div class="flex gap-[53px]">
                        <div class="mb-[1.5rem] min-w-[168px] w-full">
                            <p class="mb-[10px] text-[#A1A5B6] tracking-[0.1em] text-[14px]">Username</p>
                            <InputText v-model="formState.username" placeholder="" class="p-inputtext-sm border-[1.5px] border-[#F8F8F9] bg-[#F8F8F9] rounded-[0.5rem] h-[42px] w-full"/>
                        </div>
                        <div class="mb-[1.5rem] min-w-[168px] w-full">
                            <p class="mb-[10px] text-[#A1A5B6] tracking-[0.1em] text-[14px]">Password</p>
                            <Password v-model="formState.password" :feedback="false" toggleMask placeholder="" class="w-full" inputClass="p-inputtext-sm border-[1.5px] border-[#F8F8F9] bg-[#F8F8F9] rounded-[0.5rem] h-[42px] w-full"/>
                        </div>
                    </div>
                    <div class="flex gap-[53px]">
                        <div class="mb-[1.5rem] min-w-[168px] w-full">
                            <p class="mb-[10px] text-[#A1A5B6] tracking-[0.1em] text-[14px]">Ketik Ulang Password</p>
                            <Password v-model="formState.password" :feedback="false" toggleMask placeholder="" class="w-full" inputClass="p-inputtext-sm border-[1.5px] border-[#F8F8F9] bg-[#F8F8F9] rounded-[0.5rem] h-[42px] w-full"/>
                        </div>
                        <div class="mb-[32px] min-w-[168px] w-full">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-[1.5rem] font-semibold text-[#616379] flex justify-between items-center">
                <p>Detail Pengguna</p>
                <p v-tooltip.left="{ value: `<p class='text-white text-[12px] my-[-5px]'>Hello World</p>`, escape: true}" class="pi pi-info-circle"></p>
            </div>
            <div class="bg-white rounded-[1.25rem] p-[0.5rem] px-[1.4rem] pt-[1.25rem] flex-1">
                <div class="flex flex-col mr-[54px] w-full">
                    <div class="flex gap-[53px]">
                        <div class="mb-[1.5rem] min-w-[168px] w-full">
                            <p class="mb-[10px] text-[#A1A5B6] tracking-[0.1em] text-[14px]">Nama</p>
                            <InputText v-model="formState.name" placeholder="" class="p-inputtext-sm border-[1.5px] border-[#F8F8F9] bg-[#F8F8F9] rounded-[0.5rem] h-[42px] w-full"/>
                        </div>
                        <div class="mb-[1.5rem] min-w-[168px] w-full">
                            <p class="mb-[10px] text-[#A1A5B6] tracking-[0.1em] text-[14px]">Tipe Staff</p>
                            <Dropdown v-model="formState.user_type" :options="optionStaffType" optionLabel="name" placeholder="Pilih"
                                class="w-full md:w-14rem border-[1.5px] border-[#F8F8F9] bg-[#F8F8F9] rounded-[0.5rem]" :inputStyle="{ 'width': '100%' }" inputClass="p-inputtext-sm"
                                panelClass="text-[0.875rem]" />
                        </div>
                    </div>
                    <div class="flex gap-[53px]">
                        <div class="mb-[1.5rem] min-w-[168px] w-full">
                            <p class="mb-[10px] text-[#A1A5B6] tracking-[0.1em] text-[14px]">Tipe Pembangkit</p>
                            <Dropdown v-on:change="filterPowerPlant()" v-model="formState.power_plant_type" :options="optionPowerPlantType" optionLabel="name" placeholder="Pilih"
                                class="w-full md:w-14rem border-[1.5px] border-[#F8F8F9] bg-[#F8F8F9] rounded-[0.5rem]" :inputStyle="{ 'width': '100%' }" inputClass="p-inputtext-sm"
                                panelClass="text-[0.875rem]" />
                        </div>
                        <div class="mb-[1.5rem] min-w-[168px] w-full">
                            <p class="mb-[10px] text-[#A1A5B6] tracking-[0.1em] text-[14px]">Pembangkit</p>
                            <Dropdown v-model="formState.power_plant_id" :options="optionPowerPlant" optionLabel="name" placeholder="Pilih"
                                class="w-full md:w-14rem border-[1.5px] border-[#F8F8F9] bg-[#F8F8F9] rounded-[0.5rem]" :inputStyle="{ 'width': '100%' }" inputClass="p-inputtext-sm"
                                panelClass="text-[0.875rem]" />
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </MainLayoutAdmin>
</template>

<script>
import { ref } from "vue";
import MainLayoutAdmin from '../../Layouts/Admin/MainLayout.vue';
import Dropdown from 'primevue/dropdown';
import InputText from 'primevue/inputtext';
import Password from 'primevue/password';
import { useForm } from '@inertiajs/vue3';

export default {
    components: {
        MainLayoutAdmin,
        Dropdown,
        InputText,
        Password
    },
    props: {
        listPowerPlant: {
            type: Array,
            default: () => []
        },
        data: {
            type: Object,
            default: () => ({})
        }
    },
    setup(props) {
        const optionPowerPlant = ref([]);
        
        const optionPowerPlantType = ref([
            {name: 'PLTD'},
            {name: 'PLTS'},
        ]);
        
        const optionStaffType = ref([
            {name: 'Staff PIC', id: 2},
            {name: 'Staff Operator', id: 3},
        ]);
        
        const filterPowerPlant = () => {
            optionPowerPlant.value = props.listPowerPlant.filter((item) => {
                return item.type == formState.power_plant_type.name;
            });
        }
        
        const getCurrentPowerPlantType = (name) => {
            optionPowerPlant.value = props.listPowerPlant.filter((item) => {
                return item.type == name;
            });
            return optionPowerPlantType.value.find(powerPlantType => powerPlantType.name == name);
        };
        
        const getCurrentPowerPlant = (id) => {
            return optionPowerPlant.value.find(powerPlant => powerPlant.id == id);
        };
        
        const getCurrentUserType = (name) => {
            return optionStaffType.value.find(userType => userType.name == name);
        }
        
        const formState = useForm({
            name: props.data.name,
            power_plant_type: getCurrentPowerPlantType(props.data.power_plant_type),
            power_plant_id: getCurrentPowerPlant(props.data.power_plant_id),
            user_type: getCurrentUserType(props.data.user_type),
            username: props.data.username,
            password: '',
        })
        
        return {
            formState,
            optionStaffType,
            optionPowerPlant,
            optionPowerPlantType,
            filterPowerPlant
        }
    }
}
</script>