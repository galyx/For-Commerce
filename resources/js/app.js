/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import moment from 'moment';
import VueSweetalert2 from 'vue-sweetalert2';
import VueFileAgent from 'vue-file-agent';
import VueEditor from "vue2-editor";

Vue.use(require('vue-resource'));
Vue.use(VueSweetalert2);
Vue.use(VueFileAgent);
Vue.use(VueEditor);

import Verte from 'verte';
import 'verte/dist/verte.css';
Vue.component('verte', Verte);

// Filtro de data global
Vue.filter('formatDate', function(value) {
    if (value) {
        // return moment(String(value)).format('MM/DD/YYYY hh:mm')
        return moment(String(value)).format('DD/MM/YYYY')
    }
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/AdminComponent.vue -> <admin-component></admin-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
//site
Vue.component("product-list", require("./components/site/ProductList.vue").default);
// Admins
Vue.component('admin-component', require('./components/Admin.vue').default);
// Perfil do Admin
Vue.component('perfiladmin-component', require('./components/PerfilAdmin.vue').default);
// Imagens
Vue.component('imagens-component', require('./components/Imagens.vue').default);

// Catalogos
// Categorias
Vue.component('categorie-component', require('./components/catalogos/Categorie.vue').default);
// Produtos
Vue.component('produtos-component', require('./components/catalogos/Product.vue').default);
// Tags
// Catalogo de Cores
Vue.component('cores-component', require('./components/catalogos/tags/Colors.vue').default);
// Marcas de Produtos
Vue.component('marcas-component', require('./components/catalogos/tags/Brand.vue').default);
// Familia dos Produtos
Vue.component('familia-component', require('./components/catalogos/tags/Family.vue').default);

// Clientes
// Clientes
Vue.component('clientes-component', require('./components/clientes/Clientes.vue').default);

//calculadora
Vue.component('calculadora-component', require('./components/calculadora.vue').default);

// Paginação
Vue.component('pagination', require('laravel-vue-pagination'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
