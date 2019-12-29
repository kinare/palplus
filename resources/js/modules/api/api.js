class Api {
  baseUrl = "";
  constructor(url) {
    this.baseUrl = url;
    this.intercept();
  }

  async call(requestType, url, data = null) {
    return await window.axios[requestType](this.baseUrl + url, data);
  }

  intercept() {
    //Intercept axios for toast
    window.axios.interceptors.response.use(
      res => {
        return Promise.resolve(res);
      },
      error => {
        console.log(error);
        // Event.$emit(
        //   "ApiError",
        //   error.response.status,
        //   error.response.data.message
        // );
        return Promise.reject(error);
      }
    );
  }
}
export default Api;
