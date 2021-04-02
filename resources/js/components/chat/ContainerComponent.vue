<template>
  <transition class="fade pt-5 w-30" id="loginModal">
    <div class="">
<div class="modal-container">
  <div class="modal-header  bg-modal-fuccia">

<a class="btn text-white fas fa-redo text-decoration-none pt-3"@click="getMessages()"></a>
    <h6 class="text-light text-center font-weight-bold pt-2">
        <chat-room-select v-if="currentRoom.id" :rooms="chatRooms" :currentRoom="currentRoom" @roomchanged="setRoom($event)">
        </chat-room-select>
      </h6>
        <a class="btn btn-lg text-white text-decoration-none"@click="$emit('close')">&times</a>
</div>
<div class="modal-body">
  <slot>
  <div class="panel-body col-12">
      <div class="overflow-hidden shadow-xl sm:rounded-lg">
        <message-container-component :messages="messages">
        </message-container-component>
        <input-message-component @messagesent="getMessages()" :room="currentRoom">
        </input-message-component>

      </div>
  </div>
</slot>
</div>
</div>
</div>
</transition>
</template>

<script>
    export default {
      data:function(){
        return{
          chatRooms:[],
          ventanaChat:false,
          currentRoom:[],
          messages:[],
        }
      },
      watch:{
        currentRoom(val,oldVal){
          if(oldVal.id){
            this.disconect(oldVal);
          }
          this.connect();
        }
      },
      methods:{
        connect:function(){
          if(this.currentRoom.id){
            let vm=this;
            vm.getMessages();
            window.Echo.private('chat.'+this.currentRoom.id)
            .listen('NewChatMessage',e=>{
              vm.getMessages();
            });
          }
        },
        disconect:function(room){
          window.Echo.leave('chat.'+room.id);
        },
        getRooms:function(){
          axios.get('/chat/rooms')
               .then(response=>{
                 this.chatRooms=response.data;
                 this.setRoom(response.data[0]);
               })
               .catch(error=>{
                 console.log(error);
               });
        },
        setRoom:function(room){
          this.currentRoom=room;
          //this.getMessages();
        },
        getMessages:function(){
          axios.get('/chat/room/'+this.currentRoom.id+'/messages')
               .then(response=>{
                 this.messages=response.data;
               })
               .catch(error=>{
                 console.log(error);
               });
        },
        closeChat:function(){

        },
      },
      created(){

        this.getRooms();
      },
      mounted(){
      }
    }
</script>
