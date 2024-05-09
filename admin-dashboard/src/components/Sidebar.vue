<template lang="">
    <div class="w-full bg-blue-950 text-white">
        <div class="my-20">
            <h1 class="text-2xl text-center">Nguyễn Hoài Nam</h1>
            <p class="pl-7">Quản trị viên</p>
        </div>
        <ul class="mt-10">
            <li>
                <div class="p-3 cursor-pointer flex items-center justify-between">
                    <router-link :to="{name: 'dashboard'}" class="">
                        <font-awesome-icon icon="fa-solid fa-square-poll-vertical" />
                        <span class="p-3 text-lg">Dashboard</span>
                    </router-link>
                </div>
            </li>
            <li>
                <div
                    class="p-3 cursor-pointer flex items-center justify-between"
                    @click="toggleSubMenu('userManager')"
                >
                    <div class="">
                        <font-awesome-icon icon="fa-regular fa-user" />
                        <span class="p-3 text-lg">QL Thành Viên</span>
                    </div>
                    <font-awesome-icon v-if="isOpenSubMenu('userManager')" icon="fa-solid fa-angle-down" />
                    <font-awesome-icon v-else icon="fa-solid fa-chevron-right" class="" />
                </div>
                <div v-if="isOpenSubMenu('userManager')" class="pl-8">
                    <router-link :to="{name: 'users.group'}"  class="text-lg p-2 cursor-pointer active-link" >
                        <p>- QL Nhóm Thành Viên</p>
                    </router-link>
                    <router-link :to="{name: 'users'}" class="text-lg p-2 cursor-pointer">
                        <p>- QL Thành Viên</p>
                    </router-link>
                </div>
            </li>
            <li>
                <div
                    class="p-3 cursor-pointer flex items-center justify-between"
                    @click="toggleSubMenu('postManager')"
                >
                    <div class="">
                        <font-awesome-icon icon="fa-solid fa-pen-nib" />
                        <span class="p-3 text-lg">QL Bài Viết</span>
                    </div>
                    <font-awesome-icon v-if="isOpenSubMenu('postManager')" icon="fa-solid fa-angle-down" />
                    <font-awesome-icon v-else icon="fa-solid fa-chevron-right" class="" />
                </div>
                <div v-if="isOpenSubMenu('postManager')" class="pl-8">
                    <p class="text-lg">QL Nhóm Bài Viết</p>
                    <p class="text-lg">QL Bài Viết</p>
                </div>
            </li>
        </ul>
    </div>
</template>
<script>
import { ref, onMounted } from 'vue'
export default {
    setup() {
        const subMenuStates = ref({})

        function toggleSubMenu(subMenu) {
            subMenuStates.value = {
                ...subMenuStates.value,
                [subMenu]: !subMenuStates.value[subMenu]
            }
        }

        function isOpenSubMenu(subMenu) {
            return subMenuStates.value[subMenu]
        }
        // onMounted(async () => {
        //     try {
        //         const token = VueCookies.get('token')
        //         await csrf.getCookie()
        //         const response = await axios.get('/')
        //     } catch(e) {
        //         console.log(e);
        //     }
        // })
        return { isOpenSubMenu, toggleSubMenu }
    }
}
</script>
<style >
    
</style>
