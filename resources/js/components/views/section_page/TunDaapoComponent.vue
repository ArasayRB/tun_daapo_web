<template>
  <div class="row" id="sectionTunDaapo">
  <h1 class="text-center text-light border-bottom-yelow animate__animated animate__zoomIn" id="us_ttle"><img :src="src+sectionItem[0].img" class="mr-2 img-fluid" >Tun Daapo</h1>
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
             $("#sectionTunDaapo").hide(true);
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
