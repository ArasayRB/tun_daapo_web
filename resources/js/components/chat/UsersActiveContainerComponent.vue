<template>
      <ul class="navbar-nav">
        <li v-for="(user,index) in users" class="nav-item">
          <a href="#" @click="$emit('privatuserchat',user)" class="nav-link" v-if="user_log.id!=user.id">
          <p class="text-dark">{{user.name}}</p>
          </a>
        </li>
      </ul>
</template>

<script>
    export default {
      props:['users','user_log'],
      created(){
      }
    }
</script>
