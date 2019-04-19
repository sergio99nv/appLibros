<style>
    @media screen and (min-width:920px){
        .store-dialog{
          max-width: 920px;
        }

        .store-dialog__form{
            display: grid;
            grid-gap: 10px;
            grid-template-columns: repeat(2, 1fr);
        }

         .store-dialog__form  .store-dialog__form__item:nth-child(3) {
             grid-column: 1 / 3;
         }

         .file-action__imageMiniature{
            max-width: 120px;
            height: 150px;
            max-height: 150px;
         }

         .main-wrapper{
             max-width: 920px;
             margin: 0 auto;
             padding: 1rem 0 3rem 0;
         }
         .theme--light.application{
           background-color: transparent;
        }
         body{
             background-color: #efefefd9;
         }
    }
</style>


<template>
    <div class="main-wrapper">
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
           

             const fieldsStore = [
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
                        {field: "file",
                        label:"archivo", 
                        type:"file" ,
                        fileConfig:{
                            maxSize : 5000,
                            extensions : ["pdf"]
                        },
                        rules: {required: value => !!value || 'seleccione el archivo'}
                    },
                    {field: "cover",
                        label:"miniatura", 
                        type:"image" ,
                        fileConfig:{
                            maxSize : 5000,
                            extensions : ["png", "jpg", "jpeg"]
                        },
                        rules: {required: false}
                    }
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
