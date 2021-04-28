<template>
  <section class="mb-5" id="createPaketTypeModal" name="createPaketTypeModal"><!--Formulario createPaketTypeModal-->
    <form  id="form-create-user">
      <transition class="modal fade pt-5" id="createPaketTypeModalModal">
        <div class="modal-mask">
    <div class="modal-wrapper">
    <div class="modal-container">
      <div class="modal-header">
        <slot>
          <h1 class="text-center text-dark" v-if="show_lang_div===false">{{paket_type.name}}</h1>
        <h1 class="text-center text-dark" v-else="operation==='add'">{{ $trans('messages.Create') }} {{ $trans('messages.Packet Type') }}</h1>
        <h1 class="text-center text-dark" v-else="operation==='update'">{{ $trans('messages.Update') }} {{ $trans('messages.Packet Type') }}</h1>
        <button type="button" class="modal-default-button btn btn-lg" @click="$emit('close')"><span aria-hidden="true">&times;</span></button>

        </slot>
      </div>

    <div class="modal-body">
      <slot>
        <div class="container mt-5">
          <div class="row justify-content-center">
            <div class="col-12">

              <div class="form-group" id="language_div" v-show="show_lang_div!=true" v-if="operation=='add'">
                <label for="lang_trans">{{ $trans('messages.Language') }}</label>
                <select class="form-control" v-model="lang_trans" name="lang_trans" required>
                 <option value=''>{{ $trans('messages.Select') }} {{ $trans('messages.Language') }}</option>
                   <option v-for="language in languages" :value="language.id">{{language.language}}</option>
                </select>
              </div>

              <div class="form-group">
                <label for="name">{{ $trans('messages.Name') }}</label>
                <input type="text" name="name" v-model="name" class="form-control font-italic mb-2" v-if="operation==='add'">
                <input type="text" name="name" v-model="paket_type.name" class="form-control font-italic mb-2" v-if="operation==='update'">
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
            <button type="button" class="btn rounded btn-primary reserva" @click="createPaketType()" v-show="operation==='add'" v-if="show_lang_div===false">{{ $trans('messages.Translate') }}</button>
            <button type="button" class="btn rounded btn-primary reserva" @click="createPaketType()" v-show="operation==='add'" v-else>{{ $trans('messages.Create') }}</button>

              <button type="button" class="btn rounded btn-primary reserva" @click="editedPaketType(paket_type)" v-if="operation==='update'">{{ $trans('messages.Update') }}</button>

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
      props:['locale','paket_type','operation','show_lang_div','lan_to_edit'],
      data(){
        return {
          msgAddTag:this.$trans('messages.Add a new Tag'),
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
          languages:[],
          language:'',
          activeClass:'active',
          showClass:'show',
          phone:'',
          name:'',
          map:'',
          value:'',
          lang_trans:'',
          email:'',
          src:'images/lang/',
          ventanaOperPaketType:false,
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
    getLanguageList:function(){
      axios.get(window.location.origin +'/'+this.$attrs.locale+'/languages-no-translated/'+this.paket_type.id+'/Paket Type')
            .then(response=> this.languages=response.data)
            .catch(error=>this.error.push(error));
    },
        createPaketType:function(){
          let url;
          let msg_succ;
          let data;
          let mensaje;
          let default_lang=this.$lang.getLocale();

          if(this.show_lang_div===false){
            url=window.location.origin +'/'+this.$attrs.locale+"/admin/add-translate-packet-type";
            msg_succ=this.$trans('messages.Packet Type')+' '+this.$trans('messages.Translated Succefully');
            let mensaje=this.$trans('messages.Unidentified error');
            if (this.name==''||this.lang_trans=='') {
              mensaje=this.$trans('messages.You cannot leave empty fields, please check');
            }
            data = new FormData();
              data.append("name", this.name);
              data.append("name_old", this.paket_type.name);
              data.append("packet_type_id", this.paket_type.id);
              data.append("lang", this.lang_trans);
          }
          else{
            url=window.location.origin +'/'+this.$attrs.locale+"/admin/pakettypes";
            msg_succ=this.$trans('messages.Packet Type')+' '+this.$trans('messages.Created.');
            mensaje=this.$trans('messages.Unidentified error');
            if (this.name=='') {
              mensaje=this.$trans('messages.You cannot leave empty fields, please check');
            }

            data = new FormData();
              data.append("name", this.name);
          }



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
                          this.$emit('pakettypenew',roleAdd);

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
                   if(wrong.hasOwnProperty('name')){
                     mensaje+='-'+wrong.name[0];
                   }
                   swal('Error',mensaje,'error');
                   //console.log(error.response.data);
                 });

        },
        editedPaketType:function(paket_type){
          let url;
          let data;
          let msg_edited;
          let config= { headers: {"Content-Type": "multipart/form-data" }};

          if(this.lan_to_edit==='none'){
            data = new FormData();
              data.append('_method', 'patch');
              data.append("name", paket_type.name);
            url=window.location.origin +'/'+this.$attrs.locale+"/admin/pakettypes/"+paket_type.id;
            msg_edited=this.$trans('messages.Packet Type')+' '+this.$trans('messages.Edited');
          }
          else{
            data = new FormData();
              data.append("name", paket_type.name);
              //data.append("tags", postTags);
              //data.append("keywords", postKeys);
            url=window.location.origin +'/'+this.$attrs.locale+"/admin/packet-type-translated-edited/"+paket_type.id+"/"+this.lan_to_edit;
            msg_edited=this.$trans('messages.The')+' '+this.$trans('messages.Packet Type')+' '+this.$trans('messages.translation has been successfully modified');
          }



          axios.post(url,data,config)
               .then(response=>{
                 swal({title:this.$trans('messages.Packet Type'),
                       text:msg_edited,
                       icon:'success',
                       closeOnClickOutside:false,
                       closeOnEsc:false
                     }).then(select=>{
                       if (select){
                         let paketTypeUpdate=response.data;
                         this.$emit('pakettypeoperupd',paketTypeUpdate);
                       }
                     });
                 //console.log(response);
               })
               .catch(error=>{
                 if(error.response.data.message){
                   swal('Error',''+error.response.data.message,'error');
                 }
                 if(wrong.hasOwnProperty('name')){
                   mensaje+='-'+wrong.name[0];
                 }
                 swal('Error',mensaje,'error');
                 //console.log(error.response.data);
               });
        },
      },
      created: function () {
         this.getLanguageList();
         },
        mounted() {
          if (this.locale) {
               this.$lang.setLocale(this.locale);
               }
          else {
            this.$lang.setLocale('en');
          }
        }
    }
</script>
