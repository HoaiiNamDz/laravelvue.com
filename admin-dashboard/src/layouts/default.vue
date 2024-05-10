<template>
    <div class="grid grid-cols-12 h-screen overflow-auto bg-gray-200">
        <Sidebar class="col-span-2" />
        <div class="col-span-10">
            <Navbar />
            <slot class="" />
        </div>
    </div>
</template>
<script>
import Sidebar from '@/components/Sidebar.vue'
import Navbar from '@/components/Navbar.vue'
export default {
    name: 'DefaultLayout',
    components: { Sidebar, Navbar }
};
</script>
<style scoped></style>