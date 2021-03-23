<template>
        <div class="carousel-item active pt-5">
          <div class="card align-content-center">
            <div class="card-body bg-tundaapo-blue">
              <img :src="src" class="img-fluid mx-auto d-block">
            </div>
          </div>
        </div>
</template>

<script>
    export default {
      data(){
        return{
          sectionItem:[],
          src:'/images/img/topeheader.png',
          token:window.CSRF_TOKEN,
        }
      },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
