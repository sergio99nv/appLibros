<template>
    <div>
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
                         <th class="text-sm-left">Descripción</th>
                         <th class="text-sm-left">Autor</th>
                        
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
             this.config = {
                 initData : {
                     url :   prefixUrl + "/getAll",
                     params: {bookCategoryId : this.bookCategoryId}
                 },
                 createData : {
                    url :  prefixUrl + "/store",
                    fieldsStore : [
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
                                        label:"subir archivo", 
                                        type:"file" ,
                                        fileConfig:{
                                            maxSize : 5000,
                                            extensions : ["pdf"]
                                        },
                                        rules: {required: value => !!value || 'seleccione el archivo'}
                                    },
                                    // {field: "bookYear",
                                    //     label:"Fecha de publicación", 
                                    //     type:"date" ,
                                    //     rules: {required: value => !!value || 'ingrese la fecha de publicación'}
                                    // }  
                                 ],

                    titles : {main:"Nuevo libro", btn : "Nuevo libro"},
                    fieldsHidden : [{field:"bookCategoryId", value:this.bookCategoryId}]
                     
                 },

                  updateData : {
                    url :  prefixUrl + "/update",
                    fieldsUpdate : [
                                     {
                                        field: "name",
                                        label:"Libro", 
                                        input:"input",
                                        type:"text" ,
                                        value: "",
                                        rules: {required: value => !!value || 'ingrese el  nombre del libro'  }
                                    }
                                 ],
                    titles : {main:"Actualizar libro", btn : "editar"}
                   // privateData : ["id"]
                 },
                 
                 printViewData : ["name", "description", "author"],
                 activeFilterSearchProp : true
            }
             
        },
        
    }
</script>
