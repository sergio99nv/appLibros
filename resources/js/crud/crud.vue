<style>
    .msg-saved-ok{
        position: fixed;
        bottom:   0;
        width: 100%;
        left: 0;
        z-index: 100;
    }
</style>

<template>
    <div>
        <div v-if="actionMsg.show === true" class="msg-saved-ok ">
            <v-card class="green "> 
            <v-card-title primary-title class="white--text">
                    {{
                        actionMsg.msg || "d"
                    }}
            </v-card-title>
            </v-card>       
        </div>
        
        <div>
             <button  @click="()=> ++loadStoreComponent" type="button" class="v-btn theme--dark primary">
                <div class="v-btn__content">
                        {{createData.titles.btn || 'agregar'}}
                </div>
            </button>
            <store
                @addNewDataEvent="addNewDataEventHandler"
                 :open-modal-prop="loadStoreComponent"
                v-if="createData.fieldsStore && loadStoreComponent > 0"
                :url="createData.url"
                :fields-store="createData.fieldsStore">
               
                 <template slot="title-main">
                    {{createData.titles.main || 'agregar'}} 
                </template> 
              
            </store>
        </div>

        
        <table  v-if="dataCrud.length" class="v-datatable v-table theme--light">
           <slot name="fieldNames"></slot>
            <tbody>
                <tr>
                    <td v-for="(inputItem, inputItemIndex) in printViewData" :key="inputItemIndex">
                        <v-text-field
                            v-model="searchFilters[inputItem]"
                           
                            placeholder = "buscar"
                        ></v-text-field>
                        
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr  v-for="(itemData, itemDataIndex) in  searchDataResult" 
                       :key="itemData.id"
                       :ref="'refItemData' + itemData.id"> 
                      
                    <td   v-for="(item, key) in  printViewData" :key="key"> 
                        {{
                            itemData[item] || -1
                        }}
                    </td>  

                     
                     <tbody  v-if="extraActionComponents && extraActionComponents.length">
                            <td  v-for="(component,componentIndex ) in extraActionComponents" 
                                    :key="componentIndex + itemData.id.toString()"
                                        :id="itemData.id" >
                                <!-- <componet :is="component.name">
                                </componet>    -->
                            </td>   
                    </tbody>
                  
              
                    <td>
                              

                           <button title="editar" @click="loadUpdateComponent(itemData.id)" 
                                    type="button" 
                                    class="v-btn v-btn--flat v-btn--icon theme--light indigo--text">
                                    <div class="v-btn__content">
                                          <i aria-hidden="true" 
                                            class="v-icon material-icons theme--light">edit
                                          </i>
                                    </div>
                            </button>
                           
                          <update
                            @updateDataEvent="updateDataEventHandler"
                            v-if="updateData.fieldsUpdate &&   loadedUpdateComponentData[itemData.id] > 0"
                            :url="updateData.url "
                            :updated-id="itemData.id"
                            :items-from-crud="itemData"
                            :items-from-crud-index="itemDataIndex"
                            :fields-update="updateData.fieldsUpdate"
                            :open-modal-prop=" loadedUpdateComponentData[itemData.id]"
                            >
                        
                            <template slot="title-btn">
                                <v-btn
                                    color="primary"
                                    dark>
                                    s
                                    {{updateData.titles.btn || 'agregar'}}
                                </v-btn>
                            </template>

                            <template slot="title-main">
                                {{updateData.titles.main || 'agregar'}}  
                            </template>
                        
                       </update> 
                        
                    </td>
                    
                </tr>
             </tbody>    
        </table> 
 
    </div>
</template>


