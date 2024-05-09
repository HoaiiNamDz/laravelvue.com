<template lang="">
    <div class="p-4 bg-white m-3 rounded-md shadow-md">
        <div class="flex items-center justify-between mb-2">
            <h1 class="p-2 text-xl">{{tableTitle}}</h1>
            <div class="relative">
                <button class="flex items-center gap-3 bg-gray-600 text-white px-3 py-2 rounded-md group" @click="toogleSetting">
                    <font-awesome-icon icon="fa-solid fa-gear" class="group-hover:animate-spin" />
                    <p>Tác vụ nâng cao</p>
                </button>
                <div v-if="isOpenSettingModal" class="absolute top-0 -left-44 bg-white text-black rounded-md shadow-md">
                    <div class="border-b p-2 cursor-pointer">
                        <font-awesome-icon icon="fa-solid fa-trash" />
                        <span class="pl-2" @click="deleteMultiple">Xóa toàn bộ</span>
                    </div>
                    <div class="border-b p-2 cursor-pointer">
                        <font-awesome-icon icon="fa-solid fa-check" />
                        <span class="pl-2" @click="setStatusMultiple(2)">Publish toàn bộ</span>
                    </div>
                    <div class="p-2 cursor-pointer">
                        <font-awesome-icon icon="fa-solid fa-xmark" />
                        <span class="pl-2" @click="setStatusMultiple(1)">Unpublish toàn bộ</span>
                    </div>
                </div>
            </div>
        </div>
        <IboxFilter :endpoint="endpoint" :buttonTitle="buttonTitle"/>
        <table class="w-full">
            <thead class="border-black border p-2 bg-blue-100">
                <tr>
                    <th class="border-black border p-2">
                        <input type="checkbox" name="" id="" v-model="selectedAll" @change="checkAll">
                    </th>
                    <th v-for="(thead, index) in table.field.name" :key="index" class="border-black border p-2">{{thead}}</th>
                    <th class="border-black border p-2">Tình trạng</th>
                    <th class="border-black border p-2">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(data, index) in table.data" :key="index" :class="{'bg-orange-300': selectedRow.includes(data.id) }">
                    <td class="border-black border p-2 text-center">
                        <input type="checkbox" name="" id="" v-model="selectedRow" :value="data.id" @change="checkRow">
                    </td>
                    <td v-for="(field, index) in table.field.value" class="border-black border p-2">{{data[field]}}
                        <span v-if="field === 'users_count'">thành viên</span>
                    </td>
                    <td class="border-black border p-2 text-center">
                        <label class="relative inline-flex items-center cursor-pointer ">
                            <input type="checkbox" :id="data.id" class="sr-only peer" :checked="data.publish !== 1" @change="updatePublish($event)">
                            <div class="group peer ring-0  bg-gradient-to-bl from-neutral-800 via-neutral-700 to-neutral-600  rounded-full outline-none duration-1000 after:duration-300 w-12 h-6  shadow-md  peer-focus:outline-none  after:content-[''] after:rounded-full after:absolute peer-checked:after:rotate-180 after:bg-white after:outline-none after:h-4 after:w-4 after:top-1 after:left-1   peer-checked:after:translate-x-6 peer-hover:after:scale-95 peer-checked:bg-gradient-to-r peer-checked:from-emerald-500 peer-checked:to-emerald-900"></div>
                        </label>
                    </td>
                    <td class="border-black border p-2">
                        <div class="flex items-center gap-3 justify-center">
                            <router-link :to="{name:'users.update', query: {id: data.id} }" class="p-3 bg-green-600 rounded-md text-white">
                                <font-awesome-icon icon="fa-regular fa-pen-to-square" />
                            </router-link>
                            <button class="p-3 bg-red-600 rounded-md text-white" @click="deleteRow(data.id)">
                                <font-awesome-icon icon="fa-solid fa-trash" />
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <Pagination :endpoint="endpoint"/>
    </div>
</template>
<script>
import { defineComponent, ref, computed, onBeforeUnmount } from 'vue'
import IboxFilter from '@/components/IboxFilter.vue'
import { useTableStore } from '@/store/table'
import Pagination from '@/components/Pagination.vue'
import axios from '@/config/axios.js'
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

export default defineComponent({
    components: { IboxFilter, Pagination },
    props: ['table', 'endpoint', 'tableTitle', 'buttonTitle', 'model'],
    setup(props) {
        const tableStore = useTableStore();
        const table = ref(props.table).value
        const tableData = computed(() => {
            return tableStore.getTable;
        });
        table.data = tableData

        const selectedAll = ref(false)
        const selectedRow = ref([])
        const endpoint = ref(props.endpoint).value
        const model = ref(props.model).value
        const checkAll = () => {
            if (selectedAll.value) {
                selectedRow.value = tableData.value.map((value, index) => value.id)
                if (selectedRow.value.length === tableData.value.length) {
                    selectedAll.value = true
                }
            } else {
                selectedRow.value = []
            }
        }

        const checkRow = () => {
            const totalRow = tableData.value.length
            selectedAll.value = (selectedRow.value.length === totalRow) ? true : false
        }

        const updatePublish = async (e) => {
            try {
                const response = await axios.put(`${endpoint}/update/status`, { id: e.target.id, checked: e.target.checked, field: 'publish', model: model })
                toast.success(response.message);
            } catch (error) {
                console.log(error);
            }
            console.log(e.target.checked);
        }

        const isOpenSettingModal = ref(false)
        const toogleSetting = () => {
            isOpenSettingModal.value = !isOpenSettingModal.value
        }

        const deleteMultiple = async () => {
            try {
                if(window.confirm('Are you sure?')) {
                    const response = await axios.delete(`users/group/deleteMultiple?ids=${selectedRow.value}`)
                    tableStore.loadTableAndPagination(undefined, endpoint)
                    toast.success(response.message)
                }
            } catch(e) {
                console.log(e);
            }
        }

        const setStatusMultiple = async (value) => {
            try {
                const response = await axios.put(`${endpoint}/update/status/multiple`, {ids: selectedRow.value, field: 'publish', model: model, value: value})
                tableStore.loadTableAndPagination(undefined, endpoint)
                toast.success(response.message)
            } catch (error) {
                console.log(error);
            }
        }

        const deleteRow = async (id) => {
            try {
                if(window.confirm('Are you sure?')) {
                    const response = await axios.delete(`users/group/delete?id=${id}`)
                    tableStore.loadTableAndPagination(undefined, endpoint)
                    toast.success(response.message)
                }
            } catch (error) {
                console.log(error);
            }
        }

        onBeforeUnmount(() => {
            tableStore.clearData()
        })

        return { table, selectedAll, selectedRow, 
            checkAll, checkRow, updatePublish, 
            toogleSetting, isOpenSettingModal,deleteMultiple, 
            setStatusMultiple, deleteRow 
        };
    }
})
</script>
<style lang="">

</style>