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


    stats : ``,
    wallets : `wallet`,
    wallet_transactions : `wallet/transactions`,
    currency : `currency`,
    groups : `groups`,
    group : id => `group/${id}`,
    myGroups : id => `my-groups/${id}`,
    activity : `activity`,
    memberActivity : id => `member-activity/${id}`,
    project : `project`,
    investments : `investments`,
    loans : `loans`,
    loanSettings : `loan-setting`,
    members : `users`,
    nok : `nok`,
    member : id=>  `user/${id}`,
    membershipSetting : `membership-setting`,
    transactions : `transactions`,
    payments : `payments`,
    requests : `withdrawal-requests`,
    opportunities : `investments`,
    setups : `setups`,
    adSetups : `advert-setup`,
    adSetup : id => `advert-setup/${id}`,
    groupSetups : `group-setup`,
    groupSetup : id => `group-setup/${id}`,
    setup : id => `setup/${id}`,
    paypalRequests : `paypal-withdrawals`,
    reportings : `reportings`,

    toggleGroupActive : `toggle-group-active`,
    toggleMemberActive : `toggle-member-active`,
    suspendGroup : `suspend-group`,
    suspendMember : `suspend-member`,

  // Groups

};
