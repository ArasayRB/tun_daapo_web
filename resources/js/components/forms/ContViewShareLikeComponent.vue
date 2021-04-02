<template>
     <div class="redes-chat">
       <a href="#" class="fa fa-eye d-block text-decoration-none bg-fuccia text-white text-center" title="Reads/ Lecturas">{{cant_read}}</a>
       <a href="#" @click="addLove()" class="fa fa-heart d-block text-decoration-none bg-fuccia text-white text-center" title="Show your love/ Muestra tu amor">{{likes}}</a>
       <a href="#" @click="shareSocialMedia('facebook')" class="fab fa-facebook d-block text-decoration-none bg-fuccia text-white text-center" title="Share/ Compartir"></a>
       <a href="#" @click="shareSocialMedia('twitter')" class="fab fa-twitter d-block text-decoration-none bg-fuccia text-white text-center" title="Share/ Compartir"></a>
     </div>

</template>

<script>
    export default {
      props:['id_post','cant_read', 'cant_shares', 'cant_likes', 'title', 'url_post'],
      data(){
        return {
          model:this.$attrs.model,
          likes:'',
          sharess:'',
          token   : window.CSRF_TOKEN,

        }
      },
      methods:{
        shareSocialMedia:function(media){
        let url='/share/'+this.id_post+'/'+media;
        let urlSocial;
        if(media==='facebook'){
          urlSocial='http://www.facebook.com/sharer.php?u='+this.url_post+'&t='+this.title;
        }

        else if (media==='twitter'){
          urlSocial='https://twitter.com/share?url='+this.url_post+'&text='+this.title;
        }
        var lba = document.getElementsByClassName("social-button")

       function myPopup() {
           window.open(urlSocial, 'mywin',
                   'left=20,top=20,width=500,height=500,toolbar=1,resizable=0');
           event.preventDefault();
           return false;
       }

       for (var i = 0; i < lba.length; i++) {
           lba[i].addEventListener("click", myPopup, false);
       }
      let data = new FormData();
        data.append("page", urlSocial);
        data.append("neth", media);
      axios.post(url,data)
        .then(response=>{
          let shar=response.data;
          this.sharess=shar.cant_shares;

        })
             .catch(error => this.errors.push(error));

      },
      addLove:function(){
        let url='/post-love/'+this.id_post;
        axios.post(url)
        .then(response=>{

            let lik=response.data;
          swal({title:this.$trans('messages.Thanks!'),
                text:this.$trans('messages.Thank you, we love you to!'),
                icon:'success',
                closeOnClickOutside:false,
                closeOnEsc:false
              }).then(select=>{
                if (select){
                  this.likes=lik.cant_likes;
                }
              });
        })
             .catch(error => this.errors.push(error));
      },
      },
        mounted() {
          this.likes=this.cant_likes;
          this.sharess=this.cant_shares;
          if (this.$attrs.locale) {
               this.$lang.setLocale(this.$attrs.locale);
               }
          else {
            this.$lang.setLocale('en');
          }
        }
    }
</script>
