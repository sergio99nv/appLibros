<style scoped>
 

    .main-wrapper-video{
           padding: 1rem 0 3rem 0;
    }

    .row{
        margin-bottom: 20px;
    }
    
    @media screen and (min-width:920px){

        .main-wrapper-video{
            max-width: 920px;
            margin: 0 auto;
         }


   
 
    }

</style>
 <style>
    .main-wrapper-video  .v-dialog{
        max-width: 600px;
     }
 </style>
 

<template>
    <div class="main-wrapper-video">
      <div class="row">
            <h1>Videos</h1>
            <p class="">Unicamente puede agregar videos de youtube!</p>
        </div>
       <v-app>    
        <crud
             :init-data = "config.initData"
             :create-data= "config.createData"
             :update-data= "config.updateData"
             :links-action= "config.linksAction"
             :print-view-data="config.printViewData"
             :active-filter-search-prop="config.activeFilterSearchProp"
            > 
                <thead   slot="fieldNames">
                    <tr>
                        <th style="min-width:110px"  class="text-sm-left">url</th>
                        <th class="text-sm-left">abrir video</th>
                         <th class="text-sm-left">Acciones</th>
                    </tr>
                </thead>
             </crud>
       </v-app>      
    </div>
</template>

<script>


 
import crud from '@pathRoot/crud/crud.vue'
  
   
    export default {
         name : "books",
         components : { crud},
         props:{
             bookCategoryId:{
                 type : [Number, String],
                 required : true
             }
         },
         data(){
            return{
                config : {}
            }
         },
         created() {
             const prefixUrl =  "/admins/bookCategories/videos";
        

             const fieldsStore = [
                 
                    {
                        field: "url",
                        label:"url del video(youtube)", 
                        type:"text" ,
                        rules: {required: value => !!value || 'ingrese la url'  }
                    },
                      
                ];


             this.config = {
                 initData : {
                     url :   prefixUrl + "/getAll",
                     params: {bookCategoryId : this.bookCategoryId}
                 },
                 createData : {
                    url :  prefixUrl + "/store",
                    openIn : "modal",
                    fieldsStore : fieldsStore,

                    titles : {main:"Nuevo video(youtube)", btn : "Nuevo video"},
                    fieldsHidden : [{field:"bookCategoryId", value:this.bookCategoryId}]
                     
                 },

                  updateData : {
                    url :  prefixUrl + "/update",
                    fieldsUpdate : fieldsStore,
                    titles : {main:"Actualizar video(youtube)", btn : "editar"}
                  
                 },

                  linksAction : [ 
                     {name:"Ver video", param : "url" , isExternal : true}
                   
                 ],
                 
                 printViewData : ["url"],
                 activeFilterSearchProp : true
            }
             
        },
        
    }
</script>
