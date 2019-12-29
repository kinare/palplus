import { httpClient } from "./http-client/HttpClient";

async function call(requestType, url, data = null) {
  return await httpClient[requestType](url, data);
}
export default call;
