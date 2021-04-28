<template>
  <section class="mb-5" id="createCategoryModal" name="createCategoryModal"><!--Formulario createCategoryModal-->
    <form  id="form-create-category">
      <transition class="modal fade pt-5" id="createCategoryModal">
        <div class="modal-mask">
    <div class="modal-wrapper">
    <div class="modal-container">
      <div class="modal-header">
        <slot>
          <h1 class="text-center text-dark" v-if="show_lang_div===false">{{category.name}}</h1>
        <h1 class="text-center text-dark" v-else="operation==='add'">{{ $trans('messages.Create') }} {{ $trans('messages.Category') }}</h1>
        <h1 class="text-center text-dark" v-else="operation==='update'">{{ $trans('messages.Update') }} {{ $trans('messages.Category') }}</h1>
        <button type="button" class="modal-default-button btn btn-lg" @click="$emit('close')"><span aria-hidden="true">&times;</span></button>

        </slot>
      </div>

    <div class="modal-body">
      <slot>
        <div class="container mt-5">
          <div class="row justify-content-center">
            <div class="col-12">

              <div class="form-group">
                <label for="name">{{ $trans('messages.Category') }}</label>
                <input type="text" name="category" v-model="category_post" class="form-control font-italic mb-2" v-if="operation==='add'">
                <input type="text" name="category" v-model="category.category_post" class="form-control font-italic mb-2" v-if="operation==='update'">
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
              v-model="category.description"
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
            <button type="button" class="btn rounded btn-primary reserva" @click="createCategory()" v-show="operation==='add'">{{ $trans('messages.Create') }}</button>

              <button type="button" class="btn rounded btn-primary reserva" @click="editedCategory(category)" v-if="operation==='update'">{{ $trans('messages.Update') }}</button>

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
      props:['locale','category','operation','show_lang_div','lan_to_edit'],
      data(){
        return {
          msgAddTag:this.$trans('messages.Add a new Tag'),
          services: [],
          selectedServs: [],
          functions: [],
          selectedFunc: [],
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
          showClass:'show',
          description:'',
          lang_trans:'',
          price:'',
          map:'',
          value:'',
          category_post:'',
          name_button:'',
          src:window.location.origin +'/'+'images/lang/',
          ventanaOperCategory:false,
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
        createCategory:function(){
          let url;
          let msg_succ;
          let data;
          let mensaje;
          let default_lang=this.$lang.getLocale();

            url=window.location.origin +'/'+this.locale+"/admin/category";
            msg_succ=this.$trans('messages.Category')+' '+this.$trans('messages.Created.');
            mensaje=this.$trans('messages.Unidentified error');
            if (this.category_post==''||this.description=='') {
              mensaje=this.$trans('messages.You cannot leave empty fields, please check');
            }

            data = new FormData();
              data.append("category_post", this.category_post);
              data.append("description", this.description);



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
                          this.$emit('categorynew',roleAdd);

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
                   if(wrong.hasOwnProperty('category_post')){
                     mensaje+='-'+wrong.category_post[0];
                   }
                   if(wrong.hasOwnProperty('description')){
                     mensaje+='-'+wrong.description[0];
                   }
                   swal('Error',mensaje,'error');
                   //console.log(error.response.data);
                 });

        },
        editedCategory:function(category){
          let url;
          let data;
          let msg_edited;
          let config= { headers: {"Content-Type": "multipart/form-data" }};

                data = new FormData();
      	          data.append('_method', 'patch');
                  data.append("category_post", category.category_post);
                  data.append("description", category.description);
                url=window.location.origin +'/'+this.locale+"/admin/category/"+category.id;
                msg_edited=this.$trans('messages.Category')+' '+this.$trans('messages.Edited');



          axios.post(url,data,config)
               .then(response=>{
                 swal({title:this.$trans('messages.Category'),
                       text:msg_edited,
                       icon:'success',
                       closeOnClickOutside:false,
                       closeOnEsc:false
                     }).then(select=>{
                       if (select){
                         let categoryUpdate=response.data;
                         this.$emit('categoryperupd',categoryUpdate);
                       }
                     });
                 //console.log(response);
               })
               .catch(error=>{
                 if(error.response.data.message){
                   swal('Error',''+error.response.data.message,'error');
                 }
                 let wrong=error.response.data.errors;
                 if(wrong.hasOwnProperty('category_post')){
                   mensaje+='-'+wrong.category_post[0];
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
