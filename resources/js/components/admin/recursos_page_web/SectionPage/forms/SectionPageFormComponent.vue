<template>
  <section class="mb-5" id="createSectionPageModal" name="createSectionPageModal"><!--Formulario createSectionPageModal-->
    <form  id="form-create-user">
      <transition class="modal fade pt-5" id="createSectionPageModalModal">
        <div class="modal-mask">
    <div class="modal-wrapper">
    <div class="modal-container">
      <div class="modal-header">
        <slot>
          <h1 class="text-center text-dark" v-if="show_lang_div===false">{{sectionpage.title}}</h1>
        <h1 class="text-center text-dark" v-else="operation==='add'">{{ $trans('messages.Create') }} {{ $trans('messages.Section Page') }}</h1>
        <h1 class="text-center text-dark" v-else="operation==='update'">{{ $trans('messages.Update') }} {{ $trans('messages.Section Page') }}</h1>
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
  <label for="img">{{ $trans('messages.Image') }}</label>
  <input type="file" name="img"  v-on:change="img" class="form-control font-italic mb-2" v-if="operation==='add'">
  <input type="file" name="img"  v-on:change="img" class="form-control font-italic mb-2" v-if="operation==='update'">
  <div class="row" v-if="operation==='update'">
    <img :src="src+sectionpage.img" :alt="sectionpage.img" width="100">
  </div>
</div>
<div class="form-group" v-show="lan_to_edit==='none'" v-else="operation==='update'">
  <label for="img">{{ $trans('messages.Image') }}</label>
  <input type="file" name="img"  v-on:change="img" class="form-control font-italic mb-2" v-if="operation==='add'">
  <input type="file" name="img"  v-on:change="img" class="form-control font-italic mb-2" v-if="operation==='update'">
  <div class="row" v-if="operation==='update'">
    <img :src="src+sectionpage.img" :alt="sectionpage.img" width="100">
  </div>
</div>

<div class="form-group">
  <label for="title">{{ $trans('messages.Title') }}</label>
  <input type="text" name="title" v-model="title" class="form-control font-italic mb-2" v-if="operation==='add'">
  <input type="text" name="title" v-model="sectionpage.title" class="form-control font-italic mb-2" v-if="operation==='update'">
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
    v-model="sectionpage.description"
    :config="config"
    @blur="onBlur($event)"
    @focus="onFocus($event)"
    @contentDom="onContentDom($event)"
    @dialogDefinition="onDialogDefinition($event)"
    @fileUploadRequest="onFileUploadRequest($event)"
    @fileUploadResponse="onFileUploadResponse($event)"
    v-if="operation==='update'"/>
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

            <button type="button" class="btn rounded btn-primary reserva" @click="createSectionPage()" v-show="operation==='add'" v-if="show_lang_div===false">{{ $trans('messages.Translate') }}</button>
            <button type="button" class="btn rounded btn-primary reserva" @click="createSectionPage()" v-show="operation==='add'" v-else>{{ $trans('messages.Create') }}</button>

              <button type="button" class="btn rounded btn-primary reserva" @click="editedSectionPage(sectionpage)" v-if="operation==='update'">{{ $trans('messages.Update') }}</button>

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
      props:['locale','sectionpage','operation','show_lang_div','lan_to_edit'],
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
          transl:'',
          activeClass:'active',
          showClass:'show',
          title:'',
          description:'',
          lang_trans:'',
          map:'',
          value:'',
          email:'',
          imagenSectionPage:'',
          src:'/storage/section_page/',
          ventanaOperSectionPage:false,
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
      axios.get(window.location.origin +'/'+this.locale+'/languages-no-translated/'+this.sectionpage.id+'/Section')
            .then(response=> this.languages=response.data)
            .catch(error=>this.error.push(error));
    },
        createSectionPage:function(){
          let url;
          let msg_succ;
          let data;
          let mensaje;
          let default_lang=this.$lang.getLocale();

          if(this.show_lang_div===false){
            url=window.location.origin +'/'+this.locale+"/admin/add-translate-section";
            msg_succ=this.$trans('messages.Section Page')+' '+this.$trans('messages.Translated Succefully');
            let mensaje=this.$trans('messages.Unidentified error');
            if (this.title==''||this.description==''||this.lang_trans=='') {
              mensaje=this.$trans('messages.You cannot leave empty fields, please check');
            }
            data = new FormData();
              data.append("title", this.title);
              data.append("title_old", this.sectionpage.title);
              data.append("section_id", this.sectionpage.id);
              data.append("lang", this.lang_trans);
              data.append("description", this.description);
          }
          else{
            url=window.location.origin +'/'+this.locale+"/admin/sectionpage";
            msg_succ=this.$trans('messages.Section Page')+' '+this.$trans('messages.Created.');
            mensaje=this.$trans('messages.Unidentified error');
            if (this.img==''||this.title==''||this.description=='') {
              mensaje=this.$trans('messages.You cannot leave empty fields, please check');
            }

            data = new FormData();
              data.append("img", this.imagenSectionPage);
              data.append("title", this.title);
              data.append("lang", this.lang_trans);
              data.append("description", this.description);
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
                          this.$emit('sectionpagenew',roleAdd);

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
                   if(wrong.hasOwnProperty('title')){
                     mensaje+='-'+wrong.title[0];
                   }
                   if(wrong.hasOwnProperty('description')){
                     mensaje+='-'+wrong.description[0];
                   }
                   swal('Error',mensaje,'error');
                   //console.log(error.response.data);
                 });

        },
        editedSectionPage:function(sectionpage){
          let url;
          let data;
          let msg_edited;
          let config= { headers: {"Content-Type": "multipart/form-data" }};
              if(this.lan_to_edit==='none'){
              data = new FormData();
    	          data.append('_method', 'patch');
                data.append("img", this.imagenSectionPage);
                data.append("title", sectionpage.title);
                data.append("description", sectionpage.description);
              url=window.location.origin +'/'+this.locale+"/admin/sectionpage/"+sectionpage.id;
              msg_edited=this.$trans('messages.Section Page')+' '+this.$trans('messages.Edited');
            }
            else{
              data = new FormData();
                data.append("title", sectionpage.title);
                data.append("description", sectionpage.description);
                //data.append("tags", postTags);
                //data.append("keywords", postKeys);
              url=window.location.origin +'/'+this.locale+"/admin/section-translated-edited/"+sectionpage.id+"/"+this.lan_to_edit;
              msg_edited=this.$trans('messages.The')+' '+this.$trans('messages.Section Page')+' '+this.$trans('messages.translation has been successfully modified');
            }
          axios.post(url,data,config)
               .then(response=>{
                 swal({title:this.$trans('messages.Section Page'),
                       text:msg_edited,
                       icon:'success',
                       closeOnClickOutside:false,
                       closeOnEsc:false
                     }).then(select=>{
                       if (select){
                         let sectionpageUpdate=response.data;
                         this.$emit('sectionpageoperupd',sectionpageUpdate);
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
                 if(wrong.hasOwnProperty('title')){
                   mensaje+='-'+wrong.title[0];
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
