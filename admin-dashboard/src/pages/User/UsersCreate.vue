<template lang="">
    <div>
        <Breadcrumb :pageTitle="pageTitle" :previousPage="previousPage"/>
        <div v-if="endpoint === '/users/group/create'" class="grid grid-cols-2 p-3">
            <div class="">
                <h2>Thông tin chung</h2>
                <p>{{detailDescription}}</p>
                <p>Lưu ý: Những trường đánh dấu <span class="text-red-600">(*)</span> là bắt buộc</p>
            </div>
            <div class="bg-white rounded-md p-2">
                <form action="" method="post" @submit.prevent="create">
                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label for="">Nhập vào tên nhóm thành viên</label>
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
        <div v-if="endpoint === '/users/create'" class="grid grid-cols-2 p-3">
            <div class="">
                <h2>Thông tin chung</h2>
                <p>{{detailDescription}}</p>
                <p>Lưu ý: Những trường đánh dấu <span class="text-red-600">(*)</span> là bắt buộc</p>
            </div>
            <div class="bg-white rounded-md p-2">
                <form action="" method="post" @submit.prevent="create">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="">
                            <label for="">Tên</label>
                            <span class="text-red-600"> *</span>
                            <input type="text" v-model="formData.name" class="outline-none border rounded-md p-2 w-full mt-2">
                            <p v-if="formErrorMessages.name" class="text-red-600 italic">
                                *{{ formErrorMessages.name }}
                            </p>
                        </div>
                        <div class="">
                            <label for="">Email</label>
                            <span class="text-red-600"> *</span>
                            <input type="email" v-model="formData.email" class="outline-none border rounded-md p-2 w-full mt-2">
                            <p v-if="formErrorMessages.email" class="text-red-600 italic">
                                *{{ formErrorMessages.email }}
                            </p>
                            <p v-if="formErrorMessages.message" class="text-red-600 italic">
                                *{{ formErrorMessages.message }}
                            </p>
                        </div>
                        <div class="">
                            <label for="">Mật khẩu</label>
                            <span class="text-red-600"> *</span>
                            <input type="password" v-model="formData.password" class="outline-none border rounded-md p-2 w-full mt-2">
                            <p v-if="formErrorMessages.password" class="text-red-600 italic">
                                *{{ formErrorMessages.password }}
                            </p>
                        </div>
                        <div class="">
                            <label for="">Nhập lại mật khẩu</label>
                            <span class="text-red-600"> *</span>
                            <input type="password" v-model="formData.repassword" class="outline-none border rounded-md p-2 w-full mt-2">
                            <p v-if="formErrorMessages.repassword" class="text-red-600 italic">
                                *{{ formErrorMessages.repassword }}
                            </p>
                        </div>
                        <div class="col-span-2">
                            <label for="">Ảnh đại diện</label>
                            <span class="text-red-600"> *</span>
                            <input type="file" @change="formData.avatar" class="outline-none border rounded-md p-2 w-full mt-2">
                            <p v-if="formErrorMessages.avatar" class="text-red-600 italic">
                                *{{ formErrorMessages.avatar }}
                            </p>
                        </div>
                        <div class="">
                            <label for="">Chọn nhóm thành viên</label>
                            <span class="text-red-600"> *</span>
                            <select class="outline-none border rounded-md p-2 w-full mt-2">
                                <option :value="userGroup.id" v-for="userGroup in usersGroup" :key="userGroup.id">{{userGroup.name}}</option>
                            </select>
                            <p v-if="formErrorMessages.repassword" class="text-red-600 italic">
                                *{{ formErrorMessages.repassword }}
                            </p>
                        </div>
                        <div class="">
                            <label for="">Ngày sinh</label>
                            <span class="text-red-600"> *</span>
                            <input type="date" v-model="formData.birthday" class="outline-none border rounded-md p-2 w-full mt-2">
                            <p v-if="formErrorMessages.birthday" class="text-red-600 italic">
                                *{{ formErrorMessages.birthday }}
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div v-if="endpoint === '/users/create'" class="grid grid-cols-2 p-3">
            <div class="">
                <h2>Thông tin liên hệ</h2>
                <p>{{contactDescription}}</p>
                <p>Lưu ý: Những trường đánh dấu <span class="text-red-600">(*)</span> là bắt buộc</p>
            </div>
            <div class="bg-white rounded-md p-2">
                <form action="" method="post" @submit.prevent="create">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="">
                            <label for="">Số điện thoại</label>
                            <span class="text-red-600"> *</span>
                            <input type="text" v-model="formData.phone" class="outline-none border rounded-md p-2 w-full mt-2">
                            <p v-if="formErrorMessages.phone" class="text-red-600 italic">
                                *{{ formErrorMessages.phone }}
                            </p>
                            <p v-if="formErrorMessages.message" class="text-red-600 italic">
                                *{{ formErrorMessages.message }}
                            </p>
                        </div>
                        <div class="">
                            <label for="">Địa chỉ</label>
                            <span class="text-red-600"> *</span>
                            <input type="text" v-model="formData.address" class="outline-none border rounded-md p-2 w-full mt-2">
                            <p v-if="formErrorMessages.address" class="text-red-600 italic">
                                *{{ formErrorMessages.address }}
                            </p>
                        </div>
                        <div class="">
                            <label for="">Thành phố</label>
                            <span class="text-red-600"> *</span>
                            <select class="outline-none border rounded-md p-2 w-full mt-2" @change="getDistricts(formData.provinceId)" v-model="formData.provinceId">
                                <option :value="province.code" v-for="province in provinces" :key="province.code">{{province.name}}</option>
                            </select>
                            <p v-if="formErrorMessages.province" class="text-red-600 italic">
                                *{{ formErrorMessages.province }}
                            </p>
                        </div>
                        <div class="">
                            <label for="">Quận/Huyện</label>
                            <span class="text-red-600"> *</span>
                            <select class="outline-none border rounded-md p-2 w-full mt-2" v-model="formData.district">
                                <option :value="district.id" v-for="district in formData.districts" :key="district.id">{{district}}</option>
                            </select>
                            <p v-if="formErrorMessages.district" class="text-red-600 italic">
                                *{{ formErrorMessages.district }}
                            </p>
                        </div>
                        <div class="">
                            <label for="">Phường/Xã</label>
                            <span class="text-red-600"> *</span>
                            <select class="outline-none border rounded-md p-2 w-full mt-2" v-model="formData.ward">
                                <option :value="ward.id" v-for="ward in formData.wards" :key="ward.id">{{ward}}</option>
                            </select>
                            <p v-if="formErrorMessages.ward" class="text-red-600 italic">
                                *{{ formErrorMessages.ward }}
                            </p>
                        </div>
                        <div class="">
                            <label for="">Ghi chú</label>
                            <input type="text" v-model="formData.description" class="outline-none border rounded-md p-2 w-full mt-2">
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
import { defineComponent, ref, onMounted, watchEffect  } from 'vue'
import Breadcrumb from "@/components/Breadcrumb.vue"
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import { useRouter } from 'vue-router'
import { handleFormError } from '@/helper/helper.js'

