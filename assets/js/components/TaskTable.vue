<template>
  <div>
    <b-row class="table-toolbar">
      <b-col md="4" lg="3">
        <b-input-group>
          <b-form-input v-model="filter.keyword" placeholder="Filter"></b-form-input>
          <b-input-group-append>
            <b-button :disabled="!filter.keyword" @click="filter.keyword = ''">Clear</b-button>
          </b-input-group-append>
        </b-input-group>
      </b-col>
      <b-col>
        <b-pagination
          v-model="pagination.currentPage"
          :total-rows="pagination.totalRows"
          :per-page="pagination.perPage"
          :limit="pagination.limit"
          class="float-md-right"
        ></b-pagination>
      </b-col>
    </b-row>

    <b-row>
      <b-col>
        <b-table
          responsive="md"
          hover
          :items="filteredItems"
          :fields="fields"
          sort-by="id"
          sort-desc
          show-empty
          :per-page="pagination.perPage"
          :current-page="pagination.currentPage"
        >
          <template slot="type" slot-scope="data">
            <!--<a :href="showLink.replace('_id_', data.item.id)">-->
            {{ data.item.type }}
            <!--</a>-->
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
    // showLink: {
    //   required: true,
    //   type: String
    // }
  },
  mounted() {
    //Set the initial number of items
    this.pagination.totalRows = this.filteredItems.length
  },
  data() {
    return {
      fields: [
        { key: "id", sortable: true },
        { key: "title", sortable: true },
        { key: "completionDate", sortable: true }
      ],
      filter: {
        keyword: ""
      },
      pagination: {
        totalRows: 1,
        currentPage: 1,
        perPage: 10,
        pageOptions: [5, 10, 15],
        limit: 10
      }
    }
  },
  computed: {
    filteredItems() {
      let keyword = this.filter.keyword.toLowerCase()
      let filteredItems = this.items.filter(item => {
        return (
          item.active === this.filter.active &&
          (!this.filter.keyword || item.title.toLowerCase().includes(keyword))
        )
      })
      this.pagination.totalRows = filteredItems.length
      return filteredItems
    }
  }
}
</script>
