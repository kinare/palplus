<template>
    <div class="Card has-background-white">
        <header class="card-header">
            <p class="card-header-title">Admin Card</p>
        </header>
        <div class="card-content">
            <div class="content has-text-left">
                <div class="columns is-multiline">
                    <div class="column">
                        <b-field label="Access type">
                            <b-select expanded placeholder="Select Access type" v-model="admin.access_type">
                                <option>Editor</option>
                                <option>Viewer</option>
                            </b-select>
                        </b-field>
                    </div>
                    <div class="column">
                        <b-field label="Full Names">
                            <b-input type="text" placeholder="Names" v-model="admin.name"></b-input>
                        </b-field>
                    </div>
                    <div class="column">
                        <b-field label="Phone">
                            <b-input type="text" placeholder="Phone" v-model="admin.phone"></b-input>
                        </b-field>
                    </div>
                </div>
                <div class="columns is-multiline">
                    <div class="column">
                        <b-field label="Email">
                            <b-input type="email" placeholder="email" v-model="admin.email"></b-input>
                        </b-field>
                    </div>
                    <div class="column">
                        <b-field label="Status">
                            <b-select expanded placeholder="Select status" v-model="admin.status">
                                <option>Active</option>
                                <option>Inactive</option>
                            </b-select>
                        </b-field>
                    </div>
                    <div class="column">
                        <b-field label="WEF date" >
                            <b-datepicker
                                    :show-week-number="true"
                                    placeholder="Click to select..."
                                    icon="calendar-today"
                                    v-model="admin.wef"
                            >
                            </b-datepicker>
                        </b-field>
                    </div>
                </div>
                <div class="columns is-multiline">
                    <div class="column">
                        <b-field label="WET date">
                            <b-datepicker
                                    :show-week-number="true"
                                    placeholder="Click to select..."
                                    icon="calendar-today"
                                    v-model="admin.wet"
                            >
                            </b-datepicker>
                        </b-field>
                    </div>
                    <div class="column"></div>
                    <div class="column"></div>
                </div>
                <div class="columns is-multiline">
                    <div class="column">
                        <div class="buttons">
                            <b-button @click="saveAdmin()" type="is-primary" expanded>Submit</b-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import BField from "buefy/src/components/field/Field";
    import BInput from "buefy/src/components/input/Input";
    import BButton from "buefy/src/components/button/Button";
    import BDatepicker from "buefy/src/components/datepicker/Datepicker";
    export default {
        name: "AdminCard",
        components: {BDatepicker, BButton, BInput, BField},
        data : function () {
            return {
                admin : {
                    access_type : '',
                    name : '',
                    email : '',
                    phone : '',
                    status : '',
                    wef : '',
                    wet : '',
                }
            }
        },
        methods : {
            saveAdmin : function () {
                this.$store.dispatch('Admin/invite', this.admin)
            }
        }
    }
</script>

<style scoped>

</style>
