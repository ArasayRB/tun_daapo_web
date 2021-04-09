<template>
  <div class="row pt-1">
    <div class="font-weight-bold text-xl col text-white" v-if="user_active.length>0">
      {{user_active.name}} Chat
       <i class="fas fa-circle text-success btn btn-sm" @click="openActiveUsers()" title="Actives/Activos" v-show="selected.users.length>0" v-if="activeitem==true">
       <span class="badge badge-danger badge-counter">{{users_join}}</span></i>
       <i class="fas fa-circle text-muted btn btn-sm" @click="openActiveUsers()" title="Actives/Activos" v-show="selected.users.length>0" v-else>
       <span class="badge badge-danger badge-counter">{{users_join}}</span></i>
       <i class="fas fa-bell text-success btn btn-sm" @click="$emit('openunreadmssg')" :title="unread.length" v-if="activenot==true">
       <span class="badge badge-danger badge-counter">{{unread.length}}</span></i>
       <i class="fas fa-bell text-muted btn btn-sm" @click="$emit('openunreadmssg')" :title="unread.length" v-else>
       <span class="badge badge-danger badge-counter">{{unread.length}}</span></i>
       <i class="fas fa-user text-success btn btn-sm" @click="$emit('roomusers')" :title="unread.length" v-if="activeur==true">
       <span class="badge badge-danger badge-counter">{{usersroom.length}}</span></i>
       <i class="fas fa-user text-muted btn btn-sm" @click="$emit('roomusers')" :title="unread.length" v-else>
       <span class="badge badge-danger badge-counter">{{usersroom.length}}</span></i>
    </div>
      <div class="font-weight-bold text-xl col text-white" v-else>
        {{selected.name}} Chat
         <i class="fas fa-circle text-success btn btn-sm" @click="openActiveUsers()" title="Actives/Activos" v-show="selected.users.length>0" v-if="activeitem==true">
         <span class="badge badge-danger badge-counter">{{users_join}}</span></i>
         <i class="fas fa-circle text-muted btn btn-sm" @click="openActiveUsers()" title="Actives/Activos" v-show="selected.users.length>0" v-else>
         <span class="badge badge-danger badge-counter">{{users_join}}</span></i>
         <i class="fas fa-bell text-success btn btn-sm" @click="$emit('openunreadmssg')" :title="unread.length" v-if="activenot==true">
         <span class="badge badge-danger badge-counter">{{unread.length}}</span></i>
         <i class="fas fa-bell text-muted btn btn-sm" @click="$emit('openunreadmssg')" :title="unread.length" v-else>
         <span class="badge badge-danger badge-counter">{{unread.length}}</span></i>
         <i class="fas fa-user text-success btn btn-sm" @click="$emit('roomusers')" :title="unread.length" v-if="activeur==true">
         <span class="badge badge-danger badge-counter">{{usersroom.length}}</span></i>
         <i class="fas fa-user text-muted btn btn-sm" @click="$emit('roomusers')" :title="unread.length" v-else>
         <span class="badge badge-danger badge-counter">{{usersroom.length}}</span></i>
      </div>
    <div class="col">
      <select class="float-right text-muted" v-model="selected" @change="$emit('roomchanged',selected)">
        <option :value="room" :key="index" v-for="(room,index) in rooms"><p class="text-muted h6">{{room.name}}</p></option>
      </select>
    </div>
</div>
</template>

<script>
    export default {
      props:['rooms','currentRoom','users_join','user_active','unread','activeitem','activenot','usersroom','activeur'],
      data:function(){
        return{
        selected:'',
        }
      },
      methods:{
        openActiveUsers:function(){
          this.$emit('activeusers');
        }
      },
      created(){
        this.selected=this.currentRoom;
          this.$emit('unreadmssg');
      }
    }
</script>
