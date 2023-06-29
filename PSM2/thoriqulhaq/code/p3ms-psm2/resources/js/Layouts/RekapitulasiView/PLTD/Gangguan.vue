<template>
    <div class="flex w-full h-full p-[20px] gap-[61px]">
        <div class="flex-1">
            <RekapitulasiResult
                value="Unit"
                :data="'Mesin ' + data?.detail?.unit"
            />
            <RekapitulasiResult
                value="Status"
                :data="data?.detail?.status"
            />
            <RekapitulasiResult
                value="No. LH5"
                :data="data?.detail?.lh_five_no"
            />
        </div>
        <div class="flex-1">
            <RekapitulasiResult
                value="Keterangan"
                :data="data?.detail?.description"
                type="2"
            />
            <RekapitulasiResult
                value="Material"
                :data="getMaterial()"
                type="2"
            />
        </div>
    </div>
</template>

<script>
import RekapitulasiResult from '../../../Components/RekapitulasiResult.vue'

export default {
    components: {
        RekapitulasiResult
    },
    props: {
        data: {
            type: Object,
        }
    },
    setup(props) {
        const formatString = (string) => {
            return string.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                return letter.toUpperCase();
            });
        }
        
        const getMaterial = () => {
            var string = '';
            props.data?.detail?.selectedMaterial?.forEach((item) => {
                string += `<div class='flex justify-between items-center mr-[0.5rem] mb-[0.75rem]'><span>${formatString(item.material)}</span> <span>(${item.quantity} Buah)</span></div>`;
            });
            return string;
        }
        
        return {
            getMaterial
        }
    }
}
</script>