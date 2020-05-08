import { authService } from "../../modules/auth";

export default function auth({ next, router, to }) {
    if (!authService.check()) {
        return router.push({ path: `/auth/login` });
    }
    return next();
}
