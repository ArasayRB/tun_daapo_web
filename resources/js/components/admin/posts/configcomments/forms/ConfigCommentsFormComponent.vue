<template>
  <section class="mb-5" id="createConfigCommentsModal" name="createConfigCommentsModal"><!--Formulario createConfigCommentsModal-->
    <form  id="form-create-conf-comment">
      <transition class="modal fade pt-5" id="createConfigCommentsModal">
        <div class="modal-mask">
    <div class="modal-wrapper">
    <div class="modal-container">
      <div class="modal-header">
        <slot>
          <h1 class="text-center text-dark" v-if="show_lang_div===false">{{confcomment.max_nivel}}</h1>
        <h1 class="text-center text-dark" v-else="operation==='add'">{{ $trans('messages.Create') }} {{ $trans('messages.Comment') }} {{ $trans('messages.Configuration') }}</h1>
        <h1 class="text-center text-dark" v-else="operation==='update'">{{ $trans('messages.Update') }} {{ $trans('messages.Comment') }} {{ $trans('messages.Configuration') }}</h1>
        <button type="button" class="modal-default-button btn btn-lg" @click="$emit('close')"><span aria-hidden="true">&times;</span></button>

        </slot>
      </div>

    <div class="modal-body">
      <slot>
        <div class="container mt-5">
          <div class="row justify-content-center">
            <div class="col-12">

              <div class="form-group">
                <label for="name">{{ $trans('messages.Level') }}</label>
                <input type="text" name="max_nivel" v-model="max_nivel" class="form-control font-italic mb-2" v-if="operation==='add'">
                <input type="text" name="max_nivel" v-model="confcomment.max_nivel" class="form-control font-italic mb-2" v-if="operation==='update'">
              </div>

              <div class="form-group">
                <label for="max_answers">{{ $trans('messages.Answer') }}</label>
                <input type="text" name="max_answers" v-model="max_answers" class="form-control font-italic mb-2" v-if="operation==='add'">
                <input type="text" name="max_answers" v-model="confcomment.max_answers" class="form-control font-italic mb-2" v-if="operation==='update'">
              </div>

            </div>

          </div>
        </div>
      </slot>
    </div>
    <div class="modal-footer">
      <slot>
        <div class="col justify-content-center">
      <div class="form-group row mb-0">
          <div class="col-md-5 offset-md-4">
            <button type="button" class="btn rounded btn-primary reserva" @click="createConfigComment()" v-show="operation==='add'">{{ $trans('messages.Create') }}</button>

              <button type="button" class="btn rounded btn-primary reserva" @click="editedConfigComment(confcomment)" v-if="operation==='update'">{{ $trans('messages.Update') }}</button>

              <button type="button" class="modal-default-button btn btn-danger" @click="$emit('close')">{{ $trans('messages.Close') }}</button>

          </div>
      </div>
      </div>
      </slot>
    </div>
    </div>
    </div>
    </div>
  </transition>
    </form>
  </section><!--End Formulario login-->
</template>

<script>
    export default {
      props:['locale','confcomment','operation','show_lang_div','lan_to_edit'],
      data(){
        return {
          msgAddTag:this.$trans('messages.Add a new Tag'),
          activeClass:'active',
          showClass:'show',
          max_answers:'',
          lang_trans:'',
          value:'',
          max_nivel:'',
          src:window.location.origin +'/'+'images/lang/',
          ventanaOperConfigComment:false,
          error:'',
          token   : window.CSRF_TOKEN,

        }
      },
      methods:{
        createConfigComment:function(){
          let url;
          let msg_succ;
          let data;
          let mensaje;
          let default_lang=this.$lang.getLocale();

            url=window.location.origin +'/'+this.locale+"/admin/configuration-comments";
            msg_succ=this.$trans('messages.Comment')+' '+this.$trans('messages.Configuration')+' '+this.$trans('messages.Created.');
            mensaje=this.$trans('messages.Unidentified error');
            if (this.max_nivel==''||this.max_answers=='') {
              mensaje=this.$trans('messages.You cannot leave empty fields, please check');
            }

            data = new FormData();
              data.append("max_nivel", this.max_nivel);
              data.append("max_answers", this.max_answers);



            axios.post(url,data)
                 .then(response=>{
                   swal({title:this.$trans('messages.Correct data'),
                         text:msg_succ,
                         icon:'success',
                         closeOnClickOutside:false,
                         closeOnEsc:false
                       }).then(select=>{
                         if (select){
                           let roleAdd=response.data;
                          this.$emit('confcommentnew',roleAdd);

                           //location.reload();
                         }
                       });
                   //console.log(response);
                 })
                 .catch(error=>{
                   if(error.response.data.message){
                     swal('Error',''+error.response.data.message,'error');
                   }
                   let wrong=error.response.data.errors;
                   if(wrong.hasOwnProperty('max_nivel')){
                     mensaje+='-'+wrong.max_nivel[0];
                   }
                   if(wrong.hasOwnProperty('max_answers')){
                     mensaje+='-'+wrong.max_answers[0];
                   }
                   swal('Error',mensaje,'error');
                   //console.log(error.response.data);
                 });

        },
        editedConfigComment:function(confcomment){
          let url;
          let data;
          let msg_edited;
          let config= { headers: {"Content-Type": "multipart/form-data" }};

                data = new FormData();
      	          data.append('_method', 'patch');
                  data.append("max_nivel", confcomment.max_nivel);
                  data.append("max_answers", confcomment.max_answers);
                url=window.location.origin +'/'+this.locale+"/admin/configuration-comments/"+confcomment.id;
                msg_edited=this.$trans('messages.Comment')+' '+this.$trans('messages.Configuration')+' '+this.$trans('messages.Edited');



          axios.post(url,data,config)
               .then(response=>{
                 swal({title:this.$trans('messages.Category'),
                       text:msg_edited,
                       icon:'success',
                       closeOnClickOutside:false,
                       closeOnEsc:false
                     }).then(select=>{
                       if (select){
                         let confCommentUpdate=response.data;
                         this.$emit('confcommentperupd',confCommentUpdate);
                       }
                     });
                 //console.log(response);
               })
               .catch(error=>{
                 if(error.response.data.message){
                   swal('Error',''+error.response.data.message,'error');
                 }
                 let wrong=error.response.data.errors;
                 if(wrong.hasOwnProperty('max_nivel')){
                   mensaje+='-'+wrong.max_nivel[0];
                 }
                 if(wrong.hasOwnProperty('max_answers')){
                   mensaje+='-'+wrong.max_answers[0];
                 }
                 swal('Error',mensaje,'error');
                 //console.log(error.response.data);
               });
        },
      },
      created: function () {
         },
        mounted() {
          if (this.locale) {
               this.$lang.setLocale(this.locale);
               }
          else {
            this.$lang.setLocale('en');
          }
        }
    }
</script>
