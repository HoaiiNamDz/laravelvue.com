<template lang="">
    <div>
        <Breadcrumb :pageTitle="pageTitle" :previousPage="previousPage"/>
        <div class="grid grid-cols-2 p-3">
            <div class="">
                <h2>Thông tin chung</h2>
                <p>Nhập thông tin chung của nhóm thành viên</p>
                <p>Lưu ý: Những trường đánh dấu <span class="text-red-600">(*)</span> là bắt buộc</p>
            </div>
            <div class="bg-white rounded-md p-2">
                <form action="" method="post" @submit.prevent="update">
                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label for="">Tên nhóm thành viên</label>
                            <span class="text-red-600"> *</span>
                            <input type="text" v-model="formData.name" class="outline-none border rounded-md p-2 w-full mt-2">
                            <p v-if="formErrorMessages.name" class="text-red-600 italic">
                                *{{ formErrorMessages.name }}
                            </p>
                            <p v-if="formErrorMessages.message" class="text-red-600 italic">
                                *{{ formErrorMessages.message }}
                            </p>
                        </div>
                        <div class="flex-1">
                            <label for="">Mô tả</label>
                            <span class="text-red-600"> *</span>
                            <input type="text" v-model="formData.description" class="outline-none border rounded-md p-2 w-full mt-2">
                            <p v-if="formErrorMessages.description" class="text-red-600 italic">
                                *{{ formErrorMessages.description }}
                            </p>
                        </div>
                    </div>
                    <button type="submit" class="py-2 px-3 bg-blue-600 text-white rounded-md float-right my-3">Lưu thông tin</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import axios from '@/config/axios.js'
import csrf from '@/config/csrf.js'
import { defineComponent, ref, onMounted } from 'vue'
import Breadcrumb from "@/components/Breadcrumb.vue"
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import { useRouter } from 'vue-router'
import { handleFormError } from '@/helper/helper.js'
export default defineComponent({
    components: {Breadcrumb},
    setup() {
        const previousPage = ref('Quản lý nhóm thành viên')
        const pageTitle = ref('Chỉnh sửa nhóm thành viên')
        const formData = ref({
            name: '',
            description: ''
        })
        const formErrorMessages = ref({})
        const router = useRouter()
        const id = router.currentRoute.value.query.id

        const update = async () => {
            try {
                const response = await axios.put(`users/group/update?id=${id}`, formData.value)
                toast.success(response.message)
                setTimeout(() => {
                    router.push({ name: 'users.group' })
                }, 1000);
            } catch (error) {
                console.log(error);
                handleFormError(error, formErrorMessages);
            }
        }

        onMounted(async () => {
            try {
                const response = await axios.get(`users/group?id=${id}`)
                formData.value.name = response.name
                formData.value.description = response.description
            } catch (error) {
                console.log(error);
            }
        })
        
        return { pageTitle, formData, formErrorMessages, previousPage, update }
    }
})
</script>
<style lang="">
    
</style>