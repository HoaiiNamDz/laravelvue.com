import { defineStore } from 'pinia'
import axios from '@/config/axios.js'
import csrf from '@/config/csrf.js'
import VueCookies from 'vue-cookies'

export const useAuthStore = defineStore('auth', {
    state: () => ({
        loggedIn: false,
        user: null,
        token: null
    }),
    actions: {
        async login(email, password) {
            await csrf.getCookie()
            const response = await axios.post('/auth/login', {
                email: email,
                password: password
            })
            this.loggedIn = true
            this.user = { email, password }
            this.token = response.token
            VueCookies.set('token',this.token)
            VueCookies.set('token_expires',response.token_expired_at)
        },
        logout() {
            this.loggedIn = false
            this.user = null
        }
    }
})
