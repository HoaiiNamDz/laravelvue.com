<template lang="">
    <nav class="flex items-center gap-x-1 justify-center mt-6">
        <div v-for="(link, index) in pagination.links" :key="index"  class="flex items-center gap-x-1" @click="renderTable(link.label)">
            <span v-if="link.label === '&amp;laquo; Previous'" class="cursor-pointer min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex jusify-center items-center gap-x-2 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                <svg class="flex-shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m15 18-6-6 6-6"></path>
                </svg>
            </span>
            <span v-else-if="link.label === 'Next &amp;raquo;'" class="cursor-pointer min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex jusify-center items-center gap-x-2 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                <svg class="flex-shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m9 18 6-6-6-6"></path>
                </svg>
            </span>
            <span v-else class="min-h-[38px] min-w-[38px] flex justify-center items-center bg-gray-200 text-gray-800 py-2 px-3 text-sm rounded-lg focus:outline-none disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-600 dark:text-white dark:focus:bg-neutral-500 cursor-pointer hover:bg-gray-100" aria-current="page" :class="{'exact-active-link': link.active}" >{{link.label}}</span>
        </div>
    </nav>
</template>
<script>
import { useTableStore } from '@/store/table'
import { useRouter } from 'vue-router'
import { onMounted, ref, computed } from 'vue'
export default {
    props: ['endpoint'],
    setup(props) {
        const tableStore = useTableStore()
        const router = useRouter()
        let paginationData = ref(props['endpoint']).value
        const pagination = computed(() => {
            return tableStore.getPagination;
        });
        const renderTable = async (link) => {
            try {
                let queryPage = router.currentRoute.value.query.page
                let currentPage = (link !== undefined) ? link : queryPage
                if (queryPage !== undefined) {
                    if (currentPage === '&laquo; Previous') {
                        currentPage = parseInt(queryPage) - 1;
                        if (currentPage < 1) {
                            currentPage = 1;
                        }
                    }
                    else if (currentPage === 'Next &raquo;') {
                        currentPage = parseInt(queryPage) + 1;
                        if (currentPage > pagination.value.links.length - 2) {
                            return false
                        }
                    }
                } else {
                    if (currentPage === '&laquo; Previous') {
                        return false
                    } else if (currentPage === 'Next &raquo;') {
                        currentPage = 2;
                        if (currentPage > pagination.value.links.length - 2) {
                            return false
                        }
                    }
                }
                await tableStore.loadTableAndPagination(currentPage, paginationData)
                if (currentPage !== undefined) {
                    router.push({ query: { page: currentPage } })
                }
            } catch (e) {
                console.log(e);
            }
        }
        onMounted(() => {
            renderTable()
        })
        return { renderTable, router, pagination }
    }
}
</script>
<style lang="">

</style>