<template>
    <div>
        
        <crud
             :urls-data = "config.urlsData"
             :print-view-data="config.printViewData"
             :edit-data = "config.dataEdit"
             :create-data = "config.dataCreate"
             :extra-action-components="config.extraActionComponents"> 
             <div class="grid-data__item"  slot="fieldNames">
                <div>
                    name
                </div>
                <div>
                    userName         
                </div>
             </div>
             </crud>
    </div>
</template>

<script>


import test from "./test";
import crud from '@crud/crud/crud'

 
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
                     getAll : "/admins/users/getAll",
                     create : "/admins/users/create",
                     update : "/admins/users/update",
                 },
                 dataEdit : ["userName"],
                 dataCreate : ["fullName","userName"],
                 printViewData : ["fullName","userName"],
                 extraActionComponents : [{
                     name : "test",
                     props : ""
                 }]
                }
             
        },
        
    }
</script>
