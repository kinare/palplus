<template>
    <div class="Card has-background-white">
        <header class="card-header">
            <p class="card-header-title">Admins</p>
        </header>
        <div class="card-content">
            <b-table
                :data="data"
                :striped="true"
                :hoverable="true">
                <template slot-scope="props">
                    <b-table-column field="name" label="Name" :searchable="true" >
                        {{ props.row.name }}
                    </b-table-column>
                    <b-table-column field="email" label="Email" :searchable="true">
                        {{ props.row.email }}
                    </b-table-column>
                    <b-table-column field="phone" label="Phone" :searchable="true">
                        {{ props.row.phone }}
                    </b-table-column>
                    <b-table-column field="status" label="Status" :searchable="true">
                        <span class="tag" :class="props.row.status === 'active' ? 'is-success' : 'is-grey'">
                            {{ props.row.status }}
                        </span>
                    </b-table-column>
                    <b-table-column field="role" label="Role" :searchable="true">
                        {{ props.row.role }}
                    </b-table-column>
                    <b-table-column field="wef" label="WEF" :searchable="true">
                        {{ props.row.wef }}
                    </b-table-column>
                    <b-table-column field="wet" label="WET" :searchable="true">
                        {{ props.row.wet }}
                    </b-table-column>
                    <b-table-column field="id" label="Options">
                        <b-dropdown aria-role="list">
                            <button class="button" slot="trigger">
                                <span>Options</span> &nbsp;
                                <font-awesome-icon icon="caret-down"/>
                            </button>
                            <b-dropdown-item aria-role="listitem">View</b-dropdown-item>
                            <b-dropdown-item aria-role="listitem">Edit</b-dropdown-item>
                            <b-dropdown-item aria-role="listitem">{{props.row.status === 'active' ? 'Deactivate' : 'Activate'}}</b-dropdown-item>
                            <b-dropdown-item aria-role="listitem">Delete</b-dropdown-item>
                        </b-dropdown>
                    </b-table-column>
                </template>
            </b-table>
        </div>
    </div>
</template>

<script>
    import BTable from "buefy/src/components/table/Table";
    export default {
        name: "AdminList",
        components: {BTable},
        data() {
            return {
                data: [
                    {
                        'name': 'michael kamau',
                        'email': 'michaelkinare@gmail.com',
                        'phone': '0708338855',
                        'status': 'active',
                        'role': 'editor',
                        'wef': '10/2/2019',
                        'wet': '10/2/2020',
                        'id':'1'
                    }, {
                        'name': 'michael kamau',
                        'email': 'michaelkinare@gmail.com',
                        'phone': '0708338855',
                        'status': 'inactive',
                        'role': 'editor',
                        'wef': '10/2/2019',
                        'wet': '10/2/2020',
                        'id':'2'
                    },
                ],
            }
        }
    }
</script>

<style scoped>

</style>
