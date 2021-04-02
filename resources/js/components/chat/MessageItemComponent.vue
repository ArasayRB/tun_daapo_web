<template>
  <div class="text-muted">
    <p class="badge badge-pill badge-primary">{{message.user.name}}: {{message.message}}</p>
  </div>
</template>

<script>
    export default {
      props:['message'],
    }
</script>
