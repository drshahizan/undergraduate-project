<template>
    <div class="bg-[#F4F5F4] bg-cover h-screen">
        <div class="w-full h-full flex">
            <SidebarAdmin :sideBar="sideBar"/>
            <div class="flex flex-col p-[2rem] flex-1">
                <div class="flex flex-col flex-1">
                    <slot/>
                </div>
                <div class="flex justify-center items-center">
                    <p class="text-[12px] mt-[1.5rem] text-[#616278]">© PT PLN (Persero) 2023. All right reserve</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import SidebarAdmin from "../../Components/SidebarAdmin.vue";

export default {
    components: {
        SidebarAdmin
    },
    props: {
        sideBar : {
            type: Number,
            default: 1
        }
    },
}
</script>