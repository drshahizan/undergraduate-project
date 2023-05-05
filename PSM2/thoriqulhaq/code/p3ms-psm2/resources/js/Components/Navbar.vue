<template>
    <div class="w-full flex justify-between">
        <div>
            <img src="/images/LOGO_1_P3MS.png" alt="P3MS" class="w-[90px]" />
        </div>
        <div class="pr-[54px]">
            <Toast />
            <SplitButton label="STAFF OPERATOR 1" :model="items" @click="save" rounded class="mb-2 bg-white"
                severity="secondary" size="small" raised text plain>
            </SplitButton>
        </div>
    </div>
</template>

<script>
import Toast from 'primevue/toast';
import { useToast } from "primevue/usetoast";
import SplitButton from 'primevue/splitbutton';

export default {
    components: {
        SplitButton,
        Toast,
    },
    props: {
    },
    setup(props) {
        const toast = useToast();

        const items = [
            {
                label: 'PROFIL',
                icon: 'pi pi-user',
                command: () => {
                    toast.add({ severity: 'success', summary: 'Updated', detail: 'Data Updated', life: 3000 });
                }
            },
            {
                label: 'KELUAR',
                icon: 'pi pi-sign-out',
                command: () => {
                    toast.add({ severity: 'warn', summary: 'Delete', detail: 'Data Deleted', life: 3000 });
                }
            },
        ];

        const save = () => {
            toast.add({ severity: 'success', summary: 'Success', detail: 'Data Saved', life: 3000 });
        };

        return {
            items,
            save,
            toast
        }
    }
}
</script>