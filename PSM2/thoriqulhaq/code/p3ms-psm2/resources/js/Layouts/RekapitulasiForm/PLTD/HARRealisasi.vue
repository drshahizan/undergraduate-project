<template>
    <div class="flex flex-col w-full h-full px-[34px] py-[40px]">
        <div class="flex w-full gap-[61px]">
            <div class="flex-[4_4_0%]">
                <RekapitulasiDropdown 
                    value="UNIT" 
                    :model="{
                        name: 'unit_mesin',
                        value: formState.unit_mesin
                    }"
                    :option="list_mesin"
                    :updateFormState="updateFormState"
                    unit="MW"
                />
            </div>
            <div class="flex-[5_5_0%]">
                <RekapitulasiTextArea 
                    value="KEGIATAN HAR" 
                    :model="{
                        name: 'kegiatan_har',
                        value: formState.kegiatan_har
                    }"
                    :updateFormState="updateFormState"
                />
            </div>
        </div>
        <div class="flex w-full flex-col">
            <h2 class="mb-[42px] tracking-[0.1em] text-white text-[28px] font-semibold">MATERIAL HAR</h2>
            <div class="flex w-full gap-[61px]">
                <div class="flex-[4_4_0%]">
                    <div class="flex gap-[32px]">
                        <RekapitulasiDropdown 
                            value="UNIT" 
                            :model="{
                                name: 'unit_mesin',
                                value: formState.unit_mesin
                            }"
                            :option="list_mesin"
                            :updateFormState="updateFormState"
                            unit="MW"
                            :useLabel="false"
                        />
                        <RekapitulasiInput 
                            value="STOK PENERIMAAN" 
                            :model="{
                                name: 'mesin_1_mp3',
                                value: formState.mesin_1_mp3
                            }"
                            :updateFormState="updateFormState"
                            unit="BH"
                            :useLabel="false"
                        />
                    </div>
                    <Link class="bg-[#282A39] w-full h-[44px] flex justify-center items-center rounded-[6px] px-[12px]">
                        <i class="pi pi-plus text-white mr-[12px] font-semibold"></i>
                    </Link>
                </div>
                <div class="flex-[5_5_0%]">
                    <DataTable :value="products" tableClass="min-w-full">
                        <Column headerClass="bg-[#282A39] text-white" field="id" header="ID"></Column>
                        <Column headerClass="bg-[#282A39] text-white" field="material" header="Material"></Column>
                        <Column headerClass="bg-[#282A39] text-white" field="jumlah" header="Jumlah"></Column>
                        <Column headerClass="bg-[#282A39] text-white" field="option" header="">
                            <template #body="{  }">
                                <Link>
                                    <i class="pi pi-trash text-[#E0686B] mr-[12px] font-semibold"></i>
                                </Link>
                            </template>
                        </Column>
                    </DataTable>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from "vue";
import RekapitulasiDropdown from "../../../Components/RekapitulasiDropdown.vue";
import RekapitulasiInput from '../../../Components/RekapitulasiInput.vue';
import RekapitulasiTextArea from "../../../Components/RekapitulasiTextArea.vue";
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup'; 
import Row from 'primevue/row';   

export default {
    components: {
        RekapitulasiDropdown,
        RekapitulasiInput,
        RekapitulasiTextArea,
        DataTable,
        Column,
        ColumnGroup,
        Row
    },
    props: {
        
    },
    setup(props) {
        const formState = ref({
            unit_mesin : '',
            kegiatan_har : '',
        })
        
        const list_mesin = ref([
            { name: 'Mesin 1', code: '1' },
            { name: 'Mesin 2', code: '2' },
        ]);
        
        const updateFormState = (model, isNumber = false) => {
            if (isNumber) {
                formState.value[model.name] = Number(model.value);
            } else {
                formState.value[model.name] = model.value;
            }
        };
        
        const products = [
            {
                id: '1',
                material: 'Fuel Filter',
                jumlah: 24,
            },
            {
                id: '2',
                material: 'Oil Filter',
                jumlah: 24,
            },
        ]
        
        return {
            formState,
            updateFormState,
            list_mesin,
            products
        }
    }
}
</script>