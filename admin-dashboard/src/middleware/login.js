import VueCookies from 'vue-cookies'

const login = (to, from, next) => {
    const token = VueCookies.get('token')
    const tokenExpires = VueCookies.get('token_expires')
    const tokenExpirationDate = new Date(tokenExpires)
    if(token && tokenExpirationDate >= new Date()) {
        next({
            path: '/dashboard'
        })
        return
    }
    next()
}
export default login