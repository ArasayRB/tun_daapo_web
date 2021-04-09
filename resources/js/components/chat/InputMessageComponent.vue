<template>
  <div class="relative h-10 m-1">
    <div class="row shadow">
      <input type="text" v-model="message" @keyup.enter="sendMessage()" placeholder="Say Something..." class="col form-control col-span-5 outline-none" name="" value="">
      <img :src="src" alt="" type="button" @click="sendMessage()" class="col-2 btn  h-1 w-1 chat-btn bg-button-fuccia">
    </div>
  </div>
</template>

<script>
    export default {
      props:['room','user'],
      data:function(){
        return{
          message:'',
          src:'/images/img/enviar.png',
        }
      },
      watch:{
        message(){
          console.log('escrit',this.message);
          let vm=this;
          window.Echo.private('chat.'+this.room.id)
                    .whisper('typing',{
                      name:vm.message
                    });
        },
      },
      methods:{
        sendMessage:function(){
                if(this.message===''){
                  return;
                }
                axios.post('/chat/room/'+this.room.id+'/message',{
                  message:this.message,
                  user:this.user.id
                })
                .then(response=>{
                  if(response.status==201){
                    this.message='';
                    this.$emit('messagesent');
                  }
                })
                .catch(error=>{
                  console.log(error);
                });
        },
      },
    }
</script>
