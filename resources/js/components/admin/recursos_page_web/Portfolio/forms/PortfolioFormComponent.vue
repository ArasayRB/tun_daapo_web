<template>
  <section class="mb-5" id="createPortfolioModal" name="createPortfolioModal"><!--Formulario createPortfolioModal-->
    <form  id="form-create-user">
      <transition class="modal fade pt-5" id="createPortfolioModalModal">
        <div class="modal-mask">
    <div class="modal-wrapper">
    <div class="modal-container">
      <div class="modal-header">
        <slot>
        <h1 class="text-center text-dark" v-if="operation==='add'">{{ $trans('messages.Create') }} {{ $trans('messages.Portfolio') }}</h1>
        <h1 class="text-center text-dark" v-if="operation==='update'">{{ $trans('messages.Update') }} {{ $trans('messages.Portfolio') }}</h1>
        <button type="button" class="modal-default-button btn btn-lg" @click="$emit('close')"><span aria-hidden="true">&times;</span></button>

        </slot>
      </div>

    <div class="modal-body">
      <slot>
        <div class="container mt-5">
          <div class="row justify-content-center">
            <div class="col-12">


<div class="form-group">
  <label for="img">{{ $trans('messages.Image') }}</label>
  <input type="file" name="img"  v-on:change="img" class="form-control font-italic mb-2" v-if="operation==='add'">
  <input type="file" name="img"  v-on:change="img" class="form-control font-italic mb-2" v-if="operation==='update'">
  <div class="row" v-if="operation==='update'">
    <img :src="src+portfolio.img" :alt="portfolio.img" width="100">
  </div>
</div>

<div class="form-group">
  <label for="empresa_solicitante">{{ $trans('messages.Agency/Freelancer') }}</label>
  <input type="text" name="empresa_solicitante" v-model="empresa_solicitante" class="form-control font-italic mb-2" v-if="operation==='add'">
  <input type="text" name="empresa_solicitante" v-model="portfolio.empresa_solicitante" class="form-control font-italic mb-2" v-if="operation==='update'">
</div>

<div class="form-group">
  <label for="project_name">{{ $trans('messages.Project') }} {{ $trans('messages.Name') }}</label>
  <input type="text" name="project_name" v-model="project_name" class="form-control font-italic mb-2" v-if="operation==='add'">
  <input type="text" name="project_name" v-model="portfolio.project_name" class="form-control font-italic mb-2" v-if="operation==='update'">
</div>

<div class="form-group">
  <label for="description">{{ $trans('messages.Description') }}</label>
  <input type="text" name="description" v-model="description" class="form-control font-italic mb-2" v-if="operation==='add'">
  <input type="text" name="description" v-model="portfolio.description" class="form-control font-italic mb-2" v-if="operation==='update'">
</div>

<div class="form-group">
  <label for="service">{{ $trans('messages.Service') }}: <span class="text-danger">{{ $trans('messages.Separate with (,) please') }}</span></label></label>

  <tags-input element-id="servcs" name="service" :add-tags-on-comma=true	class=""
     v-model="selectedServs"
     placeholder="Add a service"
     :existing-tags="services"
     id-field="key"
     text-field="value"
     :typeahead="true">
  </tags-input>
</div>






            </div>

          </div>
        </div>
      </slot>
    </div>
    <div class="modal-footer">
      <slot>
        <div class="col justify-content-center">
      <div class="form-group row mb-0">
          <div class="col-md-5 offset-md-4">
            <button type="button" class="btn rounded btn-primary reserva" @click="createPortfolio()" v-if="operation==='add'">{{ $trans('messages.Create') }}</button>

              <button type="button" class="btn rounded btn-primary reserva" @click="editedPortfolio(portfolio)" v-if="operation==='update'">{{ $trans('messages.Update') }}</button>

              <button type="button" class="modal-default-button btn btn-danger" @click="$emit('close')">{{ $trans('messages.Close') }}</button>

          </div>
      </div>
      </div>
      </slot>
    </div>
    </div>
    </div>
    </div>
  </transition>
    </form>
  </section><!--End Formulario login-->
</template>

