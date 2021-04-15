<template>
  <div class="panel pt-5 pb-5 mt-5" id="comments-post">
  <div class="panel-header" v-show="answer=='no'">
    <h1 class="panel-title text-center text-dark">{{ $trans('messages.Leave your Comment Here!') }}</h1>
  </div>
  <div class="panel-body">

      <div class="row justify-content-center">
        <div class="col-12">
      <form action="" class="ml-3">
        <div class="text-center" id="form">
        <p class="clasificacion" v-show="answer==='no'">
        <input id="radio1" type="radio" name="estrellas" v-model="valuation" value="5"><!--
        --><label for="radio1">★</label><!--
        --><input id="radio2" type="radio" name="estrellas" v-model="valuation" value="4"><!--
        --><label for="radio2">★</label><!--
        --><input id="radio3" type="radio" name="estrellas" v-model="valuation" value="3"><!--
        --><label for="radio3">★</label><!--
        --><input id="radio4" type="radio" name="estrellas" v-model="valuation" value="2"><!--
        --><label for="radio4">★</label><!--
        --><input id="radio5" type="radio" name="estrellas"v-model="valuation"  value="1"><!--
        --><label for="radio5">★</label>
        </p>
        </div>
          <input type="text" v-model="email" class="form-control font-italic mt-5" placeholder="Email/Correo..." id="email" name="email">
          <input type="text" v-model="name" class="form-control font-italic mt-2" placeholder="Name/Nombre..." id="name" name="name">
          <textarea name="mensaje" v-model="message" class="form-control font-italic mt-2" id="" cols="33" rows="2" placeholder="Comment/Comentario..."></textarea>
          <div class="row ml-2">
          <input type="checkbox" checked="checked" name="privacy" v-model="privacy" class="form-control font-italic mt-2 col-1">
          <label for="privacy" class=" font-weight-bold text-dark mt-3 col-5"><a href="/privacy-policy">{{ $trans('messages.I accept this Privacy Policy') }}</a></label>
          </div>
         <button type="button" class="btn btn-primary rounded btn-lg mt-3" @click="makeComment()">{{ $trans('messages.Send') }}</button>
      </form>
      </div>
      </div>
  </div>
  </div>



</template>

<script>
    export default {
      props:['post','poster','company_email','comment_reply','moderator','dashboard'],
      data(){
        return {
          email:'',
          tuun_daapo_data:[],
          post_id:this.$attrs.id_post,
          user_email:this.$attrs.user_email,
          answer:this.$attrs.answer,
          name:'',
          valuation:'',
          message:'',
          privacy:'',
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
      makeComment:function(){
        let url;
        let mensaje=this.$trans('messages.Unidentified error');
        if (this.email==''||this.name==''||this.message==''|| this.valuation==='') {
          mensaje=this.$trans('messages.You cannot leave empty fields, please check');
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
            data.append("token", this.token);
            data.append("message", this.message);
            data.append("valuation", this.valuation);
            data.append("privacy", this.privacy);

      if(this.answer==='no'){
            data.append("company_email", this.tuun_daapo_data.email);
            data.append("poster_email", this.user_email);
            data.append("post_id", this.post_id);
           url="/leave-comment";

         }
         else{
                 data.append("company_email", this.company_email);
                 data.append("poster_email", this.poster);
                 data.append("post_id", this.post);
                 data.append("comment_reply", this.comment_reply);
                url="/leave-comment-reply";
         }
          axios.post(url,data)
               .then(response=>{
                 let contact=response.data;
                 this.email='';
                 this.name='';
                 this.message='';
                 this.valuation=0;
                 if(this.answer!='no'){
                   this.$emit('recharge');
                 }
                 if(response.data==='over'){
                   swal({title:this.$trans('messages.Comment')+' '+this.$trans('messages.Warning!'),
                         text:this.$trans('messages.This comment no accept more replys, Sorry!'),
                         icon:'success',
                         closeOnClickOutside:false,
                         closeOnEsc:false
                       });
                 }
                 else{
                 swal({title:this.$trans('messages.Comment')+' '+this.$trans('messages.sended'),
                       text:this.$trans('messages.Thank you')+'!',
                       icon:'success',
                       closeOnClickOutside:false,
                       closeOnEsc:false
                     });
                   }

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
                 if(wrong.hasOwnProperty('message')){
                   mensaje+='-'+wrong.message[0];
                 }
                 if(wrong.hasOwnProperty('valuation')){
                   mensaje+='-'+wrong.valuation[0];
                 }

                 swal('Error',mensaje,'error');
                 //console.log(error.response.data);
               });
             }
        //alert('Hola');
      }
      },
        mounted() {
          this.tunDaapoData();
          this.privacy=true;
          if(this.dashboard==="yes"){
            this.email=this.moderator.email;
            this.name=this.moderator.name;
            $("#name").hide(true);
            $("#email").hide(true);
            console.log('El nombre del dashboard es: '+this.name+' y el email: '+this.email);
          }
          if (this.$attrs.locale) {
               this.$lang.setLocale(this.$attrs.locale);
               }
          else {
            this.$lang.setLocale('en');
          }
        }
    }
</script>
