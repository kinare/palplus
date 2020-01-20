import Vue from "vue";
import Router from "vue-router";
import store from "../store/store";
import nextFactory from "./middleware/MiddlewareFactory";
import palplus from "../palplus"
import Home from "../views/Home"
import Wallets from "../views/wallet/Wallets";
import WalletTransactions from "../views/wallet/WalletTransactions";
import { authRoutes } from "../modules/auth";
import { auth } from "./middleware";
import Currency from "../views/currency/Currency";
import Admins from "../views/admin/Admins";
import NewAdmin from "../views/admin/NewAdmin";
import Group from "../views/group/Group";
import Member from "../views/member/Member";
import MemberCard from "../views/member/Card";
import WithdrawalRequest from "../views/transaction/WithdrawalRequest";
import Transaction from "../views/transaction/Transaction";
import Investment from "../views/investment/Investment";
import Loan from "../views/loan/Loan";
import Card from "../views/group/Card";
import Payments from "../views/transaction/Payments";
import MembershipSetting from "../views/setting/MembershipSetting";
import LoanSetting from "../views/setting/LoanSetting";
import Activity from "../views/group/Activity";
import Project from "../views/group/Project";

Vue.use(Router);

const router =new Router({
  mode: "history",
  base: process.env.BASE_URL,
    routes: [
        {
            path : "/",
            component : palplus,
            children : [
                {
                    path: '/',
                    redirect : '/wallets'
                },
                {
                    path: '/wallets',
                    name: 'wallets',
                    component: Wallets,
                    meta : { middleware : auth}
                },
                {
                    path: '/wallets-transactions/:type?',
                    name: 'Wallet Transactions',
                    component: WalletTransactions,
                    meta : { middleware : auth},
                    props : true
                },
                {
                    path: '/currency-rates',
                    name: 'Currency',
                    component: Currency,
                    meta : { middleware : auth},
                },
                {
                    path: '/admins/:id?',
                    name: 'Admins',
                    component: Admins,
                    meta : { middleware : auth},
                },
                {
                    path: '/admin-card/:id?',
                    name: 'Admin Card',
                    component: NewAdmin,
                    meta : { middleware : auth},
                    props : true
                },
                {
                    path: '/groups',
                    name: 'Groups',
                    component: Group,
                    meta : { middleware : auth},
                },
                {
                    path: '/group-card/:id',
                    name: 'Group Card',
                    component: Card,
                    meta : { middleware : auth},
                },
                {
                    path: '/members/:id?/:type?',
                    name: 'Members',
                    component: Member,
                    meta : { middleware : auth},
                },
                {
                    path: '/members/card/:id',
                    name: 'Members',
                    component: Card,
                    meta : { middleware : auth},
                },
                {
                    path: '/membership-settings/:id?',
                    name: 'Membership Settings',
                    component: MembershipSetting,
                    meta : { middleware : auth},
                },
                {
                    path: '/group-withdrawal-requests/:id?',
                    name: 'Withdrawal requests',
                    component: WithdrawalRequest,
                    meta : { middleware : auth},
                },
                {
                    path: '/transactions/:type?/:owner?/:id?',
                    name: 'Transactions',
                    component: Transaction,
                    meta : { middleware : auth},
                    props : true
                },
                {
                    path: '/pending-payments/:id?',
                    name: 'Pending Payments',
                    component: Payments,
                    meta : { middleware : auth},
                    props : true
                },
                {
                    path: '/investment-opportunity',
                    name: 'Investment Opportunity',
                    component: Investment,
                    meta : { middleware : auth},
                    props : true
                },
                {
                    path: '/loans/:type?/:id?',
                    name: 'Loans',
                    component: Loan,
                    meta : { middleware : auth},
                    props : true
                },
                {
                    path: '/loan-settings/:id?',
                    name: 'Loans Settings',
                    component: LoanSetting,
                    meta : { middleware : auth},
                    props : true
                },
                {
                    path: '/activity/:type?/:id?',
                    name: 'Activity',
                    component: Activity,
                    meta : { middleware : auth},
                    props : true
                },
                {
                    path: '/project/:id?',
                    name: 'Project',
                    component: Project,
                    meta : { middleware : auth},
                    props : true
                },
            ]
        },
        ...authRoutes
    ],
    scrollBehavior (to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition
        } else {
            return { x: 0, y: 0 }
        }
    }
});

/* Collapse mobile aside menu on route change */
router.afterEach(() => {
    store.commit('asideMobileStateToggle', false)
});

router.beforeEach((to, from, next) => {
  if (to.meta.middleware) {
    const middleware = Array.isArray(to.meta.middleware)
        ? to.meta.middleware
        : [to.meta.middleware];

    const context = {
      from,
      next,
      router,
      to
    };
    const nextMiddleware = nextFactory(context, middleware, 1);

    return middleware[0]({ ...context, next: nextMiddleware });
  }

  return next();
});

export default router;
