/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

//Rutas para vue-router
import PeliculasComponent from './components/PeliculasComponent.vue';
import GestionActorComponent from './components/GestionActorComponent.vue';
import GestionPeliculasComponent from './components/GestionPeliculasComponent.vue';


import VueRouter from 'vue-router';
Vue.use(VueRouter);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('principal-component', require('./components/PrincipalComponent.vue').default);
Vue.component('menu-component', require('./components/MenuComponent.vue').default);
Vue.component('actor-component', require('./components/ActorComponent.vue').default);
Vue.component('pelicula-component', require('./components/PeliculaComponent.vue').default);

Vue.component('detalle-pelicula-component', require('./components/DetallePeliculaComponent.vue').default);
Vue.component('detalle-pelicula-favorita-component', require('./components/DetallePeliculaFavoritaComponent.vue').default);
Vue.component('websocket-component', require('./components/WebSocketComponent.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 const routes = [
     { path: '/', component: PeliculasComponent},
     { path: '/gestion-actor', component: GestionActorComponent},
     { path: '/gestion-peliculas', component: GestionPeliculasComponent}
 ];

 const router = new VueRouter({
     routes,
     mode: 'history'
 });

const app = new Vue({
    el: '#app',
    router
});
