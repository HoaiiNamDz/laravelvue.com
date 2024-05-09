<template>
    <div class="">
        <component :is="layout">
            <router-view />
        </component>
    </div>
</template>
<script>
export default {
    computed: {
        layout() {
            // Lấy layout từ meta của route hiện tại
            return this.$route.meta.layout
        }
    }
}
</script>
<style></style>