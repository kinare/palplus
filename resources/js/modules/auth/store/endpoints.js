export default {
    //Auth
    login: "admin/login",
    refreshToken: "admin/refreshToken",
    user: "admin/me",
    logout: "admin/logout",
    validate: "admin/validate",
    create: "admin/create",

    //Admins
    getAdmin : 'admin',
    saveAdmin : id => `admin/${id}`,
    removeAdmin : id => `admin/${id}`,
    activateAdmin : id => `admin/activate/${id}`,
    deactivateAdmin : id => `admin/deactivate/${id}`,
    inviteAdmin : 'admin/invite',

    // Groups
};
