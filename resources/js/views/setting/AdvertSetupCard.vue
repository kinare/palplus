<template>
    <div>
        <hero-bar :has-right-visible="true">
            Ad Setup
        </hero-bar>
        <section class="section is-main-section">
            <div class="columns">
                <div class="column is-one-third">
                    <card-component title="Setup" class="has-mobile-sort-spaced">
                        <b-field  label="Type">
                            <b-input v-model="setting.type"  />
                        </b-field>

                        <b-field  label="rate(%)">
                            <b-input v-model="setting.rate"  />
                        </b-field>

                        <b-field  label="Description">
                            <b-input v-model="setting.description"  />
                        </b-field>

                        <b-field  label="Currency">
                            <b-input type="text" v-model="setting.currency"  />
                        </b-field>

                        <div class="buttons" style="margin-top: 40px">
                            <b-button @click="saveSetting()" type="is-primary" expanded>Save</b-button>
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
        name: "AdvertSetupCard",
        components: {HeroBar, CardComponent,  ModalBox },
        data : function(){
            return {
                setting : {
                    type : '',
                    rate : '',
                    description : '',
                    currency:  ''
                }
            }
        },
        beforeRouteEnter(to, from, next){
            next(v => {
                if(to.params.id)
                    v.$store.dispatch('Setup/getAdSetup', to.params.id)
            })
        },
        computed : {
            setup(){
                return this.$store.getters['Setup/adSetup'];
            }
        },
        methods : {
            saveSetting : function () {
                this.$store.dispatch('Setup/saveAdSetup', this.setting);
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
