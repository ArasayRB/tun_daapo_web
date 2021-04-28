<template>
  <div>
  <div class="row py-lg-2">
    <div class="col-md-6">
      <h1 class="h3 mb-2 text-gray-800">{{ $trans('messages.Contact') }}</h1>
    </div>
    <div class="col-md-6">
      <a href="#" @click="openAddContact()" class="btn btn-primary btn-lg float-md-right" permission="button" aria-pressed="true">{{ $trans('messages.Add') }}</a>
    </div>

  </div>
  <div class="card shadow mb-4">
    <contact-oper-form-component @contactnew="addContactIndex" @contactoperupd="updContactIndex" :operation="operation" :lan_to_edit="lan_to_edit" :contact="contact" :locale="locale" :show_lang_div="show_lang_div" v-if="ventanaOperContact" @close="ventanaOperContact = false">

    </contact-oper-form-component>
    <div class="card-header py-3">
      <div class="row input-group">
      <h6 class="m-0 font-weight-bold text-primary col">{{ $trans('messages.List') }}</h6>
      <!-- Topbar Search -->
      <input-searcher-component :url="'/admin/all-contacts'" :locale="locale" :emit="'contacts'" @cancelsearch="contactList" @contactsfilter="filtersContacts">
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
        <paginate class="pt-5 mt-3" ref="paginator" name = "contacts" :list = "contacts" :per = "2" :key="contacts ? contacts.length:0">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.Email') }}</th>
              <th>{{ $trans('messages.Phone') }}</th>
              <th>{{ $trans('messages.Adress') }}</th>
              <th>{{ $trans('messages.Map') }}</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.Email') }}</th>
              <th>{{ $trans('messages.Phone') }}</th>
              <th>{{ $trans('messages.Adress') }}</th>
              <th>{{ $trans('messages.Map') }}</th>
            </tr>
          </tfoot>
          <tbody>


                <tr v-for="(contact,index) in paginated('contacts')" :contact="contact" :key="contact.id">

                    <td>
                      <div class="dropdown">
                        <a class="dropdown-toggle" :id="'edit-translate-contact-'+contact.id" v-can-user="'edit-translate-contact'" title="Edit Translate/Editar Traducción" data-toggle="dropdown" @click="getTranslates(index,contact)" hidden>
                          <i class="fa fa-edit"></i>
                          <i class="fas fa-language"></i>
                        </a>
                        <div class="dropdown-menu">

                          <a class="dropdown-item" type="button" v-for="lang_available in translated_languages" @click="openEditTranslated(contact, lang_available)">
                              {{lang_available}}
                          </a>

                          </div>
                      </div>

                      <a href="#" @click="openAddTranslate(index,contact)" :id="'translate-contact-'+contact.id" v-can-user="'translate-contact'" hidden><i class="fas fa-language" title="Add Language/Añadir Lenguage"></i></a>
                      <a href="#" @click="openEditContact(index,contact)"><i class="fa fa-edit" title="Edit/Editar"></i></a>
                        <a href="#" @click="deleteContact(index,contact.id)"><i class="fa fa-trash-alt" title="Delete/Eliminar"></i></a>
                   </td>
                    <td>{{contact.email}}</td>
                    <td>{{contact.phone}}</td>
                    <td>{{contact.address}}</td>
                    <td>{{contact.map}}</td>

                </tr>



          </tbody>
        </table>
      </paginate>
           <strong class="text-primary">
             <paginate-links for="contacts" :show-step-links="true"></paginate-links>
             <paginate-links
            for="contacts"
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
          contacts:[],
          contact:[],
          permission_state:[],
          paginate:['contacts'],
          hreff:'/permission-preview/',
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
          src:'storage/img_web/login_img/',
          src_qr:'storage/qrcodes/permissions/',
          ventanaOperContact:false,
          ventanaEditPermiso:false,
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
    filtersContacts:function(filters){
      this.contacts=filters;
    },
        imageEdit:function(e){

          this.imagenpermission=e.target.files[0];
        },
        openEditTranslated:function(contact, lang_available){
          let contact_translated_array;
          axios.get(window.location.origin +'/'+this.$attrs.locale+'/admin/get-translated-contact-by-lang/'+lang_available+'/'+contact.id+'/Contact')
               .then(response =>{
                 contact_translated_array = response.data;
                 this.contact=contact_translated_array;
                   this.operation='update';
                     this.ventanaOperContact=true;
                     this.lan_to_edit=lang_available;
                 if (response.data==''){
                   this.mensage=this.$trans('messages.Contact')+'  '+this.$trans('messages.None added yet');
                 }})
               .catch(error => this.errors.push(error));
        },
        getTranslates:function(index,contact){
          axios.get(window.location.origin +'/'+this.$attrs.locale+'/translated-language-item/'+contact.id+'/Contact')
               .then(response =>{
                   this.lang=false;
                 if (response.data==='no-language-added'){
                   this.translated_languages = [];
                   let mensageLang=this.$trans('messages.None language added yet');
                   swal({title:this.$trans('messages.Warning!'),
                         text:mensageLang,
                         icon:'warning',
                         closeOnClickOutside:false,
                         closeOnEsc:false
                       });
                 }
                 else{
                     this.translated_languages = response.data;
                 }
               })
               .catch(error => this.errors.push(error));
        },
        contactList:function(){
          axios.get(window.location.origin +'/'+this.$attrs.locale+'/admin/contactList')
               .then(response =>{
                 this.contacts = response.data;
                 if (response.data==''){
                   this.mensage=this.$trans('messages.None added yet');
                 }
               })
               .catch(error => this.errors.push(error));
        },
        addContactIndex:function(permissionAdd){
          this.operation='';
          this.contactList();
          this.mensage="";
          this.show_lang_div=false;
          this.ventanaOperContact=false;
        },
        updContactIndex:function(contactUpd){
          this.operation='';
          this.show_lang_div=false;
          const position=this.contacts.findIndex(contact=>contact.id===contactUpd.id);
          this.contactList();
          this.ventanaOperContact=false;
        },
        deleteContact:function(index,contact){
          let contact_id=contact;
            swal({title:this.$trans('messages.Delete')+' '+this.$trans('messages.Contact'),
                  text:this.$trans('messages.Are you completely sure you want to delete ')+this.$trans('messages.Contact')+'?',
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
                    let  url=window.location.origin +'/'+this.$attrs.locale+'/admin/contact/'+contact_id;
                    axios.delete(url)
                         .then(response=>{
                           swal({title:this.$trans('messages.Correct data'),
                                 text:this.$trans('messages.Contact')+' '+this.$trans('messages.Deleted'),
                                 icon:'success',
                                 closeOnClickOutside:false,
                                 closeOnEsc:false
                               }).then(select=>{
                                 if (select){
                                   this.contactList();
                                   if(this.contacts.length===0){
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
        openAddTranslate:function(index,contact){
          this.contact=contact;
          this.show_lang_div=false;
          this.operation='add';
          this.ventanaOperContact = true;
        },
        openAddContact:function(){
          this.show_lang_div=true;
          this.operation='add';
          this.ventanaOperContact = true;
        },
        openEditContact:function(index,contact){
          this.operation='update';
          this.lan_to_edit='none';
        this.contact=contact;
          this.ventanaOperContact=true;

        },

      },
      created: function () {
        this.contactList();
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
