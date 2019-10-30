<template>
    <main class="column">
<!--        Header-->
        <div class="level">
            <div class="level-left">
                <div class="level-item">
                    <div class="title">{{$route.name}}</div>
                </div>
            </div>
            <div class="level-right">
                <div class="level-item">
                    <router-view name="menu"/>
                </div>
            </div>
    </div>

<!--        Content-->
        <div class="container">
            <router-view name="content"/>
        </div>
    </main>
</template>

<script>
    export default {
        name: "MainContent"
    }
</script>

<style scoped>
a.router-link-active{
    background-color: #6d488e;
    color: #fff;
}
</style>
