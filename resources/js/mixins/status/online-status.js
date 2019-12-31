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
          if (n)
              this.$buefy.toast.open({
              duration: 100,
              message: "internet connection",
              position: 'is-bottom-left',
              type: 'is-success'
          });

          if (!n)
              this.$buefy.toast.open({
                  duration: 70000,
                  message: "No internet connection",
                  position: 'is-bottom-left',
                  type: 'is-warning'
              });
        }
      }
    }
  }
};

export default isOnline;
