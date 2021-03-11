<template>
  <div>
  <div class="row py-lg-2">
    <div class="col-md-6">
      <h1 class="h3 mb-2 text-gray-800">{{ $trans('messages.Section Page') }}</h1>
    </div>
    <div class="col-md-6">
      <a href="#" @click="openAddSectionPage()" class="btn btn-primary btn-lg float-md-right" permission="button" aria-pressed="true">{{ $trans('messages.Add') }}</a>
    </div>

  </div>
  <div class="card shadow mb-4">
    <sectionpage-oper-form-component @sectionpagenew="addSectionPageIndex" @sectionpageoperupd="updSectionPageIndex" :operation="operation" :sectionpage="sectionpage" :locale="locale" v-if="ventanaOperSectionPage" @close="ventanaOperSectionPage = false">

    </sectionpage-oper-form-component>
    <div class="card-header py-3">
      <div class="row input-group">
      <h6 class="m-0 font-weight-bold text-primary col">{{ $trans('messages.List') }}</h6>
      <!-- Topbar Search -->
      <input-searcher-component :url="'/all-section-pages'" :emit="'sectionspages'" @cancelsearch="sectionpageList" @sectionspagesfilter="filtersSectionPage">
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
        <paginate class="pt-5 mt-3" ref="paginator" name = "sectionpages" :list = "sectionpages" :per = "2" :key="sectionpages ? sectionpages.length:0">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.Image') }}</th>
              <th>{{ $trans('messages.Title') }}</th>
              <th>{{ $trans('messages.Description') }}</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.Image') }}</th>
              <th>{{ $trans('messages.Title') }}</th>
              <th>{{ $trans('messages.Description') }}</th>
            </tr>
          </tfoot>
          <tbody>


                <tr v-for="(sectionpage,index) in paginated('sectionpages')" :sectionpage="sectionpage" :key="sectionpage.id">

                    <td>

                          <a href="#" @click="openEditSectionPage(index,sectionpage)"><i class="fa fa-edit" title="Edit/Editar"></i></a>
                        <a href="#" @click="deleteSectionPage(index,sectionpage.id)"><i class="fa fa-trash-alt" title="Delete/Eliminar"></i></a>
                   </td>
                    <td><img :src="src+sectionpage.img"  width="100" v-if="sectionpage.img!=null"></td>
                    <td>{{sectionpage.title}}</td>
                    <td>{{sectionpage.description}}</td>

                </tr>



          </tbody>
        </table>
      </paginate>
           <strong class="text-primary">
             <paginate-links for="sectionpages" :show-step-links="true"></paginate-links>
             <paginate-links
            for="sectionpages"
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
          sectionpages:[],
          sectionpage:[],
          permission_state:[],
          paginate:['sectionpages'],
          hreff:'/permission-preview/',
          permissionActualizar:false,
          idpermissionActualizar:-1,
          value:'',
          operation:'',
          id:'',
          mensage:'',
          valueImg:'',
          lang:true,
          locale:'',
          src:'storage/section_page/',
          src_qr:'storage/qrcodes/permissions/',
          ventanaOperSectionPage:false,
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
    filtersSectionPage:function(filters){
      this.sectionpages=filters;
    },
        imageEdit:function(e){

          this.imagenpermission=e.target.files[0];
        },
        sectionpageList:function(){
          axios.get('/sectionpageList')
               .then(response =>{
                 this.sectionpages = response.data;
                 if (response.data==''){
                   this.mensage=this.$trans('messages.None added yet');
                 }
               })
               .catch(error => this.errors.push(error));
        },
        addSectionPageIndex:function(permissionAdd){
          this.operation='';
          this.sectionpageList();
          this.mensage="";
          this.ventanaOperSectionPage=false;
        },
        updSectionPageIndex:function(sectionpageUpd){
          this.operation='';
          const position=this.sectionpages.findIndex(sectionpage=>sectionpage.id===sectionpageUpd.id);
          this.sectionpageList();
          this.ventanaOperSectionPage=false;
        },
        deleteSectionPage:function(index,sectionpage){
          let sectionpage_id=sectionpage;
            swal({title:this.$trans('messages.Delete')+' '+this.$trans('messages.Section Page'),
                  text:this.$trans('messages.Are you completely sure you want to delete ')+this.$trans('messages.Section Page')+'?',
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
                    let  url='/sectionpage/'+sectionpage_id;
                    axios.delete(url)
                         .then(response=>{
                           swal({title:this.$trans('messages.Correct data'),
                                 text:this.$trans('messages.Section Page')+' '+this.$trans('messages.Deleted'),
                                 icon:'success',
                                 closeOnClickOutside:false,
                                 closeOnEsc:false
                               }).then(select=>{
                                 if (select){
                                   this.sectionpageList();
                                   if(this.sectionpages.length===0){
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
        openAddSectionPage:function(){
          this.operation='add';
          this.ventanaOperSectionPage = true;
        },
        openEditSectionPage:function(index,sectionpage){
          this.operation='update';
        this.sectionpage=sectionpage;
          this.ventanaOperSectionPage=true;

        },

      },
      created: function () {
        this.sectionpageList();
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
