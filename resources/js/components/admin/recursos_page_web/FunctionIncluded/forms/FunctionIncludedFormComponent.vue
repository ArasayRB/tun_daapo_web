<template>
  <section class="mb-5" id="createFunctionIncludedModal" name="createFunctionIncludedModal"><!--Formulario createFunctionIncludedModal-->
    <form  id="form-create-user">
      <transition class="modal fade pt-5" id="createFunctionIncludedModalModal">
        <div class="modal-mask">
    <div class="modal-wrapper">
    <div class="modal-container">
      <div class="modal-header">
        <slot>
        <h1 class="text-center text-dark" v-if="operation==='add'">{{ $trans('messages.Create') }} {{ $trans('messages.Functions Included') }}</h1>
        <h1 class="text-center text-dark" v-if="operation==='update'">{{ $trans('messages.Update') }} {{ $trans('messages.Functions Included') }}</h1>
        <button type="button" class="modal-default-button btn btn-lg" @click="$emit('close')"><span aria-hidden="true">&times;</span></button>

        </slot>
      </div>

    <div class="modal-body">
      <slot>
        <div class="container mt-5">
          <div class="row justify-content-center">
            <div class="col-12">

<div class="form-group">
  <label for="name">{{ $trans('messages.Name') }}</label>
  <vue-ckeditor
   v-model="name"
   :config="config"
   @blur="onBlur($event)"
   @focus="onFocus($event)"
   @contentDom="onContentDom($event)"
   @dialogDefinition="onDialogDefinition($event)"
   @fileUploadRequest="onFileUploadRequest($event)"
   @fileUploadResponse="onFileUploadResponse($event)"
   v-if="operation==='add'"/>
   <vue-ckeditor
    v-model="functionsincluded.name"
    :config="config"
    @blur="onBlur($event)"
    @focus="onFocus($event)"
    @contentDom="onContentDom($event)"
    @dialogDefinition="onDialogDefinition($event)"
    @fileUploadRequest="onFileUploadRequest($event)"
    @fileUploadResponse="onFileUploadResponse($event)"
    v-if="operation==='update'"/>
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
    v-model="functionsincluded.description"
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
            <button type="button" class="btn rounded btn-primary reserva" @click="createFunctionIncluded()" v-if="operation==='add'">{{ $trans('messages.Create') }}</button>

              <button type="button" class="btn rounded btn-primary reserva" @click="editedFunctionsIncluded(functionsincluded)" v-if="operation==='update'">{{ $trans('messages.Update') }}</button>

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
      props:['locale','functionsincluded','operation'],
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
          showClass:'show',
          name:'',
          description:'',
          value:'',
          ventanaOperFunctionsIncluded:false,
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
        createFunctionIncluded:function(){

            let  url="/functions-included";
            let msg_succ=this.$trans('messages.Functions Included')+' '+this.$trans('messages.Created.');
            let mensaje=this.$trans('messages.Unidentified error');
            if (this.name=='') {
              mensaje=this.$trans('messages.You cannot leave empty fields, please check');
            }

            let data = new FormData();
              data.append("name", this.name);
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
                          this.$emit('functionsincludednew',roleAdd);

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
        editedFunctionsIncluded:function(functionsincluded){
          let url;
          let data;
          let msg_edited;
          let config= { headers: {"Content-Type": "multipart/form-data" }};

              data = new FormData();
    	          data.append('_method', 'patch');
                data.append("name", functionsincluded.name);
                data.append("description", functionsincluded.description);
              url="/functions-included/"+functionsincluded.id;
              msg_edited=this.$trans('messages.Functions Included')+' '+this.$trans('messages.Edited');

          axios.post(url,data,config)
               .then(response=>{
                 swal({title:this.$trans('messages.Functions Included'),
                       text:msg_edited,
                       icon:'success',
                       closeOnClickOutside:false,
                       closeOnEsc:false
                     }).then(select=>{
                       if (select){
                         let functionsincludedUpdate=response.data;
                         this.$emit('functionsincludedoperupd',functionsincludedUpdate);
                       }
                     });
                 //console.log(response);
               })
               .catch(error=>{
                 if(error.response.data.message){
                   swal('Error',''+error.response.data.message,'error');
                 }
                 let wrong=error.response.data.errors;
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

         },
        mounted() {
        }
    }
</script>
