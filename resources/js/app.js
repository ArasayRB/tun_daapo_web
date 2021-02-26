/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import "./src/directives/directives.js";

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('reset-email-form-component', require('./components/auth/ResetEmailFormComponent.vue').default);
Vue.component('add-post-form-component', require('./components/admin/posts/forms/AddPostFormComponent.vue').default);
Vue.component('edit-user-form-component', require('./components/admin/users/forms/EditUserFormComponent.vue').default);
Vue.component('add-user-form-component', require('./components/admin/users/forms/AddUserFormComponent.vue').default);
Vue.component('edit-role-form-component', require('./components/admin/roles/forms/EditRoleFormComponent.vue').default);
Vue.component('add-role-form-component', require('./components/admin/roles/forms/AddRoleFormComponent.vue').default);
Vue.component('edit-permiso-form-component', require('./components/admin/permisos/forms/EditPermisoFormComponent.vue').default);
Vue.component('add-permiso-form-component', require('./components/admin/permisos/forms/AddPermisoFormComponent.vue').default);
Vue.component('edit-post-form-component', require('./components/admin/posts/forms/EditPostFormComponent.vue').default);
Vue.component('index-post-component', require('./components/admin/posts/indexPostComponent.vue').default);
Vue.component('index-user-component', require('./components/admin/users/indexUserComponent.vue').default);
Vue.component('index-role-component', require('./components/admin/roles/indexRoleComponent.vue').default);
Vue.component('index-permiso-component', require('./components/admin/permisos/indexPermisoComponent.vue').default);
Vue.component('post-ppal-tab-component', require('./components/admin/posts/PostPpalTabComponent.vue').default);
Vue.component('relationed-tags-component', require('./components/admin/posts/RelationedTagsComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data(){
      return{
      ventanaResetEmail:'',
      token   : window.CSRF_TOKEN,
    }
    },
    methods:{
      resetEmailModal:function(){
        this.ventanaResetEmail=true;
      },
    },
});
