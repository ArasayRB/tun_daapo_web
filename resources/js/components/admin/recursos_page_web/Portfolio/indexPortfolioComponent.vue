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
    <portfolio-oper-form-component @portfolionew="addPortfolioIndex" @portfoliooperupd="updPortfolioIndex" :operation="operation" :lan_to_edit="lan_to_edit" :portfolio="portfolio" :locale="locale" :show_lang_div="show_lang_div" v-if="ventanaOperPortfolio" @close="ventanaOperPortfolio = false">

    </portfolio-oper-form-component>
    <div class="card-header py-3">
      <div class="row input-group">
      <h6 class="m-0 font-weight-bold text-primary col">{{ $trans('messages.List') }}</h6>
      <!-- Topbar Search -->
      <input-searcher-component :url="'/admin/all-portfolios'" :locale="locale" :emit="'portfolios'" @cancelsearch="portfolioList" @portfoliosfilter="filtersPortfolios">
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
                      <div class="dropdown">
                        <a class="dropdown-toggle" :id="'edit-translate-portfolio-'+portfolio.id" v-can-user="'edit-translate-portfolio'" title="Edit Translate/Editar Traducción" data-toggle="dropdown" @click="getTranslates(index,portfolio)" hidden>
                          <i class="fa fa-edit"></i>
                          <i class="fas fa-language"></i>
                        </a>
                        <div class="dropdown-menu">

                          <a class="dropdown-item" type="button" v-for="lang_available in translated_languages" @click="openEditTranslated(portfolio, lang_available)">
                              {{lang_available}}
                          </a>

                          </div>
                      </div>
                      <a href="#" @click="openAddTranslate(index,portfolio)" :id="'translate-portfolio-'+portfolio.id" v-can-user="'translate-portfolio'" hidden><i class="fas fa-language" title="Add Language/Añadir Lenguage"></i></a>
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
          translated_languages:[],
          id:'',
          mensage:'',
          valueImg:'',
          show_lang_div:false,
          lan_to_edit:'none',
          lang:true,
          locale:this.$attrs.locale,
          src:window.location.origin+'/storage/portfolio/',
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
    filtersPortfolios:function(filters){
      this.portfolios=filters;
    },
    openEditTranslated:function(portfolio, lang_available){
      let portfolio_translated_array;
      axios.get(window.location.origin +'/'+this.$attrs.locale+'/admin/get-translated-portfolio-by-lang/'+lang_available+'/'+portfolio.id+'/Portfolio')
           .then(response =>{
             portfolio_translated_array = response.data;
             this.portfolio=portfolio_translated_array;
               this.operation='update';
                 this.ventanaOperPortfolio=true;
                 this.lan_to_edit=lang_available;
             if (response.data==''){
               this.mensage=this.$trans('messages.Portfolio')+'  '+this.$trans('messages.None added yet');
             }})
           .catch(error => this.errors.push(error));
    },
    getTranslates:function(index,portfolio){
      axios.get(window.location.origin +'/'+this.$attrs.locale+'/translated-language-item/'+portfolio.id+'/Portfolio')
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
        portfolioList:function(){
          axios.get(window.location.origin +'/'+this.$attrs.locale+'/admin/portfolioList')
               .then(response =>{
                 this.portfolios = response.data;
                 if (response.data==''){
                   this.mensage=this.$trans('messages.None added yet');
                 }
               })
               .catch(error => this.errors.push(error));
        },
        addPortfolioIndex:function(permissionAdd){
          this.operation='';
          this.portfolioList();
          this.mensage="";
          this.show_lang_div=false;
          this.ventanaOperPortfolio=false;
        },
        updPortfolioIndex:function(portfolioUpd){
          this.operation='';
          this.show_lang_div=false;
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
                    let  url=window.location.origin +'/'+this.$attrs.locale+'/admin/portfolio/'+portfolio_id;
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
        openAddTranslate:function(index,portfolio){
          this.portfolio=portfolio;
          this.show_lang_div=false;
          this.operation='add';
          this.ventanaOperPortfolio = true;
        },
        openAddPortfolio:function(){
          this.show_lang_div=true;
          this.operation='add';
          this.ventanaOperPortfolio = true;
        },
        openEditPortfolio:function(index,portfolio){
          this.show_lang_div=false;
          this.lan_to_edit='none';
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
