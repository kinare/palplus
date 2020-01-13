<template>
    <div>
        <hero-bar :has-right-visible="true">
            Loan Settings
        </hero-bar>
        <section class="section is-main-section">
            <card-component v-if="settings" title="Settings" class="has-mobile-sort-spaced">
                <h2>LOAN PERIODS</h2>
                <b-field horizontal label="Qualification Period(days)">
                    <b-input :value="settings.qualification_period" custom-class="is-static" expanded readonly/>
                </b-field>
                <b-field horizontal label="Repayment Period(days)">
                    <b-input :value="settings.repayment_period" custom-class="is-static" expanded readonly/>
                </b-field>
                <hr>

                <h2> LOAN COMPUTATION</h2>
                <b-field horizontal label="Loan Limit(of Total Contribution)">
                    <b-input :value="settings.fixed_amount ? settings.limit_amount : settings.limit_rate + '%'" custom-class="is-static" expanded readonly/>
                </b-field>
                <b-field horizontal label="Interest Rate/Amount">
                    <b-input :value="settings.fixed_interest_amount ? settings.interest_amount : settings.interest_rate + '%'" custom-class="is-static" expanded readonly/>
                </b-field>
                <hr>

                <h2>LOAN APPROVALS</h2>
                <b-field horizontal label="Loan Approvers">
                    <b-input :value="settings.approvers" custom-class="is-static" expanded readonly/>
                </b-field>
                <b-field horizontal label="Display Loan Info">
                    <b-input :value="settings.show_loans ? 'Yes' : 'No'" custom-class="is-static" expanded readonly/>
                </b-field>

            </card-component>
        </section>
    </div>
</template>

<script>
    import ModalBox from '../../components/ModalBox'
    import CardComponent from "../../components/CardComponent";
    import HeroBar from "../../components/HeroBar";
    export default {
        name: "LoanSetting",
        components: {HeroBar, CardComponent,  ModalBox },
        data () {
            return {
                isModalActive: false,
                trashObject: null,
                isLoading: false,
                paginated: true,
                perPage: 10,
            }
        },
        beforeRouteEnter(to, from, next){
            next(v => {
                v.$store.dispatch('Loan/getSetting');
                v.group_id = to.params.id
            })
        },

        computed: {
            settings(){
                return this.$store.getters['Loan/setting'].filter( s => {
                    return s.group_id === parseInt(this.group_id)
                }).shift();
            }
        },
    }
</script>

<style scoped>

</style>
