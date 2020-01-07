export default {
  //Auth
  validate: "auth/validate",
  create: "auth/create",

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
    requests : `withdrawal-requests`,
    opportunities : `investments`,
    saveAdmin : id => `admin/${id}`,
    removeAdmin : id => `admin/${id}`,
    activateAdmin : id => `admin/activate/${id}`,
    deactivateAdmin : id => `admin/deactivate/${id}`,
    inviteAdmin : 'auth/invite',
  // Groups

};
