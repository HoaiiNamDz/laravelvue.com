import VueCookies from 'vue-cookies'
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

const auth = (to, from, next) => {
    const token = VueCookies.get('token')
    const tokenExpires = VueCookies.get('token_expires')
    if(!token || !tokenExpires) {
        toast.error('Vui lòng đăng nhập để sử dụng dịch vụ này!')
        next({
            path: '/login'
        })
        return
    }
    const tokenExpiresDate = new Date(tokenExpires)
    if(tokenExpiresDate < new Date()) {
        toast.error('Phiên đăng nhập của bạn đã hết hạn. Vui lòng đăng nhập lại!')
        next({
            path: '/login'
        })
        return
    }
    next()
}
export default auth