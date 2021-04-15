<template>
  <div>
    <div v-show="answares.length>0" v-for="(ans,position) in answares">
    <div class="panel pt-5 pb-5 mt-5 shadow w-60 text-center col float-right" v-if="ans.answer_to===comment_reply">
      <div class="panel-header">
       <h3 class="panel-title text-center text-dark">{{ans.fullName}}</h3>
      </div>
     <div class="panel-body">
      {{ans.comment}} <small class="badge float-right text-dark">{{ans.time}}</small>
     </div>
     <div class="panel-footer mt-1">
       <button type="button" :name="'ans_button_'+position" @click="showAnsware(position)" class="btn btn-primary fas fa-reply float-right" title="Reply/Responder" v-show="ans.count_answer<max_answers"></button>
       <button type="button" :name="'ans_button_close_'+position" @click="closeAnsware(position)" class="btn btn-primary font-weight-bold" v-show="ans.show==='true'" title="Cancel/Cancelar"> X</button>
       <button type="button" :name="'ans_button_plus_'+position" @click="searchAnsware(ans)" class="btn btn-primary fas fa-comments" v-show="ans.has_answer=='yes'" title="Answers/Respuestas"></button>
       <comment-post-component @recharge="searchAnsware(ans)" :moderator="moderator" :dashboard="dashboard" :post="post" :poster="poster" :comment_reply="ans.id" :company_email="company_email" answer="yes" :id="'ans_comment_'+position" v-show="ans.show==='true'">
       </comment-post-component>
       <all-ans-comments-component :answares="comments" :post="post" :poster="poster" :comment_reply="ans.id" :company_email="company_email" answer="yes" :id="'ans_comment_'+position">
       </all-ans-comments-component>
     </div>
    </div>
  </div>
  </div>
</template>

<script>
    export default {
      props:['moderator','answares','post','poster','comment_reply','company_email','answer'],
      data(){
        return {
          email:'',
          comments:[],
          name:'',
          max_levels:0,
          max_answers:0,
          valuation:0,
          message:'',
          privacy:'',
          dashboard:this.$attrs.dashboard,
          token   : window.CSRF_TOKEN,

        }
      },
      methods:{
        showAnsware:function(index){
          this.answares[index]['show']='true';
        },
        closeAnsware:function(index){
          this.answares[index]['show']='false';
        },
        searchAnsware:function(comment){
          axios.get('/comments-post-answare/'+this.post+'/'+comment.id)
               .then(response =>{
                 this.comments=response.data;

               });
        },
        /*allComments:function(){
          axios.get('/comments-post/'+this.post_id)
               .then(response =>{
                 this.comments=response.data;

               });
        },*/
        configComments:function(){
          axios.get('/config-comments')
               .then(response =>{
                 this.max_levels=response.data.max_nivel;
                 this.max_answers=response.data.max_answers;
               });
        },
        /*tunDaapoData:function(){
          axios.get('/tun-daapo-contact')
               .then(response =>{
                 this.tuun_daapo_data=response.data;

               });
        },*/
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
        //  this.tunDaapoData();
        //  this.allComments();
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
