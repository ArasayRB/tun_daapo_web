<template>
  <div class="row" id="sectionTunDaapo">
  <h1 class="text-center border-bottom-blue animate__animated animate__zoomIn" id="us_ttle"><img :src="src+sectionItem[0].img" class="mr-2 img-fluid" >Tun Daapo</h1>
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
          axios.get('/section_name/'+this.section_name)
              .then(response =>{
                this.sectionItem=response.data;
                console.log('tun_dapo',response.data);
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
            console.log('Component mounted.')
        }
    }
</script>
