export default function auth({ next, router, to, store }) {
  if (store.getters.user.type !== to.name) {
    return router.push({ path: `/${store.getters.user.type}` });
  }
  return next();
}
