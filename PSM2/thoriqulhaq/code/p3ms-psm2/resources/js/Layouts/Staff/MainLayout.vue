<template>
    <div class="bg-[#F4F5F4] bg-cover h-screen">
        <div class="p-[30px] w-full h-full flex">
            <Sidebar/>
            <div class="flex flex-col ml-[40px] mr-[10px] flex-1">
                <div class="z-10 flex justify-between my-[1.5rem] items-center">
                    <div class="flex gap-[3rem] text-[15px] text-[#5F6279] font-semibold">
                        <Link :class="{ 'text-[#14A3B8]': $page.url === '/' }" href="/">
                            <p>Dashboard</p>
                        </Link>
                        <Link :class="{ 'text-[#14A3B8]': $page.url === '/info-material' }" href="/info-material">
                            <p>Info Material</p>
                        </Link>
                        <Link v-if="$page.props.user.user_type == 'Staff Operator'" :class="{ 'text-[#14A3B8]': $page.url === '/rekap/riwayat' }" href="/rekap/riwayat">
                            <p>Riwayat Rekap</p>
                        </Link>
                        <Link v-if="$page.props.user.user_type == 'Staff PIC'" :class="{ 'text-[#14A3B8]': $page.url === '/rekap/permintaan' }" href="/rekap/permintaan">
                            <p>Permintaan Rekap</p>
                        </Link>
                        <Link :class="{ 'text-[#14A3B8]': $page.url === '/laporan/unduh' }" href="/laporan/unduh">
                            <p>Unduh Laporan</p>
                        </Link>
                    </div>
                    <div class="relative">
                        <Button v-on:click="isNotificationOpen = !isNotificationOpen" v-badge.danger="'1'" :class="isNotificationOpen ? 'bg-[#F8F8F9]' : 'bg-white'" class="p-overlay-badge h-[2.75rem] w-[2.75rem] flex justify-center items-center rounded-full drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)]">
                            <i  class="pi pi-bell text-[#BFC3CF]"></i>
                        </Button>
                        <div v-if="isNotificationOpen" class="absolute overflow-y-scroll scrollbar-hide flex flex-col right-0 top-[4rem] bg-white rounded-[1.5rem] py-[1rem] px-[1.5rem] w-[350px] h-[600px] drop-shadow-[0px_12px_24px_rgba(0,0,0,0.04)]">
                                <div class="border-b-[1px] border-[#F8F8F9] h-[80px] flex flex-col justify-center gap-[0.5rem]">
                                    <div class="flex justify-between items-center gap-[0.25rem]">
                                        <p class="text-[14px] text-[#14A3B8] font-semibold">
                                            Rekap #1290818
                                        </p>
                                        <p class="text-[12px] text-[#BFC3CF]">
                                            1 Januari 2023
                                        </p>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <p v-if="$page.props.user.user_type == 'Staff Operator'" class="text-[12px] text-[#606279]">Rekap anda telah disetujui oleh Staff PIC</p>
                                        <p v-if="$page.props.user.user_type == 'Staff PIC'" class="text-[12px] text-[#606279]">Rekap baru saja dibuat oleh Staff Operator</p>
                                        <Badge severity="danger"></Badge>
                                    </div>
                                </div>
                                <div class="border-b-[1px] border-[#F8F8F9] h-[80px] flex flex-col justify-center gap-[0.5rem]">
                                    <div class="flex justify-between items-center gap-[0.25rem]">
                                        <p class="text-[14px] text-[#14A3B8] font-semibold">
                                            Rekap #1290818
                                        </p>
                                        <p class="text-[12px] text-[#BFC3CF]">
                                            1 Januari 2023
                                        </p>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <p v-if="$page.props.user.user_type == 'Staff Operator'" class="text-[12px] text-[#606279]">Rekap anda telah disetujui oleh Staff PIC</p>
                                        <p v-if="$page.props.user.user_type == 'Staff PIC'" class="text-[12px] text-[#606279]">Rekap baru saja dibuat oleh Staff Operator</p>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <slot/>
                <div class="flex justify-center items-center">
                    <p class="text-[12px] mt-[1.5rem] text-[#616278]">© PT PLN (Persero) 2023. All right reserve</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from "vue";
import Sidebar from '../../Components/Sidebar.vue';

export default {
    components: {
        Sidebar,
    },
    setup(props) {
        const isNotificationOpen = ref(false)
        
        return {
            isNotificationOpen,
        }
    }
}
</script>