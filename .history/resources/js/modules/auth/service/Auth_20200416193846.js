import { appName } from "../../../environment/environment";

class Auth {
    constructor() {
        this.token = window.localStorage.getItem(`${appName}_token`);
    }

    check() {
        return !!this.token;
    }

    login(token) {
        window.localStorage.setItem(`${appName}_token`, token);
        Event.$emit("login");
    }

    logout() {
        window.localStorage.removeItem(`${appName}_token`);
        Event.$emit("logout");
    }
}
const authService = new Auth();
export { authService };