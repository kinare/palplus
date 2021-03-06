import Vue from "vue";
import Router from "vue-router";
import store from "../store/store";
import nextFactory from "./middleware/MiddlewareFactory";
import palplus from "../palplus";
import Home from "../views/Home";
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
import GroupChats from "../views/group/Chats";
import Card from "../views/group/Card";
import Payments from "../views/transaction/Payments";
import MembershipSetting from "../views/setting/MembershipSetting";
import LoanSetting from "../views/setting/LoanSetting";
import NextOfKin from "../views/member/NextOfKin";
import GatewaySetting from "../views/setting/GatewaySetting";
import PaypalRequests from "../views/transaction/PaypalRequests";
import Reporting from "../views/group/Reporting";
import GatewaySettingCard from "../views/setting/GatewaySettingCard";
import AdvertSetup from "../views/setting/AdvertSetup";
import AdvertSetupCard from "../views/setting/AdvertSetupCard";
import Dashboard from "../views/admin/Dashboard";
import GroupSetup from "../views/setting/GroupSetup";
import GroupSetupCard from "../views/setting/GroupSetupCard";
import CommunicationCard from "../views/communication/Card.vue";

/**
 * GROUP Details
 */
import Activity from "../views/group/Activity";
import Project from "../views/group/Project";
/**
 * END OF GRoup Details
 */

Vue.use(Router);

const router = new Router({
    mode: "history",
    base: process.env.BASE_URL,
    routes: [
        {
            path: "/",
            component: palplus,
            children: [
                {
                    path: "/",
                    redirect: "/dashboard",
                },
                {
                    path: "/dashboard",
                    name: "Dashboard",
                    component: Dashboard,
                    meta: { middleware: auth },
                },
                {
                    path: "/communication",
                    name: "Communication",
                    component: CommunicationCard,
                    meta: { middleware: auth },
                },
                {
                    path: "/wallets/:type?/:id?",
                    name: "wallets",
                    component: Wallets,
                    meta: { middleware: auth },
                },
                {
                    path: "/wallets-transactions/:type?",
                    name: "Wallet Transactions",
                    component: WalletTransactions,
                    meta: { middleware: auth },
                    props: true,
                },
                {
                    path: "/currency-rates",
                    name: "Currency",
                    component: Currency,
                    meta: { middleware: auth },
                },
                {
                    path: "/admins/:id?",
                    name: "Admins",
                    component: Admins,
                    meta: { middleware: auth },
                },
                {
                    path: "/admin-card/:id?",
                    name: "Admin Card",
                    component: NewAdmin,
                    meta: { middleware: auth },
                    props: true,
                },
                {
                    path: "/groups/:id?",
                    name: "Groups",
                    component: Group,
                    props: true,
                    meta: { middleware: auth },
                },
                {
                    path: "/group-card/:id",
                    name: "Group Card",
                    component: Card,
                    meta: { middleware: auth },
                },
                {
                    path: "/group-chats/:id",
                    name: "Group Card",
                    component: GroupChats,
                    meta: { middleware: auth },
                },
                {
                    path: "/members/:id?/:type?",
                    name: "Members",
                    component: Member,
                    meta: { middleware: auth },
                },
                {
                    path: "/member/card/:id",
                    name: "Member Card",
                    component: MemberCard,
                    meta: { middleware: auth },
                },
                {
                    path: "/reportings",
                    name: "Reportings",
                    component: Reporting,
                    meta: { middleware: auth },
                },
                {
                    path: "/nok/:id?",
                    name: "Next Of Kin",
                    component: NextOfKin,
                    meta: { middleware: auth },
                },
                {
                    path: "/membership-settings/:id?",
                    name: "Membership Settings",
                    component: MembershipSetting,
                    meta: { middleware: auth },
                },
                {
                    path: "/group-withdrawal-requests/:id?",
                    name: "Withdrawal requests",
                    component: WithdrawalRequest,
                    meta: { middleware: auth },
                },
                {
                    path: "/transactions/:type?/:owner?/:id?/:title?",
                    name: "Transactions",
                    component: Transaction,
                    meta: { middleware: auth },
                    props: true,
                },
                {
                    path: "/pending-payments/:id?/:type?",
                    name: "Pending Payments",
                    component: Payments,
                    meta: { middleware: auth },
                    props: true,
                },
                {
                    path: "/investment-opportunity",
                    name: "Investment Opportunity",
                    component: Investment,
                    meta: { middleware: auth },
                    props: true,
                },
                {
                    path: "/loans/:status?/:owner?/:id?",
                    name: "Loans",
                    component: Loan,
                    meta: { middleware: auth },
                    props: true,
                },
                {
                    path: "/loan-settings/:id?",
                    name: "Loans Settings",
                    component: LoanSetting,
                    meta: { middleware: auth },
                    props: true,
                },
                {
                    path: "/activity/:type?/:id?/:owner?",
                    name: "Activity",
                    component: Activity,
                    meta: { middleware: auth },
                    props: true,
                },
                {
                    path: "/project/:id?",
                    name: "Project",
                    component: Project,
                    meta: { middleware: auth },
                    props: true,
                },
                {
                    path: "/setups/:type?",
                    name: "Setups",
                    component: GatewaySetting,
                    meta: { middleware: auth },
                    props: true,
                },
                {
                    path: "/setup/:id?",
                    name: "Setups Card",
                    component: GatewaySettingCard,
                    meta: { middleware: auth },
                    props: true,
                },
                {
                    path: "/advert-setups",
                    name: "Advert Setups",
                    component: AdvertSetup,
                    meta: { middleware: auth },
                    props: true,
                },
                {
                    path: "/advert-setup/:id?",
                    name: "Advert Setups Card",
                    component: AdvertSetupCard,
                    meta: { middleware: auth },
                    /*/group-setups*/
                    props: true,
                },
                {
                    path: "/group-setups",
                    name: "Group Setups",
                    component: GroupSetup,
                    meta: { middleware: auth },
                    props: true,
                },
                {
                    path: "/group-setup/:id?",
                    name: "Group Setups Card",
                    component: GroupSetupCard,
                    meta: { middleware: auth },
                    props: true,
                },
                {
                    path: "/paypal-withdrawal",
                    name: "Paypal Withdrawal Requests",
                    component: PaypalRequests,
                    meta: { middleware: auth },
                    props: true,
                },
            ],
        },
        ...authRoutes,
    ],
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition;
        } else {
            return { x: 0, y: 0 };
        }
    },
});

/* Collapse mobile aside menu on route change */
router.afterEach(() => {
    store.commit("asideMobileStateToggle", false);
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
            to,
        };
        const nextMiddleware = nextFactory(context, middleware, 1);

        return middleware[0]({ ...context, next: nextMiddleware });
    }

    return next();
});

export default router;