import { useProvinces } from '@/services/Location.js'
export default defineComponent({
    components: {Breadcrumb},
    setup() {
        const previousPage = ref('Quản lý nhóm thành viên')
        const pageTitle = ref('Thêm mới nhóm thành viên')
        const detailDescription = ref('Nhập thông tin chung cho nhóm thành viên')
        const contactDescription = ref('Nhập thông tin liên hệ cho thành viên')
        const formData = ref({
            name: '',
            description: '',
            email: '',
            phone: '',
            password: '',
            repassword: '',
            avatar: '',
            address: '',
            provinceId: '0',
            districtId: '0',
            wardsId: '0',
            usersGroupId: '0'
        })
        const formErrorMessages = ref({})
        const router = useRouter()
        const endpoint = router.currentRoute.value.fullPath
        const create = async () => {
            try {
                await csrf.getCookie()
                const response = await axios.post(endpoint, formData.value)
                toast.success(response.message)
                setTimeout(() => {
                    router.push({ name: 'users.group' })
                }, 1000);
            } catch(error) {
                handleFormError(error, formErrorMessages);
            }
        }

        const usersGroup = ref([{id: 0, name: 'Chọn nhóm thành viên'}])
        const getUsersGroup = async () => {
            try {
                const response = await axios.get('users/group')
                return usersGroup.value.push(...response.data)
            } catch(error) {
                console.log(error);
            }
        }

        const getDistricts = (id) => {
            console.log(id);
        }

        let provinces = ref([{code: 0, name: 'Chọn thành phố'}])
        const {provinceValues, getProvinces } = useProvinces()
        watchEffect(() => {
            if (provinceValues.value.length > 0) {
                provinces.value = provinces.value.concat(provinceValues.value);
            }
        });

        onMounted( async () => {
            switch (router.currentRoute.value.params.action) {
                case 'group/create':
                    previousPage.value = 'Quản lý nhóm thành viên'
                    pageTitle.value = 'Thêm mới nhóm thành viên'
                    detailDescription.value = 'Nhập thông tin chung cho nhóm thành viên'
                    break;
                case 'create':
                    previousPage.value = 'Quản lý thành viên'
                    pageTitle.value = 'Thêm mới thành viên'
                    detailDescription.value = 'Nhập thông tin chung cho thành viên'
                    break;
                default:
                    break;
            }
            await getUsersGroup()
            await getProvinces()
        })
        return { pageTitle, formData, create, 
            formErrorMessages, previousPage, detailDescription, 
            contactDescription, endpoint, getUsersGroup ,
            getDistricts, usersGroup, provinces
        }
    }
})
</script>
<style lang="">
    
</style>