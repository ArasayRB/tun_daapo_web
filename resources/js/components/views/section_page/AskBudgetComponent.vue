<template>
  <section class="mt-5 pt-5 pb-5" id="pedir-presupuesto" name="presupuesto">
    <h1 class="text-center text-light">{{sectionItem[0].title}}</h1><!--Section Presupuesto-->
    <div v-if="mensageaskbudget!=''">
      <h4 class="text-light">"{{ $trans('messages.Web Development Plan') }} {{mensageaskbudget}}"</h4>
    </div>
    <form action="" class="mt-5  mb-4">
      <div class="container mt-5">
        <div class="row justify-content-center">
          <div class="col-6 mb-2"><input type="text" v-model="name" class="form-control font-italic" placeholder="Tu Nombre o Empresa..."></div>
          <div class="col-6 mb-2"><input type="text" v-model="phone" class="form-control font-italic" placeholder="Teléfono de contacto..."></div>
            <div class="col-2 d-block">
            </div>
          <div class="col-6"><input type="text" v-model="email" class="form-control font-italic" placeholder="Email de contacto..."></div>
          <div class="col-2"><button type="button" @click="askbudget()" class="btn rounded bg-warning ">{{ $trans('messages.Ask for budget') }}</button></div>
        </div>
      </div>
    </form>
    <span v-html="sectionItem[0].description"></span>
  </section><!--END Section Presupuesto-->
</template>

<script>
    export default {
      props:['mensageaskbudget'],
      data(){
        return{
          sectionItem:[],
          name:'',
          phone:'',
          email:'',
          mensage:'',
          url:'/ask-budget',
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
             $("#pedir-presupuesto").hide(true);
                }
              /*  else{
                  this.comentarios=
                }*/
              });
        },
        askbudget:function(){
          let mensaje=this.$trans('messages.Unidentified error');
          if (this.email==''||this.name==''||this.phone=='') {
            mensaje=this.$trans('messages.You cannot leave empty fields, please check');
          }
          let data = new FormData();
              data.append("email", this.email);
              data.append("name_or_company", this.name);
              data.append("token", this.token);
              data.append("contact_phone", this.phone);
              data.append("paket_name", this.mensageaskbudget);

            axios.post(this.url,data)
                 .then(response=>{
                   let contact=response.data;
                   this.ventanaContact=false;
                   this.$emit('resetaskbudgetmssg');
                   this.mensageaskbudget='';
                   this.name='';
                   this.phone='';
                   this.email='';
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
                   if(wrong.hasOwnProperty('name')){
                     mensaje+='-'+wrong.name[0];
                   }
                   if(wrong.hasOwnProperty('phone')){
                     mensaje+='-'+wrong.phone[0];
                   }

                   swal('Error',mensaje,'error');
                   //console.log(error.response.data);
                 });
          //alert('Hola');
        },
      },
      created(){
       this.getSection();
       console.log('message es: '+this.mensage);
      },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
