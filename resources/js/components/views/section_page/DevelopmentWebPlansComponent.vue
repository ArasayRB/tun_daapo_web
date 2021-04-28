<template>
  <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center" id="development_plans">
    <h1 class="display-4 text-light">{{sectionItem[0].title}}</h1>
    <span v-html="sectionItem[0].description"></span>
  </div>
</template>

<script>
    export default {
      data(){
        return{
          sectionItem:[],
          src:'/storage/section_page/',
          section_name:this.$attrs.name_section,
          token:window.CSRF_TOKEN,
        }
      },
      methods:{

        getSection:function(){
          axios.get(window.location.origin+'/'+this.$attrs.locale+'/section_name/'+this.section_name)
              .then(response =>{
                this.sectionItem=response.data;
                if(this.sectionItem.length===0){
             $("#development_plans").hide(true);
                }
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
