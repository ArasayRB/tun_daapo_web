<template>
<div class="row">
  <div class="col-xl-6 col-md-6 mb-4" v-for="(serviceItem,index) in servicesItem">
    <div class="panel h-100 py-2">
      <div class="panel-header">
        <div class="col-xs-12">
          <img :src="src+serviceItem.img" width="160" class="mx-auto d-block mb-4 shadow" :alt="serviceItem.img_descript">
        </div>
      </div>
      <div class="panel-body border-left-primary">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 h6">{{serviceItem.name}}</div>
            <div class="h6 mb-0 font-weight-bold text-light"><span v-html="serviceItem.description"></span></div>
            <a href="#contacto" class="h6 text-info mt-2 float-right">{{ $trans('messages.Contact us and we will schedule an appointment with you') }}</a>
          </div>
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
          servicesItem:[],
          serviceItem:[],
          src:'storage/service/',
          token:window.CSRF_TOKEN,
        }
      },
      methods:{

        getServices:function(){
          axios.get('/services_offer')
              .then(response =>{
                this.servicesItem=response.data;
                if(this.servicesItem.length===0){
             $("#fac_plac").hide(true);
                }
              /*  else{
                  this.comentarios=
                }*/
              });
        },
      },
      created(){
       this.getServices();
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
