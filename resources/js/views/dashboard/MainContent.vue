<template>
    <main class="column">
<!--        Header-->
        <div class="hero is-white  is-small has-margin-bottom-20">
            <div class="hero-body">
                <div class="container">
                    <div class="level">
                        <div class="level-left">
                            <div class="level-item">
                                <div class="content has-text-left">
                                    <h1 class="title">{{$route.name}}</h1>

                                    <nav class="breadcrumb" aria-label="breadcrumbs">
                                        <ul style="margin-left: 0">
                                            <li><a href="../">Dashboard</a></li>
<!--                                            <li><a href="../">{{// $route.}}</a></li>-->
                                            <li><a href="../">Examples</a></li>
                                            <li class="is-active"><a href="#" aria-current="page">Admin</a></li>
                                        </ul>
                                    </nav>

                                </div>
                            </div>
                        </div>
                        <div class="level-right">
                            <div class="level-item">
                                <router-view name="menu"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!--        Content-->
        <div class="">
            <router-view name="content"/>
        </div>
    </main>
</template>

<script>
    export default {
        name: "MainContent",
        created() {
            console.log(this.$route)
        }
    }
</script>

<style scoped>
a.router-link-active{
    background-color: #6d488e;
    color: #fff;
}
</style>
