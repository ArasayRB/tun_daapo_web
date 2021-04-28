<template>
  <div>
  <div class="row py-lg-2">
    <div class="col-md-6">
      <h1 class="h3 mb-2 text-gray-800">{{ $trans('messages.Chat') }} {{ $trans('messages.Message') }} {{ $trans('messages.Type') }}</h1>
    </div>
    <div class="col-md-6">
      <a href="#" @click="openAddMssgTypeChat()" class="btn btn-primary btn-lg float-md-right" permission="button" aria-pressed="true">{{ $trans('messages.Add') }}</a>
    </div>

  </div>
  <div class="card shadow mb-4">
    <mssgt-chat-oper-form-component @mssgtchatnew="addMssgTChatIndex" @mssgtchatoperupd="updMssgTChatIndex" :operation="operation" :lan_to_edit="lan_to_edit" :mssgtchat="mssgtchat" :locale="locale" :show_lang_div="show_lang_div" v-if="ventanaOperMssgTChat" @close="ventanaOperMssgTChat = false">

    </mssgt-chat-oper-form-component>
    <div class="card-header py-3">
      <div class="row input-group">
      <h6 class="m-0 font-weight-bold text-primary col">{{ $trans('messages.List') }}</h6>
      <!-- Topbar Search -->
      <input-searcher-component :url="'/admin/all-mssg-types-chats'" :locale="locale" :emit="'mssgtchats'" @cancelsearch="mssgTList" @mssgtchatsfilter="filtersMssgTChat">
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
        <paginate class="pt-5 mt-3" ref="paginator" name = "mssgtchats" :list = "mssgtchats" :per = "2" :key="mssgtchats ? mssgtchats.length:0">
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


                <tr v-for="(mssgtchat,index) in paginated('mssgtchats')" :mssgtchat="mssgtchat" :key="mssgtchat.id">

                    <td>
                      <a href="#" @click="openEditMssgTChat(index,mssgtchat)"><i class="fa fa-edit" title="Edit/Editar"></i></a>
                        <a href="#" @click="deleteMssgTChat(index,mssgtchat.id)"><i class="fa fa-trash-alt" title="Delete/Eliminar"></i></a>
                   </td>
                    <td>{{mssgtchat.name}}</td>

                </tr>



          </tbody>
        </table>
      </paginate>
           <strong class="text-primary">
             <paginate-links for="mssgtchats" :show-step-links="true"></paginate-links>
             <paginate-links
            for="mssgtchats"
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
          mssgtchats:[],
          mssgtchat:[],
          permission_state:[],
          paginate:['mssgtchats'],
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
          ventanaOperMssgTChat:false,
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
    filtersMssgTChat:function(filters){
      this.mssgtchats=filters;
    },
        mssgTList:function(){
          axios.get(window.location.origin +'/'+this.$attrs.locale+'/admin/mssg-types-list')
               .then(response =>{
                 this.mssgtchats = response.data;
                 if (response.data==''){
                   this.mensage=this.$trans('messages.None added yet');
                 }
               })
               .catch(error => this.errors.push(error));
        },
        addMssgTChatIndex:function(permissionAdd){
          this.operation='';
          this.mssgTList();
          this.mensage="";
          this.show_lang_div=false;
          this.ventanaOperMssgTChat=false;
        },
        updMssgTChatIndex:function(mssgtchatUpd){
          this.operation='';
          this.show_lang_div=false;
          const position=this.mssgtchats.findIndex(mssgtchat=>mssgtchat.id===mssgtchatUpd.id);
          this.mssgTList();
          this.ventanaOperMssgTChat=false;
        },
        deleteMssgTChat:function(index,mssgtchat){
          let mssgtchat_id=mssgtchat;
            swal({title:this.$trans('messages.Delete')+' '+this.$trans('messages.Message')+' '+this.$trans('messages.Type')+' '+this.$trans('messages.Chat'),
                  text:this.$trans('messages.Are you completely sure you want to delete ')+this.$trans('messages.Message')+' '+this.$trans('messages.Type')+' '+this.$trans('messages.Chat')+'?',
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
                    let  url=window.location.origin +'/'+this.$attrs.locale+'/admin/mssg-type-chat/'+mssgtchat_id;
                    axios.delete(url)
                         .then(response=>{
                           swal({title:this.$trans('messages.Correct data'),
                                 text:this.$trans('messages.Message')+' '+this.$trans('messages.Type')+' '+this.$trans('messages.Chat')+' '+this.$trans('messages.Deleted'),
                                 icon:'success',
                                 closeOnClickOutside:false,
                                 closeOnEsc:false
                               }).then(select=>{
                                 if (select){
                                   this.mssgTList();
                                   if(this.mssgtchats.length===0){
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
        openAddTranslate:function(index,mssgtchat){
          this.mssgtchat=mssgtchat;
          this.show_lang_div=false;
          this.operation='add';
          this.ventanaOperMssgTChat = true;
        },
        openAddMssgTypeChat:function(){
          this.show_lang_div=true;
          this.operation='add';
          this.ventanaOperMssgTChat = true;
        },
        openEditMssgTChat:function(index,mssgtchat){
          this.operation='update';
          this.lan_to_edit='none';
        this.mssgtchat=mssgtchat;
          this.ventanaOperMssgTChat=true;

        },

      },
      created: function () {
        this.mssgTList();
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
