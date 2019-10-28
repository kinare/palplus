class Auth {
  constructor() {
    this.token = window.localStorage.getItem("token");
    this.expires_in = window.localStorage.getItem("expires_in");
    this.refresh_token = window.localStorage.getItem("refresh_token");
    this.token_type = window.localStorage.getItem("token_type");

    //Set axios global headers
    window.axios.defaults.headers.common["Accept"] = "Application/json";
    window.axios.defaults.headers.post["Content-Type"] =
      "application/x-www-form-urlencoded";
    // window.axios.defaults.headers.post['Access-Control-Allow-Origin'] = '*';

    //set token if present
    if (this.check()) {
      window.axios.defaults.headers.common["Authorization"] =
        this.token_type + ' ' + this.token;
    }
  }

  check() {
    return !!this.authToken();
  }

  authToken() {
    return this.token || null;
  }

  authUser() {
    return this.user || null;
  }

  expiration() {
    return this.expires_in || null;
  }

  refreshToken() {
    return this.refresh_token || null;
  }

  tokenType() {
    return this.token_type || null;
  }

  login(data) {
    //persist items to local storage
    window.localStorage.setItem("token", data.access_token);
    window.localStorage.setItem("expires_in", data.expires_in);
    window.localStorage.setItem("refresh_token", data.refresh_token);
    window.localStorage.setItem("token_type", data.token_type);

    //make items available globally
    this.token = data.access_token;
    this.expires_in = data.expires_in;
    this.refresh_token = data.refresh_token;
    this.token_type = data.token_type;

    //redirect to loggedin
    Event.$emit("userLoggedIn");
  }

  logout() {
    window.localStorage.removeItem("token");
    window.localStorage.removeItem("expires_in");
    window.localStorage.removeItem("refresh_token");
    window.localStorage.removeItem("token_type");
    this.token = null;
    this.expires_in = null;
    this.refresh_token = null;
    this.token_type = null;

    Event.$emit("userLoggedOut");
  }
}

export default Auth;
