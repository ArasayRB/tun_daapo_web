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
/**Directives*/
import VueLang from '@eli5/vue-lang-js';
import translations from './vue-translations.js';
import VoerroTagsInput from '@voerro/vue-tagsinput';
import Echo from 'laravel-echo';
import Toaster from 'v-toaster';
import 'v-toaster/dist/v-toaster.css';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
  broadcaster: 'pusher',
  key: process.env.MIX_PUSHER_APP_KEY,
  cluster: process.env.MIX_PUSHER_APP_CLUSTER,
  forceTLS: true
});
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
Vue.use(Toaster,{timeout:5000});
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
Vue.component('language-oper-form-component', require('./components/admin/configuration/languages/forms/LanguageFormComponent.vue').default);
Vue.component('service-oper-form-component', require('./components/admin/recursos_page_web/Service/forms/ServiceFormComponent.vue').default);
Vue.component('portfolio-oper-form-component', require('./components/admin/recursos_page_web/Portfolio/forms/PortfolioFormComponent.vue').default);
Vue.component('paket-oper-form-component', require('./components/admin/recursos_page_web/Paket/forms/PaketFormComponent.vue').default);
Vue.component('category-oper-form-component', require('./components/admin/posts/category/forms/CategoryFormComponent.vue').default);
Vue.component('conf-com-oper-form-component', require('./components/admin/posts/configcomments/forms/ConfigCommentsFormComponent.vue').default);
Vue.component('comments-oper-form-component', require('./components/admin/posts/comments/forms/CommentsFormComponent.vue').default);
Vue.component('functions-included-oper-form-component', require('./components/admin/recursos_page_web/FunctionIncluded/forms/FunctionIncludedFormComponent.vue').default);
Vue.component('paket-type-oper-form-component', require('./components/admin/recursos_page_web/PaketType/forms/PaketTypeFormComponent.vue').default);
Vue.component('sectionpage-oper-form-component', require('./components/admin/recursos_page_web/SectionPage/forms/SectionPageFormComponent.vue').default);
Vue.component('room-chat-oper-form-component', require('./components/admin/chat/ChatAdmin/forms/RoomFormComponent.vue').default);
Vue.component('roomt-chat-oper-form-component', require('./components/admin/chat/ChatRoomType/forms/RoomTypeFormComponent.vue').default);
Vue.component('mssgt-chat-oper-form-component', require('./components/admin/chat/ChatTypeMessage/forms/MessageTypeFormComponent.vue').default);
Vue.component('index-post-component', require('./components/admin/posts/indexPostComponent.vue').default);
Vue.component('index-user-component', require('./components/admin/users/indexUserComponent.vue').default);
Vue.component('index-role-component', require('./components/admin/roles/indexRoleComponent.vue').default);
Vue.component('index-permiso-component', require('./components/admin/permisos/indexPermisoComponent.vue').default);
Vue.component('index-contact-component', require('./components/admin/recursos_page_web/Contact/indexContactComponent.vue').default);
Vue.component('index-service-component', require('./components/admin/recursos_page_web/Service/indexServiceComponent.vue').default);
Vue.component('index-portfolio-component', require('./components/admin/recursos_page_web/Portfolio/indexPortfolioComponent.vue').default);
Vue.component('index-paket-component', require('./components/admin/recursos_page_web/Paket/indexPaketComponent.vue').default);
Vue.component('index-category-component', require('./components/admin/posts/category/indexCategoryComponent.vue').default);
Vue.component('index-conf-com-component', require('./components/admin/posts/configcomments/indexConfigCommentsComponent.vue').default);
Vue.component('index-comments-component', require('./components/admin/posts/comments/indexCommentsComponent.vue').default);
Vue.component('index-paket-type-component', require('./components/admin/recursos_page_web/PaketType/indexPaketTypeComponent.vue').default);
Vue.component('index-function-included-component', require('./components/admin/recursos_page_web/FunctionIncluded/indexFunctionIncludedComponent.vue').default);
Vue.component('index-sectionpage-component', require('./components/admin/recursos_page_web/SectionPage/indexSectionPageComponent.vue').default);
Vue.component('index-language-component', require('./components/admin/configuration/languages/indexLanguageComponent.vue').default);
Vue.component('index-room-chat-component', require('./components/admin/chat/ChatAdmin/indexRoomComponent.vue').default);
Vue.component('index-roomt-chat-component', require('./components/admin/chat/ChatRoomType/indexRoomTypeComponent.vue').default);
Vue.component('index-mssgt-chat-component', require('./components/admin/chat/ChatTypeMessage/indexMessageTypeComponent.vue').default);
Vue.component('post-ppal-tab-component', require('./components/admin/posts/PostPpalTabComponent.vue').default);
Vue.component('relationed-tags-component', require('./components/admin/posts/RelationedTagsComponent.vue').default);
Vue.component('tun-daapo-section-component', require('./components/views/section_page/TunDaapoComponent.vue').default);
Vue.component('portfolio-section-component', require('./components/views/portfolio/PortfolioComponent.vue').default);
Vue.component('design-section-component', require('./components/views/section_page/DesignComponent.vue').default);
Vue.component('header-section-component', require('./components/views/section_page/HeaderCarrousel.vue').default);
Vue.component('development-section-component', require('./components/views/section_page/DevelopmentWebPlansComponent.vue').default);
Vue.component('necesitas-plan-section-component', require('./components/views/section_page/header-carrousel/NecesitasUnPlan.vue').default);
Vue.component('terms-conditions-section-component', require('./components/views/section_page/aviso-legal/TermsAndConditionsComponent.vue').default);
Vue.component('privacy-policy-section-component', require('./components/views/section_page/aviso-legal/PrivacyPolicyComponent.vue').default);
Vue.component('ask-budget-section-component', require('./components/views/section_page/AskBudgetComponent.vue').default);
Vue.component('accept-cookies-component', require('./components/views/legacy-message/CookiesMssgComponent.vue').default);
Vue.component('development-plan-section-component', require('./components/views/development_web_plans/DevelopmentPlansWebComponent.vue').default);
Vue.component('service-section-component', require('./components/views/service/ServiceComponent.vue').default);
Vue.component('cont-view-share-like-component', require('./components/forms/ContViewShareLikeComponent.vue').default);
Vue.component('newsletter-component', require('./components/forms/NewsletterComponent.vue').default);
Vue.component('contact-us-component', require('./components/forms/ContactoComponent.vue').default);
Vue.component('comment-post-component', require('./components/forms/CommentComponent.vue').default);
Vue.component('post-ppal-tab-component', require('./components/admin/posts/PostPpalTabComponent.vue').default);
Vue.component('input-searcher-component', require('./components/admin/searcher/SearcherInputComponent.vue').default);
Vue.component('chat-room-select', require('./components/chat/ChatRoomSelectComponent.vue').default);
Vue.component('container-component', require('./components/chat/ContainerComponent.vue').default);
Vue.component('input-message-component', require('./components/chat/InputMessageComponent.vue').default);
Vue.component('message-container-component', require('./components/chat/MessageContainerComponent.vue').default);
Vue.component('users-active-container-component', require('./components/chat/UsersActiveContainerComponent.vue').default);
Vue.component('message-item-component', require('./components/chat/MessageItemComponent.vue').default);
Vue.component('all-comments-component', require('./components/forms/AllCommentsComponent.vue').default);
Vue.component('all-ans-comments-component', require('./components/forms/AllAnswersCommentsComponent.vue').default);
Vue.component('dashboard-menu-component', require('./components/admin/layout/menu/MenuComponent.vue').default);

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
      ventanaChat:'',
      sectionItem:[],
      token   : window.CSRF_TOKEN,
    }
    },
    methods:{
      resetEmailModal:function(){
        this.ventanaResetEmail=true;
      },
      showRoute:function(address){
          window.location.href =window.location.origin +address;
      },
    },
    created(){
    },
});