<script>
    import store from "./store.vue";
    import update from "./update.vue";
    import AppHelper from '@pathRoot/appHelper';

    export default {
         name : "crud",
         components : {store, update},
         props:{
             urlsData:{
                 required : true,
                 type : Object
             },

             printViewData:{
                  required : true,
                  type : Array
             },
             createData:{
                  required : false,
                  type : Object
             },
             updateData:{
                  required : false,
                  type : Object
             },
             extraActionComponents :{
                 required : false,
                 type : Array,
                 default: function(){
                     return []
                 }

             }
         },
         data(){
            return{
                test : [],
                dataCrud : [],
                actionMsg:{
                     msg : "",
                     show:false,
                     action : ""
                },
                searchFilters:{

                },
                loadStoreComponent : 0,
                loadedUpdateComponentData:{}
            }
        },
        mounted() {

            this.getData(this.urlsData.getAll);
            
        },
        methods:{

            /**
             *  obtenmos la data del server
             * 
             *  @param { string} url  La url de donde se obtendran los datos
             */
           getData(url){
                const token = document.head.querySelector('meta[name="csrf-token"]');
                if(token)  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

               // const url = "/admins/users/getData";
                axios.post(url).
                then((response) => {
                    //console.log(response.data)  
                    this.dataCrud = response.data
                    this.setSearchFilters();
                     
                }).catch((err)=>{
                    console.log(err)
                })
                 
            },

         

            /**
             *  metodo para leer los datos del evento  *addNewDataEvent*,
             * este evento se activa cuando se crea un nuevo registro
             * 
             * @param {Object} data la data recibida 
             */
            addNewDataEventHandler(data){
                this.dataCrud.push(data)
                 this.actionMsg.msg = "datos guardados";
                 this.actionMsg.show = true;

                 const refHtml =  this.$refs["refItemData"+ data.id]
                console.log(refHtml)
                //AppHelper.markHtmlElement(refHtml,  ["light-green" , "lighten-4"], 4500);
            },



            /**
             *  metodo para leer los datos del evento  *updateDataEvent*,
             * este evento se activa cuando se actualiza un  registro
             * 
             * @param {Object} data   la data recibida 
             * @param {Number}  index hace referencia a la posicion del item dentro del array
             */
             updateDataEventHandler(data, index){
                
                 if(this.dataCrud[index]){
                     const item = this.dataCrud[index];

                    for (const key of Object.keys(item)) {
                         if(key === "id") continue;
                         if(data[key]){
                              item[key]  = data[key];   
                         }                           
                    }

                    this.actionMsg.msg = "datos actualizados";
                    this.actionMsg.show = true;
                    const refHtml =  this.$refs["refItemData"+ item.id][0]
                    AppHelper.markHtmlElement(refHtml,  ["light-green" , "lighten-4"], 4500);
                 }

            },


            setSearchFilters(){
                this.printViewData.forEach(element => {           
                        this.$set(this.searchFilters, element, "")
                });
            },


            searchData(event, item){
                const value = event.target.value
                console.log(value, item)
            },

            loadUpdateComponent(id){
                const idString =  id.toString();   
                if(!this.loadedUpdateComponentData[idString]){
                    this.loadedUpdateComponentData  = {} 
                    this.$set(this.loadedUpdateComponentData,idString, 1)   
                }else{
                    ++this.loadedUpdateComponentData[idString];
                }      
            }

           
          
        } ,
        watch: {
            actionMsg:{
                handler: function(newVal, oldVal) {
                   if(newVal.show){
                      if(this.actionMsg.timer) clearInterval(this.actionMsg.timer);

                      this.actionMsg.timer =  setTimeout(()=>{
                            this.actionMsg.show = false;    
                            this.actionMsg.msg = "";
                       }, 5000)
                   }

                },
               deep: true
            }
        },

        computed:{
             searchDataResult(){
                  
                 return this.dataCrud.filter((item)=>{

                        const res =  this.printViewData.map((fieldName)=>{
                            const existe =  item.name.toLowerCase().includes(this.searchFilters[fieldName].toLowerCase()) ;
                           
                            return  existe;
              
                        })
                 
                  
                    return res[0];    

                      //  return item.name.toLowerCase().includes(this.searchFilters["name"].toLowerCase());
                      //return item.name.toLowerCase().includes(this.searchFilters["name"].toLowerCase())
                       //return item.name.toLowerCase().includes(this.searchFilters["name"].toLowerCase())
                        
                 });
             }
        }
 
    }
</script>
