<template>
  <div class="rounded row">
        <div class="col-6" id="sectionDesign">
          <img :src="src+sectionItem[0].img" class="img-fluid animate__animated animate__slideInLeft">
        </div>
        <div class="col-6 mt-xl-5 mt-md-5">

            <p class="h1 mt-5 text-light border-bottom-primary animate__animated animate__bounceIn" id="diseño">{{sectionItem[0].title}}</p>
            <p class="h5 text-light text-justify pr-3 animate__animated animate__bounceIn"> <span v-html="sectionItem[0].description"></span> </p>

        </div>


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
                if(this.sectionItem.length===0){
             $("#sectionDesign").hide(true);
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
