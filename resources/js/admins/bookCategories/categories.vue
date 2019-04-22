<style scoped>
      
        .main-wrapper{
             max-width: 920px;
             margin: 0 auto;
             padding: 1rem 0 3rem 0;
         }
         

       .theme--light.application{
           background-color: transparent;
       }

  
        
      
</style>

<style>

  @media screen and (min-width:600px){
    .main-wrapper--cat  .v-dialog{
        max-width: 600px;
     }
   }
</style>


<template>
    <div class="main-wrapper main-wrapper--cat">
       <v-app>    
        <crud

             :init-data = "config.initData"
             :create-data= "config.createData"
             :update-data= "config.updateData"
             :print-view-data="config.printViewData"
             :active-filter-search-prop="config.activeFilterSearchProp"
             :links-action= "config.linksAction"> 
                <thead   slot="fieldNames">
                    <tr>
                        <th class="text-sm-left">Categoría</th>
                        <th class="text-sm-left">Ver libros</th>
                        <th class="text-sm-left">Ver Videos</th>
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
          name : "categories",
         components : {crud},
         data(){
            return{
                config : {}
            }
         },
         created() {
             const prefixUrl =  "/admins/bookCategories";

             this.config = {
                  initData : {
                     url :   prefixUrl + "/getAll",   
                  },

                 createData : {
                    url : prefixUrl + "/store",
                    fieldsStore : [{field: "name",
                                 label:"categoría", 
                                 input:"input",
                                 type:"text" ,
                                  rules: {required: value => !!value || 'ingrese la categoría'  }
                                 }],
                    titles : {main:"Nueva categoría", btn : "Nueva categoría"}
                   // privateData : ["id"]
                     
                 },
                  updateData : {
                    url :  prefixUrl +  "/update",
                    fieldsUpdate : [
                                     {
                                        field: "name",
                                        label:"categoría", 
                                        input:"input",
                                        type:"text" ,
                                        value: "",
                                        rules: {required: value => !!value || 'ingrese la categoría'  }
                                    }
                                 ],
                    titles : {main:"Actualizar categoría", btn : "editar"}
                   // privateData : ["id"]
                     
                 },
                 printViewData : ["name"],

                 linksAction : [ 
                     {route:"/libros", name:"Ver libros", param : "id"},
                     {route:"/videos", name:"Ver Videos", param : "id"}
                 ],
                 activeFilterSearchProp : true
                }
             
        },
        
    }
</script>
