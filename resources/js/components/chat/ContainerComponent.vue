<template>
  <transition class="fade pt-5 w-30" id="loginModal">
    <div class="">
<div class="modal-container">
  <div class="modal-header  bg-modal-fuccia">

<a class="btn text-white fas fa-redo text-decoration-none pt-3"@click="getMessageOfUser(userChat)"></a>
    <h6 class="text-light text-center font-weight-bold pt-2">
        <chat-room-select v-if="currentRoom.id" :activeitem="active" :activeur="activeUser" :activenot="activeNotif" :usersroom="usersRoom" :rooms="chatRooms" :user_active="userChat" @roomusers="openUsersRoom()" @unreadmssg="getMessageUnread(userChat)" :unread="usersUnread" :users_join="usersJoin" :currentRoom="currentRoom" @roomchanged="setRoom($event)" @openunreadmssg="openUsersNotif" @activeusers="showActiveUsers()">
        </chat-room-select>
      </h6>
        <a class="btn btn-lg text-white text-decoration-none" @click="$emit('close')">&times</a>
</div>
<div class="modal-body">
  <slot>
  <div class="panel-body col-12">
      <div class="overflow-hidden shadow-xl sm:rounded-lg">
        <users-active-container-component :users="usersActive" :user_log="user" v-show="active" @privatuserchat="getMessageOfUser" @closeactiveusers="closeActiveUsers()">
        </users-active-container-component>
        <users-active-container-component :users="usersRoom" :user_log="user" v-show="activeUser" @privatuserchat="getMessageOfUser" @closeactiveusers="closeActiveUsers()">
        </users-active-container-component>
        <users-active-container-component :users="usersUnread" :user_log="user" v-show="activeNotif" @privatuserchat="getMessageOfUser" @closeactiveusers="closeActiveUsers()">
        </users-active-container-component>
        <message-container-component :messages="messages" :typing="typing">
        </message-container-component>
        <input-message-component @messagesent="getMessageOfUser(userChat)" :room="currentRoom" :user="userChat">
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
          usersActive:[],
          userChat:[],
          user:[],
          usersRoom:[],
          usersUnread:[],
          messages_unread:[],
          active:false,
          activeUser:false,
          activeNotif:false,
          typing:'',
          usersJoin:0,
        }
      },
      watch:{
        currentRoom(val,oldVal){
          this.usersRoom=val.users;
          if(oldVal.id){
            this.disconect(oldVal);
          }
          this.connect();
        },
      },
      methods:{
        connect:function(){
          if(this.currentRoom.id){
            let vm=this;
            vm.getMessageOfUser(this.userChat);
            window.Echo.private('chat.'+this.currentRoom.id)
            .listen('NewChatMessage',e=>{
              console.log(e);
              vm.getMessageOfUser(this.userChat);
              vm.getMessageUnread(this.userChat);
            })
            .listenForWhisper('typing',e=>{
              if(e.name!=''){
                this.typing=this.$trans('messages.Writing...');
              }
              else{
                this.typing='';
              }
            });
            window.Echo.join('chat.'+this.currentRoom.id)
                      .here((users)=>{
                        this.usersJoin=users.length;
                        this.usersActive=users;
                      })
                      .joining((user)=>{
                        this.usersJoin+=1;
                        this.usersActive.push(user);
                        this.$toaster.success(user.name+' '+this.$trans('messages.is joining to chat room'));
                      })
                      .leaving((user)=>{
                        this.usersJoin-=1;
                          const position=this.usersActive.findIndex(user=>user.name===user.name);
                        this.usersActive.splice(position,1);this.usersActive;
                        this.$toaster.warning(user.name+' '+this.$trans('messages.is leaving chat room'));
                      });
          }
        },
        disconect:function(room){
          window.Echo.leave('chat.'+room.id);
        },
        getMessageOfUser:function(user){
          this.active=false;
          this.userChat=user;
          axios.get('/chat/room/'+this.currentRoom.id+'/'+user.id+'/user/message')
          .then(response=>{
            this.messages=response.data;
            this.getMessageUnread(this.userChat);
          })
          .catch(error=>{
            console.log(error);
          });
        },
        getMessageUnread:function(user){
          axios.get('/chat/room/'+this.currentRoom.id+'/'+user.id+'/unread-messages')
          .then(response=>{
            this.messages_unread=response.data.mssg;
            this.usersUnread=response.data.user_unread;
          })
          .catch(error=>{
            console.log(error);
          });
        },
        showActiveUsers:function(){
          if(this.active==true){
            this.active=false;
          }
          else{
          this.active=true;
          this.activeNotif=false;
          this.activeUser=false;
        }
        },
        openUsersRoom:function(){
          if(this.activeUser==true){
            this.activeUser=false;
          }
          else{
          this.activeUser=true;
          this.activeNotif=false;
          this.active=false;
        }
        },
        openUsersNotif:function(){
          if(this.activeNotif==true){
            this.activeNotif=false;
          }
          else{
          this.activeNotif=true;
          this.active=false;
          this.activeUser=false;
        }
        },
        closeActiveUsers:function(){
          this.active=false;
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
        },
        closeChat:function(){

        },
      },
      created(){
        this.user=window.UserId;
        this.getRooms();
      }
    }
</script>
