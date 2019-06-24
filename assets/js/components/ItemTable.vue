<template>
    <div>
        <b-form-group label-cols-sm="3" label="Filter">
            <b-input-group>
            <b-form-input v-model="filter" placeholder="Type to Search"></b-form-input>
            <b-input-group-append>
                <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
            </b-input-group-append>
            </b-input-group>
        </b-form-group>
        <b-table  hover :items="items" :fields="fields" :filter="filter"></b-table>
    </div>
</template>

<script>
export default {
    props: {
        items: Array
    },
    data () {
        return ({
            fields: [
                { key: 'name', sortable: true },
                { key: 'role', sortable: true },
                { key: 'code', sortable: false }
            ],
            filter: ''
        })
    }
}
</script>
