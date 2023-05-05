<template>
    <div class="h-screen relative custom-bg-color">
        <StudentSidebar />
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



export default {
    components: {
        Button,
        Sidebar,
        StudentSidebar,
    },

    setup(props) {
        const visible = ref(false);
        return {
            visible: visible,
        }
    }
}
</script>
