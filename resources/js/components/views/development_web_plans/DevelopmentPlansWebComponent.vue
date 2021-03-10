<template>
  <div class="card-deck mb-3 text-center mt-5">
  <div class="card mb-4 shadow-sm" v-for="(planItem, index) in plansItem">
    <div :class="planItem.name=='Premium'?classe='card-header bg-warning':'card-header'">
      <h4 class="my-0 font-weight-normal"><small class="text-muted h3">{{planItem.name}}</small></h4>
    </div>
    <div :class="planItem.name=='Premium'?classe='card-body bg-dark':'card-body'">
      <p class="text-light" v-if="planItem.name=='Premium'"> a partir de</p>
      <h1 class="card-title pricing-card-title"><small :class="planItem.name=='Premium'?classe='text-light':'text-muted'">${{planItem.price}}</small></h1>
      <ul class="list-unstyled mt-3 mb-4">
        <li :class="planItem.name=='Premium'?classe='text-light':''" v-for="(funct,index_func) in planItem.functions" v-html="funct.name"></li>
      </ul>
      <button type="button" :class="index==0?btn_bg='btn btn-lg btn-block btn-light btn-outline-primary contrata':planItem.name==='Premium'?btn_bt='btn btn-lg btn-warning btn-block contrata':'btn btn-lg btn-block contrata btn-primary'" class="btn btn-lg btn-block btn-primary contrata">{{planItem.name_button}}</button>
    </div>
  </div>
  </div>
</template>

<script>
    export default {
      data(){
        return{
          plansItem:[],
          planItem:[],
          token:window.CSRF_TOKEN,
        }
      },
      methods:{

        getPlans:function(){
          axios.get('/paketList')
              .then(response =>{
                this.plansItem=response.data;
                if(this.plansItem.length===0){
             $("#planes_precios").hide(true);
                }
              /*  else{
                  this.comentarios=
                }*/
              });
        },
      },
      created(){
       this.getPlans();
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
