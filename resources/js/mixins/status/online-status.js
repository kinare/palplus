const isOnline = {
  data: function() {
    return {
      state: true
    };
  },
  mounted() {
    setInterval(function() {
      Event.$emit("noInternet", navigator.onLine);
    }, 5000);

    Event.$on("noInternet", state => {
      this.state = state;
    });
  },
  watch: {
    state: {
      handler: function(n, o) {
        if (n !== o) {
          if (n) this.$toasted.clear();

          if (!n)
            this.$toasted.show("No internet connection", {
              position: "bottom-left",
              keepOnHover: true,
              iconPack: "fontawesome",
              duration: 1000000000000000000,
              type: "error",
              icon: "unlink",
              closeOnSwipe: true
            });
        }
      }
    }
  }
};

export default isOnline;
