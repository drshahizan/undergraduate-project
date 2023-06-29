<template>
    <div class="flex flex-col w-full h-full">
        <div class="flex w-full flex-col">
            <div class="flex w-full gap-[61px]">
                <div class="flex-[4_4_0%]">
                    <div class="flex gap-[32px]">
                        <RekapitulasiDropdown 
                            value="MATERIAL" 
                            :model="{
                                name: 'material',
                                value: formState.material
                            }"
                            :option="optionMaterial"
                            :updateFormState="updateFormState"
                            unit=""
                            :useLabel="false"
                        />
                        <RekapitulasiInput 
                            value="JUMLAH" 
                            :model="{
                                name: 'quantity',
                                value: formState.quantity
                            }"
                            :updateFormState="updateFormState"
                            unit="BH"
                            :useLabel="false"
                        />
                    </div>
                    <RekapitulasiDropdown 
                            value="STATUS" 
                            :model="{
                                name: 'status',
                                value: formState.status
                            }"
                            :option="optionStatus"
                            :updateFormState="updateFormState"
                            unit=""
                            :useLabel="false"
                        />
                    <button v-on:click="addSelectedMaterial()" class="bg-[#12A4B9] w-full h-[38px] flex justify-center items-center rounded-[6px] px-[12px]">
                        <i class="pi pi-plus text-white mr-[12px] font-semibold"></i>
                    </button>
                </div>
                <div class="flex-[5_5_0%] recap-input-table mb-[2rem]">
                    <DataTable :value="selectedMaterial" tableClass="min-w-full">
                        <template #empty>
                            <div class="flex justify-center items-center">
                                <p class="italic text-[#A7ACB0]">Data tidak ditemukan</p>
                            </div>
                        </template>
                        <template #loading>
                            <div class="flex justify-center items-center">
                                <p class="italic text-[#A7ACB0]">Sedang memuat data, harap tunggu</p>
                            </div>
                        </template>
                        <Column bodyClass="p-[0.75rem]" headerClass="p-[0.75rem] text-[#6D757D]" field="material" header="Material" style="min-width: 4rem"></Column>
                        <Column bodyClass="p-[0.75rem]" headerClass="p-[0.75rem] text-[#6D757D]" field="quantity" header="Jumlah" style="width: 10rem"></Column>
                        <Column bodyClass="p-[0.75rem]" headerClass="p-[0.75rem] text-[#6D757D]" field="status" header="Status" style="width: 10rem"></Column>
                        <Column bodyClass="p-[0.75rem]" headerClass="p-[0.75rem] text-[#6D757D]" field="option" header="" style="width: 4rem">
                            <template #body="{ data }">
                                <button v-on:click="deleteSelectedMaterial(data.id)" class="py-[0.5rem] px-[1rem] flex justify-center items-center bg-[#F0416D] border-[#F0416D] rounded-[0.5rem] max-w-[80px]">
                                    <p class="text-white text-[14px]">Hapus</p>
                                </button>
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
import { usePage } from '@inertiajs/vue3';
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
        formState: {
            type: Object,
            required: true
        },
        data : {
            type: Object,
            default : {}
        }
    },
    setup(props) {
        const page = usePage();
        
        const initialData = {
            material : null,
            quantity : 0,
            status : null,
            selectedMaterial : props.data.detail?.selectedMaterial ?? []
        }
        
        const selectedMaterial = ref(props.data.detail?.selectedMaterial ?? [])
        
        const getOptionMaterial = () => {
            return page.props.user.material.map((item) => {
                const totalSelectedMaterial = selectedMaterial.value.filter((selected) => {
                    return selected.id == item.id
                }).length
                
                if(totalSelectedMaterial != 3) {
                    return {
                        name: item.description,
                        id: item.id,
                    }
                }
            }).filter((item) => {
                return item != null
            })
        } 
        
        const optionMaterial = ref(getOptionMaterial());
        
        const status = [            
            {
                name: 'Penerimaan',
            },
            {
                name: 'Pemakaian',
            },
            {
                name: 'Kirim',
            },
        ];
        
        const getOptionStatus = () => {
            var filteredStatus = [];
            
            if(props.formState.material != null) {
                const isPenerimaanExist = selectedMaterial.value.find((selected) => {
                    return selected.id == props.formState.material.id && selected.status == 'Penerimaan'
                })
                const isPemakaianExist = selectedMaterial.value.find((selected) => {
                    return selected.id == props.formState.material.id && selected.status == 'Pemakaian'
                })
                const isKirimExist = selectedMaterial.value.find((selected) => {
                    return selected.id == props.formState.material.id && selected.status == 'Kirim'
                })
                
                if(!isPenerimaanExist) {
                    filteredStatus.push(status[0])
                }
                if(!isPemakaianExist) {
                    filteredStatus.push(status[1])
                }
                if(!isKirimExist) {
                    filteredStatus.push(status[2])
                }
            }
            
            return filteredStatus;
        }
        
        const optionStatus = ref(getOptionStatus());
        
        Object.assign(props.formState, initialData);
        
        const updateFormState = (model, isNumber = false) => {
            if (isNumber) {
                props.formState[model.name] = Number(model.value);
            } else {
                props.formState[model.name] = model.value;
            }
        };
        
        const addSelectedMaterial = () => {
            if(props.formState.material != null && props.formState.quantity != 0 && props.formState.status != null) {
                selectedMaterial.value.push({
                    id: props.formState.material.id,
                    material: props.formState.material.name,
                    quantity: props.formState.quantity,
                    status: props.formState.status.name,
                })
                
                props.formState.selectedMaterial = selectedMaterial;
                
                props.formState.material = null;
                props.formState.quantity = 0;
                props.formState.status = null;
                
                optionMaterial.value = getOptionMaterial();
            }
        }
        
        const deleteSelectedMaterial = (id) => {
            selectedMaterial.value = selectedMaterial.value.filter((item) => item.id !== id);
            props.formState.selectedMaterial = selectedMaterial;
            
            optionMaterial.value = getOptionMaterial();
        }
        
        return {
            updateFormState,
            optionMaterial,
            optionStatus,
            selectedMaterial,
            addSelectedMaterial,
            deleteSelectedMaterial,
            getOptionStatus
        }
    },
    watch : {
        'formState.material' : {
            handler : function (val) {
                this.optionStatus = this.getOptionStatus();
            },
            deep : true
        }
    }
}
</script>