<template>
  <div
    v-show="isVisible"
    class="w-full px-4 py-3 rounded shadow-lg transition-opacity duration-500 mb-2"
    :class="alertClass"
  >
    <span>{{ message }}</span>
  </div>
</template>

<script>
export default {
  props: {
    message: { type: String, required: true },
    type: { type: String, default: "success" },
    duration: { type: Number, default: 3000 },
    closable: { type: Boolean, default: true },
  },
  data() {
    return {
      isVisible: true,
    };
  },
  computed: {
    alertClass() {
      return {
        "bg-green-500 text-white": this.type === "success",
        "bg-red-500 text-white": this.type === "error",
        "bg-yellow-500 text-black": this.type === "warning",
      };
    },
  },
  mounted() {
    if (this.duration > 0) {
      setTimeout(() => {
        this.isVisible = false;
        // this.$emit("close"); // Emit event saat alert hilang
      }, this.duration);
    }
  },
  methods: {
    closeAlert() {
      this.isVisible = false;
      this.$emit("close"); // Emit event untuk menghapus alert dari list
    },
  },
};
</script>
