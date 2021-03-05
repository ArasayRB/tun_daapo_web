/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import swal from 'sweetalert';
import VueLocalStorage from 'vue-localstorage';
import VueCookies from 'vue-cookies';
import moment from 'moment';
import VCalendar from 'v-calendar';
import VuePaginate from 'vue-paginate';
/**Directives*/
import "./src/directives/directives.js";
import VueLang from '@eli5/vue-lang-js';
import translations from './vue-translations.js';
import VoerroTagsInput from '@voerro/vue-tagsinput';
require('lang.js');

Vue.use(VCalendar, {
  componentPrefix: 'vc',  // Use <vc-calendar /> instead of <v-calendar />
  locales: {
   'pt-PT': {
     firstDayOfWeek: 1,
     masks: {
       L: 'YYYY-MM-DD',
       // ...optional `title`, `weekdays`, `navMonths`, etc
     }
   }
 },
                 // ...other defaults
});
Vue.use(VuePaginate);
Vue.use(VueLang, {
  messages: translations, // Provide locale file
  //locale: 'es', // Set locale
  fallback: 'en' // Set fallback lacale
});
Vue.use(require('vue-cookies'));
Vue.use(VueLocalStorage);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('tags-input', VoerroTagsInput);
Vue.component('keys-input', VoerroTagsInput);
Vue.component('keywords-input', VoerroTagsInput);
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
Vue.component('contact-oper-form-component', require('./components/admin/recursos_page_web/Contact/forms/ContactFormComponent.vue').default);
Vue.component('service-oper-form-component', require('./components/admin/recursos_page_web/Service/forms/ServiceFormComponent.vue').default);
Vue.component('portfolio-oper-form-component', require('./components/admin/recursos_page_web/Portfolio/forms/PortfolioFormComponent.vue').default);
Vue.component('paket-oper-form-component', require('./components/admin/recursos_page_web/Paket/forms/PaketFormComponent.vue').default);
Vue.component('sectionpage-oper-form-component', require('./components/admin/recursos_page_web/SectionPage/forms/SectionPageFormComponent.vue').default);
Vue.component('index-post-component', require('./components/admin/posts/indexPostComponent.vue').default);
Vue.component('index-user-component', require('./components/admin/users/indexUserComponent.vue').default);
Vue.component('index-role-component', require('./components/admin/roles/indexRoleComponent.vue').default);
Vue.component('index-permiso-component', require('./components/admin/permisos/indexPermisoComponent.vue').default);
Vue.component('index-contact-component', require('./components/admin/recursos_page_web/Contact/indexContactComponent.vue').default);
Vue.component('index-service-component', require('./components/admin/recursos_page_web/Service/indexServiceComponent.vue').default);
Vue.component('index-portfolio-component', require('./components/admin/recursos_page_web/Portfolio/indexPortfolioComponent.vue').default);
Vue.component('index-paket-component', require('./components/admin/recursos_page_web/Paket/indexPaketComponent.vue').default);
Vue.component('index-sectionpage-component', require('./components/admin/recursos_page_web/SectionPage/indexSectionPageComponent.vue').default);
Vue.component('post-ppal-tab-component', require('./components/admin/posts/PostPpalTabComponent.vue').default);
Vue.component('relationed-tags-component', require('./components/admin/posts/RelationedTagsComponent.vue').default);
Vue.component('tun-daapo-section-component', require('./components/views/section_page/TunDaapoComponent.vue').default);
Vue.component('service-section-component', require('./components/views/service/ServiceComponent.vue').default);

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
      sectionItem:[],
      token   : window.CSRF_TOKEN,
    }
    },
    methods:{
      resetEmailModal:function(){
        this.ventanaResetEmail=true;
      },
    },
    created(){
    },
});
