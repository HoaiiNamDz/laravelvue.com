import axios from '@/config/axios.js'

const getProvinces = async () => {
    try {
        const response = await axios.get('/provinces')
        return response.data
    } catch (error) {
        console.log(error);
    }
}

const fetchLocation = async (id, relation) => {
    try {
        const response = await axios.get('/locations', {
            params: {id: id, relation: relation}
        })
        return response[relation]
    } catch (error) {
        console.log(error);
    }
}

export { getProvinces , fetchLocation}