<template>
    <div>
        <hero-bar :has-right-visible="true">
            Ad Setup
        </hero-bar>
        <section class="section is-main-section">
            <div class="columns">
                <div class="column is-one-third">
                    <card-component title="Setup" class="has-mobile-sort-spaced">

                        <b-field  label="Description">
                            <b-input v-model="setting.description"  />
                        </b-field>

                        <b-field  label="Currency">
                            <b-input type="text" v-model="setting.currency"  />
                        </b-field>

                        <b-field  label="rate(%)">
                            <b-input v-model="setting.amount"  />
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
    import HeroBar from "../../components/HeroBar";
    import CardComponent from "../../components/CardComponent";
    import ModalBox from "../../components/ModalBox";

    export default {
        name: "GroupSetupCard",
        components: {HeroBar, CardComponent,  ModalBox },
        data : function(){
            return {
                setting : {
                    description : '',
                    currency:  '',
                    amount:  ''
                }
            }
        },
        beforeRouteEnter(to, from, next){
            next(v => {
                if(to.params.id)
                    v.$store.dispatch('Setup/getGroupSetup', to.params.id)
            })
        },
        computed : {
            setup(){
                return this.$store.getters['Setup/groupSetup'];
            }
        },
        methods : {
            saveSetting : function () {
                this.$store.dispatch('Setup/saveGroupSetup', this.setting);
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
