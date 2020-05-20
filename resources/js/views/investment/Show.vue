<template>
  <section>
    <div class="buttons">
      <b-tooltip label="View" position="is-right">
        <button class="button is-info is-small" @click="isActive = true">
          <i class="mdi mdi-eye default"></i>
        </button>
      </b-tooltip>
    </div>
    <b-modal :active.sync="isActive" :width="640" scroll="keep">
      <div class="card">
        <div class="card-content">
          <div class="media">
            <div class="media-left">
              <figure class="image is-48x48">
                <img :src="invest.avatar_url" alt="Avatar" />
              </figure>
            </div>
            <div class="media-content">
              <p class="title is-4">{{invest.title}}</p>
            </div>
          </div>
          <div class="content">
            <div class="wrapper-item">
              <p class="subtitle">Description</p>
              <hr />
              <p>{{invest.description}}</p>
            </div>

            <hr />
            <div class="wrapper-item">
              <p class="subtitle">
                <template v-if="invest.featured">
                  <b-button class="is-primary">Featured</b-button>
                </template>
                <template v-else>
                  <b-button class="is-warning">Not Featured</b-button>
                </template>
              </p>
            </div>
          </div>
        </div>
      </div>
    </b-modal>
  </section>
</template>

<script>
export default {
  name: "ShowInvestment",
  props: {
    invest: {
      type: Object
    }
  },
  data() {
    return {
      isImageModalActive: false,
      isActive: false
    };
  }
};
</script>
<style >
.wrapper-item {
  margin-bottom: 20px !important;
}
</style>