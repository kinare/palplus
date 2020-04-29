import axios from "axios";
import { apiBaseUrl } from "../../../environment/environment";
import { authService } from "../../auth";

/**
 * Axios basic configuration
 */
const config = {
    baseURL: apiBaseUrl
};

/**
 * Creating the instance of Axios
 * It is because, in large scale application we may need to consume APIs from more than single server,
 */
const httpClient = axios.create(config);

/**
 * Auth interceptors
 * @description Add auth tokens to every outgoing requests.
 * @param {*} config
 */
const authInterceptor = config => {
    const token = authService.token;
    if (authService.check()) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    config.headers.common["Accept"] = "Application/json";
    return config;
};

/**
 * Logger interceptors
 * @description Log app requests.
 * @param {*} config
 */
const loggerInterceptor = config => {
    /** Add logging here */
    return config;
};

/** Adding the request interceptors */
httpClient.interceptors.request.use(authInterceptor);
httpClient.interceptors.request.use(loggerInterceptor);

/** Adding the response interceptors */
httpClient.interceptors.response.use(
    response => {
        return Promise.resolve(response);
    },
    error => {
        /** Emit Api error event */
        Event.$emit("ApiError", 500, error.response.data.message);
        console.log(response.data)
        if (response.status === 422) console.log(response.data)
        return Promise.reject(error);
    }
);
export { httpClient };