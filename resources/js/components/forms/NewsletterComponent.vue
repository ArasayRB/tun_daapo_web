<template>

  <form id="newsletter" class="mt-5">
    <div class="container mt-5"><h4 class="text-uppercase text-center mt-5 mb-5 text-light">{{ $trans('messages.Subscribe yourself!! Do not lost the Blog News and Promotions') }}</h4>
      <div class="row justify-content-center">
        <div class="col-6 mb-2"><input type="text" v-model="name" class="form-control font-italic" placeholder="Nombre..."></div>
          <div class="col-2 d-block">
          </div>
        <div class="col-6"><input type="text" v-model="email" class="form-control font-italic" placeholder="Déjanos tu email..."></div>
        <div class="col-2 d-block">
        </div>
        <div class="row ml-2 col-6">
        <input type="checkbox" checked="checked" name="privacy" v-model="privacy" class="form-control font-italic mt-2 col-1">
        <label for="privacy" class=" font-weight-bold text-light mt-3 col-5">{{ $trans('messages.I accept this Privacy Policy') }}</label>
        </div>
        <div class="col-2"><img :src="src" alt="" type="button" @click="suscribe()" id="enviar-news" class="btn rounded bg-info px-2 py-2 newsletter"></div>
      </div>

    </div>
  </form>

</template>

<script>
    export default {
      data(){
        return {
          email:'',
          name:'',
          privacy:'',
          src:'/images/img/enviar.png',
          token   : window.CSRF_TOKEN,

        }
      },
      methods:{
      suscribe:function(){
        let url=window.location.origin +"/suscripcion";
        let mensaje=this.$trans('messages.Unidentified error');
        if (this.email==''||this.name=='') {
          mensaje=this.$trans('messages.You cannot leave empty fields, please check');
        }
        if(this.privacy==false){
          mensaje=mensaje+this.$trans('messages.You need accept Privacy Policy, please.');
        }
        if(this.privacy==''||this.privacy!=true){
          swal({title:this.$trans('messages.Warning!'),
                text:this.$trans('messages.You need accept Privacy Policy, please.'),
                icon:'warning',
                closeOnClickOutside:false,
                closeOnEsc:false
              });
        }
        else{
          let data = new FormData();
          data.append("email", this.email);
          data.append("name", this.name);
          data.append("privacy", this.privacy);

          axios.post(url,data)
               .then(response=>{
                 this.name='';
                 this.email='';
                 this.privacy=true;
                 swal({title:this.$trans('messages.Correct data'),
                       text:this.$trans('messages.Thank you for subscribe!'),
                       icon:'success',
                       closeOnClickOutside:false,
                       closeOnEsc:false
                     });
                 //console.log(response);
               })
               .catch(error=>{
                 if(error.response.data.message){
                   swal('Error',''+error.response.data.message,'error');
                 }
                 let wrong=error.response.data.errors;
                 if(wrong.hasOwnProperty('email')){
                   mensaje+='-'+wrong.email[0];
                 }
                 if(wrong.hasOwnProperty('name')){
                   mensaje+='-'+wrong.name[0];
                 }
                 if(wrong.hasOwnProperty('privacy')){
                   mensaje+='-'+wrong.privacy[0];
                 }

                 swal('Error',mensaje,'error');
                 //console.log(error.response.data);
               });
             }
        //alert('Hola');
      }
      },
        mounted() {
          this.privacy=true;
          if (this.$attrs.locale) {
               this.$lang.setLocale(this.$attrs.locale);
               }
          else {
            this.$lang.setLocale('en');
          }
        }
    }
</script>
