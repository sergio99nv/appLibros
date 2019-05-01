<style>
    .msg-saved-ok{
        position: fixed;
        bottom:   0;
        width: 100%;
        left: 0;
        z-index: 100;
        padding: 11px 24px;
       
    }

     .msg-saved-ok .layout{
        justify-content: space-between;
     }

    .msg-saved-ok__close{
        cursor: pointer;
    }



    .close-modal-btn{
        width: auto;
        padding: 0 0;
        height: auto;
    }

    th{
          max-width: 80%;
     }
</style>

<style scoped>
    .sc-crud-desc{
        margin-bottom: 10px;
    }

    .sc-crud-desc > div{
        margin-left: 5px;
    }

    @media screen and (min-width:600px){
     .sc-crud-desc{
         display: flex;
         flex-direction: row;
        justify-content: space-between;
        align-items: center
    }

   
   }
</style>


<template>
    <div>
        <div v-show="actionMsg.show == true" class="  msg-saved-ok green white--text">
            <div class="layout">
                    <h2>
                    {{
                        actionMsg.msg  
                    }}    
                </h2>   
    
                <i
                    title="cerrar"
                    @click="()=>actionMsg.show  = false"
                    aria-hidden="true" class="v-icon    msg-saved-ok__close material-icons  white--text">close</i>
            </div>
             
        </div>
        

        <div class="sc-crud-desc">
                <div>
                    <strong>
                        {{
                            dataCrud.length
                        }}
                        registros
                    </strong>
                </div>

                <button   v-if="createData"  @click="()=>  loadStoreComponent= !loadStoreComponent" type="button" class="v-btn theme--dark primary">
                <div class="v-btn__content">
                        {{createData.titles.btn || 'agregar'}}
                </div>
              </button>
         </div>
        <div v-if="createData">
            
             <v-dialog
                 
                 v-if="loadStoreComponent"
                content-class="store-dialog"
                v-model="loadStoreComponent"
                :persistent = "true"
                >
                <store
                    @addNewDataEvent="addNewDataEventHandler"
                    v-if="createData.fieldsStore "
                    :url="createData.url"
                    :fields-store="createData.fieldsStore"
                    :fields-hidden="createData.fieldsHidden">
                    <template slot="title-main">
                        <div> 
                            {{createData.titles.main || 'agregar'}}     
                        </div>  
                    </template> 
                     <template slot="close-modal-x">
                            <v-btn   @click="()=>  loadStoreComponent= !loadStoreComponent" 
                                 flat icon color="grey">
                              <v-icon>close</v-icon>
                        </v-btn>  
                    </template>                       
                     <template slot="close-modal">
                             <button    class="v-btn v-btn--flat     black--text " 
                                 @click="()=>  loadStoreComponent= !loadStoreComponent" >
                                 cerrar
                            </button>  
                     </template>
                
                </store> 
               </v-dialog>  
        </div>

    <div class="v-table__overflow">
        <table  class="v-datatable v-table theme--light elevation-1">
            
           <slot name="fieldNames"></slot>
            <tbody v-if="dataCrud.length && activeFilterSearchProp">
                <tr>
                    <td v-for="(inputItem, inputItemIndex) in printViewData" :key="inputItemIndex">
                        <v-text-field
                            v-model="searchFilters[inputItem]"
                           
                            placeholder = "buscar"
                        ></v-text-field>
                        
                    </td>
                </tr>
            </tbody>
 
            <tbody  v-if="dataCrud.length">
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
                  
                 
                    <td v-for="(link, linkIndex) in linksAction" :key="'route' + linkIndex">
                       
                        <a v-if="link.isExternal" target="_blank" :href="getFieldFromItem(itemData, link.param)">
                            {{
                                link.name
                            }}
                            <i title="ver video" class="material-icons v-icon--right">
                                 open_in_new
                            </i>
                        </a>
                        <router-link
                         v-else
                         :to="link.route + '/' + getFieldFromItem(itemData, link.param)">{{  link.name }}</router-link>
                    </td>
                  
                    <td v-if="updateData">
                        <button title="editar" 
                                 
                                @click="loadUpdateComponentFn(itemData.id)" 
                                type="button" 
                                class="v-btn v-btn--flat v-btn--icon theme--light indigo--text">
                                <div class="v-btn__content">
                                        <i aria-hidden="true" 
                                        title="editar registro"
                                        class="v-icon material-icons green--text">edit
                                        </i>
                                </div>
                        </button>

                         <v-dialog
                             v-if="loadUpdateComponent[itemData.id]"
                            content-class="store-dialog"
                            v-model="loadUpdateComponent[itemData.id]"
                            :persistent = "true"
                            >
                           
                          <update
                            @updateDataEvent="updateDataEventHandler"
                            v-if="updateData.fieldsUpdate"
                            :url="updateData.url "
                            :updated-id="itemData.id"
                            :items-from-crud="itemData"
                            :items-from-crud-index="itemDataIndex"
                            :fields-update="updateData.fieldsUpdate"
                            :open-modal-prop=" loadUpdateComponent[itemData.id]"
                            >
                        
                            <template slot="title-btn">
                                <v-btn
                                    color="primary"
                                    dark>
                        
                                    {{updateData.titles.btn || 'Actualizar'}}
                                </v-btn>
                            </template>


                             <template slot="close-modal-x">
                                    <v-btn    @click="()=>  loadUpdateComponent[itemData.id] = false"
                                        flat icon color="grey">
                                    <v-icon>close</v-icon>
                                </v-btn>  
                            </template>  

                            <template slot="title-main">
                                {{updateData.titles.main || 'Actualizar'}}  
                            </template>

                           <template slot="close-modal">
                                <button    class="v-btn v-btn--flat     black--text " 
                                    @click="()=>  loadUpdateComponent[itemData.id] = false" >
                                    cerrar
                                </button>  
                           </template>
                            
                       </update> 


                    </v-dialog>    
                    </td>
                    
                </tr>
             </tbody>   
              <tbody v-if="!dataCrud.length">
                <tr>
                   <td>
                       <h3> Sin registros</h3>
                   </td>
                </tr>
            </tbody> 
        </table> 
 </div>
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
             initData:{
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
             },
             linksAction:{
                 required : false,
                 type : Array
             },
             activeFilterSearchProp:{
                 required : false,
                 default : false,
                 type : Boolean
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
                loadUpdateComponent:{},
                loadingData: false
            }
        },
        mounted() {

            this.getData(this.initData.url, this.initData.params);
            
        },
        methods:{

            /**
             *  obtenmos la data del server
             * 
             *  @param { string} url  La url de donde se obtendran los datos
             *  @param { object} params   
             */
           getData(url, params){
                const token = document.head.querySelector('meta[name="csrf-token"]');
                if(token)  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

               // const url = "/admins/users/getData";
                this.loadingData = true;
                axios.post(url, params).
                then((response) => {

                    this.loadingData = true;
                    const responseData = response.data;
                   
                    if(responseData.error === false){
                         this.dataCrud = responseData.data
                         this.setSearchFilters();
                          
                    
                    }else{
                         throw new Error('error');
                    }
   
                     
                }).catch((err)=>{
                    console.log(err)
                      this.loadingData = false;
                })
                 
            },

         

            /**
             *  metodo para leer los datos del evento  *addNewDataEvent*,
             * este evento se activa cuando se crea un nuevo registro
             * 
             * @param {Object} data la data recibida 
             */
            addNewDataEventHandler(data){
                this.loadStoreComponent = false
                this.dataCrud.push(data)
                 this.actionMsg.msg = "datos guardados";
                 this.actionMsg.show = true;

                this.$nextTick(()=>{
                     const refHtml =  this.$refs["refItemData"+ data.id][0]
                    AppHelper.markHtmlElement(refHtml,  ["light-green" , "lighten-4"], 5000);
                })
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
                     const itemId= item.id;
                     this.loadUpdateComponent[itemId] =false;

                    for (const key of Object.keys(item)) {
                         if(key === "id") {

                             continue
                         };
                         if(data[key]){
                              item[key]  = data[key];   
                         }                           
                    }

                    this.actionMsg.msg = "datos actualizados";
                    this.actionMsg.show = true;
                    const refHtml =  this.$refs["refItemData"+ itemId][0]
                   
                    AppHelper.markHtmlElement(refHtml,  ["light-green" , "lighten-4"], 5000);
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


            loadUpdateComponentFn(id){
                const idString =  id.toString();   

                if(!this.loadUpdateComponent[idString]){
                    this.loadUpdateComponent  = {} 
                    this.$set(this.loadUpdateComponent,idString, true)   
                }else{
                    this.loadUpdateComponent[idString] = !this.loadUpdateComponent[idString];
                }      
            },


            /**
             * metodo para obtener un campo en especifico de un objecto
             * 
             * @param {Object} item  el objeto donde buscaremos el campo
             * @param {String} field el campo q buscaremos
             * @return {String}  retornamos el campo
             */
            getFieldFromItem(item, field){
                  return item[field] || '';
            }

           
          
        } ,
        watch: {
            actionMsg:{
                handler: function(newVal, oldVal) {
                 if(this.actionMsg.timer) clearInterval(this.actionMsg.timer);
                   
                if(newVal.show){
                      this.actionMsg.timer =  setTimeout(()=>{
                            this.actionMsg.show = false;    
                            this.actionMsg.msg = "";
                       }, 5500)
                   } 
                },
               deep: true
            }
        },

        computed:{
             searchDataResult(){
                if(!this.activeFilterSearchProp)  return this.dataCrud;
           
                const self = this;
                let filtered = this.dataCrud;
    
                this.printViewData.forEach((fieldName)=>{
                    filtered   = filtered
                    .filter((item)=>{
                        const itemSearch =  item[fieldName];
                        return itemSearch 
                                ? itemSearch.toLowerCase()
                                .includes(self.searchFilters[fieldName].trim().toLowerCase())
                                : filtered;   
                    }); 
                });

                return filtered;
             }
        }
 
    }
</script>
