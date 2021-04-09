<template>
  <div>
  <div class="row py-lg-2">
    <div class="col-md-6">
      <h1 class="h3 mb-2 text-gray-800">{{ $trans('messages.Chat') }} {{ $trans('messages.Room') }}</h1>
    </div>
    <div class="col-md-6">
      <a href="#" @click="openAddRoomChat()" class="btn btn-primary btn-lg float-md-right" permission="button" aria-pressed="true">{{ $trans('messages.Add') }}</a>
    </div>

  </div>
  <div class="card shadow mb-4">
    <room-chat-oper-form-component @roomchatnew="addRoomChatIndex" @roomchatoperupd="updRoomChatIndex" :operation="operation" :lan_to_edit="lan_to_edit" :roomchat="roomchat" :locale="locale" :show_lang_div="show_lang_div" v-if="ventanaOperRoomChat" @close="ventanaOperRoomChat = false">

    </room-chat-oper-form-component>
    <div class="card-header py-3">
      <div class="row input-group">
      <h6 class="m-0 font-weight-bold text-primary col">{{ $trans('messages.List') }}</h6>
      <!-- Topbar Search -->
      <input-searcher-component :url="'/all-room-chats'" :emit="'roomchats'" @cancelsearch="roomList" @roomchatsfilter="filtersRoomsChat">
    </input-searcher-component>

    </div>
    </div>
    <div class="alert alert-success" v-if="mensage!=''">
      <ul>
        <li>{{mensage}}</li>
      </ul>
    </div>
    <div class="card-body">

      <div class="table-responsive">
        <paginate class="pt-5 mt-3" ref="paginator" name = "roomchats" :list = "roomchats" :per = "2" :key="roomchats ? roomchats.length:0">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.Name') }}</th>
              <th>{{ $trans('messages.Type') }}</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.Name') }}</th>
              <th>{{ $trans('messages.Type') }}</th>
            </tr>
          </tfoot>
          <tbody>


                <tr v-for="(roomchat,index) in paginated('roomchats')" :roomchat="roomchat" :key="roomchat.id">

                    <td>
                      <a href="#" @click="openEditRoomChat(index,roomchat)"><i class="fa fa-edit" title="Edit/Editar"></i></a>
                        <a href="#" @click="deleteRoomChat(index,roomchat.id)"><i class="fa fa-trash-alt" title="Delete/Eliminar"></i></a>
                   </td>
                    <td>{{roomchat.name}}</td>
                    <td>{{roomchat.type.name}}</td>

                </tr>



          </tbody>
        </table>
      </paginate>
           <strong class="text-primary">
             <paginate-links for="roomchats" :show-step-links="true"></paginate-links>
             <paginate-links
            for="roomchats"
            :show-step-links="true"
            :simple="{
                prev: $trans('messages.Previous'),
                next: $trans('messages.Next')
            }"
           ></paginate-links>

      </strong>
      </div>
    </div>
  </div>
  </div>
</template>
<style>
  .paginate-links{
    width:100%;
    list-style: none;
    text-align: center;
}
.paginate-links li {
    display: inline;
    background-color:#1fa9ed;
    color:white;
    padding:0.5rem;
    margin-left:0.3rem;
    margin-right: 0.3rem;
    cursor:pointer;
    border-radius: 3px;
}
.paginate-result{
    width: 100%;
    text-align:center;
    margin-bottom: 1rem;
}
</style>
<script>
  import VueCkeditor from 'vue-ckeditor2';
  export default {
      components: { VueCkeditor },
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
          roomchats:[],
          roomchat:[],
          permission_state:[],
          paginate:['roomchats'],
          permissionActualizar:false,
          idpermissionActualizar:-1,
          value:'',
          operation:'',
          translated_languages:[],
          id:'',
          mensage:'',
          valueImg:'',
          show_lang_div:false,
          lan_to_edit:'none',
          lang:true,
          locale:'',
          ventanaOperRoomChat:false,
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
    filtersRoomsChat:function(filters){
      this.roomchats=filters;
    },
        roomList:function(){
          axios.get('/room-chat-list')
               .then(response =>{
                 this.roomchats = response.data;
                 if (response.data==''){
                   this.mensage=this.$trans('messages.None added yet');
                 }
               })
               .catch(error => this.errors.push(error));
        },
        addRoomChatIndex:function(permissionAdd){
          this.operation='';
          this.roomList();
          this.mensage="";
          this.show_lang_div=false;
          this.ventanaOperRoomChat=false;
        },
        updRoomChatIndex:function(roomchatUpd){
          this.operation='';
          this.show_lang_div=false;
          const position=this.roomchats.findIndex(roomchat=>roomchat.id===roomchatUpd.id);
          this.roomList();
          this.ventanaOperRoomChat=false;
        },
        deleteRoomChat:function(index,roomchat){
          let roomchat_id=roomchat;
            swal({title:this.$trans('messages.Delete')+' '+this.$trans('messages.Room')+' '+this.$trans('messages.Chat'),
                  text:this.$trans('messages.Are you completely sure you want to delete ')+this.$trans('messages.Room')+' '+this.$trans('messages.Chat')+'?',
                  icon:'warning',
                  closeOnClickOutside:false,
                  closeOnEsc:false,
                  buttons:true,
                  dangerMode:true,
                  showCancelButton: true,
                  confirmButtonText: this.$trans('messages.Yes, delete'),
                  cancelButtonText: this.$trans('messages.Cancel'),
                }).then(select=>{
                  if (select){
                    let  url='/room-chat/'+roomchat_id;
                    axios.delete(url)
                         .then(response=>{
                           swal({title:this.$trans('messages.Correct data'),
                                 text:this.$trans('messages.Room')+' '+this.$trans('messages.Chat')+' '+this.$trans('messages.Deleted'),
                                 icon:'success',
                                 closeOnClickOutside:false,
                                 closeOnEsc:false
                               }).then(select=>{
                                 if (select){
                                   this.roomList();
                                   if(this.roomchats.length===0){
                                     this.mensage=this.$trans('messages.None added yet');
                                   }
                                 }
                               });
                         })
                         .catch(error=>{
                           console.log(error.response.data.errors);
                           let wrong=error.response.data.errors;
                           swal('Error',mensaje,'error');
                         });
                  }
                });


        },
        openAddTranslate:function(index,roomchat){
          this.roomchat=roomchat;
          this.show_lang_div=false;
          this.operation='add';
          this.ventanaOperRoomChat = true;
        },
        openAddRoomChat:function(){
          this.show_lang_div=true;
          this.operation='add';
          this.ventanaOperRoomChat = true;
        },
        openEditRoomChat:function(index,roomchat){
          this.operation='update';
          this.lan_to_edit='none';
        this.roomchat=roomchat;
          this.ventanaOperRoomChat=true;

        },

      },
      created: function () {
        this.roomList();
         },
        mounted() {
          if (this.$attrs.locale) {
               this.$lang.setLocale(this.$attrs.locale);
               }
          else {
            this.$lang.setLocale('en');
          }
        }
    }
</script>
