<template>
  <div>
  <div class="row py-lg-2">
    <div class="col-md-6">
      <h1 class="h3 mb-2 text-gray-800">{{ $trans('messages.Comment') }}</h1>
    </div>

  </div>
  <div class="card shadow mb-4">
    <comments-oper-form-component @commentnew="addCommentIndex" @commentperupd="updCommentIndex" :operation="operation" :lan_to_edit="lan_to_edit" :comment="comment" :locale="locale" :show_lang_div="show_lang_div" v-if="ventanaOperComment" @close="ventanaOperComment = false">

    </comments-oper-form-component>
    <div class="card-header py-3">
      <div class="row input-group">
      <h6 class="m-0 font-weight-bold text-primary col">{{ $trans('messages.List') }}</h6>
      <!-- Topbar Search -->
      <input-searcher-component :url="'/admin/all-comments'" :emit="'comments'" :locale="locale" @cancelsearch="commentList" @commentsfilter="filtersComment">
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
        <paginate class="pt-5 mt-3" ref="paginator" name = "comments" :list = "comments" :per = "2" :key="comments ? comments.length:0">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.Name') }}</th>
              <th>{{ $trans('messages.Email') }}</th>
              <th>{{ $trans('messages.Comment') }}</th>
              <th>{{ $trans('messages.Answer') }}s</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>{{ $trans('messages.Tools') }}</th>
              <th>{{ $trans('messages.Name') }}</th>
              <th>{{ $trans('messages.Email') }}</th>
              <th>{{ $trans('messages.Comment') }}</th>
              <th>{{ $trans('messages.Answer') }}s</th>
            </tr>
          </tfoot>
          <tbody>


                <tr v-for="(comment,index) in paginated('comments')" :comment="comment" :key="comment.id">

                    <td>
                        <a href="#" @click="openEditComment(index,comment)"><i class="fa fa-edit" title="Edit/Editar"></i></a>
                        <a href="#" @click="deleteComment(index,comment.id)"><i class="fa fa-trash-alt" title="Delete/Eliminar"></i></a>
                        <a href="#" @click="replayComment(index,comment)" v-show="comment.count_answer<max_answers"><i class="fas fa-reply" title="Reply/Responder"></i></a>
                        <a href="#" @click="viewCommentReplys(comment)" v-show="comment.has_answer=='yes'"><i class="fas fa-comments" title="Answers/Respuestas"></i></a>
                        <a id="publicado" :id="'publish-comment-post-'+comment.id" v-can-user="'publish-comment-post'" hidden>
                          <i :id="'publish-'+index" @click="publishIt(index,comment)" v-if="comment.show_btn==false" title="Publish it/Publicar" class="fa fa-toggle-off"></i>
                          <i :id="'unpublish-'+index"  @click="publishIt(index,comment)" v-else title="Publish it/Publicar" class="fa fa-toggle-on text-primary"></i>
                        </a>
                   </td>
                    <td>{{comment.fullName}}</td>
                    <td>{{comment.email}}</td>
                    <td>{{comment.comment}}</td>
                    <td><all-ans-comments-component :moderator="moderator" :answares="answares" :post="comment.post.id" :poster="comment.post.users.email" :comment_reply="comment.id" :company_email="tuun_daapo_data.email" answer="yes" dashboard="yes">
                    </all-ans-comments-component></td>

                </tr>



          </tbody>
        </table>
      </paginate>
           <strong class="text-primary">
             <paginate-links for="comments" :show-step-links="true"></paginate-links>
             <paginate-links
            for="comments"
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
          comments:[],
          comment:[],
          answares:[],
          moderator:[],
          tuun_daapo_data:[],
          permission_state:[],
          max_levels:0,
          max_answers:0,
          paginate:['comments'],
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
          src:window.location.origin +'/'+'storage/img_web/login_img/',
          src_qr:window.location.origin +'/'+'storage/qrcodes/permissions/',
          ventanaOperComment:false,
          token   : window.CSRF_TOKEN,

        }
      },
      methods:{
        filtersComment:function(filters){
          this.comments=filters;
        },
        configComments:function(){
          axios.get('/config-comments')
               .then(response =>{
                 this.max_levels=response.data.max_nivel;
                 this.max_answers=response.data.max_answers;
               });
        },
        publishIt:function(index,comment){
          //alert($("#publish-"+index).removeClass('fa-toggle-on'));
          let mssg;
          let state_act;

          if(comment.publish===0){
            mssg=this.$trans('messages.Do you want publish the comment');
            state_act=1;
          }
          else{
          mssg=this.$trans('messages.Do you want unpublish the comment');
          state_act=0;
        }
          swal({title:this.$trans('messages.Publish'),
                text:mssg+': '+comment.fullName+'?',
                icon:'warning',
                closeOnClickOutside:false,
                closeOnEsc:false,
                buttons:true,
                dangerMode:true,
                showCancelButton: true,
                confirmButtonText: this.$trans('messages.Yes'),
                cancelButtonText: this.$trans('messages.Cancel'),
              }).then(select=>{
                if (select){
                  let  url=window.location.origin +'/'+this.$attrs.locale+'/admin/publicate-comment/'+comment.id+'/'+state_act;

                  axios.post(url)
                       .then(response=>{
                         let publicated_comment=response.data;
                         swal({title:this.$trans('messages.Correct data'),
                               text:this.$trans('messages.The Comment had been publicate'),
                               icon:'success',
                               closeOnClickOutside:false,
                               closeOnEsc:false
                             }).then(select=>{
                               if (select){
                                 if(this.comments[index].show_btn===false){
                                 this.comments[index].show_btn=true;
                                 this.comments[index].publish=1;
                               }
                               else{
                               this.comments[index].show_btn=false;
                               this.comments[index].publish=0;
                             }

                                  // $("#publish-"+index).hide(true);

                               //location.reload();
                               }
                             });
                       })
                       .catch(error=>{
                         if(error.response.data.message){
                         swal('Error',''+error.response.data.message,'error');
                       }
                         let wrong=error.response.data.errors;

                         if (wrong.hasOwnProperty('login')){
                           mensaje+='-'+wrong.login[0];
                         }
                         swal('Error',mensaje,'error');
                       });
                }
              });

        },
        commentList:function(){
          axios.get(window.location.origin +'/'+this.$attrs.locale+'/admin/comments-list')
               .then(response =>{
                 this.comments = response.data;
                 if (response.data==''){
                   this.mensage=this.$trans('messages.None added yet');
                 }
               })
               .catch(error => this.errors.push(error));
        },
        tunDaapoData:function(){
          axios.get(window.location.origin +'/'+this.$attrs.locale+'/tun-daapo-contact')
               .then(response =>{
                 this.tuun_daapo_data=response.data;

               });
        },
        addCommentIndex:function(commentAdd){
          this.operation='';
          this.commentList();
          this.mensage="";
          this.show_lang_div=false;
          this.ventanaOperComment=false;
        },
        viewCommentReplys:function(comment){
          axios.get('/comments-post-answare/'+comment.post_id+'/'+comment.id)
               .then(response =>{
                 this.answares=response.data;

               });
        },
        updCommentIndex:function(commentUpd){
          this.operation='';
          this.show_lang_div=false;
          const position=this.comments.findIndex(comment=>comment.id===commentUpd.id);
          this.commentList();
          this.ventanaOperComment=false;
        },
        deleteComment:function(index,comment){
          let comment_id=comment;
            swal({title:this.$trans('messages.Delete')+' '+this.$trans('messages.Comment'),
                  text:this.$trans('messages.Are you completely sure you want to delete ')+this.$trans('messages.Comment')+'?',
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
                    let  url=window.location.origin +'/'+this.$attrs.locale+'/admin/comments-post/'+comment_id;
                    axios.delete(url)
                         .then(response=>{
                           swal({title:this.$trans('messages.Correct data'),
                                 text:this.$trans('messages.Comment')+' '+this.$trans('messages.Deleted'),
                                 icon:'success',
                                 closeOnClickOutside:false,
                                 closeOnEsc:false
                               }).then(select=>{
                                 if (select){
                                   this.commentList();
                                   if(this.comments.length===0){
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
        replayComment:function(index,comment){
          this.show_lang_div=true;
        this.comment=comment;
          this.operation='replay';
          this.ventanaOperComment=true;

        },
        openEditComment:function(index,comment){
          this.lan_to_edit='none';
          this.operation='update';
        this.comment=comment;
          this.ventanaOperComment=true;

        },

      },
      created: function () {
        this.tunDaapoData();
        this.commentList();
        this.configComments();
        this.moderator=UserId;
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
