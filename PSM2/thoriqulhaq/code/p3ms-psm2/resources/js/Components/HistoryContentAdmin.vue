<template>
    <div class="w-full h-[60px] rounded-[1rem] bg-[#F3FAFE] flex items-center gap-[1rem] p-[1rem]">
        <i class="pi pi-users text-[24px] text-[#B7DFFD]"></i>
        <div class="flex flex-col gap-[0.125rem] justify-center w-full">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-[10px] text-[#606279]">16/04/2023</p>
                    <p class="text-[12px] font-semibold text-[#606279]">Staff</p>
                </div>
                <p class="text-[12px] font-semibold text-[#606279]">+24</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default ({
        props: {
            data: {
                type: Array,
                default: () => []
            }
        },
        setup(props) {
            const colorStatus = {
                increase :{
                    primary: '#F3FAFE',
                    secondary: '#B7DFFD',
                    text: '#009FF7'
                },
                decrease :{
                    primary: '#FEF5F9',
                    secondary: '#FCC0CE',
                    text: '#F1416C'
                },
            }
            
            const dataIcon = {
                account: 'pi pi-users',
                master_data: 'pi pi-box'
            }
            
            return {
                colorStatus,
                dataIcon
            }
        }
    })
</script>