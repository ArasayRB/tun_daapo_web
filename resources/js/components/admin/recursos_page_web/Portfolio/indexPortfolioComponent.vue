Portfolio<template>
  <div>
  <div class="row py-lg-2">
    <div class="col-md-6">
      <h1 class="h3 mb-2 text-gray-800">{{ $trans('messages.Portfolio') }}</h1>
    </div>
    <div class="col-md-6">
      <a href="#" @click="openAddPortfolio()" class="btn btn-primary btn-lg float-md-right" permission="button" aria-pressed="true">{{ $trans('messages.Add') }}</a>
    </div>

  </div>
  <div class="card shadow mb-4">
    <portfolio-oper-form-component @portfolionew="addPortfolioIndex" @portfoliooperupd="updPortfolioIndex" :operation="operation" :portfolio="portfolio" :locale="locale" v-if="ventanaOperPortfolio" @close="ventanaOperPortfolio = false">

    </portfolio-oper-form-component>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">{{ $trans('messages.List') }}</h6>
    </div>
    <div class="alert alert-success" v-if="mensage!=''">
      <ul>
        <li>{{mensage}}</li>
      </ul>
    </div>
    <div class="card-body">

      <div class="table-responsive">
        <paginate class="pt-5 mt-3" ref="paginator" name = "portfolios" :list = "portfolios" :per = "2" :key="portfolios ? portfolios.length:0">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.Image') }}</th>
              <th>{{ $trans('messages.Agency/Freelancer') }}</th>
              <th>{{ $trans('messages.Project') }} {{ $trans('messages.Name') }}</th>
              <th>{{ $trans('messages.Description') }}</th>
              <th>{{ $trans('messages.Services') }}</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.Image') }}</th>
              <th>{{ $trans('messages.Agency/Freelancer') }}</th>
              <th>{{ $trans('messages.Project') }} {{ $trans('messages.Name') }}</th>
              <th>{{ $trans('messages.Description') }}</th>
              <th>{{ $trans('messages.Services') }}</th>
            </tr>
          </tfoot>
          <tbody>


                <tr v-for="(portfolio,index) in paginated('portfolios')" :portfolio="portfolio" :key="portfolio.id">

                    <td>

                          <a href="#" @click="openEditPortfolio(index,portfolio)"><i class="fa fa-edit" title="Edit/Editar"></i></a>
                        <a href="#" @click="deletePortfolio(index,portfolio.id)"><i class="fa fa-trash-alt" title="Delete/Eliminar"></i></a>
                   </td>
                    <td><img :src="src+portfolio.img"  width="100"></td>
                    <td>{{portfolio.empresa_solicitante}}</td>
                    <td>{{portfolio.project_name}}</td>
                    <td>{{portfolio.description}}</td>
                    <td>{{portfolio.service_id}}</td>

                </tr>



          </tbody>
        </table>
      </paginate>
           <strong class="text-primary">
             <paginate-links for="portfolios" :show-step-links="true"></paginate-links>
             <paginate-links
            for="portfolios"
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
          portfolios:[],
          portfolio:[],
          permission_state:[],
          paginate:['portfolios'],
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
          src:'storage/portfolio/',
          ventanaOperPortfolio:false,
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
        portfolioList:function(){
          axios.get('/portfolioList')
               .then(response =>{
                 this.portfolios = response.data;
                 if (response.data==''){
                   this.mensage=this.$trans('messages.None added yet');
                 }
               })
               .catch(error => this.errors.push(error));
        },
        addPortfolioIndex:function(permissionAdd){
          this.operation='';this.portfolioList();
          this.mensage="";
          this.ventanaOperPortfolio=false;
        },
        updPortfolioIndex:function(portfolioUpd){
          this.operation='';
          const position=this.portfolios.findIndex(portfolio=>portfolio.id===portfolioUpd.id);
          this.portfolioList();
          this.ventanaOperPortfolio=false;
        },
        deletePortfolio:function(index,portfolio){
          let portfolio_id=portfolio;
            swal({title:this.$trans('messages.Delete')+' '+this.$trans('messages.Portfolio'),
                  text:this.$trans('messages.Are you completely sure you want to delete ')+this.$trans('messages.Portfolio')+'?',
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
                    let  url='/portfolio/'+portfolio_id;
                    axios.delete(url)
                         .then(response=>{
                           swal({title:this.$trans('messages.Correct data'),
                                 text:this.$trans('messages.Portfolio')+' '+this.$trans('messages.Deleted'),
                                 icon:'success',
                                 closeOnClickOutside:false,
                                 closeOnEsc:false
                               }).then(select=>{
                                 if (select){
                                   this.portfolioList();
                                   if(this.portfolios.length===0){
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
        openAddPortfolio:function(){
          this.operation='add';
          this.ventanaOperPortfolio = true;
        },
        openEditPortfolio:function(index,portfolio){
          this.operation='update';
        this.portfolio=portfolio;
          this.ventanaOperPortfolio=true;

        },

      },
      created: function () {
        this.portfolioList();
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
