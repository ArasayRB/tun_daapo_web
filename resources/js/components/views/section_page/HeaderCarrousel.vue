<template>
  
        <necesitas-plan-section-component>
        </necesitas-plan-section-component>
      
</template>

<script>
    export default {
      data(){
        return{
          sectionItem:[],
          src:'/storage/section_page/',
          section_name:this.$attrs.name_section,
          token:window.CSRF_TOKEN,
        }
      },
      created(){
       this.getSection();
      },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
