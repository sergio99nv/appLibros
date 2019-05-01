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

    .row{
        margin-bottom: 20px;
    }


</style>

<style>

    .update-form__item,
     .store-form__item{
         margin-bottom: 10px;
     }
     
     @media screen and (min-width:920px){

          .update-form__item,
          .store-form__item{
             margin-bottom: 0;
         }

        .main-wrapper--book  .v-dialog{
                max-width: 950px;
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
        
        <div class="row">
            <h1>Libros</h1>
        </div>

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
                        <th style="min-width:110px" class="text-sm-left">Libro</th>
                        <th style="min-width:110px" class="text-sm-left">Autor</th>
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
                        label:"Libro", 
                        type:"file" ,
                        fileConfig:{
                            maxSize : configFileFile["maxSize"],
                            extensions : configFileFile["extensions"],
                            urlPath : configFileFile["urlPath"],
                            urlUpload : prefixUrl + "/storeFile"
                            
                        },
                         rules: {required: true}
                    },
                    {field: "cover",
                        label:"Portada", 
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
                        label:"Descripción (Opcional)", 
                        type:"textArea" ,
                        rules: {required: false  }
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
