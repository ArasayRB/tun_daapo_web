<template>
  <div class="alert" id='cookies-sms' v-if="show==true">
    <ul class="text-center">
          <div class="alert alert-success font-weight-bold text-center" role="alert">
              {{ $trans('messages.This website use cookies own and of thirds, accept it for continue.') }}
              <a type="button" href="#" @click="aceptCookies()" class="btn btn-primary">{{ $trans('messages.I Accept') }}</a>
              <a type="button" href="/privacy-policy" class="btn btn-primary">{{ $trans('messages.See more about') }}</a>
          </div>


    </ul>
  </div>

</template>

<script>
    export default {
      props:['mensageaskbudget'],
      data(){
        return{
          sectionItem:'',
          show:false,
          name:'',
          phone:'',
          email:'',
          privacy:'',
          mensage:'',
          url:window.location.origin+'/cookies-accepted',
          src:window.location.origin+'/storage/section_page/',
          section_name:this.$attrs.name_section,
          token:window.CSRF_TOKEN,
        }
      },
      methods:{

        getCookieMssg:function(){
          axios.get(window.location.origin+'/is-cookies-accepted')
              .then(response =>{
                this.sectionItem=response.data;
                console.log('Cookie is acepted:'+this.sectionItem);
                if(this.sectionItem===false){
                  this.show=true;
                }
                else{
                  this.show=false;
                }
              /*  else{
                  this.comentarios=
                }*/
              });
        },
        aceptCookies:function(){


            axios.get(this.url)
                .then(response =>{
                  this.show=false;
            })
                 .catch(error=>{
                   if(error.response.data.message){
                     swal('Error',''+error.response.data.message,'error');
                   }

                   swal('Error',mensaje,'error');
                   //console.log(error.response.data);
                 });
          //alert('Hola');
        },
      },
      created(){
       this.getCookieMssg();
      },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
