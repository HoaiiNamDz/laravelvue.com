import axios from '@/config/axios.js'
import {ref} from 'vue'

const useProvinces = () => {
    let provinceValues = ref([])
    const getProvinces = async () => {
        try {
            const response = await axios.get('/provinces')
            provinceValues.value =  response.data
        } catch (error) {
            console.log(error);
        }
    }
    return {provinceValues,getProvinces}
}

export { useProvinces }