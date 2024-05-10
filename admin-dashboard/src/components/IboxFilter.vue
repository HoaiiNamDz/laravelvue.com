<template lang="">
    <div class="flex items-center justify-between mb-3">
        <select name="" id="" class="border p-2" v-model="perpageValue" @change="changePerpage">
            <option value="2">2 bản ghi</option>
            <option value="3">3 bản ghi</option>
            <option value="4">4 bản ghi</option>
        </select>
        <div class="flex gap-3 items-center">
            <select name="" id="" class="border p-2" v-model="searchValue.selectedOption" @change="changePerpage">
                <option
                    :value="index"
                    v-for="(publishOption, index) in publishOptions"
                    :key="index"
                >
                    {{ publishOption }}
                </option>
            </select>
            <form action="" @submit.prevent="changePerpage" class="flex gap-3 items-center" method="post">
                <div class="flex items-center">
                    <input
                        type="text"
                        class="outline-none border rounded-md p-2 rounded-tr-none rounded-br-none"
                        placeholder="Tìm kiếm"
                        v-model="searchValue.searchKeyword"
                    />
                    <button type="submit">
                        <font-awesome-icon
                            icon="fa-solid fa-magnifying-glass"
                            class="p-3 text-white bg-blue-600 rounded-md rounded-tl-none rounded-bl-none cursor-pointer hover:bg-blue-500"
                        />
                    </button>
                </div>
            </form>
            <router-link
                :to="`${endpoint}/create`"
                class="flex gap-2 items-center py-2 px-3 bg-yellow-400 text-white rounded-md"
            >
                <font-awesome-icon icon="fa-solid fa-plus" />
                <p>{{buttonTitle}}</p>
            </router-link>
        </div>
    </div>
</template>
<script>
import { ref, onMounted } from 'vue'
import { useTableStore } from '@/store/table'
import { useRouter } from 'vue-router'
export default {
    props: ['endpoint', 'buttonTitle'],
    setup(props) {
        const publishOptions = ref(['Chọn tình trạng', 'Không active', 'Đang active'])
        const searchValue = ref({
            selectedOption: 0,
            searchKeyword: ''
        })
        
        const router = useRouter()
        const tableStore = useTableStore()
        const endpoint = ref(props['endpoint']).value
        const perpageValue = ref(4)
        const currentPage = router.currentRoute.value.query?.page ?? tableStore.getCurrentPage
        const queryPerpage = router.currentRoute.value.query?.perpage
        const queryKeyword = router.currentRoute.value.query?.keyword
        const queryPublish = router.currentRoute.value.query?.publish
        const queryData = router.currentRoute.value.query
        const queryString = {
            page: currentPage
        }

        const changePerpage = () => {
                tableStore.setQuery(searchValue.value.selectedOption, searchValue.value.searchKeyword, perpageValue.value)
                tableStore.loadTableAndPagination(currentPage, endpoint)
                const hasQueryData = Object.keys(queryData).length !== 0 || perpageValue.value !== 4
                const hasPageData = currentPage !== undefined
                if (hasPageData) {
                    queryString.page = router.currentRoute.value.query?.page 
                    if (hasQueryData) {
                        queryString.perpage = perpageValue.value ?? tableStore.getQuery.perpage
                    }
                    if(searchValue.value.searchKeyword ) {
                        queryString.keyword = searchValue.value.searchKeyword ?? tableStore.getQuery.keyword
                    } 
                    if (searchValue.value.selectedOption !== 0) {
                        queryString.publish = searchValue.value.selectedOption ?? tableStore.getQuery.publish
                    }
                } 
                router.push({ query: queryString })
        }
        onMounted(() => {
            perpageValue.value = queryPerpage ?? 4
            searchValue.value.searchKeyword = queryKeyword ?? ''
            searchValue.value.selectedOption = queryPublish ?? 0
            changePerpage()
        })
        return { publishOptions, searchValue, perpageValue, changePerpage }
    }
}
</script>
<style lang=""></style>
