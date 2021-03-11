<template>
  <div>
  <div class="row py-lg-2">
    <div class="col-md-6">
      <h1 class="h3 mb-2 text-gray-800">{{ $trans('messages.Functions Included') }}</h1>
    </div>
    <div class="col-md-6">
      <a href="#" @click="openAddFunctionsIncluded()" class="btn btn-primary btn-lg float-md-right" permission="button" aria-pressed="true">{{ $trans('messages.Add') }}</a>
    </div>

  </div>
  <div class="card shadow mb-4">
    <functions-included-oper-form-component @functionsincludednew="addFunctionsIncludedIndex" @functionsincludedoperupd="updFunctionsIncludedIndex" :operation="operation" :functionsincluded="functionsincluded" :locale="locale" v-if="ventanaOperFunctionsIncluded" @close="ventanaOperFunctionsIncluded = false">

    </functions-included-oper-form-component>
    <div class="card-header py-3">
      <div class="row input-group">
      <h6 class="m-0 font-weight-bold text-primary col">{{ $trans('messages.List') }}</h6>
      <!-- Topbar Search -->
      <input-searcher-component :url="'/all-functions-included'" :emit="'functionsincluded'" @cancelsearch="functionsincludedList" @functionsincludedfilter="filtersFunctionsIncluded">
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
        <paginate class="pt-5 mt-3" ref="paginator" name = "functionsincludeds" :list = "functionsincludeds" :per = "6" :key="functionsincludeds ? functionsincludeds.length:0">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.Name') }}</th>
              <th>{{ $trans('messages.Description') }}</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.Name') }}</th>
              <th>{{ $trans('messages.Description') }}</th>
            </tr>
          </tfoot>
          <tbody>


                <tr v-for="(functionsincluded,index) in paginated('functionsincludeds')" :functionsincluded="functionsincluded" :key="functionsincluded.id">

                    <td>

                          <a href="#" @click="openEditFunctionsIncluded(index,functionsincluded)"><i class="fa fa-edit" title="Edit/Editar"></i></a>
                        <a href="#" @click="deleteFunctionsIncluded(index,functionsincluded.id)"><i class="fa fa-trash-alt" title="Delete/Eliminar"></i></a>
                   </td>
                    <td>{{functionsincluded.name}}</td>
                    <td>{{functionsincluded.description}}</td>

                </tr>



          </tbody>
        </table>
      </paginate>
           <strong class="text-primary">
             <paginate-links for="functionsincludeds" :show-step-links="true"></paginate-links>
             <paginate-links
            for="functionsincludeds"
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
          functionsincludeds:[],
          functionsincluded:[],
          permission_state:[],
          paginate:['functionsincludeds'],
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
          ventanaOperFunctionsIncluded:false,
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
    filtersFunctionsIncluded:function(filters){
      this.functionsincludeds=filters;
    },
        functionsincludedList:function(){
          axios.get('/functions-included-list')
               .then(response =>{
                 this.functionsincludeds = response.data;
                 if (response.data==''){
                   this.mensage=this.$trans('messages.None added yet');
                 }
               })
               .catch(error => this.errors.push(error));
        },
        addFunctionsIncludedIndex:function(permissionAdd){
          this.operation='';
          this.functionsincludedList();
          this.mensage="";
          this.ventanaOperFunctionsIncluded=false;
        },
        updFunctionsIncludedIndex:function(functionsincludedUpd){
          this.operation='';
          const position=this.functionsincludeds.findIndex(functionsincluded=>functionsincluded.id===functionsincludedUpd.id);
          this.functionsincludedList();
          this.ventanaOperFunctionsIncluded=false;
        },
        deleteFunctionsIncluded:function(index,functionsincluded){
          let functionsincluded_id=functionsincluded;
            swal({title:this.$trans('messages.Delete')+' '+this.$trans('messages.Functions Included'),
                  text:this.$trans('messages.Are you completely sure you want to delete ')+this.$trans('messages.Functions Included')+'?',
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
                    let  url='/functions-included/'+functionsincluded_id;
                    axios.delete(url)
                         .then(response=>{
                           swal({title:this.$trans('messages.Correct data'),
                                 text:this.$trans('messages.Functions Included')+' '+this.$trans('messages.Deleted'),
                                 icon:'success',
                                 closeOnClickOutside:false,
                                 closeOnEsc:false
                               }).then(select=>{
                                 if (select){
                                   this.functionsincludedList();
                                   if(this.functionsincludeds.length===0){
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
        openAddFunctionsIncluded:function(){
          this.operation='add';
          this.ventanaOperFunctionsIncluded = true;
        },
        openEditFunctionsIncluded:function(index,functionsincluded){
          this.operation='update';
        this.functionsincluded=functionsincluded;
          this.ventanaOperFunctionsIncluded=true;

        },

      },
      created: function () {
        this.functionsincludedList();
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
