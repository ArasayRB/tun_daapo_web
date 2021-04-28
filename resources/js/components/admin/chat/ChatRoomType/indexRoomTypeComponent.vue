<template>
  <div>
  <div class="row py-lg-2">
    <div class="col-md-6">
      <h1 class="h3 mb-2 text-gray-800">{{ $trans('messages.Chat') }} {{ $trans('messages.Room') }} {{ $trans('messages.Type') }}</h1>
    </div>
    <div class="col-md-6">
      <a href="#" @click="openAddRoomTypeChat()" class="btn btn-primary btn-lg float-md-right" permission="button" aria-pressed="true">{{ $trans('messages.Add') }}</a>
    </div>

  </div>
  <div class="card shadow mb-4">
    <roomt-chat-oper-form-component @roomtchatnew="addRoomTChatIndex" @roomtchatoperupd="updRoomTChatIndex" :operation="operation" :lan_to_edit="lan_to_edit" :roomtchat="roomtchat" :locale="locale" :show_lang_div="show_lang_div" v-if="ventanaOperRoomTChat" @close="ventanaOperRoomTChat = false">

    </roomt-chat-oper-form-component>
    <div class="card-header py-3">
      <div class="row input-group">
      <h6 class="m-0 font-weight-bold text-primary col">{{ $trans('messages.List') }}</h6>
      <!-- Topbar Search -->
      <input-searcher-component :url="'/admin/all-room-types-chats'" :locale="locale" :emit="'roomtchats'" @cancelsearch="roomTList" @roomtchatsfilter="filtersRoomsTChat">
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
        <paginate class="pt-5 mt-3" ref="paginator" name = "roomtchats" :list = "roomtchats" :per = "2" :key="roomtchats ? roomtchats.length:0">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.Name') }}</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.Name') }}</th>
            </tr>
          </tfoot>
          <tbody>


                <tr v-for="(roomtchat,index) in paginated('roomtchats')" :roomtchat="roomtchat" :key="roomtchat.id">

                    <td>
                      <a href="#" @click="openEditRoomTChat(index,roomtchat)"><i class="fa fa-edit" title="Edit/Editar"></i></a>
                        <a href="#" @click="deleteRoomTChat(index,roomtchat.id)"><i class="fa fa-trash-alt" title="Delete/Eliminar"></i></a>
                   </td>
                    <td>{{roomtchat.name}}</td>

                </tr>



          </tbody>
        </table>
      </paginate>
           <strong class="text-primary">
             <paginate-links for="roomtchats" :show-step-links="true"></paginate-links>
             <paginate-links
            for="roomtchats"
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
          roomtchats:[],
          roomtchat:[],
          permission_state:[],
          paginate:['roomtchats'],
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
          locale:this.$attrs.locale,
          ventanaOperRoomTChat:false,
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
    filtersRoomsTChat:function(filters){
      this.roomtchats=filters;
    },
        roomTList:function(){
          axios.get(window.location.origin +'/'+this.$attrs.locale+'/admin/room-types-list')
               .then(response =>{
                 this.roomtchats = response.data;
                 if (response.data==''){
                   this.mensage=this.$trans('messages.None added yet');
                 }
               })
               .catch(error => this.errors.push(error));
        },
        addRoomTChatIndex:function(permissionAdd){
          this.operation='';
          this.roomTList();
          this.mensage="";
          this.show_lang_div=false;
          this.ventanaOperRoomTChat=false;
        },
        updRoomTChatIndex:function(roomtchatUpd){
          this.operation='';
          this.show_lang_div=false;
          const position=this.roomtchats.findIndex(roomtchat=>roomtchat.id===roomtchatUpd.id);
          this.roomTList();
          this.ventanaOperRoomTChat=false;
        },
        deleteRoomTChat:function(index,roomtchat){
          let roomtchat_id=roomtchat;
            swal({title:this.$trans('messages.Delete')+' '+this.$trans('messages.Room')+' '+this.$trans('messages.Type')+' '+this.$trans('messages.Chat'),
                  text:this.$trans('messages.Are you completely sure you want to delete ')+this.$trans('messages.Room')+' '+this.$trans('messages.Type')+' '+this.$trans('messages.Chat')+'?',
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
                    let  url=window.location.origin +'/'+this.$attrs.locale+'/admin/room-type-chat/'+roomtchat_id;
                    axios.delete(url)
                         .then(response=>{
                           swal({title:this.$trans('messages.Correct data'),
                                 text:this.$trans('messages.Room')+' '+this.$trans('messages.Type')+' '+this.$trans('messages.Chat')+' '+this.$trans('messages.Deleted'),
                                 icon:'success',
                                 closeOnClickOutside:false,
                                 closeOnEsc:false
                               }).then(select=>{
                                 if (select){
                                   this.roomTList();
                                   if(this.roomtchats.length===0){
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
        openAddTranslate:function(index,roomtchat){
          this.roomtchat=roomtchat;
          this.show_lang_div=false;
          this.operation='add';
          this.ventanaOperRoomTChat = true;
        },
        openAddRoomTypeChat:function(){
          this.show_lang_div=true;
          this.operation='add';
          this.ventanaOperRoomTChat = true;
        },
        openEditRoomTChat:function(index,roomtchat){
          this.operation='update';
          this.lan_to_edit='none';
        this.roomtchat=roomtchat;
          this.ventanaOperRoomTChat=true;

        },

      },
      created: function () {
        this.roomTList();
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
