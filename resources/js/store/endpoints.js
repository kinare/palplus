export default {
  //Auth
  validate: "auth/validate",
  create: "auth/create",
  user: "auth/me",

  //Admins
    admins : `admins`,
    saveAdmin : id => `admin/${id}`,
    deleteAdmin : id => `admin/${id}`,
    activateAdmin : id => `admin/activate/${id}`,
    deactivateAdmin : id => `admin/deactivate/${id}`,
    inviteAdmin : 'auth/invite',
    toggleStatus : id => `admin/toggle-status/${id}`,


    wallets : `wallet`,
    wallet_transactions : `wallet/transactions`,
    currency : `currency`,
    groups : `groups`,
    group : id => `group/${id}`,
    myGroups : id => `my-groups/${id}`,
    activity : `activity`,
    project : `project`,
    investments : `investments`,
    loans : `loans`,
    loanSettings : `loan-setting`,
    members : `members`,
    nok : `nok`,
    member : id=>  `member/${id}`,
    membershipSetting : `membership-setting`,
    transactions : `transactions`,
    payments : `payments`,
    requests : `withdrawal-requests`,
    opportunities : `investments`,

  // Groups

};
