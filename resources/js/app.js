/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/**
 * Clubs
 * */
const club_files = require.context('./components/admin/clubs/', true, /\.vue$/i);
club_files.keys().map(key => Vue.component(club_files(key).default.name, club_files(key).default));

/**
 * ClubMembers
 * */
const clubmember_files = require.context('./components/admin/club-members/', true, /\.vue$/i);
clubmember_files.keys().map(key => Vue.component(clubmember_files(key).default.name, clubmember_files(key).default));

const clubmember_members_files = require.context('./components/member/members/', true, /\.vue$/i);
clubmember_members_files.keys().map(key => Vue.component(clubmember_members_files(key).default.name, clubmember_members_files(key).default));

const clubmember_membership_files = require.context('./components/member/memberships/', true, /\.vue$/i);
clubmember_membership_files.keys().map(key => Vue.component(clubmember_membership_files(key).default.name, clubmember_membership_files(key).default));

const clubmember_membershiptype_files = require.context('./components/member/membership-types/', true, /\.vue$/i);
clubmember_membershiptype_files.keys().map(key => Vue.component(clubmember_membershiptype_files(key).default.name, clubmember_membershiptype_files(key).default));

const clubmember_membershiptypename_files = require.context('./components/member/membership-type-names/', true, /\.vue$/i);
clubmember_membershiptypename_files.keys().map(key => Vue.component(clubmember_membershiptypename_files(key).default.name, clubmember_membershiptypename_files(key).default));

const clubmember_vehicle_files = require.context('./components/member/vehicles/', true, /\.vue$/i);
clubmember_vehicle_files.keys().map(key => Vue.component(clubmember_vehicle_files(key).default.name, clubmember_vehicle_files(key).default));

/**
 * Inductions
 * */
const induction_files = require.context('./components/admin/inductions/', true, /\.vue$/i);
induction_files.keys().map(key => Vue.component(induction_files(key).default.name, induction_files(key).default));

/**
 * Memberships
 */
const membership_files = require.context('./components/admin/memberships/', true, /\.vue$/i);
membership_files.keys().map(key => Vue.component(membership_files(key).default.name, membership_files(key).default));

/**
 * MembershipTypes
 */
const membershiptype_files = require.context('./components/admin/membership-types/', true, /\.vue$/i);
membershiptype_files.keys().map(key => Vue.component(membershiptype_files(key).default.name, membershiptype_files(key).default));

/**
 * MembershipTypeNames
 */
const membershiptypename__files = require.context('./components/admin/membership-type-names/', true, /\.vue$/i);
membershiptypename__files.keys().map(key => Vue.component(membershiptypename__files(key).default.name, membershiptypename__files(key).default));

/**
 * SuperAdmins
 */
const superadmin_files = require.context('./components/admin/super-admins/', true, /\.vue$/i);
superadmin_files.keys().map(key => Vue.component(superadmin_files(key).default.name, superadmin_files(key).default));

/**
 * Users
 */
const user_files = require.context('./components/admin/users/', true, /\.vue$/i);
user_files.keys().map(key => Vue.component(user_files(key).default.name, user_files(key).default));

/**
 * Vehicles
 */
const vehicle_files = require.context('./components/admin/vehicles/', true, /\.vue$/i);
vehicle_files.keys().map(key => Vue.component(vehicle_files(key).default.name, vehicle_files(key).default));

/**
 * Laravel Passport Vue Components
 */
Vue.component('passport-clients', require('./components/passport/Clients.vue').default);
Vue.component('passport-authorized-clients', require('./components/passport/AuthorizedClients.vue').default);
Vue.component('passport-personal-access-tokens', require('./components/passport/PersonalAccessTokens.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    // components: {},
    // render: h => h()
});
