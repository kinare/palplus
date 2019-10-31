<template>
    <div class="Card has-background-white">
        <header class="card-header">
            <p class="card-header-title">Currencies</p>
        </header>
        <div class="card-content">
            <b-table
                    :data="data"
                    :columns="columns"
                    :striped="true"
                    :hoverable="true"
            >
            </b-table>
        </div>
    </div>
</template>
<script>
    import BTable from "buefy/src/components/table/Table";
    export default {
        name: "List",
        components: {BTable},
        data() {
            return {
                data: [
                    { 'name': 'Kenya Shillings', 'short_code': 'KES', 'country': 'Kenya', 'rate': '102.09'},
                    { 'name': 'US Dollars', 'short_code': 'USD', 'country': 'USA', 'rate': '1'},
                    { 'name': 'Uganda Shillings', 'short_code': 'UGX', 'country': 'Uganda', 'rate': '3709.09'},
                ],
                columns: [
                    {
                        field: 'name',
                        label: 'Currency',
                        searchable: true,
                    },
                    {
                        field: 'short_code',
                        label: 'Short Description',
                        searchable: true,
                    },
                    {
                        field: 'country',
                        label: 'Country',
                        searchable: true,
                    },
                    {
                        field: 'rate',
                        label: 'Today\'s Rate vs USD',
                        searchable: true,
                    },

                ]
            }
        }
    }
</script>

<style scoped>

</style>
