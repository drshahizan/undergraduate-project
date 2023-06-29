<template>
    <div class="bg-[#F4F5F4] bg-cover h-screen">
        <div class="p-[30px] w-full h-full flex">
            <Sidebar/>
            <div class="flex flex-col ml-[40px] mr-[10px] flex-1">
                <div class="z-10 flex justify-between mt-[1.5rem] mb-[2rem] items-center">
                    <slot name="header"/>
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
import Sidebar from '../../Components/Sidebar.vue';

export default {
    components: {
        Sidebar,
    },
    setup(props) {
        
        return {
            
        }
    }
}
</script>