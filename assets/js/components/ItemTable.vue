<template>
    <div>
        <b-row class="my-1">
            <b-col>
                <b-form inline>
                    <b-input-group>
                        <b-form-input v-model="filter.keyword" placeholder="Filter"></b-form-input>
                        <b-input-group-append>
                            <b-button :disabled="!filter.keyword" @click="filter.keyword = ''">Clear</b-button>
                        </b-input-group-append>
                    </b-input-group>
                    <b-form-checkbox v-model="filter.active" name="filter-active" switch class="mx-4">
                        Active
                    </b-form-checkbox>
                    <b-pagination
                        v-model="pagination.currentPage"
                        :total-rows="pagination.totalRows"
                        :per-page="pagination.perPage"
                        :limit="pagination.limit"
                        class="ml-auto my-0"
                    >
                    </b-pagination>
                </b-form>
            </b-col>
        </b-row>
        <b-row>
            <b-col>
                <b-table 
                    responsive="md"
                    hover
                    :items="filteredItems"
                    :fields="fields"
                    sort-by="name"
                    :per-page="pagination.perPage"
                    :current-page="pagination.currentPage"
                >
                    <template slot="name" slot-scope="data">
                        <a :href="'?id=' + data.item.id">{{ data.item.name }}</a>
                    </template>
                </b-table>
            </b-col>
        </b-row>
    </div>
</template>

<script>
export default {
    props: {
        items: Array
    },
    mounted() {
      //Set the initial number of items
      this.pagination.totalRows = this.filteredItems.length
    },
    data () {
        return ({
            fields: [
                { key: 'name', sortable: true },
                { key: 'role', sortable: true },
                { key: 'code', sortable: false }
            ],
            filter: {
                keyword: '',
                active: true
            },
            pagination: {
                totalRows: 1,
                currentPage: 1,
                perPage: 10,
                pageOptions: [5, 10, 15],
                limit: 10
            }
        })
    },
    computed: {
        filteredItems() {
            let keyword = this.filter.keyword.toLowerCase()
            let filteredItems = this.items.filter((item) => {
                return item.active === this.filter.active && (
                    !this.filter.keyword
                    || item.name.toLowerCase().includes(keyword)
                    || item.role.toLowerCase().includes(keyword)
                    || item.code.toLowerCase().includes(keyword)
                )
            })
            this.pagination.totalRows = filteredItems.length;
            return filteredItems;
        }
    }
}
</script>
