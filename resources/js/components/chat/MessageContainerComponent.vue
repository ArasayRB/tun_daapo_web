<template>
    <div class=" container-mssg overflow-auto">
      <div class="badge badge-pill badge-dark" v-if="typing!=''">
      {{typing}}
      </div>
      <div :key="index" v-for="(message,index) in messages">
        <message-item-component :message="message" :user="user">
        </message-item-component>
      </div>
    </div>
</template>

<script>
    export default {
      props:['messages','typing'],
      data:function(){
        return{
          user:[],
        }
      },
      mounted(){
        this.user=window.UserId;
      }
    }
</script>
