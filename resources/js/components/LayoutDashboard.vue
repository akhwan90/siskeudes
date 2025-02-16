<template>
    <LayoutNavbar/>
    <slot></slot>

</template>

<script>
import LayoutNavbar from "./LayoutNavbar.vue"

export default {
    name: "LayoutDashboard",
    components: {
        LayoutNavbar,
    },
};
</script>