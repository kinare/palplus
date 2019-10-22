const isOnline = {
  mounted() {
    setInterval(function() {
      if (!navigator.onLine) Event.$emit("noInternet");
    }, 5000);
  }
};

export default isOnline;
