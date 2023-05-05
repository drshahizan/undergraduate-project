<template>
    <div class="h-screen relative custom-bg-color">
        <StudentSidebar />
    <div class="gap-[1.5rem] flex flex-1 justify-end items-end mx-12 mt-12">
        <Dropdown v-model="selectedCity" :options="cities" optionLabel="name" placeholder="Tahun Ajaran" class="flex-1 w-[2rem] md:w-12rem" />
        <Dropdown v-model="selectedCity" :options="cities" optionLabel="name" placeholder="Semester" class="flex-1 w-[2rem] md:w-12rem" />
        <Dropdown v-model="selectedCity" :options="cities" optionLabel="name" placeholder="Kelas" class="flex-1 w-[2rem] md:w-12rem" />
        <Button type="button" label="Unduh" severity="success" />
        
            </div>
         <div class="flex justify-center items-center mt-12">
            <img class="w-1/2" src="/images/rapor.png" alt="">
            </div>
    </div>
</template>

<script >
import StudentSidebar from "../../Components/StudentSidebar";
import Divider from 'primevue/divider';
import 'primeicons/primeicons.css';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Sidebar from 'primevue/sidebar';
import { ref } from 'vue';
import Dropdown from 'primevue/dropdown';


export default {
    components: {
        Button,
        Sidebar,
        StudentSidebar,
        Dropdown,
    },

    setup(props) {
        const visible = ref(false);
        return {
            visible: visible,
        }
    }
}
</script>
