<template>
    <div>
        <hero-bar :has-right-visible="true">
            Gateway Setup
        </hero-bar>
        <section class="section is-main-section">
            <div class="columns">
                <div class="column is-one-third">
                    <card-component title="Type" class="has-mobile-sort-spaced">
                        <b-field  label="Type">
                            <b-input v-model="setting.type"  />
                        </b-field>

                        <b-field  label="rate(%)">
                            <b-input v-model="setting.rate"  />
                        </b-field>

                        <b-field  label="gateway">
                            <b-input v-model="setting.gateway"  />
                        </b-field>

                        <b-field  label="Minimum Amount">
                            <b-input type="number" v-model="setting.min_amount"  />
                        </b-field>

                        <b-field  label="Maximum Amount">
                            <b-input type="number" v-model="setting.max_amount"  />
                        </b-field>

                        <b-field  label="status">
                            <b-select expanded v-model="setting.active">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </b-select>
                        </b-field>

                        <div class="buttons" style="margin-top: 40px">
                            <b-button @click="saveSetting()" type="is-primary" expanded>Submit</b-button>
                        </div>

                    </card-component>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import ModalBox from '../../components/ModalBox'
    import CardComponent from "../../components/CardComponent";
    import HeroBar from "../../components/HeroBar";
    export default {
        name: "GatewaySettingCard",
        components: {HeroBar, CardComponent,  ModalBox },
        data : function(){
          return {
              setting : {
                  type : '',
                  rate : '',
                  gateway : '',
                  active:  ''
              }
          }
        },
        beforeRouteEnter(to, from, next){
            next(v => {
                if(to.params.id)
                    v.$store.dispatch('Setup/getSetup', to.params.id)
            })
        },
        computed : {
            setup(){
                return this.$store.getters['Setup/setup'];
            }
        },
        methods : {
            saveSetting : function () {
                this.$store.dispatch('Setup/saveSetup', this.setting);
                this.$router.go(-1);
            }
        },
        watch : {
            setup : {
                handler : function (n) {
                    if (n){
                        this.setting = n
                    }
                }
            }
        }
    }
</script>

<style scoped>

</style>
