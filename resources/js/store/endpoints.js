export default {
  //Auth
  login: "admin/login",
  refreshToken: "admin/refreshToken",
  user: "admin/me",
  logout: "admin/logout",
  validate: "admin/validate",
  create: "admin/create",

  //Admins
    admins : `admins`,
    wallets : `wallet`,
    wallet_transactions : `wallet/transactions`,
    currency : `currency`,
    groups : `groups`,
    investments : `investments`,
    loans : `loans`,
    members : `members`,
    transactions : `transactions`,
    saveAdmin : id => `admin/${id}`,
    removeAdmin : id => `admin/${id}`,
    activateAdmin : id => `admin/activate/${id}`,
    deactivateAdmin : id => `admin/deactivate/${id}`,
    inviteAdmin : 'admin/invite',

  // Groups

};
