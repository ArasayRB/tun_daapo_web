<template>

        <necesitas-plan-section-component :locale="locale">
        </necesitas-plan-section-component>

</template>

<script>
    export default {
      data(){
        return{
          sectionItem:[],
          locale:this.$attrs.locale,
          src:'/storage/section_page/',
          section_name:this.$attrs.name_section,
          token:window.CSRF_TOKEN,
        }
      },
      created(){
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
