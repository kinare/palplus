const listener = {
  mounted: function() {
    //Global Event Listeners
    Event.$on("userLoggedIn", () => {
      window.location = "/dashboard";
    });

    Event.$on("userLoggedOut", () => {
      this.$router.push("/auth/login");
    });

    Event.$on("userSignedUp", () => {
      this.$router.push("/auth/login");
    });

    Event.$on("userActivated", () => {
      this.$router.push("/auth/login");
    });

    Event.$on("userPasswordSet", () => {
      this.$router.push("/auth/login");
    });

    Event.$on("ApiError", (status, messsage) => {
      let toastObject = {
        position: "top-center",
        keepOnHover: true,
        iconPack: "fontawesome",
        duration: 5000,
        type: "error",
        icon: "exclamation-circle",
        closeOnSwipe: true
      };

      this.$toasted.show(status + " " + messsage, toastObject);
    });

    Event.$on("ApiSuccess", (status, messsage) => {
      let toastObject = {
        position: "top-center",
        keepOnHover: true,
        iconPack: "fontawesome",
        duration: 5000,
        type: "success",
        icon: "check-circle",
        closeOnSwipe: true
      };

      this.$toasted.show(status + " " + messsage, toastObject);
    });

    //internet connection listener
    Event.$on("noInternet", () => {
      this.$toasted.show("No internet connection", {
        position: "bottom-right",
        keepOnHover: true,
        iconPack: "fontawesome",
        fullWidth: true,
        fitToScreen: true,
        duration: 5000,
        type: "error",
        icon: "unlink",
        closeOnSwipe: true,
        singleton: true
      });
    });
  }
};

export default listener;
