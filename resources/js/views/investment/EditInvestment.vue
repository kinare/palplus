<template>
  <section>
    <div class="buttons">
      <b-tooltip label="Edit" position="is-top">
        <button class="button is-primary is-small" @click="isActive = true">
          <i class="mdi mdi-pencil default"></i>
        </button>
      </b-tooltip>
    </div>
    <b-modal :active.sync="isActive" :width="640" scroll="keep">
      <div class="card">
        <div class="card-title">
          <div class="card-title">
            <p class="title">
              <span class="font-weight: normal !important;">Edit</span>
              {{invest.title}}
            </p>
          </div>
        </div>
        <div class="card-content">
          <b-field label="Title">
            <b-input type="text" :value="invest.title"></b-input>
          </b-field>
          <b-field label="Amount">
            <b-input type="number" step=".000000012" value="300000"></b-input>
          </b-field>
          <b-field label="Description">
            <b-input type="textarea" :value="invest.description"></b-input>
          </b-field>
          <div class="field">
            <b-checkbox :value="invest.featured">Featured</b-checkbox>
          </div>

          <b-upload v-model="form.image">
            <a class="button is-primary">
              <b-icon icon="upload"></b-icon>
              <span>Upload Image</span>
            </a>
          </b-upload>
        </div>
      </div>
    </b-modal>
  </section>
</template>

<script>
export default {
  name: "EditInvestment",
  props: {
    invest: {
      type: Object
    }
  },
  data() {
    return {
      isActive: false,
      form: {
        image: ""
      }
    };
  }
};
</script>