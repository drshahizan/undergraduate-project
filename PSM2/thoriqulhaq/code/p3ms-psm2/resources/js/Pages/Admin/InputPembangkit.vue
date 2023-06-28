<template>
    <MainLayoutAdmin sideBar="3">
        <form 
            @submit.prevent="formState.post(route('power-plant.create'))"
            class="flex flex-col flex-1" 
        >
            <div class="flex justify-between items-center mb-[2rem]">
                <div class="flex flex-col">
                    <p class="text-[#14A3B8] font-semibold">Tambah Master Data</p>
                    <p class="text-[12px]">Data Pembangkit</p>
                </div>
                <div class="flex items-center gap-[1rem]">
                    <Link href="/admin/kelola-master-data/pembangkit" class="py-[0.5rem] px-[1rem] flex justify-center items-center bg-white rounded-[0.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)]">
                        <p class="text-[#14A3B8]  text-[14px]">Batal</p>
                    </Link>
                    <button type="submit"  class="py-[0.5rem] px-[1rem] flex justify-center items-center bg-[#14A3B8] rounded-[0.5rem] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)]">
                        <p class="text-white text-[14px]">Simpan</p>
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
                            <p class="mb-[10px] text-[#A1A5B6] tracking-[0.1em] text-[14px]">Nama Pembangkit</p>
                            <InputText v-model="formState.name" placeholder="" class="p-inputtext-sm border-[1.5px] border-[#F8F8F9] bg-[#F8F8F9] rounded-[0.5rem] h-[42px] w-full"/>
                        </div>
                        <div class="mb-[1.5rem] min-w-[168px] w-full">
                            <p class="mb-[10px] text-[#A1A5B6] tracking-[0.1em] text-[14px]">Kode</p>
                            <InputText v-model="formState.code" placeholder="" class="p-inputtext-sm border-[1.5px] border-[#F8F8F9] bg-[#F8F8F9] rounded-[0.5rem] h-[42px] w-full"/>
                        </div>
                    </div>
                    <div class="flex gap-[53px]">
                        <div class="mb-[1.5rem] min-w-[168px] w-full">
                            <p class="mb-[10px] text-[#A1A5B6] tracking-[0.1em] text-[14px]">Unit</p>
                            <Dropdown v-model="formState.unit_id" :options="optionUnit" optionLabel="name" placeholder="Pilih"
                                class="w-full md:w-14rem border-[1.5px] border-[#F8F8F9] bg-[#F8F8F9] rounded-[0.5rem]" :inputStyle="{ 'width': '100%' }" inputClass="p-inputtext-sm"
                                panelClass="text-[0.875rem]" />
                        </div>
                        <div class="mb-[1.5rem] min-w-[168px] w-full">
                            <p class="mb-[10px] text-[#A1A5B6] tracking-[0.1em] text-[14px]">Tipe Pembangkit</p>
                            <Dropdown v-model="formState.power_plant_type" :options="optionPowerPlant" optionLabel="name" placeholder="Pilih"
                                class="w-full md:w-14rem border-[1.5px] border-[#F8F8F9] bg-[#F8F8F9] rounded-[0.5rem]" :inputStyle="{ 'width': '100%' }" inputClass="p-inputtext-sm"
                                panelClass="text-[0.875rem]" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-[1.5rem] font-semibold text-[#616379] flex justify-between items-center">
                <p>Detail Pembangkit</p>
                <p v-tooltip.left="{ value: `<p class='text-white text-[12px] my-[-5px]'>Hello World</p>`, escape: true}" class="pi pi-info-circle"></p>
            </div>
            <div class="bg-white rounded-[1.25rem] p-[0.5rem] px-[1.4rem] pt-[1.25rem] flex-1">
                <div class="flex flex-col mr-[54px] w-full">
                    <div class="flex gap-[53px]">
                        <div class="mb-[1.5rem] min-w-[168px] w-full">
                            <p class="mb-[10px] text-[#A1A5B6] tracking-[0.1em] text-[14px]">Jumlah Mesin</p>
                            <InputNumber v-model="formState.engine_quantity" placeholder="" class="w-full" inputClass="p-inputtext-sm border-[1.5px] border-[#F8F8F9] bg-[#F8F8F9] rounded-[0.5rem] h-[42px]"/>
                        </div>
                        <div class="mb-[1.5rem] min-w-[168px] w-full">
                            <p class="mb-[10px] text-[#A1A5B6] tracking-[0.1em] text-[14px]">Jumlah Feeder</p>
                            <InputNumber v-model="formState.feeder_quantity" placeholder="" class="w-full" inputClass="p-inputtext-sm border-[1.5px] border-[#F8F8F9] bg-[#F8F8F9] rounded-[0.5rem] h-[42px]"/>
                        </div>
                    </div>
                    <div class="flex gap-[53px]">
                        <div class="mb-[1.5rem] min-w-[168px] w-full">
                            <p class="mb-[10px] text-[#A1A5B6] tracking-[0.1em] text-[14px]">Estimasi Pemakaian</p>
                            <InputNumber v-model="formState.estimated_usage_amount" placeholder="" class="w-full" inputClass="p-inputtext-sm border-[1.5px] border-[#F8F8F9] bg-[#F8F8F9] rounded-[0.5rem] h-[42px]"/>
                        </div>
                        <div class="mb-[1.5rem] min-w-[168px] w-full">
                            <p class="mb-[10px] text-[#A1A5B6] tracking-[0.1em] text-[14px]">Deadstock</p>
                            <InputNumber v-model="formState.dead_stock_amount" placeholder="" class="w-full" inputClass="p-inputtext-sm border-[1.5px] border-[#F8F8F9] bg-[#F8F8F9] rounded-[0.5rem] h-[42px]"/>
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
import InputNumber from 'primevue/inputnumber';
import { useForm } from '@inertiajs/vue3';

export default {
    components: {
        MainLayoutAdmin,
        Dropdown,
        InputText,
        InputNumber
    },
    props: {
        listUnit: {
            type: Array,
            default: () => []
        },
    },
    setup(props) {
        const formState = useForm({
            name: '',
            code: '',
            engine_quantity: 0,
            feeder_quantity: 0,
            estimated_usage_amount: 0,
            dead_stock_amount: 0,
            power_plant_type: '',
            unit_id: ''
        })
        
        const optionUnit = ref(props.listUnit);
        
        const optionPowerPlant = ref([
            {name: 'PLTD'},
            {name: 'PLTS'},
        ]);
        
        return {
            formState,
            optionUnit,
            optionPowerPlant
        }
    }
}
</script>