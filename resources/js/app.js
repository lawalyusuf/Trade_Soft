
require('./bootstrap');

window.Vue = require('vue').default;

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

import {Form, HasError, AlertError} from 'vform';
window.toast = toast;

window.Form = Form;

Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
import swal from 'sweetalert2'
window.swal = swal;

const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', swal.stopTimer)
        toast.addEventListener('mouseleave', swal.resumeTimer)
    }
});


import numeral from 'numeral';
import moment from 'moment'

Vue.filter('myDate', function(created){
    return moment(created).format('MMMM Do YYYY');
})

Vue.filter('timeAgo', function(created){
    return moment(created).startOf('hour').fromNow();
})

Vue.filter('currency', function(text){
    var number = numeral(text);

    return number.format('0,0.00');

})

Vue.component('add-recipient', () =>import('./components/add-recipient.vue'));
Vue.component('amount', () =>import('./components/amount.vue'));
Vue.component('rd', () =>import('./components/showRD.vue'));
Vue.component('timeago', () =>import('./components/time.vue'));
Vue.component('transaction', () =>import('./components/transaction.vue'));
Vue.component('calculator', () =>import('./components/calculator.vue'));
Vue.component('send-calculator', () =>import('./components/send-calculator.vue'));
Vue.component('currency', () =>import('./components/currency.vue'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
