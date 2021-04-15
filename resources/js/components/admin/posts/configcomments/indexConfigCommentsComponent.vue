<template>
  <div>
  <div class="row py-lg-2">
    <div class="col-md-6">
      <h1 class="h3 mb-2 text-gray-800">{{ $trans('messages.Comment') }} {{ $trans('messages.Configuration') }}</h1>
    </div>
    <div class="col-md-6">
      <a href="#" @click="openAddConfComment()" class="btn btn-primary btn-lg float-md-right" permission="button" aria-pressed="true">{{ $trans('messages.Add') }}</a>
    </div>

  </div>
  <div class="card shadow mb-4">
    <conf-com-oper-form-component @confcommentnew="addConfCommentIndex" @confcommentperupd="updConfCommentIndex" :operation="operation" :lan_to_edit="lan_to_edit" :confcomment="confcomment" :locale="locale" :show_lang_div="show_lang_div" v-if="ventanaOperConfComment" @close="ventanaOperConfComment = false">

    </conf-com-oper-form-component>
    <div class="card-header py-3">
      <div class="row input-group">
      <h6 class="m-0 font-weight-bold text-primary col">{{ $trans('messages.List') }}</h6>
      <!-- Topbar Search -->
      <input-searcher-component :url="'/all-comments-config'" :emit="'confcomments'" @cancelsearch="confcommentList" @confcommentsfilter="filtersConfComment">
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
        <paginate class="pt-5 mt-3" ref="paginator" name = "confcomments" :list = "confcomments" :per = "2" :key="confcomments ? confcomments.length:0">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.Level') }}</th>
              <th>{{ $trans('messages.Answer') }}</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.Level') }}</th>
              <th>{{ $trans('messages.Answer') }}</th>
            </tr>
          </tfoot>
          <tbody>


                <tr v-for="(confcomment,index) in paginated('confcomments')" :confcomment="confcomment" :key="confcomment.id">

                    <td>
                        <a href="#" @click="openEditConfComment(index,confcomment)"><i class="fa fa-edit" title="Edit/Editar"></i></a>
                        <a href="#" @click="deleteConfComment(index,confcomment.id)"><i class="fa fa-trash-alt" title="Delete/Eliminar"></i></a>
                   </td>
                    <td>{{confcomment.max_nivel}}</td>
                    <td>{{confcomment.max_answers}}</td>

                </tr>



          </tbody>
        </table>
      </paginate>
           <strong class="text-primary">
             <paginate-links for="confcomments" :show-step-links="true"></paginate-links>
             <paginate-links
            for="confcomments"
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
          confcomments:[],
          confcomment:[],
          permission_state:[],
          paginate:['confcomments'],
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
          ventanaOperConfComment:false,
          token   : window.CSRF_TOKEN,

        }
      },
      methods:{
        filtersConfComment:function(filters){
          this.confcomments=filters;
        },
        confcommentList:function(){
          axios.get('/config-comments-list')
               .then(response =>{
                 this.confcomments = response.data;
                 if (response.data==''){
                   this.mensage=this.$trans('messages.None added yet');
                 }
               })
               .catch(error => this.errors.push(error));
        },
        addConfCommentIndex:function(confcommentAdd){
          this.operation='';
          this.confcommentList();
          this.mensage="";
          this.show_lang_div=false;
          this.ventanaOperConfComment=false;
        },
        updConfCommentIndex:function(confcommentUpd){
          this.operation='';
          this.show_lang_div=false;
          const position=this.confcomments.findIndex(confcomment=>confcomment.id===confcommentUpd.id);
          this.confcommentList();
          this.ventanaOperConfComment=false;
        },
        deleteConfComment:function(index,confcomment){
          let confcomment_id=confcomment;
            swal({title:this.$trans('messages.Delete')+' '+this.$trans('messages.Comment')+' '+ this.$trans('messages.Configuration'),
                  text:this.$trans('messages.Are you completely sure you want to delete ')+this.$trans('messages.Comment')+' '+ this.$trans('messages.Configuration')+'?',
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
                    let  url='/configuration-comments/'+confcomment_id;
                    axios.delete(url)
                         .then(response=>{
                           swal({title:this.$trans('messages.Correct data'),
                                 text:this.$trans('messages.Comment')+' '+this.$trans('messages.Configuration')+' '+this.$trans('messages.Deleted'),
                                 icon:'success',
                                 closeOnClickOutside:false,
                                 closeOnEsc:false
                               }).then(select=>{
                                 if (select){
                                   this.confcommentList();
                                   if(this.confcomments.length===0){
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
        openAddConfComment:function(){
          this.show_lang_div=true;
          this.operation='add';
          this.ventanaOperConfComment = true;
        },
        openEditConfComment:function(index,confcomment){
          this.lan_to_edit='none';
          this.operation='update';
        this.confcomment=confcomment;
          this.ventanaOperConfComment=true;

        },

      },
      created: function () {
        this.confcommentList();
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
