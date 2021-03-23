<template>
        <div class="carousel-item pt-5">
          <div class="card align-content-center">
            <div class="card-body" v-html="sectionItem[0].description">

            </div>
          </div>
        </div>
</template>

<script>
    export default {
      data(){
        return{
          sectionItem:[],
          src:'/storage/section_page/',
          section_name:'Necesitas una Estrategia de Marketing Digital',
          token:window.CSRF_TOKEN,
        }
      },
      methods:{

        getSection:function(){
          axios.get('/section_name/'+this.section_name)
              .then(response =>{
                this.sectionItem=response.data;
              /*  else{
                  this.comentarios=
                }*/
              });
        },
      },
      created(){
       this.getSection();
      },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
