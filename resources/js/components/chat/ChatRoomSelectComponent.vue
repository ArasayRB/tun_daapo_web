<template>
  <div class="row pt-1">
    <div class="font-weight-bold text-xl col text-white">
      {{selected.name}} Chat
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
      props:['rooms','currentRoom'],
      data:function(){
        return{
        selected:'',
        }
      },
      created(){
        this.selected=this.currentRoom;
      }
    }
</script>
