<template>
    <div>
        <hero-bar :has-right-visible="true">
            New Admin
        </hero-bar>
        <section class="section is-main-section">
            <card-component title="New" class="has-mobile-sort-spaced">

            </card-component>
        </section>
    </div>
</template>

<script>
    import CardComponent from "../../components/CardComponent";
    import HeroBar from "../../components/HeroBar";
    export default {
        name: "NewAdmin",
        components: {HeroBar, CardComponent},
    }
</script>

<style scoped>

</style>
