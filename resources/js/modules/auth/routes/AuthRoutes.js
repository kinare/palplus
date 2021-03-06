import Auth from "../views/Auth";
import Signin from "../views/Signin";
import Signup from "../views/Signup";
import PasswordRequest from "../views/PasswordRequest";
import Password from "../views/Password";
import Login from "../views/Login";
import Invitation from "../../../views/admin/Invitation";

const authRoutes = [
  {
    path: "/auth",
    component: Auth,
    children: [
      {
        path: "",
        redirect: "/auth/signin"
      },
      {
        path: "signin",
        component: Signin
      },
      {
        path: "login",
        component: Login
      },
      {
        path: "signup",
        component: Signup
      },
      {
        path: "reset",
        component: PasswordRequest
      },
      {
        path: "password",
        component: Password
      },
        {
            path: "invitation/:token",
            component: Invitation,

        }
    ]
  }
];

export default authRoutes;
