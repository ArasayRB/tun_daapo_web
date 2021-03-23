<template>
  <header>
    <div class="carousel slide" id="demo" data-ride="carousel">
      <!--Indicators-->
      <ul class="carousel-indicators">
        <li data-target="demo" data-slide-to="0" class="active"></li>
        <li data-target="demo" data-slide-to="1" ></li>
        <li data-target="demo" data-slide-to="2" ></li>
        <li data-target="demo" data-slide-to="3" ></li>
        <li data-target="demo" data-slide-to="4" ></li>
        <li data-target="demo" data-slide-to="5" ></li>
      </ul>
      <!--IMGS-->
      <div class="carousel-inner">
        <logo-header-section-component>
        </logo-header-section-component>
        <necesitas-plan-section-component>
        </necesitas-plan-section-component>
        <por-que-section-component>
        </por-que-section-component>
        <marketing-section-component>
        </marketing-section-component>
        <diseno-comunicacion-section-component>
        </diseno-comunicacion-section-component>
        <sin-recursos-section-component>
        </sin-recursos-section-component>
      </div>
      <!--Controls-->
      <a href="#demo" class="carousel-control-prev" data-slide="prev"><span class="carousel-control-prev-icon rounded"></span></a>
      <a href="#demo" class="carousel-control-next" data-slide="next"><span class="carousel-control-next-icon"></span></a>
    </div>
  </header>
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
      created(){
       this.getSection();
      },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
