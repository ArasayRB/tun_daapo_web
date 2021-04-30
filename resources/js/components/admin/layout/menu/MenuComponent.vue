<template>
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
    <div class="sidebar-brand-icon">
      <img :src="src_ico" alt="">
    </div>
    <div class="sidebar-brand-text mx-3">{{ $trans('messages.Admin Tun Daapo')}} </div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="/admin">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>{{ $trans('messages.Administration Bar')}}</span></a>
  </li>
  <div v-show="is_adminitrator==true">
  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    {{ $trans('messages.Interface')}}
  </div>

  <!-- Nav Item - Pages Collapse Menu -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>{{ $trans('messages.Manage User')}}</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">{{ $trans('messages.Tabs')}}:</h6>
        <a class="collapse-item" @click="show('/admin/users')">{{ $trans('messages.Users')}}</a>

          <a class="collapse-item" @click="show('/admin/roles')">{{ $trans('messages.Role')}}</a>

        <a class="collapse-item" @click="show('/admin/permissions')">{{ $trans('messages.Permissions')}}</a>
      </div>
    </div>
  </li>

  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    {{ $trans('messages.Web Page Resources')}}
  </div>

  <!-- Nav Item - Pages Collapse Menu -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseResource" aria-expanded="true" aria-controls="collapseResource">
      <i class="fas fa-fw fa-cog"></i>
      <span>{{ $trans('messages.Resources')}}</span>
    </a>
    <div id="collapseResource" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">{{ $trans('messages.Tabs')}}:</h6>
        <a class="collapse-item" @click="show('/admin/contact')">{{ $trans('messages.Contact')}}</a>

        <a class="collapse-item" @click="show('/admin/service')">{{ $trans('messages.Service')}}</a>

        <a class="collapse-item" @click="show('/admin/portfolio')">{{ $trans('messages.Portfolio')}}</a>

      <a class="collapse-item" @click="show('/admin/functions-included')">{{ $trans('messages.Functions Included')}}</a>

      <a class="collapse-item" @click="show('/admin/pakettypes')">{{ $trans('messages.Packet Type')}}</a>

    <a class="collapse-item" @click="show('/admin/paket')">{{ $trans('messages.Packet')}}</a>

    <a class="collapse-item" @click="show('/admin/sectionpage')">{{ $trans('messages.Section Page')}}</a>
      </div>
    </div>
  </li>

  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    {{ $trans('messages.Web Page Resources')}}
  </div>

  <!-- Nav Item - Pages Collapse Menu -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseConfiguration" aria-expanded="true" aria-controls="collapseConfiguration">
      <i class="fas fa-fw fa-cog"></i>
      <span>{{ $trans('messages.Configuration')}}</span>
    </a>
    <div id="collapseConfiguration" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">{{ $trans('messages.Tabs')}}:</h6>
        <a class="collapse-item" @click="show('/admin/idiomas')">{{ $trans('messages.Language')}}</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseChat" aria-expanded="true" aria-controls="collapseChat">
      <i class="fas fa-fw fa-cog"></i>
      <span>{{ $trans('messages.Chat')}}</span>
    </a>
    <div id="collapseChat" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">{{ $trans('messages.Tabs')}}:</h6>
        <a class="collapse-item" @click="show('/admin/room-chat')">{{ $trans('messages.Chat')}} {{ $trans('messages.Room')}}</a>
        <a class="collapse-item" @click="show('/admin/room-type-chat')">{{ $trans('messages.Chat')}} {{ $trans('messages.Room')}} {{ $trans('messages.Type')}}</a>
        <a class="collapse-item" @click="show('/admin/mssg-type-chat')">{{ $trans('messages.Chat')}} {{ $trans('messages.Message')}} {{ $trans('messages.Type')}}</a>
      </div>
    </div>
  </li>

  </div>




  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    {{ $trans('messages.Addons')}}
  </div>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePost" aria-expanded="true" aria-controls="collapseUtilities">
      <i class="fas fa-fw fa-clipboard-list"></i>
      <span>{{ $trans('messages.Posts')}}</span>
    </a>
    <div id="collapsePost" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">{{ $trans('messages.Tabs')}}:</h6>
        <a class="collapse-item" @click="show('/admin/posts')" v-can-role="'administrator,viewer-content,writer-content,publisher-content,editor-content'">{{ $trans('messages.Posts')}}</a>
        <a class="collapse-item" @click="show('/admin/category')" v-can-role="'administrator,editor-content'">{{ $trans('messages.Posts Category')}}</a>
        <a class="collapse-item" @click="show('/admin/configuration-comments')" v-can-role="'administrator,editor-content'">{{  $trans('messages.Comment') }} {{  $trans('messages.Configuration') }}</a>
        <a class="collapse-item" @click="show('/admin/comments-post')" v-can-role="'administrator,editor-content,moderator-content'">{{  $trans('messages.Comment') }}s {{ $trans('messages.Posts')}}</a>
      </div>
    </div>
  </li>
  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
      <img class="img-profile rounded-circle" :src="src+user_loginn.imagen_url">
      <span>{{user_loginn.name}}</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">{{ $trans('messages.Utilities User')}}:</h6>
        <a class="collapse-item" href="/admin/user-perfil" ><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>{{ $trans('messages.Profile')}}</a>

      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
</template>
<script>
export default {
  name: "",
  data() {
return{
  user_loginn:[],
  is_adminitrator:false,
  src:'/storage/img_web/login_img/',
  src_ico:'/images/img/favicon/Icon_TunDaapoBlack.png',
  token   : window.CSRF_TOKEN,
}
},
methods:{
  show:function(href){
    window.location.href =window.location.origin +'/'+this.$attrs.locale+href;
  },
},
created(){
this.user_loginn=window.UserId;
this.is_adminitrator=window.Admin;
    console.log('Permisos',window.Permissions);
      console.log(' Roles',window.UserId);
        console.log(' Admin',window.Admin);
},
mounted(){

    if (this.$attrs.locale) {
         this.$lang.setLocale(this.$attrs.locale);
         }
    else {
      this.$lang.setLocale('en');
    }
},
}
</script>
