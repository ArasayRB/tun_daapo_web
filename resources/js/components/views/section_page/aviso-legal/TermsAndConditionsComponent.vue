<template>
  <div class="col-lg-12" v-html="sectionItem[0].description">
</div>
</template>

<script>
    export default {
      data(){
        return{
          sectionItem:[],
          src:'/storage/section_page/',
          section_name:'Términos y Condiciones',
          token:window.CSRF_TOKEN,
        }
      },
      methods:{

        getSection:function(){
          axios.get(window.location.origin+'/'+this.$attrs.locale+'/section_name/'+this.section_name)
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
        if (this.$attrs.locale) {
             this.$lang.setLocale(this.$attrs.locale);
             }
        else {
          this.$lang.setLocale('en');
        }
        }
    }
</script>
