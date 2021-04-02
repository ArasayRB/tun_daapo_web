<template>
    <div class=" container-mssg overflow-auto">
      <div :key="index" v-for="(message,index) in messages">
        <message-item-component :message="message">
        </message-item-component>
      </div>
    </div>
</template>

<script>
    export default {
      props:['messages'],
      created(){
        console.log('mensages en el container de mensages',this.messages);
      }
    }
</script>
