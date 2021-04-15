<template>
  <div class="row">
   <div class="panel pt-5 pb-5 mt-5 shadow w-50 text-center col"  v-for="(comment,index) in comments" id="all-comments-post">
    <div class="panel-header">
     <h3 class="panel-title text-center text-dark">{{comment.fullName}}</h3>
     <div class="text-center" id="form">
     <p class="clasificacion">

       <input :id="'radio1_'+index" type="radio" v-if="comment.evaluation==='5'" :name="'estrellas_'+index" value="5" disabled checked>
       <input :id="'radio1_'+index" type="radio" v-else :name="'estrellas_'+index" value="5"  disabled>
       <label :for="'radio1_'+index">★</label>
       <input :id="'radio2_'+index" type="radio" v-if="comment.evaluation==='4'" :name="'estrellas_'+index" value="4" disabled checked>
       <input :id="'radio2_'+index" type="radio" v-else :name="'estrellas_'+index" value="4"  disabled>
       <label :for="'radio2_'+index">★</label>
       <input :id="'radio3_'+index" type="radio" v-if="comment.evaluation==='3'" :name="'estrellas_'+index" value="3" disabled checked>
       <input :id="'radio3_'+index" type="radio" v-else :name="'estrellas_'+index" value="3"  disabled>
       <label :for="'radio3_'+index">★</label>
       <input :id="'radio4_'+index" type="radio" v-if="comment.evaluation==='2'" :name="'estrellas_'+index" value="2" disabled checked>
       <input :id="'radio4_'+index" type="radio" v-else :name="'estrellas_'+index" value="2"  disabled>
       <label :for="'radio4_'+index">★</label>
       <input :id="'radio5_'+index" type="radio" v-if="comment.evaluation==='1'" :name="'estrellas_'+index" value="1" disabled checked>
       <input :id="'radio5_'+index" type="radio" v-else :name="'estrellas_'+index" value="1"  disabled>
       <label :for="'radio5_'+index">★</label>
     </p>
     </div>
    </div>
    <div class="panel-body mb-1">
      {{comment.comment}} <small class="badge float-right text-dark">{{comment.time}}</small>
    </div>
    <div class="panel-footer mt-1">
      <button type="button" :name="'button_'+index" @click="showAnsware(index)" class="btn btn-primary fas fa-reply float-right" title="Reply/Responder" v-show="comment.count_answer<max_answers"></button>
      <button type="button" :name="'button_close_'+index" @click="closeAnsware(index)" class="btn btn-primary font-weight-bold" v-show="comment.show==='true'" title="Cancel/Cancelar"> X</button>
      <button type="button" :name="'button_plus_'+index" @click="searchAnsware(comment)" class="btn btn-primary fas fa-comments" v-show="comment.has_answer=='yes'" title="Answers/Respuestas"></button>
      <comment-post-component @recharge="allComments" :post="post_id" :poster="user_email" :comment_reply="comment.id" :company_email="tuun_daapo_data.email" answer="yes" :id="'comment_'+index" v-show="comment.show==='true'">
      </comment-post-component>
      <all-ans-comments-component :answares="answares" :post="post_id" :poster="user_email" :comment_reply="comment.id" :company_email="tuun_daapo_data.email" answer="yes">
      </all-ans-comments-component>
    </div>
   </div>
  </div>
</template>

<script>
    export default {
      data(){
        return {
          email:'',
          tuun_daapo_data:[],
          comments:[],
          answares:[],
          post_id:this.$attrs.id_post,
          user_email:this.$attrs.user_email,
          name:'',
          max_levels:0,
          max_answers:0,
          valuation:0,
          message:'',
          privacy:'',
          token   : window.CSRF_TOKEN,

        }
      },
      methods:{
        showAnsware:function(index){
          this.comments[index]['show']='true';
        },
        closeAnsware:function(index){
          this.comments[index]['show']='false';
        },
        searchAnsware:function(comment){
          axios.get('/comments-post-answare/'+this.post_id+'/'+comment.id)
               .then(response =>{
                 this.answares=response.data;

               });
        },
        allComments:function(){
          axios.get('/comments-post/'+this.post_id)
               .then(response =>{
                 this.comments=response.data;

               });
        },
        configComments:function(){
          axios.get('/config-comments')
               .then(response =>{
                 this.max_levels=response.data.max_nivel;
                 this.max_answers=response.data.max_answers;
               });
        },
        tunDaapoData:function(){
          axios.get('/tun-daapo-contact')
               .then(response =>{
                 this.tuun_daapo_data=response.data;

               });
        },
      makeComment:function(){
        let url="/leave-comment";
        let mensaje=this.$trans('messages.Unidentified error');
        if (this.email==''||this.name==''||this.message=='') {
          mensaje=this.$trans('messages.You cannot leave empty fields, please check');
        }
        if(this.privacy==''||this.privacy!=true){
          swal({title:this.$trans('messages.Warning!'),
                text:this.$trans('messages.You need accept Privacy Policy, please.'),
                icon:'warning',
                closeOnClickOutside:false,
                closeOnEsc:false
              });
        }
        else{
        let data = new FormData();
            data.append("email", this.email);
            data.append("name", this.name);
            data.append("token", this.token);
            data.append("message", this.message);
            data.append("valuation", this.valuation);
            data.append("privacy", this.privacy);
            data.append("company_email", this.tuun_daapo_data.email);
            data.append("poster_email", this.user_email);
            data.append("post_id", this.post_id);

          axios.post(url,data)
               .then(response=>{
                 let contact=response.data;
                 this.email='';
                 this.name='';
                 this.message='';
                 this.valuation=0;
                 swal({title:this.$trans('messages.Comment')+' '+this.$trans('messages.sended'),
                       text:this.$trans('messages.Thank you')+'!',
                       icon:'success',
                       closeOnClickOutside:false,
                       closeOnEsc:false
                     });

                 //console.log(response);
               })
               .catch(error=>{
                 if(error.response.data.message){
                   swal('Error',''+error.response.data.message,'error');
                 }
                 let wrong=error.response.data.errors;
                 if(wrong.hasOwnProperty('email')){
                   mensaje+='-'+wrong.email[0];
                 }
                 if(wrong.hasOwnProperty('name')){
                   mensaje+='-'+wrong.name[0];
                 }
                 if(wrong.hasOwnProperty('message')){
                   mensaje+='-'+wrong.message[0];
                 }

                 swal('Error',mensaje,'error');
                 //console.log(error.response.data);
               });
             }
        //alert('Hola');
      }
      },
        mounted() {
          this.tunDaapoData();
          this.allComments();
          this.configComments();
          this.privacy=true;
          if (this.$attrs.locale) {
               this.$lang.setLocale(this.$attrs.locale);
               }
          else {
            this.$lang.setLocale('en');
          }
        }
    }
</script>
