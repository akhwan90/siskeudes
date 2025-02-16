<template>
    <div class="bg-white shadow-lg p-3 m-4 border flex gap-0">
        <a href="/parameter/pemda" class="border-r-2 px-4 text-blue-400 hover:text-blue-600">Pemda</a>
        <a href="/parameter/bidang" class="border-r-2 px-4 text-blue-400 hover:text-blue-600">Bidang</a>
        <a href="/parameter/sumberdana" class="border-r-2 px-4 text-blue-400 hover:text-blue-600">Sumber Dana</a>
    </div>
</template>

<script>
export default {
    name: "SubMenuParameter",
    props: {
        // title: String,
    },
};
</script>