<style scoped>
      
        .main-wrapper{
             max-width: 620px;
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
             <h1>Usuarios administradores</h1>
             <p>Listado de usuarios administradores</p>
        </div>
       <v-app>    
        <crud
            :print-view-data = "config.printViewData"
           
             :init-data = "config.initData"
             :active-filter-search-prop="config.activeFilterSearchProp"> 
                <thead   slot="fieldNames">
                    <tr>
                        <th class="text-sm-left">usuario</th>
                    </tr>
                </thead>
             </crud>
       </v-app>      
    </div>
</template>

<script>

 
import crud from '@pathRoot/crud/crud.vue'
 
    export default {
          name : "users",
         components : {crud},
         data(){
            return{
                config : {}
            }
         },
         created() {
             const prefixUrl =  "/admins/users";
//admins/users/getAll
             this.config = {
                 initData : {
                     url :   prefixUrl + "/getAll",
                 },
                 printViewData : ["userName"],
                 activeFilterSearchProp : true
                }
             
        },
        
    }
</script>
