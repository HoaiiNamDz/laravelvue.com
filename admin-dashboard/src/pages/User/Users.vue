<template lang="">
    <div>
        <Breadcrumb :pageTitle="pageTitle" :previousPage="previousPage"/>
        <Table :table="table" :endpoint="endpoint" :tableTitle="tableTitle" :buttonTitle="buttonTitle" :model="model"/>
    </div>
</template>
<script>
import { defineComponent, ref, onMounted } from 'vue'
import Breadcrumb from "@/components/Breadcrumb.vue"
import Table from "@/components/Table.vue"

export default defineComponent({
    components: {Breadcrumb, Table},
    setup() {
        const previousPage = ref('Dashboard')
        const pageTitle = ref('Quản lý thành viên')
        const tableTitle = ref('DANH SÁCH THÀNH VIÊN')
        const buttonTitle = ref('Thêm mới thành viên')
        let endpoint = ref('/users')
        const model = ref('User')
        const table = ref({
            field: {
                name: ['Tên thành viên', 'Email', 'Số điện thoại', 'Địa chỉ', 'Ngày sinh', 'Nhóm'],
                value: ['name', 'email','phone','address', 'birthday', 'user_group_id']
            },
            data: []
        })
        return { pageTitle, table, endpoint, previousPage, tableTitle, buttonTitle, model}
    }
})
</script>
<style lang="">
    
</style>