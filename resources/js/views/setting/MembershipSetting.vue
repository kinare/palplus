<template>
    <div>
        <hero-bar :has-right-visible="true">
            Membeship Settings
        </hero-bar>
        <section class="section is-main-section">
            <card-component v-if="settings" title="Settings" class="has-mobile-sort-spaced">
                <h2>MEMBERSHIP</h2>
                <b-field horizontal label="Access Level">
                    <b-input :value="settings.access_level" custom-class="is-static" expanded readonly/>
                </b-field>
                <b-field horizontal label="Membership Fee Applicable	">
                    <b-input :value="settings.membership_fee ? 'Yes' : 'No'" custom-class="is-static" expanded readonly/>
                </b-field>
                <b-field horizontal label="Membership Fee">
                    <b-input :value="settings.membership_fee_amount" custom-class="is-static" expanded readonly/>
                </b-field>
                <hr>

                <h2> GROUP CONTRIBUTION</h2>
                <b-field horizontal label="Contribution Frequency">
                    <b-input :value="settings.period" custom-class="is-static" expanded readonly/>
                </b-field>
                <b-field horizontal label="Contribution Amount">
                    <b-input :value="settings.contribution_amount" custom-class="is-static" expanded readonly/>
                </b-field>
                <b-field horizontal label="Send Contribution Reminders">
                    <b-input :value="settings.send_reminders ? 'Yes' : 'No'" custom-class="is-static" expanded readonly/>
                </b-field>
                <b-field horizontal label="Late Contribution Penalty">
                    <b-input :value="settings.fixed_late_penalty ? settings.late_penalty_amount : settings.late_penalty_rate + '%'" custom-class="is-static" expanded readonly/>
                </b-field>
                <hr>

                <h2>LEAVING GROUP</h2>
                <b-field horizontal label="Leave Group Fee	">
                    <b-input :value="settings.fixed_leaving_group_fee ? settings.leaving_group_fee : settings.leaving_group_rate + '%'" custom-class="is-static" expanded readonly/>
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
        name: "MembershipSetting",
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
                v.$store.dispatch('Group/getSetting');
                v.group_id = to.params.id
            })
        },

        computed: {
            settings(){
                return this.$store.getters['Group/setting'].filter( s => {
                    return s.group_id === parseInt(this.group_id)
                }).shift();
            }
        },
    }
</script>

<style scoped>

</style>
