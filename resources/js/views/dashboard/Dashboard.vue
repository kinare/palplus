<template>
  <div>
    <Header/>
    <div class="section" style="padding: 1rem;">
      <div class="columns">

<!--        side bar-->
        <side-bar/>

<!--        main content-->
        <main-content/>
      </div>
    </div>
  </div>
</template>

<script>
import Header from "./Header";
import SideBar from "./SideBar";
import MainContent from "./MainContent";
export default {
  name: "Dashboard",
  components: {MainContent, SideBar, Header}
};
</script>

<style scoped></style>
