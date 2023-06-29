<template>
    <table class="text-[11px] w-full text-center border-collapse border border-[#495157]">
        <thead>
            <tr>
                <th class="border border-[#495157]">JAM / TANGGAL</th>
                <th class="border border-[#495157]">MATERIAL</th>
                <th class="border border-[#495157]">TINDAKAN</th>
                <th class="border border-[#495157]">JUMLAH</th>
                <th class="border border-[#495157]">DIBUAT</th>
            </tr>
        </thead>
        <tbody v-if="datas?.length != 0">
            <template v-for="data in datas" :key="data">
                <tr v-for="(item, index) in data.selectedMaterial" :key="item">
                    <td class="border border-[#495157]" v-if="index == 0" :rowspan="data.selectedMaterial.length">{{formatDateTime(data.date_time)}}</td>
                    <td class="border border-[#495157]">{{item.material}}</td>
                    <td class="border border-[#495157]">{{item.status}}</td>
                    <td class="border border-[#495157]">{{item.quantity}}</td>
                    <td class="border border-[#495157]" v-if="index == 0" :rowspan="data.selectedMaterial.length">{{formatDate(data.created_at)}}</td>
                </tr>
            </template>
        </tbody>
        <tbody v-else>
            <tr>
                <td class="border border-[#495157]" :colspan="5">Tidak ada data</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    components: {

    },
    props: {
        datas: {
            required: true
        },
    },
    setup(props) {
        const formatDateTime = (value) => {
            const date = new Date(value);
            const formattedTime = date.toLocaleTimeString([], { hour12: false, hour: '2-digit', minute: '2-digit' });
            const formattedDate = date.toLocaleDateString("en-GB", {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            });
            return `${formattedTime} ${formattedDate}`;
        }
        
        const formatDate = (value) => {
            const date = new Date(value);
            return date.toLocaleDateString('en-GB', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            });
        };
        
        return {
            formatDateTime,
            formatDate,
        }
    }
}
</script>