<template lang="">
    <div class="pb-3 m-3">
        <h1 class="text-3xl">{{ pageTitle }}</h1>
        <div class="flex">
            <router-link :to="changeRouter(previousPage)" class="font-medium">{{previousPage}}</router-link>
            <span class="px-2">/</span>
            <p>{{ pageTitle }}</p>
        </div>
    </div>
</template>
<script>
export default {
    props: ['pageTitle', 'previousPage'],
    setup() {
        const changeRouter = (previousPage) => {
            switch (previousPage) {
                case 'Dashboard':
                    return { name: 'dashboard' };
                case 'Quản lý nhóm thành viên':
                    return { name: 'users.group' };
                case 'Quản lý thành viên':
                    return { name: 'users' };
                default:
                    break;
            }
        }
        return { changeRouter }
    }
}
</script>
<style lang="">
    
</style>