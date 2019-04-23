<style scoped>

    .file-action__imageMiniature{
        max-width: 120px;
        height: 150px;
        max-height: 150px;
    }

    .main-wrapper--book{
        max-width: 920px;
        margin: 0 auto;
        padding: 1rem 0 3rem 0;
    }


</style>

<style>
     
     @media screen and (min-width:920px){

        .main-wrapper--book  .v-dialog{
                max-width: 920px;
         }


         .main-wrapper--book .file-action__imageMiniature{
            max-width: 120px;
            height: 150px;
            max-height: 150px;
         } 


         .main-wrapper--book  .update-form,
         .main-wrapper--book  .store-form{
            display: grid;
            grid-gap: 10px;
            grid-template-columns: repeat(2, 1fr);
        }

        .main-wrapper--book  .update-form .update-form__item:nth-child(5) 
        .main-wrapper--book  .store-form .store-form__item:nth-child(5) {
            grid-column: 1 / 3;
        }


    }

    

</style>

<template>
    <div class="main-wrapper  main-wrapper--book">
        
       <v-app>    
        <crud
             :init-data = "config.initData"
             :create-data= "config.createData"
             :update-data= "config.updateData"
             :print-view-data="config.printViewData"
             :active-filter-search-prop="config.activeFilterSearchProp"
            > 
                <thead   slot="fieldNames">
                    <tr>
                        <th class="text-sm-left">Libro</th>
                        <th class="text-sm-left">Autor</th>
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
             const prefixUrl =  "/admins/bookCategories/books";
             const configFile = window.AppBookHelper.fileConfig;
              
             const configFileImg = configFile.image;
             const configFileFile = configFile.file;


             const fieldsStore = [
                   {field: "file",
                        label:"libro", 
                        type:"file" ,
                        fileConfig:{
                            maxSize : configFileFile["maxSize"],
                            extensions : configFileFile["extensions"],
                            urlPath : configFileFile["urlPath"],
                            urlUpload : prefixUrl + "/storeFile"
                            
                        },
                        rules: {required: value => !!value || 'seleccione el archivo'}
                    },
                    {field: "cover",
                        label:"miniatura", 
                        type:"image" ,
                        fileConfig:{
                            maxSize : configFileImg["maxSize"],
                            extensions : configFileImg["extensions"],
                            urlPath : configFileImg["urlPath"],
                            urlUpload : prefixUrl + "/storeCover",
                             
                        },
                        rules: {required: false}
                    },
                    {field: "name",
                        label:"Nombre", 
                        type:"text" ,
                        rules: {required: value => !!value || 'ingrese el  nombre del libro'  }
                    },
                        
                        {field: "author",
                        label:"Autor", 
                        type:"text" ,
                        rules: {required: value => !!value || 'ingrese el  autor'}
                    },
                    {field: "description",
                        label:"Descripción", 
                        type:"textArea" ,
                        rules: {required: value => !!value || 'ingrese la descripción'  }
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

                    titles : {main:"Nuevo libro", btn : "Nuevo libro"},
                    fieldsHidden : [{field:"bookCategoryId", value:this.bookCategoryId}]
                     
                 },

                  updateData : {
                    url :  prefixUrl + "/update",
                    fieldsUpdate : fieldsStore,
                    titles : {main:"Actualizar libro", btn : "editar"}
                   // privateData : ["id"]
                 },
                 
                 printViewData : ["name",  "author"],
                 activeFilterSearchProp : true
            }
             
        },
        
    }
</script>
