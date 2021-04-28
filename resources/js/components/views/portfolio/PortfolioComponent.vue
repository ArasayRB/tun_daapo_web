<template>
  <div class="contenedor-slider-testimonios" id="portafolio">
    <div class="testimonial-slider">
      <div class="slider-overflow"><h1 class="text-center text-light text-uppercase" id="portafolio_anim">{{ $trans('messages.Portfolio') }}</h1>
        <div class="slider-carousel">
  <div class="carousel slide" id="demo" data-ride="carousel">
  <!--Indicadores-->
  <ul class="carousel-indicators">
    <li data-target="demo" :data-slide-to="index" :id="'control-port'+index" :class="index==0?activeClass='active':''" v-for="(portfolItem,index) in portfolioItem"></li>
  </ul>
  <!--Imagenes-->
  <div class="carousel-inner">
    <div class="carousel-item" :id="'content-port'+index" v-for="(portfolItem,index) in portfolioItem" :class="index==0?activeClass='active':''">

       <img :src="src+portfolItem.img" class="mx-auto d-block img-fluid img_portafolio">
      <div class="block-quote">
        <p><span v-html="portfolItem.description"></span></p>
      </div>
      <div class="info">
        <div class="name">{{portfolItem.project_name}}</div>
        <div class="position">{{portfolItem.empresa_solicitante}}</div>
      </div>

    </div>
  </div>
  <!--Controladores izq derecha-->
  <a href="#demo" class="carousel-control-prev" data-slide="prev"><span class="carousel-control-prev-icon"></span></a>
  <a href="#demo" class="carousel-control-next" data-slide="next"><span class="carousel-control-next-icon"></span></a>
  </div>
  </div>
  </div>
  </div>
  </div>
</template>

<script>
    export default {
      data(){
        return{
          portfolioItem:[],
          portfolItem:[],
          src:window.location.origin+'/storage/portfolio/',
          token:window.CSRF_TOKEN,
        }
      },
      methods:{

        getPortfolio:function(){
          axios.get(window.location.origin+'/'+this.$attrs.locale+'/tun-daapo-portfolio')
              .then(response =>{
                this.portfolioItem=response.data;
                if(this.portfolioItem.length===0){
             $("#portafolio").hide(true);
                }
              /*  else{
                  this.comentarios=
                }*/
              });
        },
      },
      created(){
       this.getPortfolio();
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
