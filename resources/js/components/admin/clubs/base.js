window.Vue = require('vue');

Vue.component('create-and-edit-club-vue', require('./CreateAndEditView').default);
Vue.component('list-club-vue', require('./ListView').default);
Vue.component('detail-club-vue', require('./DetailView').default);
