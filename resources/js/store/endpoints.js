export default {
  //Auth
  register: "auth/registerUser",
  login: "auth/login",
  refreshToken: "auth/refreshToken",
  user: "auth/me",
  logout: "auth/logout",
  verifyGoogle: token => `google/verifyIdToken?idToken=${token}`,

  //Users


  // Groups

};
