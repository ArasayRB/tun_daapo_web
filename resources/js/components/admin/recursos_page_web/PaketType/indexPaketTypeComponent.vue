<template>
  <div>
  <div class="row py-lg-2">
    <div class="col-md-6">
      <h1 class="h3 mb-2 text-gray-800">{{ $trans('messages.Packet Type') }}</h1>
    </div>
    <div class="col-md-6">
      <a href="#" @click="openAddPaketType()" class="btn btn-primary btn-lg float-md-right" permission="button" aria-pressed="true">{{ $trans('messages.Add') }}</a>
    </div>

  </div>
  <div class="card shadow mb-4">
    <paket-type-oper-form-component @pakettypenew="addPaketTypeIndex" @pakettypeoperupd="updPaketTypeIndex" :operation="operation" :lan_to_edit="lan_to_edit" :paket_type="paket_type" :locale="locale" :show_lang_div="show_lang_div" v-if="ventanaOperPaketType" @close="ventanaOperPaketType = false">

    </paket-type-oper-form-component>
    <div class="card-header py-3">
      <div class="row input-group">
      <h6 class="m-0 font-weight-bold text-primary col">{{ $trans('messages.List') }}</h6>
      <!-- Topbar Search -->
      <input-searcher-component :url="'/all-paket-types'" :emit="'pakettype'" @cancelsearch="paketTypeList" @pakettypefilter="filtersPaketType">
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
        <paginate class="pt-5 mt-3" ref="paginator" name = "paket_types" :list = "paket_types" :per = "2" :key="paket_types ? paket_types.length:0">
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


                <tr v-for="(paket_type,index) in paginated('paket_types')" :paket_type="paket_type" :key="paket_type.id">

                    <td>
                      <div class="dropdown">
                        <a class="dropdown-toggle" :id="'edit-translate-section-'+paket_type.id" v-can-user="'edit-translate-section'" title="Edit Translate/Editar Traducción" data-toggle="dropdown" @click="getTranslates(index,paket_type)" hidden>
                          <i class="fa fa-edit"></i>
                          <i class="fas fa-language"></i>
                        </a>
                        <div class="dropdown-menu">

                          <a class="dropdown-item" type="button" v-for="lang_available in translated_languages" @click="openEditTranslated(paket_type, lang_available)">
                              {{lang_available}}
                          </a>

                          </div>
                      </div>

                      <a href="#" @click="openAddTranslate(index,paket_type)" :id="'translate-section-'+paket_type.id" v-can-user="'translate-section'" hidden><i class="fas fa-language" title="Add Language/Añadir Lenguage"></i></a>
                      <a href="#" @click="openEditPaketType(index,paket_type)"><i class="fa fa-edit" title="Edit/Editar"></i></a>
                        <a href="#" @click="deletePaketType(index,paket_type.id)"><i class="fa fa-trash-alt" title="Delete/Eliminar"></i></a>
                   </td>
                    <td>{{paket_type.name}}</td>

                </tr>



          </tbody>
        </table>
      </paginate>
           <strong class="text-primary">
             <paginate-links for="paket_types" :show-step-links="true"></paginate-links>
             <paginate-links
            for="paket_types"
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
          paket_types:[],
          paket_type:[],
          permission_state:[],
          paginate:['paket_types'],
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
          locale:'',
          src:'storage/img_web/login_img/',
          src_qr:'storage/qrcodes/permissions/',
          ventanaOperPaketType:false,
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
    filtersPaketType:function(filters){
      this.paket_types=filters;
    },
    openEditTranslated:function(paket_type, lang_available){
      let section_translated_array;
      axios.get('/get-translated-packet-type-by-lang/'+lang_available+'/'+paket_type.id+'/Paket Type')
           .then(response =>{
             section_translated_array = response.data;
             this.paket_type=section_translated_array;
               this.operation='update';
                 this.ventanaOperPaketType=true;
                 this.lan_to_edit=lang_available;
             if (response.data==''){
               this.mensage=this.$trans('messages.Packet Type')+'  '+this.$trans('messages.None added yet');
             }})
           .catch(error => this.errors.push(error));
    },
    getTranslates:function(index,paket_type){
      axios.get('/translated-language-item/'+paket_type.id+'/Paket Type')
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
        paketTypeList:function(){
          axios.get('/packet-type-list')
               .then(response =>{
                 this.paket_types = response.data;
                 if (response.data==''){
                   this.mensage=this.$trans('messages.None added yet');
                 }
               })
               .catch(error => this.errors.push(error));
        },
        addPaketTypeIndex:function(paketTypeAdd){
          this.operation='';
          this.paketTypeList();
          this.mensage="";
          this.show_lang_div=false;
          this.ventanaOperPaketType=false;
        },
        updPaketTypeIndex:function(paket_typeUpd){
          this.operation='';
          this.show_lang_div=false;
          const position=this.paket_types.findIndex(paket_type=>paket_type.id===paket_typeUpd.id);
          this.paketTypeList();
          this.ventanaOperPaketType=false;
        },
        deletePaketType:function(index,paket_type){
          let paket_type_id=paket_type;
            swal({title:this.$trans('messages.Delete')+' '+this.$trans('messages.Packet Type'),
                  text:this.$trans('messages.Are you completely sure you want to delete ')+this.$trans('messages.Packet Type')+'?',
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
                    let  url='/pakettypes/'+paket_type_id;
                    axios.delete(url)
                         .then(response=>{
                           swal({title:this.$trans('messages.Correct data'),
                                 text:this.$trans('messages.Packet Type')+' '+this.$trans('messages.Deleted'),
                                 icon:'success',
                                 closeOnClickOutside:false,
                                 closeOnEsc:false
                               }).then(select=>{
                                 if (select){
                                   this.paketTypeList();
                                   if(this.paket_types.length===0){
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
        openAddTranslate:function(index,paket_type){
          this.paket_type=paket_type;
          this.show_lang_div=false;
          this.operation='add';
          this.ventanaOperPaketType = true;
        },
        openAddPaketType:function(){
          this.show_lang_div=true;
          this.operation='add';
          this.ventanaOperPaketType = true;
        },
        openEditPaketType:function(index,paket_type){
          this.operation='update';
          this.lan_to_edit='none';
        this.paket_type=paket_type;
          this.ventanaOperPaketType=true;

        },

      },
      created: function () {
        this.paketTypeList();
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
