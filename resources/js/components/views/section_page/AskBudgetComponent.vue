<template>
  <section class="mt-5 pt-5 pb-5" id="pedir-presupuesto" name="suscripcion"><h1 class="text-center text-light">{{sectionItem[0].title}}</h1><!--Section Presupuesto-->
    <form action="" class="mt-5  mb-4">
      <div class="container mt-5">
        <div class="row justify-content-center">
          <div class="col-6 mb-2"><input type="text" class="form-control font-italic" placeholder="Tu Nombre o Empresa..."></div>
          <div class="col-6 mb-2"><input type="text" class="form-control font-italic" placeholder="Teléfono de contacto..."></div>
            <div class="col-2 d-block">
            </div>
          <div class="col-6"><input type="text" class="form-control font-italic" placeholder="Email de contacto..."></div>
          <div class="col-2"><button type="button" class="btn rounded bg-warning ">{{ $trans('messages.Ask for budget') }}</button></div>
        </div>
      </div>
    </form>
    <span v-html="sectionItem[0].description"></span>
  </section><!--END Section Presupuesto-->
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
