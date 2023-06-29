<template>
    <div class="bg-[#FEFEFF] h-full flex drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)] relative">
        <div class="py-[2rem] w-[100px] border-[1px] border-[#F4F5F4] flex flex-col justify-between items-center">
            <div  class="w-full flex flex-col items-center gap-[3rem]">
                <img src="/images/LOGO_PLN_2.png" alt="P3MS" class="w-[40px]" />
                <div class="flex flex-col gap-[2.5rem] items-center w-full">
                    <Link href="/admin" :class='(sidebarOption == 1 ? "text-[#14A3B8]" : "text-[#BFC2CE]") + " pi pi-home text-[24px] mx-[0.5rem]"'></Link>
                    <Button v-on:click="sidebarOption = 2" :class='(sidebarOption == 2 ? "text-[#14A3B8]" : "text-[#BFC2CE]") + " pi pi-users text-[24px] mx-[0.5rem]"'></Button>
                    <Button v-on:click="sidebarOption = 3" :class='(sidebarOption == 3 ? "text-[#14A3B8]" : "text-[#BFC2CE]") + " pi pi-database text-[24px] mx-[0.5rem]"'></Button>
                </div>
            </div>
            <Button class="w-full flex flex-col items-center gap-[2.5rem]">
                <img :src="'/images/avatar/avatar_' + userType[$page.props.user.user_type] + '.png'" alt="P3MS" class="w-[45px]" />
            </Button>
        </div>
        <div :class='isOpenSidebar ?  "w-[310px] flex flex-col ease-in-out duration-300 overflow-hidden" : "w-[0px] flex flex-col ease-in-out duration-300 overflow-hidden"'>
            <div class="flex flex-col justify-between flex-1 p-[2rem] w-[310px]">
                <!-- Dashboard -->
                <div v-if="sidebarOption == 1" class="flex flex-col gap-[2rem]">
                    <!-- <p class="text-[18px] font-semibold text-[#181C32] my-[1rem]">Hi, Admin !</p> -->
                    <div class="mt-[0.75rem]">
                        <p class="text-[12px] text-[#616278] tracking-[0.025rem]">Selamat datang,</p>
                        <p class="text-[12px] text-[#616278] tracking-[0.075rem] font-bold">{{ $page.props.user.name}}</p>
                    </div>
                    <div class="flex justify-between items-center mb-[0.5rem] mt-[2rem] relative">
                        <hr class="h-[1px] w-full bg-[#E1E2EA]">
                        <div class="absolute right-0 top-[-0.5rem] w-full flex justify-center">
                            <p class="text-[12px] font-semibold text-[#616278] tracking-[0.075rem] bg-[#FEFFFE] px-[1rem]">RIWAYAT</p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-[1rem]">
                        <HistoryContentAdmin/>
                    </div>
                </div>
                <!-- Kelola Akun -->
                <div v-if="sidebarOption == 2" class="flex flex-col gap-[2rem]">
                    <p class="text-[18px] font-semibold text-[#181C32] my-[1rem]">Kelola Akun</p>
                    <div class="flex flex-col gap-[1.5rem]">
                        <SidebarOptionAdmin category="Pengguna" item="Staff" url="/admin/kelola-akun/staff" icon="pi-user"/>
                        <SidebarOptionAdmin category="Pengguna" item="Admin" url="/admin/kelola-akun/admin" icon="pi-user"/>
                    </div>
                </div>
                    <!-- Kelola Master Data -->
                    <div v-if="sidebarOption == 3" class="flex flex-col gap-[2rem]">
                    <p class="text-[18px] font-semibold text-[#181C32] my-[1rem]">Kelola Master Data</p>
                    <div class="flex flex-col gap-[1.5rem]">
                        <SidebarOptionAdmin category="Data" item="Unit" url="/admin/kelola-master-data/unit" icon="pi-database"/>
                        <SidebarOptionAdmin category="Data" item="Pembangkit" url="/admin/kelola-master-data/pembangkit" icon="pi-database"/>
                        <SidebarOptionAdmin category="Data" item="Material" url="/admin/kelola-master-data/material" icon="pi-database"/>
                    </div>
                </div>
                <div class="flex justify-center items-center mb-[0.25rem]">
                    <Link :href="route('logout')" method="post" class="py-[0.5rem] px-[2rem] bg-[#F9F9F9] flex justify-center items-center gap-[0.25rem] w-full h-full rounded-[0.5rem]">
                        <i class="pi pi-sign-out text-[#BFC2CE] mx-[0.5rem]"></i>
                        <p class="text-[#BFC2CE] text-[14px]">Keluar</p>
                    </Link>
                </div>
            </div>
        </div>
        <Button v-if="$page.url != '/admin'" v-on:click="isOpenSidebar = !isOpenSidebar" class="absolute bottom-0 right-[-1.1rem] bg-[#14A3B8] rounded-[0.65rem] w-[2.25rem] h-[2.25rem] flex justify-center items-center my-[2.25rem]">
            <i v-if="isOpenSidebar" class="animate-pulse pi pi-arrow-left text-[16px] text-white mx-[0.5rem]"></i>
            <i v-if="!isOpenSidebar" class="animate-pulse pi pi-arrow-right text-[16px] text-white mx-[0.5rem]"></i>
        </Button>
    </div>
</template>

<script>
import { ref } from "vue";
import SidebarOptionAdmin from "./SidebarOptionAdmin.vue";
import HistoryContentAdmin from "./HistoryContentAdmin.vue";

export default {
    components: {
        SidebarOptionAdmin,
        HistoryContentAdmin
    },
    props: {
        sideBar : {
            type: Number,
            default: 1
        }
    },
    setup(props) {
        const isOpenSidebar = ref(true);
        const sidebarOption = ref(props.sideBar);
        const userType = {
            'Admin': 1,
            'Staff PIC': 2,
            'Staff Operator': 3
        };
        
        return {
            isOpenSidebar,
            sidebarOption,
            userType
        }
    }
}
</script>