<template>
    <div>
        <hero-bar :has-right-visible="false">
            Dashboard
        </hero-bar>
        <section class="section is-main-section">
            <tiles>
                <card-widget class="tile is-child" type="is-success" icon="account-supervisor-circle" :number="stats.users" label="Users"/><card-widget class="tile is-child" type="is-primary" icon="account-group" :number="stats.groups" label="Groups"/><card-widget class="tile is-child" type="is-info" icon="wallet" :number="stats.wallets" prefix="$" label="Wallets"/>
            </tiles>
        </section>
    </div>
</template>

<script>
    import HeroBar from '../../components/HeroBar'
    import Tiles from '../../components/Tiles'
    import CardWidget from '../../components/CardWidget'
    export default {
        name: "Dashboard",
        components: {
            CardWidget,
            Tiles,
            HeroBar,
        },
        beforeRouteEnter(to, from , next){
            next( v => {
                v.$store.dispatch('Admin/getStats')
            })
        },
        computed : {
            stats(){
                return this.$store.getters['Admin/stats']
            }
        }
    }
</script>

<style scoped>

</style>
