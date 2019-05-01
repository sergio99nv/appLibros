<style scoped>
      
        .main-wrapper{
             max-width: 920px;
             margin: 0 auto;
             padding: 1rem 0 3rem 0;
         }
         

      
    
        .row{
            margin-bottom: 20px;
        }
        
        .theme--light.application{
            background-color: transparent!important;
        }
        
</style>


<template>
    <div class="main-wrapper main-wrapper--cat">

        <div class="row">
             <h1>Estudiantes</h1>
             <p>Listado de estudiantes registrados</p>
        </div>
       <v-app>    
        <crud
            :print-view-data = "config.printViewData"
           
             :init-data = "config.initData"
             :active-filter-search-prop="config.activeFilterSearchProp"> 
                <thead   slot="fieldNames">
                    <tr>
                        <th class="text-sm-left">Nombres</th>
                        <th class="text-sm-left">Apellidos</th>
                        <th class="text-sm-left">Teléfono</th>
                        <th class="text-sm-left">Correo</th>

                    </tr>
                </thead>
             </crud>
       </v-app>      
    </div>
</template>

<script>

 
import crud from '@pathRoot/crud/crud.vue'
 
    export default {
          name : "students",
         components : {crud},
         data(){
            return{
                config : {}
            }
         },
         created() {
             const prefixUrl =  "/admins/students";
//admins/users/getAll
             this.config = {
                 initData : {
                     url :   prefixUrl + "/getAll",
                 },
                 printViewData : ['firstName', 'lastName', 'phoneNumber', 'email'],
                 activeFilterSearchProp : true
                }
             
        },
        
    }
</script>
