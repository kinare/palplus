const {
  VUE_APP_NAME,
  VUE_APP_VERSION,
  VUE_APP_API,
  NODE_ENV = ""
} = process.env;

const environment = NODE_ENV.toLowerCase();
const apiBaseUrl = VUE_APP_API;
const appName = VUE_APP_NAME;
const appVersion = VUE_APP_VERSION;

export { environment, apiBaseUrl, appName, appVersion };