<script>
  import VueCkeditor from 'vue-ckeditor2';
    export default {
      components: { VueCkeditor},
      props:['locale','portfolio','operation'],
      data(){
        return {
          msgAddTag:this.$trans('messages.Add a new Tag'),
          services: [],
          selectedServs: [],
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
          activeClass:'active',
          showClass:'show',
          empresa_solicitante:'',
          project_name:'',
          description:'',
          value:'',
          imagenPortfolio:'',
          src:'/storage/portfolio/',
          ventanaOperPortfolio:false,
          error:'',
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
    img:function(e){
      this.imagenPortfolio=e.target.files[0];
  console.log('im in',e.target.files[0]);
    },
    availabelServices:function(){
      axios.get('/available-services')
           .then(response =>{
             this.services = response.data;
           })
           .catch(error => this.errors.push(error));
    },
        createPortfolio:function(){

            let  url="/portfolio";
            let msg_succ=this.$trans('messages.Portfolio')+' '+this.$trans('messages.Created.');
            let mensaje=this.$trans('messages.Unidentified error');
            if (this.img==''||this.empresa_solicitante==''||this.project_name==''||this.selectedServs.length===0) {
              mensaje=this.$trans('messages.You cannot leave empty fields, please check');
            }

            let serviList=this.selectedServs;
            let portKey="";
            for(var i=0; i<serviList.length;i=i+1){
              if(i==(serviList.length-1)){
              portKey= ''+portKey+serviList[i].value;
            }
            else{
              portKey= ''+portKey+serviList[i].value+',';
            }
            }

            let data = new FormData();
              data.append("img", this.imagenPortfolio);
              data.append("empresa_solicitante", this.empresa_solicitante);
              data.append("project_name", this.project_name);
              data.append("description", this.description);
              data.append("service_id", portKey);



            axios.post(url,data)
                 .then(response=>{
                   swal({title:this.$trans('messages.Correct data'),
                         text:msg_succ,
                         icon:'success',
                         closeOnClickOutside:false,
                         closeOnEsc:false
                       }).then(select=>{
                         if (select){
                           let roleAdd=response.data;
                          this.$emit('portfolionew',roleAdd);

                           //location.reload();
                         }
                       });
                   //console.log(response);
                 })
                 .catch(error=>{
                   if(error.response.data.message){
                     swal('Error',''+error.response.data.message,'error');
                   }
                   let wrong=error.response.data.errors;
                   if(wrong.hasOwnProperty('img')){
                     mensaje+='-'+wrong.img[0];
                   }
                   if(wrong.hasOwnProperty('empresa_solicitante')){
                     mensaje+='-'+wrong.empresa_solicitante[0];
                   }
                   if(wrong.hasOwnProperty('project_name')){
                     mensaje+='-'+wrong.project_name[0];
                   }
                   if(wrong.hasOwnProperty('description')){
                     mensaje+='-'+wrong.description[0];
                   }
                   swal('Error',mensaje,'error');
                   //console.log(error.response.data);
                 });

        },
        editedPortfolio:function(portfolio){
          let url;
          let data;
          let msg_edited;
          let config= { headers: {"Content-Type": "multipart/form-data" }};

          let serviList=this.selectedServs;
          let portKey="";
          for(var i=0; i<serviList.length;i=i+1){
            if(i==(serviList.length-1)){
            portKey= ''+portKey+serviList[i].value;
          }
          else{
            portKey= ''+portKey+serviList[i].value+',';
          }
          }

              data = new FormData();
    	          data.append('_method', 'patch');
                data.append("img", this.imagenPortfolio);
                data.append("empresa_solicitante", portfolio.empresa_solicitante);
                data.append("project_name", portfolio.project_name);
                data.append("description", portfolio.description);
                data.append("service_id", portKey);
              url="/portfolio/"+portfolio.id;
              msg_edited=this.$trans('messages.Portfolio')+' '+this.$trans('messages.Edited');

          axios.post(url,data,config)
               .then(response=>{
                 swal({title:this.$trans('messages.Portfolio'),
                       text:msg_edited,
                       icon:'success',
                       closeOnClickOutside:false,
                       closeOnEsc:false
                     }).then(select=>{
                       if (select){
                         let portfolioUpdate=response.data;
                         this.$emit('portfoliooperupd',portfolioUpdate);
                       }
                     });
                 //console.log(response);
               })
               .catch(error=>{
                 if(error.response.data.message){
                   swal('Error',''+error.response.data.message,'error');
                 }
                 let wrong=error.response.data.errors;
                 if(wrong.hasOwnProperty('img')){
                   mensaje+='-'+wrong.img[0];
                 }
                 if(wrong.hasOwnProperty('empresa_solicitante')){
                   mensaje+='-'+wrong.empresa_solicitante[0];
                 }
                 if(wrong.hasOwnProperty('project_name')){
                   mensaje+='-'+wrong.project_name[0];
                 }
                 if(wrong.hasOwnProperty('description')){
                   mensaje+='-'+wrong.description[0];
                 }
                 swal('Error',mensaje,'error');
                 //console.log(error.response.data);
               });
        },
      },
      created: function () {
         this.availabelServices();
         if(this.operation==='update'){
           for(var i=0; i<this.portfolio.services.length;i++){
             this.selectedServs.push({'key':'',
                                       'value':this.portfolio.services[i].name});
           }
         }
         },
        mounted() {
        }
    }
</script>
