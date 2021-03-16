<template>
  <section class="mb-5" id="createContactModal" name="createContactModal"><!--Formulario createContactModal-->
    <form  id="form-create-user">
      <transition class="modal fade pt-5" id="createContactModalModal">
        <div class="modal-mask">
    <div class="modal-wrapper">
    <div class="modal-container">
      <div class="modal-header">
        <slot>
        <h1 class="text-center text-dark" v-if="operation==='add'">{{ $trans('messages.Create') }} {{ $trans('messages.Contact') }}</h1>
        <h1 class="text-center text-dark" v-else="operation==='update'">{{ $trans('messages.Update') }} {{ $trans('messages.Contact') }}</h1>
        <button type="button" class="modal-default-button btn btn-lg" @click="$emit('close')"><span aria-hidden="true">&times;</span></button>

        </slot>
      </div>

    <div class="modal-body">
      <slot>
        <div class="container mt-5">
          <div class="row justify-content-center">
            <div class="col-12">

              <div class="form-group" id="language_div" v-show="show_lang_div!=true" v-if="operation=='add'">
                <label for="lang_trans">{{ $trans('messages.Language') }}</label>
                <select class="form-control" v-model="lang_trans" name="lang_trans" required>
                 <option value=''>{{ $trans('messages.Select') }} {{ $trans('messages.Language') }}</option>
                   <option v-for="language in languages" :value="language.id">{{language.language}}</option>
                </select>
              </div>


              <div class="form-group" v-show="show_lang_div" v-if="operation==='add'">
                <label for="email">{{ $trans('messages.Email') }}</label>
                <input type="email" name="email" v-model="email" class="form-control font-italic mb-2" v-if="operation==='add'">
                <input type="email" name="email" v-model="contact.email" class="form-control font-italic mb-2" v-if="operation==='update'">
              </div>

              <div class="form-group" v-show="lan_to_edit==='none'" v-else="operation==='update'">
                <label for="email">{{ $trans('messages.Email') }}</label>
                <input type="email" name="email" v-model="email" class="form-control font-italic mb-2" v-if="operation==='add'">
                <input type="email" name="email" v-model="contact.email" class="form-control font-italic mb-2" v-if="operation==='update'">
              </div>

              <div class="form-group" v-show="show_lang_div" v-if="operation==='add'">
                <label for="phone">{{ $trans('messages.Phone') }}</label>
                <input type="tel" name="phone" v-model="phone" class="form-control font-italic mb-2" v-if="operation==='add'">
                <input type="tel" name="phone" v-model="contact.phone" class="form-control font-italic mb-2" v-if="operation==='update'">
              </div>

              <div class="form-group" v-show="lan_to_edit==='none'" v-else="operation==='update'">
                <label for="phone">{{ $trans('messages.Phone') }}</label>
                <input type="tel" name="phone" v-model="phone" class="form-control font-italic mb-2" v-if="operation==='add'">
                <input type="tel" name="phone" v-model="contact.phone" class="form-control font-italic mb-2" v-if="operation==='update'">
              </div>

              <div class="form-group">
                <label for="address">{{ $trans('messages.Adress') }}</label>
                <input type="text" name="address" v-model="address" class="form-control font-italic mb-2" v-if="operation==='add'">
                <input type="text" name="address" v-model="contact.address" class="form-control font-italic mb-2" v-if="operation==='update'">
              </div>

              <div class="form-group" v-show="show_lang_div" v-if="operation==='add'">
                <label for="map">{{ $trans('messages.Map') }}</label>
                <input type="text" name="map" v-model="map" class="form-control font-italic mb-2" v-if="operation==='add'">
                <input type="text" name="map" v-model="contact.map" class="form-control font-italic mb-2" v-if="operation==='update'">
              </div>

              <div class="form-group" v-show="lan_to_edit==='none'" v-else="operation==='update'">
                <label for="map">{{ $trans('messages.Map') }}</label>
                <input type="text" name="map" v-model="map" class="form-control font-italic mb-2" v-if="operation==='add'">
                <input type="text" name="map" v-model="contact.map" class="form-control font-italic mb-2" v-if="operation==='update'">
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
            <button type="button" class="btn rounded btn-primary reserva" @click="createContact()" v-show="operation==='add'" v-if="show_lang_div===false">{{ $trans('messages.Translate') }}</button>
            <button type="button" class="btn rounded btn-primary reserva" @click="createContact()" v-show="operation==='add'" v-else>{{ $trans('messages.Create') }}</button>

              <button type="button" class="btn rounded btn-primary reserva" @click="editedContact(contact)" v-if="operation==='update'">{{ $trans('messages.Update') }}</button>

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
  import VueCkeditor from 'vue-ckeditor2';
    export default {
      components: { VueCkeditor},
      props:['locale','contact','operation','show_lang_div','lan_to_edit'],
      data(){
        return {
          msgAddTag:this.$trans('messages.Add a new Tag'),
          config: {
       toolbar: [

     { name: 'document',    items : [ 'Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates' ] },
     { name: 'clipboard',   items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
     { name: 'editing',     items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
     { name: 'forms',       items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
     '/',
     { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
     { name: 'paragraph',   items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
     { name: 'links',       items : [ 'Link','Unlink','Anchor' ] },
     { name: 'insert',      items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak' ] },
     '/',
     { name: 'styles',      items : [ 'Styles','Format','Font','FontSize' ] },
     { name: 'colors',      items : [ 'TextColor','BGColor' ] },
     { name: 'tools',       items : [ 'Maximize', 'ShowBlocks','-','About' ] }
       ],
       height: 300
     },
          languages:[],
          language:'',
          activeClass:'active',
          showClass:'show',
          phone:'',
          address:'',
          lang_trans:'',
          map:'',
          value:'',
          email:'',
          src:'images/lang/',
          ventanaOperContact:false,
          error:'',
          token   : window.CSRF_TOKEN,

        }
      },
      methods:{
        onBlur(evt) {
      console.log(evt);
    },
    onFocus(evt) {
      console.log(evt);
    },
    onContentDom(evt) {
      console.log(evt);
    },
    onDialogDefinition(evt) {
      console.log(evt);
    },
    onFileUploadRequest(evt) {
      console.log(evt);
    },
    onFileUploadResponse(evt) {
      console.log(evt);
    },
    getLanguageList:function(){
      axios.get('/languages-no-translated/'+this.contact.id+'/Contact')
            .then(response=> this.languages=response.data)
            .catch(error=>this.error.push(error));
    },
        createContact:function(){
          let url;
          let msg_succ;
          let data;
          let mensaje;
          let default_lang=this.$lang.getLocale();
          if(this.show_lang_div===false){
            url="/add-translate-contact";
            msg_succ=this.$trans('messages.Contact')+' '+this.$trans('messages.Translated Succefully');
            let mensaje=this.$trans('messages.Unidentified error');
            if (this.address==''||this.lang_trans=='') {
              mensaje=this.$trans('messages.You cannot leave empty fields, please check');
            }
            data = new FormData();
              data.append("address", this.address);
              data.append("address_old", this.contact.address);
              data.append("contact_id", this.contact.id);
              data.append("lang", this.lang_trans);
          }
          else{
            url="/contact";
            msg_succ=this.$trans('messages.Contact')+' '+this.$trans('messages.Created.');
            mensaje=this.$trans('messages.Unidentified error');
            if (this.email==''||this.phone==''||this.address=='') {
              mensaje=this.$trans('messages.You cannot leave empty fields, please check');
            }

            data = new FormData();
              data.append("email", this.email);
              data.append("phone", this.phone);
              data.append("address", this.address);
              data.append("map", this.map);
          }

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
                          this.$emit('contactnew',roleAdd);

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
                   if(wrong.hasOwnProperty('email')){
                     mensaje+='-'+wrong.email[0];
                   }
                   if(wrong.hasOwnProperty('phone')){
                     mensaje+='-'+wrong.phone[0];
                   }
                   if(wrong.hasOwnProperty('address')){
                     mensaje+='-'+wrong.address[0];
                   }
                   if(wrong.hasOwnProperty('map')){
                     mensaje+='-'+wrong.map[0];
                   }
                   swal('Error',mensaje,'error');
                   //console.log(error.response.data);
                 });

        },
        editedContact:function(contact){
          let url;
          let data;
          let msg_edited;
          let config= { headers: {"Content-Type": "multipart/form-data" }};
            if(this.lan_to_edit==='none'){
              data = new FormData();
    	          data.append('_method', 'patch');
                data.append("email", contact.email);
                data.append("phone", contact.phone);
                data.append("address", contact.address);
                data.append("map", contact.map);
              url="/contact/"+contact.id;
              msg_edited=this.$trans('messages.Contact')+' '+this.$trans('messages.Edited');
            }
            else{
              data = new FormData();
                data.append("address", contact.address);
                //data.append("tags", postTags);
                //data.append("keywords", postKeys);
              url="/contact-translated-edited/"+contact.id+"/"+this.lan_to_edit;
              msg_edited=this.$trans('messages.The')+' '+this.$trans('messages.Contact')+' '+this.$trans('messages.translation has been successfully modified');
            }

          axios.post(url,data,config)
               .then(response=>{
                 swal({title:this.$trans('messages.Contact'),
                       text:msg_edited,
                       icon:'success',
                       closeOnClickOutside:false,
                       closeOnEsc:false
                     }).then(select=>{
                       if (select){
                         let contactUpdate=response.data;
                         this.$emit('contactoperupd',contactUpdate);
                       }
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
                 if(wrong.hasOwnProperty('phone')){
                   mensaje+='-'+wrong.phone[0];
                 }
                 if(wrong.hasOwnProperty('address')){
                   mensaje+='-'+wrong.address[0];
                 }
                 if(wrong.hasOwnProperty('map')){
                   mensaje+='-'+wrong.map[0];
                 }
                 swal('Error',mensaje,'error');
                 //console.log(error.response.data);
               });
        },
      },
      created: function () {
         this.getLanguageList();
         },
        mounted() {
        }
    }
</script>
