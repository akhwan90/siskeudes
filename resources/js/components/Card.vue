<template>
    <div class="bg-white shadow-lg p-5 m-4 border">
        <h2 class="text-xl font-bold mb-3 py-0">{{ title }}</h2>
        <hr/>
        <slot />
    </div>
</template>

<script>
export default {
    name: "Card",
    props: {
        title: String,
    },
};
</script>