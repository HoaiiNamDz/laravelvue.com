<template lang="">
    <Breadcrumb :pageTitle="pageTitle" :previousPage="previousPage"/>
    <Table :table="table" :endpoint="endpoint" :tableTitle="tableTitle" :buttonTitle="buttonTitle" :model="model"/>
</template>
<script>
import { defineComponent, ref, onMounted } from 'vue'
import Breadcrumb from "@/components/Breadcrumb.vue"
import Table from "@/components/Table.vue"

export default defineComponent({
    components: {Breadcrumb, Table},
    setup() {
        const previousPage = ref('Dashboard')
        const pageTitle = ref('Quản lý Nhóm thành viên')
        const tableTitle = ref('DANH SÁCH NHÓM THÀNH VIÊN')
        const buttonTitle = ref('Thêm mới nhóm thành viên')
        let endpoint = ref('/users/group')
        const model = ref('UserGroup')
        const table = ref({
            field: {
                name: ['Tên nhóm thành viên', 'Số thành viên', 'Mô tả'],
                value: ['name', 'users_count','description']
            },
            data: []
        })
        return { pageTitle, table, endpoint, previousPage, tableTitle, buttonTitle, model}
    }
})
</script>
<style lang="">

</style>