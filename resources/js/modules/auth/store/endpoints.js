export default {
    //Auth
    login: "auth/login",
    refreshToken: "auth/refreshToken",
    user: "auth/me",
    logout: "auth/logout",
    validate: "auth/validate",
    create: "auth/create",

    //Admins
    getAdmin : 'admin',
    saveAdmin : id => `admin/${id}`,
    removeAdmin : id => `admin/${id}`,
    activateAdmin : id => `admin/activate/${id}`,
    deactivateAdmin : id => `admin/deactivate/${id}`,
    inviteAdmin : 'admin/invite',

    // Groups
};
