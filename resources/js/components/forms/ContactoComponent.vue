<template>
  <div class="panel pt-5 pb-5 mt-5" id="contacto">
  <div class="panel-header">
    <h1 class="panel-title text-center text-light">{{ $trans('messages.Contact') }}</h1>
  </div>
  <div class="panel-body">

      <div class="row justify-content-center">
        <div class="col-6">
      <form action="" class="ml-3">
          <input type="text" v-model="email" class="form-control font-italic mt-5" placeholder="Email/Correo...">
          <input type="text" v-model="name" class="form-control font-italic mt-2" placeholder="Name/Nombre...">
          <textarea name="mensaje" v-model="message" class="form-control font-italic mt-2" id="" cols="33" rows="2" placeholder="Message/Mensaje..."></textarea>
         <button type="button" class="btn btn-primary rounded btn-lg mt-3" @click="contact()">{{ $trans('messages.Send') }}</button>
      </form>
      </div>
      <div class="col-6">
      <section class="info-contact">
        <div class="container mt-5">
            <div class="tel-fijo"><p class="text-light"><mark class="bg-dark text-light">{{ $trans('messages.Landline') }}: <br></mark>{{tuun_daapo_data.phone}}</p></div>
            <div class="email"> <p class="text-light"><mark class="bg-dark text-light">{{ $trans('messages.Email') }}: <br></mark>{{tuun_daapo_data.email}}</p></div>
            <div class="direc"><p class="text-light"><mark class="bg-dark text-light">{{ $trans('messages.Adress') }}: <br></mark>{{tuun_daapo_data.address}}</p></div>
          </div>
      </section>
      </div>
      </div>
  </div>
  </div>



</template>

<script>
    export default {
      data(){
        return {
          email:'',
          tuun_daapo_data:[],
          name:'',
          message:'',
          ventanaContact:false,
          token   : window.CSRF_TOKEN,

        }
      },
      methods:{
        tunDaapoData:function(){
          axios.get('/tun-daapo-contact')
               .then(response =>{
                 this.tuun_daapo_data=response.data;

               });
        },
      contact:function(){

        let url="/contact_us";
        let mensaje=this.$trans('messages.Unidentified error');
        if (this.email==''||this.name==''||this.message=='') {
          mensaje=this.$trans('messages.You cannot leave empty fields, please check');
        }
        let data = new FormData();
            data.append("email", this.email);
            data.append("name", this.name);
            data.append("token", this.token);
            data.append("message", this.message);
            data.append("company_email", this.tuun_daapo_data.email);

          axios.post(url,data)
               .then(response=>{
                 let contact=response.data;
                 this.ventanaContact=false;
                 this.email='';
                 this.name='';
                 this.message='';
                 swal({title:this.$trans('messages.Message')+' '+this.$trans('messages.sended'),
                       text:this.$trans('messages.You go to receive an answare as soon like be possible!'),
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

                 swal('Error',mensaje,'error');
                 //console.log(error.response.data);
               });
        //alert('Hola');
      }
      },
        mounted() {
          this.tunDaapoData();
          if (this.$attrs.locale) {
               this.$lang.setLocale(this.$attrs.locale);
               }
          else {
            this.$lang.setLocale('en');
          }
        }
    }
</script>
