<template>
  <section class="mb-5" id="createChatRoomModal" name="createChatRoomModal"><!--Formulario createChatRoomModal-->
    <form  id="form-create-chat-room">
      <transition class="modal fade pt-5" id="createChatRoomModalModal">
        <div class="modal-mask">
    <div class="modal-wrapper">
    <div class="modal-container">
      <div class="modal-header">
        <slot>
        <h1 class="text-center text-dark" v-if="operation==='add'">{{ $trans('messages.Create') }} {{ $trans('messages.Chat') }} {{ $trans('messages.Room') }}</h1>
        <h1 class="text-center text-dark" v-else="operation==='update'">{{ $trans('messages.Update') }} {{ $trans('messages.Chat') }} {{ $trans('messages.Room') }}</h1>
        <button type="button" class="modal-default-button btn btn-lg" @click="$emit('close')"><span aria-hidden="true">&times;</span></button>

        </slot>
      </div>

    <div class="modal-body">
      <slot>
        <div class="container mt-5">
          <div class="row justify-content-center">
            <div class="col-12">


              <div class="form-group" v-show="show_lang_div" v-if="operation==='add'">
                <label for="name">{{ $trans('messages.Name') }}</label>
                <input type="name" name="name" v-model="name" class="form-control font-italic mb-2" v-if="operation==='add'">
                <input type="name" name="name" v-model="roomchat.name" class="form-control font-italic mb-2" v-if="operation==='update'">
              </div>

              <div class="form-group" v-show="lan_to_edit==='none'" v-else="operation==='update'">
                <label for="name">{{ $trans('messages.Name') }}</label>
                <input type="name" name="name" v-model="name" class="form-control font-italic mb-2" v-if="operation==='add'">
                <input type="name" name="name" v-model="roomchat.name" class="form-control font-italic mb-2" v-if="operation==='update'">
              </div>

              <div class="form-group" v-show="show_lang_div" v-if="operation==='add'">
                <label for="type">{{ $trans('messages.Type') }}</label>
                <select class="form-control" v-model="type" name="type" required>
                 <option value=''>{{ $trans('messages.Select') }} {{ $trans('messages.Type') }}</option>
                   <option v-for="typ in types" :value="typ.id">{{typ.name}}</option>
                </select>
              </div>

              <div class="form-group" v-show="lan_to_edit==='none'" v-else="operation==='update'">
                <label for="type">{{ $trans('messages.Type') }}</label>
                <select class="form-control" v-model="type" name="type" required>
                 <option value=''>{{ $trans('messages.Select') }} {{ $trans('messages.Type') }}</option>
                   <option v-for="typ in types" :selected="roomchat.type_id === typ.id" :value="typ.id">{{typ.name}}</option>
                </select>
              </div>


          <div class="custom-control custom-checkbox " v-show="show_lang_div" v-if="operation==='add'">{{ $trans('messages.Users') }}:
            <span aria-hidden="true"><label :for="'user_'+user.key" v-for="user in users" class="badge badge-pill badge-primary h3">
              {{user.value}} <input type="checkbox" :name="'user_'+user.key" :id="'user_'+user.key" v-model="selectedUsers" class="ml-1" :value="user.key"></label></span>
          </div>

          <div class="custom-control custom-checkbox " v-show="lan_to_edit==='none'" v-else="operation==='update'">{{ $trans('messages.Users') }}:
            <span aria-hidden="true"><label :for="'user_'+user.key" v-for="user in users" class="badge badge-pill badge-primary h3">
              {{user.value}} <input type="checkbox" :name="'user_'+user.key" :id="'user_'+user.key" v-model="user['checked']" class="ml-1" :value="user.key"></label></span>
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
            <button type="button" class="btn rounded btn-primary reserva" @click="createChatRoom()" v-show="operation==='add'">{{ $trans('messages.Create') }}</button>

              <button type="button" class="btn rounded btn-primary reserva" @click="editedChatRoom(roomchat)" v-if="operation==='update'">{{ $trans('messages.Update') }}</button>

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
      props:['locale','roomchat','operation','show_lang_div','lan_to_edit'],
      data(){
        return {
          msgAddTag:this.$trans('messages.Add a new Tag'),
          users: [],
          user:[],
          selectedUsers: [],
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
          type:'',
          types:[],
          typ:[],
          address:'',
          lang_trans:'',
          map:'',
          value:'',
          name:'',
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
    getRoomTypes:function(){
      axios.get('/room-types-list')
           .then(response =>{
              this.types = response.data;
            })
           .catch(error => this.errors.push(error));
    },
    getUsers:function(){
      axios.get('/available-users')
           .then(response =>{
              this.users = response.data;
              if(this.operation==='update'){
              for(var i=0;i<this.users.length;i++){
                for(var n=0;n<this.roomchat.users.length;n++){
                  if(this.users[i].key===this.roomchat.users[n].id){
                    this.users[i]['checked']=true;
                    break;
                  }
                  else{
                    this.users[i]['checked']=false;
                  }
                }
              }
              }
            })
           .catch(error => this.errors.push(error));
    },
        createChatRoom:function(){
          let url;
          let msg_succ;
          let data;
          let mensaje;
          let default_lang=this.$lang.getLocale();

            url="/room-chat";
            msg_succ=this.$trans('messages.Chat')+' '+this.$trans('messages.Room')+' '+this.$trans('messages.Created.');
            mensaje=this.$trans('messages.Unidentified error');
            if (this.name==''||this.type==''||this.selectedUsers.length==0) {
              mensaje=this.$trans('messages.You cannot leave empty fields, please check');
            }

            data = new FormData();
              data.append("name", this.name);
              data.append("type_id", this.type);
              data.append("selectedUsers", this.selectedUsers);

            axios.post(url,data)
                 .then(response=>{
                   swal({title:this.$trans('messages.Correct data'),
                         text:msg_succ,
                         icon:'success',
                         closeOnClickOutside:false,
                         closeOnEsc:false
                       }).then(select=>{
                         if (select){
                           let roomchatAdd=response.data;
                          this.$emit('roomchatnew',roomchatAdd);

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
                   if(wrong.hasOwnProperty('type_id')){
                     mensaje+='-'+wrong.type_id[0];
                   }
                   swal('Error',mensaje,'error');
                   //console.log(error.response.data);
                 });

        },
        editedChatRoom:function(roomchat){
          let url;
          let data;
          let msg_edited;
          let config= { headers: {"Content-Type": "multipart/form-data" }};
          let users_array=[];
          for(var t=0;t<this.users.length;t++){
            if(this.users[t].checked){
              users_array.push(this.users[t].key);
            }
          }
            data = new FormData();
    	          data.append('_method', 'patch');
                data.append("name", roomchat.name);
                data.append("type_id", this.type);
                data.append("users", users_array);
              url="/room-chat/"+roomchat.id;
              msg_edited=this.$trans('messages.Chat')+' '+this.$trans('messages.Room')+' '+this.$trans('messages.Edited');

          axios.post(url,data,config)
               .then(response=>{
                 swal({title:this.$trans('messages.Room')+' '+this.$trans('messages.Chat'),
                       text:msg_edited,
                       icon:'success',
                       closeOnClickOutside:false,
                       closeOnEsc:false
                     }).then(select=>{
                       if (select){
                         let roomchatUpdate=response.data;
                         this.$emit('roomchatoperupd',roomchatUpdate);
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
                 if(wrong.hasOwnProperty('type_id')){
                   mensaje+='-'+wrong.type_id[0];
                 }
                 swal('Error',mensaje,'error');
                 //console.log(error.response.data);
               });
        },
      },
      created: function () {
        this.type=this.roomchat.type_id;
        this.getUsers();
        this.getRoomTypes();
         },
        mounted() {
        }
    }
</script>
