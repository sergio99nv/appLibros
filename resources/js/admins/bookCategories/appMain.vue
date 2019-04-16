<template>
    <div>
       <v-app>    
        <crud
             :urls-data = "config.urlsData"
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


import test from "./test";
import crud from '@pathRoot/crud/crud.vue'
 
 
 Vue.component('test', test);
   
    export default {
         components : {test, crud},
         name : "app-main",
         data(){
            return{
                config : {}
            }
         },
         created() {
             this.config = {
                 urlsData : {
                     getAll : "/admins/books/categories/getAll",
                     
                     update : "/admins/books/categories/update",
                 },
                 createData : {
                    url : "/admins/books/categories/store",
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
                    url : "/admins/books/categories/update",
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
                 extraActionComponents : [{
                     name : "test",
                     props : ""
                 }],
                 linksAction : [ 
                     {route:"/libros", name:"Ver libros"},
                      {route:"/videos", name:"Ver Videos"}
                 ],
                 activeFilterSearchProp : true
                }
             
        },
        
    }
</script>
