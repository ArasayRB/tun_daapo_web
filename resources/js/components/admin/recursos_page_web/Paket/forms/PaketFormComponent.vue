<template>
  <section class="mb-5" id="createPaketModal" name="createPaketModal"><!--Formulario createPaketModal-->
    <form  id="form-create-user">
      <transition class="modal fade pt-5" id="createPaketModalModal">
        <div class="modal-mask">
    <div class="modal-wrapper">
    <div class="modal-container">
      <div class="modal-header">
        <slot>
          <h1 class="text-center text-dark" v-if="show_lang_div===false">{{paket.name}}</h1>
        <h1 class="text-center text-dark" v-else="operation==='add'">{{ $trans('messages.Create') }} {{ $trans('messages.Packet') }}</h1>
        <h1 class="text-center text-dark" v-else="operation==='update'">{{ $trans('messages.Update') }} {{ $trans('messages.Packet') }}</h1>
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

              <div class="form-group" v-show="show_lang_div" v-if="operation==='add'">
                <label for="type_paket">{{ $trans('messages.Packet') }}</label>
                <select class="form-control" v-model="type_paket" name="type_paket" required v-if="operation==='add'">
                  <option value=''>{{ $trans('messages.Select') }} {{ $trans('messages.Packet Type') }}</option>
                  <option v-for="packet in packets" :value="packet.id">{{packet.name}}</option>
                </select>
                <select class="form-control" v-model="type_paket" name="type_paket" required v-if="operation==='update'">
                  <option value=''>{{ $trans('messages.Select') }} {{ $trans('messages.Packet Type') }}</option>
                  <option v-for="packet in packets" :selected=" paket.type_id=== packet.id" :value="packet.id" selected>{{packet.name}}</option>
                </select>
              </div>
              <div class="form-group" v-show="lan_to_edit==='none'" v-else="operation==='update'">
                <label for="type_paket">{{ $trans('messages.Packet') }}</label>
                <select class="form-control" v-model="type_paket" name="type_paket" required v-if="operation==='add'">
                  <option value=''>{{ $trans('messages.Select') }} {{ $trans('messages.Packet Type') }}</option>
                  <option v-for="packet in packets" :value="packet.id">{{packet.name}}</option>
                </select>
                <select class="form-control" v-model="type_paket" name="type_paket" required v-if="operation==='update'">
                  <option value=''>{{ $trans('messages.Select') }} {{ $trans('messages.Packet Type') }}</option>
                  <option v-for="packet in packets" :selected=" paket.type_id=== packet.id" :value="packet.id" selected>{{packet.name}}</option>
                </select>
              </div>

              <div class="form-group">
                <label for="name">{{ $trans('messages.Name') }}</label>
                <input type="text" name="name" v-model="name" class="form-control font-italic mb-2" v-if="operation==='add'">
                <input type="text" name="name" v-model="paket.name" class="form-control font-italic mb-2" v-if="operation==='update'">
              </div>

              <div class="form-group" v-show="show_lang_div" v-if="operation==='add'">
                <label for="functions">{{ $trans('messages.Functions Included') }}: <span class="text-danger">{{ $trans('messages.Separate with (,) please') }}</span></label></label>

                <tags-input element-id="servcs" name="functions" :add-tags-on-comma=true	class=""
                v-model="selectedFunc"
                placeholder="Add a function"
                :existing-tags="functions"
                id-field="key"
                text-field="value"
                :typeahead="true">
              </tags-input>
            </div>
            <div class="form-group" v-show="lan_to_edit==='none'" v-else="operation==='update'">
              <label for="functions">{{ $trans('messages.Functions Included') }}: <span class="text-danger">{{ $trans('messages.Separate with (,) please') }}</span></label></label>

              <tags-input element-id="servcs" name="functions" :add-tags-on-comma=true	class=""
              v-model="selectedFunc"
              placeholder="Add a function"
              :existing-tags="functions"
              id-field="key"
              text-field="value"
              :typeahead="true">
            </tags-input>
          </div>

            <div class="form-group">
              <label for="name_button">{{ $trans('messages.Name') }} {{ $trans('messages.Button') }}</label>
              <input type="text" name="name_button" v-model="name_button" class="form-control font-italic mb-2" v-if="operation==='add'">
              <input type="text" name="name_button" v-model="paket.name_button" class="form-control font-italic mb-2" v-if="operation==='update'">
            </div>

            <div class="form-group">
              <label for="description">{{ $trans('messages.Description') }}</label>
              <vue-ckeditor
              v-model="description"
              :config="config"
              @blur="onBlur($event)"
              @focus="onFocus($event)"
              @contentDom="onContentDom($event)"
              @dialogDefinition="onDialogDefinition($event)"
              @fileUploadRequest="onFileUploadRequest($event)"
              @fileUploadResponse="onFileUploadResponse($event)"
              v-if="operation==='add'"/>
              <vue-ckeditor
              v-model="paket.description"
              :config="config"
              @blur="onBlur($event)"
              @focus="onFocus($event)"
              @contentDom="onContentDom($event)"
              @dialogDefinition="onDialogDefinition($event)"
              @fileUploadRequest="onFileUploadRequest($event)"
              @fileUploadResponse="onFileUploadResponse($event)"
              v-if="operation==='update'"/>
            </div>

            <div class="form-group" v-show="show_lang_div" v-if="operation==='add'">
              <label for="price">{{ $trans('messages.Price') }}</label>
              <input type="number" min="1"  step="0.1" name="price" v-model="price" class="form-control font-italic mb-2" v-if="operation==='add'">
              <input type="number" min="1"  step="0.1" name="price" v-model="paket.price" class="form-control font-italic mb-2" v-if="operation==='update'">
            </div>

            <div class="form-group" v-show="lan_to_edit==='none'" v-else="operation==='update'">
              <label for="price">{{ $trans('messages.Price') }}</label>
              <input type="number" min="1"  step="0.1" name="price" v-model="price" class="form-control font-italic mb-2" v-if="operation==='add'">
              <input type="number" min="1"  step="0.1" name="price" v-model="paket.price" class="form-control font-italic mb-2" v-if="operation==='update'">
            </div>
            <div class="form-group" v-show="show_lang_div" v-if="operation==='add'">
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

          <div class="form-group" v-show="lan_to_edit==='none'" v-else="operation==='update'">
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
            <button type="button" class="btn rounded btn-primary reserva" @click="createPaket()" v-show="operation==='add'" v-if="show_lang_div===false">{{ $trans('messages.Translate') }}</button>
            <button type="button" class="btn rounded btn-primary reserva" @click="createPaket()" v-show="operation==='add'" v-else>{{ $trans('messages.Create') }}</button>

              <button type="button" class="btn rounded btn-primary reserva" @click="editedPaket(paket)" v-if="operation==='update'">{{ $trans('messages.Update') }}</button>

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
      props:['locale','paket','operation','show_lang_div','lan_to_edit'],
      data(){
        return {
          msgAddTag:this.$trans('messages.Add a new Tag'),
          services: [],
          selectedServs: [],
          functions: [],
          selectedFunc: [],
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
          description:'',
          lang_trans:'',
          price:'',
          map:'',
          packets:[],
          packet:[],
          type_paket:'',
          value:'',
          name:'',
          name_button:'',
          src:'images/lang/',
          ventanaOperPaket:false,
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
      axios.get('/languages-no-translated/'+this.paket.id+'/Paket')
            .then(response=> this.languages=response.data)
            .catch(error=>this.error.push(error));
    },
    packetType:function(){
      axios.get('/packet-type-list')
           .then(response => this.packets = response.data)
           .catch(error => this.errors.push(error));
    },
    availabelServices:function(){
      axios.get('/available-services')
           .then(response =>{
             this.services = response.data;
           })
           .catch(error => this.errors.push(error));
    },
    availabelFunctions:function(){
      axios.get('/available-functions')
           .then(response =>{
             this.functions = response.data;
           })
           .catch(error => this.errors.push(error));
    },
        createPaket:function(){
          let url;
          let msg_succ;
          let data;
          let mensaje;
          let default_lang=this.$lang.getLocale();
          if(this.show_lang_div===false){
            url="/add-translate-packet";
            msg_succ=this.$trans('messages.Packet')+' '+this.$trans('messages.Translated Succefully');
            let mensaje=this.$trans('messages.Unidentified error');
            if (this.name==''||this.name_button==''||this.description==''||this.lang_trans=='') {
              mensaje=this.$trans('messages.You cannot leave empty fields, please check');
            }
            data = new FormData();
              data.append("name", this.name);
              data.append("name_old", this.paket.name);
              data.append("paket_id", this.paket.id);
              data.append("lang", this.lang_trans);
              data.append("description", this.description);
                data.append("name_button", this.name_button);
          }
          else{
            url="/paket";
            msg_succ=this.$trans('messages.Packet')+' '+this.$trans('messages.Created.');
            mensaje=this.$trans('messages.Unidentified error');
            if (this.name==''||this.name_button==''||this.description==''||this.price==''||this.selectedServs.length===0||this.type_paket=='') {
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

            let functList=this.selectedFunc;
            let functKey="";
            for(var i=0; i<functList.length;i=i+1){
              if(i==(functList.length-1)){
              functKey= ''+functKey+functList[i].value;
            }
            else{
              functKey= ''+functKey+functList[i].value+',';
            }
            }

            data = new FormData();
              data.append("name", this.name);
                data.append("name_button", this.name_button);
              data.append("description", this.description);
              data.append("price", this.price);
              data.append("service_id", portKey);
              data.append("type_id",this.type_paket);
              data.append("functions_included",functKey);
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
                          this.$emit('paketnew',roleAdd);

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
                   if(wrong.hasOwnProperty('name_button')){
                     mensaje+='-'+wrong.name_button[0];
                   }
                   if(wrong.hasOwnProperty('description')){
                     mensaje+='-'+wrong.description[0];
                   }
                   if(wrong.hasOwnProperty('price')){
                     mensaje+='-'+wrong.price[0];
                   }
                   if(wrong.hasOwnProperty('map')){
                     mensaje+='-'+wrong.map[0];
                   }
                   if(wrong.hasOwnProperty('type_id')){
                     mensaje+='-'+wrong.map[0];
                   }
                   if(wrong.hasOwnProperty('functions_included')){
                     mensaje+='-'+wrong.map[0];
                   }
                   swal('Error',mensaje,'error');
                   //console.log(error.response.data);
                 });

        },
        editedPaket:function(paket){
          let url;
          let data;
          let msg_edited;
          let config= { headers: {"Content-Type": "multipart/form-data" }};
          if(this.lan_to_edit==='none'){
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

            let functList=this.selectedFunc;
            let functKey="";
            for(var i=0; i<functList.length;i=i+1){
              if(i==(functList.length-1)){
              functKey= ''+functKey+functList[i].value;
            }
            else{
              functKey= ''+functKey+functList[i].value+',';
            }
            }
                data = new FormData();
      	          data.append('_method', 'patch');
                  data.append("name", paket.name);
                  data.append("name_button", paket.name_button);
                  data.append("description", paket.description);
                  data.append("price", paket.price);
                  data.append("service_id", portKey);
                  data.append("type_id",this.type_paket);
                  data.append("functions_included",functKey);
                url="/paket/"+paket.id;
                msg_edited=this.$trans('messages.Packet')+' '+this.$trans('messages.Edited');
          }
          else{
            data = new FormData();
              data.append("name", paket.name);
              data.append("name_button", paket.name_button);
              data.append("description", paket.description);
              //data.append("tags", postTags);
              //data.append("keywords", postKeys);
            url="/packet-translated-edited/"+paket.id+"/"+this.lan_to_edit;
            msg_edited=this.$trans('messages.The')+' '+this.$trans('messages.Packet')+' '+this.$trans('messages.translation has been successfully modified');
          }



          axios.post(url,data,config)
               .then(response=>{
                 swal({title:this.$trans('messages.Packet'),
                       text:msg_edited,
                       icon:'success',
                       closeOnClickOutside:false,
                       closeOnEsc:false
                     }).then(select=>{
                       if (select){
                         let paketUpdate=response.data;
                         this.$emit('paketperupd',paketUpdate);
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
                 if(wrong.hasOwnProperty('name_button')){
                   mensaje+='-'+wrong.name_button[0];
                 }
                 if(wrong.hasOwnProperty('description')){
                   mensaje+='-'+wrong.description[0];
                 }
                 if(wrong.hasOwnProperty('price')){
                   mensaje+='-'+wrong.price[0];
                 }
                 if(wrong.hasOwnProperty('map')){
                   mensaje+='-'+wrong.map[0];
                 }
                 if(wrong.hasOwnProperty('type_id')){
                   mensaje+='-'+wrong.map[0];
                 }
                 if(wrong.hasOwnProperty('functions_included')){
                   mensaje+='-'+wrong.map[0];
                 }
                 swal('Error',mensaje,'error');
                 //console.log(error.response.data);
               });
        },
      },
      created: function () {
        this.availabelServices();
        this.packetType();
        this.availabelFunctions();
        this.getLanguageList();
        console.log('paket',this.paket);
        if(this.operation==='update'){
          for(var i=0; i<this.paket.services.length;i++){
            this.selectedServs.push({'key':'',
                                      'value':this.paket.services[i].name});
          }
          for(var i=0; i<this.paket.functions.length;i++){
            this.selectedFunc.push({'key':'',
                                      'value':this.paket.functions[i].name});
          }
          this.type_paket=this.paket.type_id;
        }
         },
        mounted() {
        }
    }
</script>
