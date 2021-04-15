<template>
  <section class="mb-5" id="createCommentsModal" name="createCommentsModal"><!--Formulario createCommentsModal-->
    <form  id="form-create-comment">
      <transition class="modal fade pt-5" id="createCommentsModal">
        <div class="modal-mask">
    <div class="modal-wrapper">
    <div class="modal-container">
      <div class="modal-header">
        <slot>
          <h1 class="text-center text-dark" v-if="show_lang_div===false">{{comment.fullName}}</h1>
        <h1 class="text-center text-dark" v-else="operation==='replay'">{{ $trans('messages.Reply') }} {{ $trans('messages.Comment') }}: {{comment.fullName}}</h1>
        <h1 class="text-center text-dark" v-else="operation==='update'">{{ $trans('messages.Update') }} {{ $trans('messages.Comment') }}</h1>
        <button type="button" class="modal-default-button btn btn-lg" @click="$emit('close')"><span aria-hidden="true">&times;</span></button>

        </slot>
      </div>

    <div class="modal-body">
      <slot>
        <div class="container mt-5">
          <div class="row justify-content-center">
            <div class="col-12">

              <div class="form-group"  v-if="operation==='update'">
                <label for="name">{{ $trans('messages.Name') }}</label>
                <input type="text" name="fullName" v-model="comment.fullName" class="form-control font-italic mb-2" disabled>
              </div>

              <div class="form-group"  v-if="operation==='update'">
                <label for="email">{{ $trans('messages.Email') }}</label>
                <input type="text" name="email" v-model="comment.email" class="form-control font-italic mb-2" disabled>
              </div>

              <div class="form-group" v-if="operation==='replay'">
                <label for="answer-to">{{ $trans('messages.Answer To') }}</label>
                <input type="text" name="answer-to" v-model="comment.comment" class="form-control font-italic mb-2" disabled>
              </div>

              <div class="form-group" v-if="show_lang_div===true">
                <label for="post">{{ $trans('messages.Post') }}</label>
                <select class="form-control" v-model="pos" name="post" disabled>
                 <option value=''>{{ $trans('messages.Select') }} {{ $trans('messages.Post') }}</option>
                   <option v-for="post in posts" :value="post.id" :selected=" comment.post_id=== post.id" selected>{{post.title}}</option>
                </select>
              </div>

              <div class="form-group">
                <label for="comment">{{ $trans('messages.Comment') }}</label>
                <vue-ckeditor
                 v-model="comment_writer"
                 v-if="operation==='replay'"
                 :config="config"
                 @blur="onBlur($event)"
                 @focus="onFocus($event)"
                 @contentDom="onContentDom($event)"
                 @dialogDefinition="onDialogDefinition($event)"
                 @fileUploadRequest="onFileUploadRequest($event)"
                 @fileUploadResponse="onFileUploadResponse($event)" />
                 <vue-ckeditor
                  v-model="comment.comment"
                  v-if="operation==='update'"
                  :config="config"
                  @blur="onBlur($event)"
                  @focus="onFocus($event)"
                  @contentDom="onContentDom($event)"
                  @dialogDefinition="onDialogDefinition($event)"
                  @fileUploadRequest="onFileUploadRequest($event)"
                  @fileUploadResponse="onFileUploadResponse($event)" />
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
            <button type="button" class="btn rounded btn-primary reserva" @click="createComment()" v-show="operation==='replay'">{{ $trans('messages.Answer') }}</button>

              <button type="button" class="btn rounded btn-primary reserva" @click="editedComment(comment)" v-if="operation==='update'">{{ $trans('messages.Update') }}</button>

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
      props:['locale','comment','operation','show_lang_div','lan_to_edit'],
      data(){
        return {
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
          msgAddTag:this.$trans('messages.Add a new Tag'),
          activeClass:'active',
          showClass:'show',
          comment_writer:'',
          posts:[],
          pos:'',
          comment_reply:'',
          email:'',
          lang_trans:'',
          value:'',
          fullName:'',
          src:'images/lang/',
          ventanaOperConfigComment:false,
          error:'',
          token   : window.CSRF_TOKEN,

        }
      },
      methods:{
        createComment:function(){
          let url;
          let msg_succ;
          let data;
          let mensaje;
          let default_lang=this.$lang.getLocale();

            url="/comments-post";
            msg_succ=this.$trans('messages.Comment')+' '+this.$trans('messages.Created.');
            mensaje=this.$trans('messages.Unidentified error');
            if (this.comment_writer==''||this.pos=='') {
              mensaje=this.$trans('messages.You cannot leave empty fields, please check');
            }

            data = new FormData();
              data.append("comment_reply", this.comment.id);
              data.append("message", this.comment_writer);
              data.append("post_id", this.pos);



            axios.post(url,data)
                 .then(response=>{
                   swal({title:this.$trans('messages.Correct data'),
                         text:msg_succ,
                         icon:'success',
                         closeOnClickOutside:false,
                         closeOnEsc:false
                       }).then(select=>{
                         if (select){
                           let commentAdd=response.data;
                          this.$emit('commentnew',commentAdd);

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
                   if(wrong.hasOwnProperty('comment_reply')){
                     mensaje+='-'+wrong.comment_reply[0];
                   }
                   if(wrong.hasOwnProperty('message')){
                     mensaje+='-'+wrong.message[0];
                   }
                   if(wrong.hasOwnProperty('post_id')){
                     mensaje+='-'+wrong.post_id[0];
                   }
                   swal('Error',mensaje,'error');
                   //console.log(error.response.data);
                 });

        },
        editedComment:function(comment){
          let url;
          let data;
          let msg_edited;
          let config= { headers: {"Content-Type": "multipart/form-data" }};

                data = new FormData();
      	          data.append('_method', 'patch');
                  data.append("fullName", comment.fullName);
                  data.append("email", comment.email);
                  data.append("message", comment.comment);
                  data.append("post_id", this.pos);
                url="/comments-post/"+comment.id;
                msg_edited=this.$trans('messages.Comment')+' '+this.$trans('messages.Edited');



          axios.post(url,data,config)
               .then(response=>{
                 swal({title:this.$trans('messages.Comment'),
                       text:msg_edited,
                       icon:'success',
                       closeOnClickOutside:false,
                       closeOnEsc:false
                     }).then(select=>{
                       if (select){
                         let confCommentUpdate=response.data;
                         this.$emit('commentperupd',confCommentUpdate);
                       }
                     });
                 //console.log(response);
               })
               .catch(error=>{
                 if(error.response.data.message){
                   swal('Error',''+error.response.data.message,'error');
                 }
                 let wrong=error.response.data.errors;
                 if(wrong.hasOwnProperty('fullName')){
                   mensaje+='-'+wrong.fullName[0];
                 }
                 if(wrong.hasOwnProperty('email')){
                   mensaje+='-'+wrong.email[0];
                 }
                 if(wrong.hasOwnProperty('message')){
                   mensaje+='-'+wrong.message[0];
                 }
                 if(wrong.hasOwnProperty('post_id')){
                   mensaje+='-'+wrong.post_id[0];
                 }
                 swal('Error',mensaje,'error');
                 //console.log(error.response.data);
               });
        },
        postsList:function(){
          axios.get('/posts-list')
               .then(response => this.posts = response.data)
               .catch(error => this.errors.push(error));
        },
      },
      created: function () {
        if(this.operation==='replay'){
          this.comment_reply=this.comment.id;
        }
        this.postsList();
          this.pos=this.comment.post_id;
         },
        mounted() {
        }
    }
</script>
