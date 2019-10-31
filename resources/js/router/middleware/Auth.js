export default function auth({ next, router, to }) {
    if (!window.auth.check()) {
        return router.push({ path: `/auth/login` });
    }
    return next();
}
