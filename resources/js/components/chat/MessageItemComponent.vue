<template>
  <ul class="text-muted list-group">
    <li class="list-group-item bg-tundaapo-blue text-light rounded mt-1" v-if="user.id===message.user_id"> {{message.message}} <small class="text-muted float-right">{{message.date}} {{message.time}}</small></li>
    <li class="list-group-item bg-warning text-light rounded mt-1" v-else> {{message.message}} <small class="text-muted float-right">{{message.date}} {{message.time}}</small></li>
    <div class="">
            <small class="badge bg-tundaapo-blue float-right text-light" v-if="user.id===message.user_id"> {{ $trans('messages.You') }}</small>
            <small class="badge bg-warning float-right text-light" v-else> {{message.user.name}}</small>
    </div>
  </ul>
</template>

<script>
    export default {
      props:['message','user'],
        mounted() {
          if (this.$attrs.locale) {
               this.$lang.setLocale(this.$attrs.locale);
               }
          else {
            this.$lang.setLocale('en');
          }
        }
    }
</script>
