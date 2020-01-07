<template>
    <div>
        <hero-bar :has-right-visible="true">
            New Admin
        </hero-bar>
        <section class="section is-main-section">
            <card-component title="New" class="has-mobile-sort-spaced">
                <div class="content has-text-left">
                    <div class="columns is-multiline">
                        <div class="column">
                            <b-field label="Access type">
                                <b-select expanded placeholder="Select Access type" v-model="admin.access_type">
                                    <option value="editor">Editor</option>
                                    <option value="viewer">Viewer</option>
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
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </b-select>
                            </b-field>
                        </div>
                        <div class="column">
                            <b-field label="WEF date" >
                                <b-datepicker
                                    :show-week-number="true"
                                    placeholder="Click to select..."
                                    icon="calendar-today"
                                    v-model="wef"
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
                                    v-model="wet"
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
            </card-component>
        </section>
    </div>
</template>

<script>
    import CardComponent from "../../components/CardComponent";
    import HeroBar from "../../components/HeroBar";
    import BField from "buefy/src/components/field/Field";
    import BInput from "buefy/src/components/input/Input";
    import BButton from "buefy/src/components/button/Button";
    import BDatepicker from "buefy/src/components/datepicker/Datepicker";
    import moment from "moment";
    export default {
        name: "NewAdmin",
        components: {HeroBar, CardComponent, BDatepicker, BButton, BInput, BField},
        data : function () {
            return {
                id : null,
                wef : new Date(),
                wet : new Date(),
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
        beforeRouteEnter(to, from, next){
            next(v =>{
                if (to.params.id){
                    v.id =  to.params.id;
                    v.admin = v.selectedAdmin;
                }

            })
        },
        computed: {
          selectedAdmin(){
              return this.$store.getters['Admin/admins'].filter(admin => {
                  return admin.id === parseInt(this.id);
              }).shift();
          }
        },
        methods : {
            saveAdmin : function () {
                this.$store.dispatch(`Admin/${this.id ? 'save' : 'invite'}`, this.admin)
            }
        },
        watch : {
            wef: {
                handler: function(n) {
                    this.admin.wef = moment(n)
                        .format()
                        .substr(0, 10);
                }
            },
            wet: {
                handler: function(n) {
                    this.admin.wet = moment(n)
                        .format()
                        .substr(0, 10);
                }
            },
        }
    }
</script>

<style scoped>

</style>
