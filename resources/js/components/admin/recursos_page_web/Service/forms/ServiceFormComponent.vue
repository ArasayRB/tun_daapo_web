<template>
  <section class="mb-5" id="createServiceModal" name="createServiceModal"><!--Formulario createServiceModal-->
    <form  id="form-create-user">
      <transition class="modal fade pt-5" id="createServiceModalModal">
        <div class="modal-mask">
    <div class="modal-wrapper">
    <div class="modal-container">
      <div class="modal-header">
        <slot>
          <h1 class="text-center text-dark" v-if="show_lang_div===false">{{service.name}}</h1>
        <h1 class="text-center text-dark" v-else="operation==='add'">{{ $trans('messages.Create') }} {{ $trans('messages.Service') }}</h1>
        <h1 class="text-center text-dark" v-else="operation==='update'">{{ $trans('messages.Update') }} {{ $trans('messages.Service') }}</h1>
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


              <div class="form-group">
                <label for="name">{{ $trans('messages.Name') }}</label>
                <input type="text" name="name" v-model="name" class="form-control font-italic mb-2" v-if="operation==='add'">
                <input type="text" name="name" v-model="service.name" class="form-control font-italic mb-2" v-if="operation==='update'">
              </div>

              <div class="form-group">
                <label for="img">{{ $trans('messages.Image') }}</label>
                <input type="file" name="img"  v-on:change="img" class="form-control font-italic mb-2" v-if="operation==='add'">
                <input type="file" name="img"  v-on:change="img" class="form-control font-italic mb-2" v-if="operation==='update'">
                <div class="row" v-if="operation==='update'">
                  <img :src="src+service.img" :alt="service.img" width="100">
                </div>
                <div class="form-group">
                  <label for="img_descr">{{ $trans('messages.Description') }} {{ $trans('messages.Image') }}</label>
                  <input type="text" name="img_descr" v-model="img_descr" class="form-control font-italic mb-2" v-if="operation==='add'">
                  <input type="text" name="img_descr" v-model="service.img_descript" class="form-control font-italic mb-2" v-if="operation==='update'">
                </div>
              </div>

              <div class="form-group">
                <label for="description">{{ $trans('messages.Description') }}</label>
                <vue-ckeditor
                v-model="description"
                :config="config"
                @blur="onBlur($event)"
                @focus="onFocus($event)"
                @contentDom="onContentDom($event)"
                @dialogDefinition="onDialogDefinition($event)"
                @fileUploadRequest="onFileUploadRequest($event)"
                @fileUploadResponse="onFileUploadResponse($event)"
                v-if="operation==='add'"/>
                <vue-ckeditor
                v-model="service.description"
                :config="config"
                @blur="onBlur($event)"
                @focus="onFocus($event)"
                @contentDom="onContentDom($event)"
                @dialogDefinition="onDialogDefinition($event)"
                @fileUploadRequest="onFileUploadRequest($event)"
                @fileUploadResponse="onFileUploadResponse($event)"
                v-if="operation==='update'"/>
              </div>

              <div class="form-group" v-show="show_lang_div" v-if="operation==='add'">
                <label for="price">{{ $trans('messages.Price') }}</label>
                <input type="number" min="1"  step="0.1" name="price" v-model="price" class="form-control font-italic mb-2" v-if="operation==='add'">
                <input type="number" min="1"  step="0.1" name="price" v-model="service.price" class="form-control font-italic mb-2" v-if="operation==='update'">
              </div>

              <div class="form-group" v-show="lan_to_edit==='none'" v-else="operation==='update'">
                <label for="price">{{ $trans('messages.Price') }}</label>
                <input type="number" min="1"  step="0.1" name="price" v-model="price" class="form-control font-italic mb-2" v-if="operation==='add'">
                <input type="number" min="1"  step="0.1" name="price" v-model="service.price" class="form-control font-italic mb-2" v-if="operation==='update'">
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
            <button type="button" class="btn rounded btn-primary reserva" @click="createService()" v-show="operation==='add'" v-if="show_lang_div===false">{{ $trans('messages.Translate') }}</button>
            <button type="button" class="btn rounded btn-primary reserva" @click="createService()" v-show="operation==='add'" v-else>{{ $trans('messages.Create') }}</button>

            <button type="button" class="btn rounded btn-primary reserva" @click="editedService(service)" v-if="operation==='update'">{{ $trans('messages.Update') }}</button>

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
      props:['locale','service','operation','show_lang_div','lan_to_edit'],
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
          activeClass:'active',
          languages:[],
          language:'',
          showClass:'show',
          description:'',
          price:'',
          map:'',
          value:'',
          name:'',
          img:'',
          img_descr:'',
          imagenSectionPage:'',
          src:'storage/service/',
          ventanaOperService:false,
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
    img:function(e){
      this.imagenSectionPage=e.target.files[0];
    },

    getLanguageList:function(){
      axios.get(window.location.origin +'/'+this.locale+'/languages-no-translated/'+this.service.id+'/Service')
            .then(response=> this.languages=response.data)
            .catch(error=>this.error.push(error));
    },
        createService:function(){
          let url;
          let msg_succ;
          let data;
          let mensaje;
          let default_lang=this.$lang.getLocale();

          if(this.show_lang_div===false){

              url=window.location.origin +'/'+this.locale+"/admin/add-translate-service";
              msg_succ=this.$trans('messages.Service')+' '+this.$trans('messages.Translated Succefully');
              let mensaje=this.$trans('messages.Unidentified error');
              if (this.name==''||this.description==''||this.lang_trans==''||this.img_descr=='') {
                mensaje=this.$trans('messages.You cannot leave empty fields, please check');
              }
              data = new FormData();
                data.append("name", this.name);
                data.append("name_old", this.service.name);
                data.append("service_id", this.service.id);
                data.append("lang", this.lang_trans);
                data.append("description", this.description);
          }
          else{
            url=window.location.origin +'/'+this.locale+"/admin/service";
            msg_succ=this.$trans('messages.Service')+' '+this.$trans('messages.Created.');
            mensaje=this.$trans('messages.Unidentified error');
            if (this.name==''||this.description=='') {
              mensaje=this.$trans('messages.You cannot leave empty fields, please check');
            }

            data = new FormData();
              data.append("img", this.imagenSectionPage);
              data.append("name", this.name);
              data.append("img_descript", this.img_descr);
              data.append("description", this.description);
              data.append("price", this.price);
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
                          this.$emit('servicenew',roleAdd);

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
                   if(wrong.hasOwnProperty('img')){
                     mensaje+='-'+wrong.img[0];
                   }
                   if(wrong.hasOwnProperty('name')){
                     mensaje+='-'+wrong.name[0];
                   }
                   if(wrong.hasOwnProperty('img_descript')){
                     mensaje+='-'+wrong.img_descript[0];
                   }
                   if(wrong.hasOwnProperty('description')){
                     mensaje+='-'+wrong.description[0];
                   }
                   swal('Error',mensaje,'error');
                   //console.log(error.response.data);
                 });

        },
        editedService:function(service){
          let url;
          let data;
          let msg_edited;
          let config= { headers: {"Content-Type": "multipart/form-data" }};

          if(this.lan_to_edit==='none'){
            data = new FormData();
              data.append('_method', 'patch');
              data.append("img", this.imagenSectionPage);
              data.append("img_descript", service.img_descript);
              data.append("name", service.name);
              data.append("description", service.description);
              data.append("price", service.price);
            url=window.location.origin +'/'+this.locale+"/admin/service/"+service.id;
            msg_edited=this.$trans('messages.Service')+' '+this.$trans('messages.Edited');
          }
          else{
            data = new FormData();
              data.append("name", service.name);
              data.append("description", service.description);
              //data.append("tags", postTags);
              //data.append("keywords", postKeys);
            url=window.location.origin +'/'+this.locale+"/admin/service-translated-edited/"+service.id+"/"+this.lan_to_edit;
            msg_edited=this.$trans('messages.The')+' '+this.$trans('messages.Service')+' '+this.$trans('messages.translation has been successfully modified');
          }



          axios.post(url,data,config)
               .then(response=>{
                 swal({title:this.$trans('messages.Service'),
                       text:msg_edited,
                       icon:'success',
                       closeOnClickOutside:false,
                       closeOnEsc:false
                     }).then(select=>{
                       if (select){
                         let serviceUpdate=response.data;
                         this.$emit('serviceperupd',serviceUpdate);
                       }
                     });
                 //console.log(response);
               })
               .catch(error=>{
                 if(error.response.data.message){
                   swal('Error',''+error.response.data.message,'error');
                 }
                 let wrong=error.response.data.errors;
                 if(wrong.hasOwnProperty('img')){
                   mensaje+='-'+wrong.img[0];
                 }
                 if(wrong.hasOwnProperty('name')){
                   mensaje+='-'+wrong.name[0];
                 }
                 if(wrong.hasOwnProperty('description')){
                   mensaje+='-'+wrong.description[0];
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
          if (this.locale) {
               this.$lang.setLocale(this.locale);
               }
          else {
            this.$lang.setLocale('en');
          }
        }
    }
</script>
