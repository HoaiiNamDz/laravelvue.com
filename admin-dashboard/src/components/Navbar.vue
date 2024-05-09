<template lang="">
    <div class="w-full bg-white h-14 flex items-center justify-between">
        <font-awesome-icon icon="fa-solid fa-bars-staggered" class="pl-3" />
        <button class="pr-3" @click="logout">
            <font-awesome-icon icon="fa-solid fa-arrow-right-from-bracket" class="pr-2" />
            <span>Đăng xuất</span>
        </button>
    </div>
</template>
<script>
import VueCookies from 'vue-cookies'
import { useRouter } from 'vue-router'
export default {
    setup() {
        const router = useRouter();
        function logout() {
            VueCookies.remove("token")
            VueCookies.remove("token_expires")
            router.push({ name: 'login' })
        }

        return { logout }
    }
}
</script>
<style lang=""></style>
