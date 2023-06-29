<template>
  <div class="h-screen w-screen flex flex-col gap-[1.5rem] justify-center items-center bg-[#F4F4F5]">
    <H1 class="text-[86px] font-semibold text-[#616278]">{{ title[status] }}</H1>
    <p class="text-[#BFC3CF]">{{ description[status] }}</p>
  </div>
</template>

<script>
    export default {
    components: {
    },
    props: {
        status : {
            type: Number,
        }
    },
    setup(props) {
        const title = {
            503: '503',
            500: '500',
            404: '404',
            403: '403',
        };

        const description = {
            503: 'Maaf, kami sedang melakukan pemeliharaan. Silakan cek kembali nanti.',
            500: 'Ups, terjadi kesalahan pada server kami.',
            404: 'Maaf, halaman yang Anda cari tidak dapat ditemukan.',
            403: 'Maaf, Anda dilarang mengakses halaman ini.',
        };

        return {
            title,
            description
        }
    }
}
</script>
