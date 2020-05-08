<template>
  <section>
    <div class="buttons">
      <b-tooltip label="Delete" class="is-danger" position="is-right">
        <button class="button is-danger is-small" @click="isActive = true">
          <i class="mdi mdi-trash default"></i>
        </button>
      </b-tooltip>
    </div>
    <b-modal :active.sync="isActive" :width="640" scroll="keep">
      <div class="modal-card">
        <div class="modal-card">
          <header class="modal-card-head">
            <p class="modal-card-title">Confirm action</p>
          </header>
          <section class="modal-card-body">
            <p>
              This will permanently delete
              <b>{{ trashName }}</b>
            </p>
            <p>Action can not be undone.</p>
          </section>
          <footer class="modal-card-foot">
            <button class="button" type="button" @click="isActive = false">Cancel</button>
            <button class="button is-danger" @click="confirm(item.id)">Delete</button>
          </footer>
        </div>
      </div>
    </b-modal>
  </section>
</template>

<script>
export default {
  name: "DeleteModal",
  props: {
    isActive: {
      type: Boolean,
      default: false
    },
    item: {
      type: Object
    },
    trashName: {
      type: String,
      default: null
    }
  },
  data() {
    return {
      isModalActive: false
    };
  },
  methods: {
    cancel() {
      this.$emit("cancel");
    },
    confirm(item_id) {
      this.$emit("confirm");
    }
  },
  watch: {
    isActive(newValue) {
      this.isModalActive = newValue;
    },
    isModalActive(newValue) {
      if (!newValue) {
        this.cancel();
      }
    }
  }
};
</script>
