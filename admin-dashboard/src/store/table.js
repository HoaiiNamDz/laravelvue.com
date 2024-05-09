import { defineStore } from 'pinia'
import axios from '@/config/axios.js'

export const useTableStore = defineStore('table', {
    state: () => ({
        table: [],
        pagination: [],
        query: null,
        router: null,
        currentPage: 1
    }),
    actions: {
        async loadTableAndPagination(page,endpoint) {
            let apiUrl = endpoint ;
            if(page === undefined) {
                apiUrl+= `?page=1`
            } else {
                apiUrl+= `?page=${page}`
            }
            if(this.query !== null) {
                // if (this.query.publish !== undefined && this.query.keyword !== undefined) {
                //     apiUrl += `&publish=${this.query.publish}&keyword=${this.query.keyword}`;
                // } else if(this.query.perpage) {
                //     apiUrl += `&perpage=${this.query.perpage}`
                // }
                if(this.query.publish !== 0) {
                    apiUrl += `&publish=${this.query.publish}`
                } if(this.query.keyword !== '') {
                    apiUrl += `&keyword=${this.query.keyword}`
                } if(this.query.perpage !== 2) {
                    apiUrl += `&perpage=${this.query.perpage}`;
                }
            }
            this.router = apiUrl
            const response = await axios.get(apiUrl)
            this.table = response.data
            this.pagination = response
        },
        setQuery(publish, keyword, perpage) {
            this.query = {
                'publish': publish,
                'keyword': keyword,
                'perpage': perpage
            }
        },
        clearData() {
            this.table = [],
            this.pagination = [],
            this.currentPage = 1
        }
    },
    getters: {
        getTable: state => state.table,
        getPagination: state => state.pagination,
        getRouter: state => state.router,
        getQuery: state => state.query,
        getRouter: state => state.router,
        getCurrentPage: state => state.currentPage,
    }
})
