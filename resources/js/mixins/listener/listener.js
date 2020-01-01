const listener = {
  mounted: function() {
    //Global Event Listeners
    Event.$on("login", () => {
      window.location = "/";
    });

    Event.$on("logout", () => {
      this.$router.push("/auth/login");
    });

    Event.$on("ApiError", (status, message) => {
        this.$buefy.toast.open({
            duration: 7000,
            message: message,
            position: 'is-top',
            type: 'is-danger'
        });
    });
  }
};
export default listener;
