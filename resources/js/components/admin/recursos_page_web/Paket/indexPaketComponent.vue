<template>
  <div>
  <div class="row py-lg-2">
    <div class="col-md-6">
      <h1 class="h3 mb-2 text-gray-800">{{ $trans('messages.Packet') }}</h1>
    </div>
    <div class="col-md-6">
      <a href="#" @click="openAddPaket()" class="btn btn-primary btn-lg float-md-right" permission="button" aria-pressed="true">{{ $trans('messages.Add') }}</a>
    </div>

  </div>
  <div class="card shadow mb-4">
    <paket-oper-form-component @paketnew="addPaketIndex" @paketperupd="updPaketIndex" :operation="operation" :lan_to_edit="lan_to_edit" :paket="paket" :locale="locale" :show_lang_div="show_lang_div" v-if="ventanaOperPaket" @close="ventanaOperPaket = false">

    </paket-oper-form-component>
    <div class="card-header py-3">
      <div class="row input-group">
      <h6 class="m-0 font-weight-bold text-primary col">{{ $trans('messages.List') }}</h6>
      <!-- Topbar Search -->
      <input-searcher-component :url="'/all-pakets'" :emit="'pakets'" @cancelsearch="paketList" @paketsfilter="filtersPaket">
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
        <paginate class="pt-5 mt-3" ref="paginator" name = "pakets" :list = "pakets" :per = "2" :key="pakets ? pakets.length:0">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.Name') }}</th>
              <th>{{ $trans('messages.Name') }} {{ $trans('messages.Button') }}</th>
              <th>{{ $trans('messages.Description') }}</th>
              <th>{{ $trans('messages.Price') }}</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.Name') }}</th>
              <th>{{ $trans('messages.Name') }} {{ $trans('messages.Button') }}</th>
              <th>{{ $trans('messages.Description') }}</th>
              <th>{{ $trans('messages.Price') }}</th>
            </tr>
          </tfoot>
          <tbody>


                <tr v-for="(paket,index) in paginated('pakets')" :paket="paket" :key="paket.id">

                    <td>
                      <div class="dropdown">
                        <a class="dropdown-toggle" :id="'edit-translate-packet-'+paket.id" v-can-user="'edit-translate-packet'" title="Edit Translate/Editar Traducción" data-toggle="dropdown" @click="getTranslates(index,paket)" hidden>
                          <i class="fa fa-edit"></i>
                          <i class="fas fa-language"></i>
                        </a>
                        <div class="dropdown-menu">

                          <a class="dropdown-item" type="button" v-for="lang_available in translated_languages" @click="openEditTranslated(paket, lang_available)">
                              {{lang_available}}
                          </a>

                          </div>
                      </div>

                      <a href="#" @click="openAddTranslate(index,paket)" :id="'translate-packet-'+paket.id" v-can-user="'translate-packet'" hidden><i class="fas fa-language" title="Add Language/Añadir Lenguage"></i></a>
                      <a href="#" @click="openEditPaket(index,paket)"><i class="fa fa-edit" title="Edit/Editar"></i></a>
                        <a href="#" @click="deletePaket(index,paket.id)"><i class="fa fa-trash-alt" title="Delete/Eliminar"></i></a>
                   </td>
                    <td>{{paket.name}}</td>
                     <td>{{paket.name_button}}</td>
                    <td>{{paket.description}}</td>
                    <td>{{paket.price}}</td>

                </tr>



          </tbody>
        </table>
      </paginate>
           <strong class="text-primary">
             <paginate-links for="pakets" :show-step-links="true"></paginate-links>
             <paginate-links
            for="pakets"
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
          pakets:[],
          paket:[],
          permission_state:[],
          paginate:['pakets'],
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
          src:'storage/img_web/login_img/',
          src_qr:'storage/qrcodes/permissions/',
          ventanaOperPaket:false,
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
    filtersPaket:function(filters){
      this.pakets=filters;
    },
        imageEdit:function(e){

          this.imagenpermission=e.target.files[0];
        },
        openEditTranslated:function(paket, lang_available){
          let paket_translated_array;
          axios.get('/get-translated-packet-by-lang/'+lang_available+'/'+paket.id+'/Paket')
               .then(response =>{
                 paket_translated_array = response.data;
                 this.paket=paket_translated_array;
                   this.operation='update';
                     this.ventanaOperPaket=true;
                     this.lan_to_edit=lang_available;
                 if (response.data==''){
                   this.mensage=this.$trans('messages.Packet')+'  '+this.$trans('messages.None added yet');
                 }})
               .catch(error => this.errors.push(error));
        },
        getTranslates:function(index,paket){
          axios.get('/translated-language-item/'+paket.id+'/Paket')
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
        paketList:function(){
          axios.get('/paketList')
               .then(response =>{
                 this.pakets = response.data;
                 if (response.data==''){
                   this.mensage=this.$trans('messages.None added yet');
                 }
               })
               .catch(error => this.errors.push(error));
        },
        addPaketIndex:function(paketAdd){
          this.operation='';
          this.paketList();
          this.mensage="";
          this.show_lang_div=false;
          this.ventanaOperPaket=false;
        },
        updPaketIndex:function(paketUpd){
          this.operation='';
          this.show_lang_div=false;
          const position=this.pakets.findIndex(paket=>paket.id===paketUpd.id);
          this.paketList();
          this.ventanaOperPaket=false;
        },
        deletePaket:function(index,paket){
          let paket_id=paket;
            swal({title:this.$trans('messages.Delete')+' '+this.$trans('messages.Packet'),
                  text:this.$trans('messages.Are you completely sure you want to delete ')+this.$trans('messages.Packet')+'?',
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
                    let  url='/paket/'+paket_id;
                    axios.delete(url)
                         .then(response=>{
                           swal({title:this.$trans('messages.Correct data'),
                                 text:this.$trans('messages.Packet')+' '+this.$trans('messages.Deleted'),
                                 icon:'success',
                                 closeOnClickOutside:false,
                                 closeOnEsc:false
                               }).then(select=>{
                                 if (select){
                                   this.paketList();
                                   if(this.pakets.length===0){
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
        openAddTranslate:function(index,paket){
          this.paket=paket;
          this.show_lang_div=false;
          this.operation='add';
          this.ventanaOperPaket = true;
        },
        openAddPaket:function(){
          this.show_lang_div=true;
          this.operation='add';
          this.ventanaOperPaket = true;
        },
        openEditPaket:function(index,paket){
          this.lan_to_edit='none';
          this.operation='update';
        this.paket=paket;
          this.ventanaOperPaket=true;

        },

      },
      created: function () {
        this.paketList();
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
