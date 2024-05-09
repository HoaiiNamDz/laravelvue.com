import axios from 'axios'
import { useAuthStore } from '@/store/auth'
axios.interceptors.request.use(
    config => {
        const token = useAuthStore().token
        if(token) {
            config.headers.Authorization = `Bearer ${token}`
        }
        return config
    },
    error => {
        return Promise.reject(error)
    }
)
axios.interceptors.response.use(
    (response) => {
        return response.data
    },
    (error) => {
        return Promise.reject(error)
    }
)
axios.defaults.withCredentials = true
axios.defaults.baseURL = 'http://127.0.0.1:8000/api'

export default axios
