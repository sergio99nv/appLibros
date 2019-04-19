 <style>
   .error-server{
      padding-left: 16px;
      padding-right: 16px;
   }
 </style>
<template>
   <div>
    
     

        <div class="v-card v-sheet theme--light">
            
          <div class="v-card__title headline">
             <slot name="title-main"></slot>
             
          </div>
           <div class="error-server  red--text" v-if="errorForm.value">
                  {{
                     errorForm.msg
                  }}
             </div>
         
          <div class="v-card__text store-dialog__form" v-show="!sendingData">
              
              <div class="store-dialog__form__item"  v-for="(item, index) in fieldsStore"    :key="index">
                  <componet
                        v-if="item.type=='text'"
                        :is="chooseComponent(item.type)" 
                        required
                        :error="form[item.field].error"
                        :error-messages="formSended && form[item.field].serverErrorMsg.length ? [form[item.field].serverErrorMsg] : ''"
                        :rules="formSended ? [form[item.field].rules.required] : []"
                        v-on="form[item.field].error ? { '~keyup': () => inputHideError(item.field) } : {}"
                        v-model="form[item.field].value"
                        :label="item.label"
                        >
                  </componet>


                   <v-textarea
                        :auto-grow="true"
                        rows="1"
                        v-else-if="item.type=='textArea'"
                        required
                        :error="form[item.field].error"
                        :error-messages="formSended && form[item.field].serverErrorMsg.length ? [form[item.field].serverErrorMsg] : ''"
                        :rules="formSended ? [form[item.field].rules.required] : []"
                        v-on="form[item.field].error ? { '~keyup': () => inputHideError(item.field) } : {}"
                        v-model="form[item.field].value"
                        :label="item.label"
                        >
                  </v-textarea>
                  
                  <uploadFile  v-else-if="item.type=='file' || item.type=='image'"
                              :show-img-miniature="item.type=='image' ? true : false"
                              :type="item.type"  
                              :label="item.label"
                              v-model="form[item.field].value"
                              :extensions="item.fileConfig.extensions"
                               v-on="form[item.field].error ? { '~inputChange': () => inputHideError(item.field) } : {}"
                              :max-size="item.fileConfig.maxSize"  
                               :server-error-msg="formSended && form[item.field].serverErrorMsg.length ? form[item.field].serverErrorMsg : ''"
                              :error-prop="form[item.field].error">
                  </uploadFile>
                
                  
                   
              </div>
          </div> 

          <div class="v-card__text  text-xs-center" v-if="sendingData">
                   <v-progress-circular
                     :size="50"
                     color="primary"
                     indeterminate
                  ></v-progress-circular>
                  <div>
                     guardando ...
                  </div>

          </div>
          
           <div class="v-card__actions">
                
                <div class="spacer"></div>
 
                <button v-if="!sendingData" type="button"
                      class="v-btn v-btn--flat theme--light primary--text  close-modal-btn">
                         <div class="v-btn__content">
                               <slot  name="close-modal">
                                </slot>
                         </div> 
               </button> 
             

                <button :disabled="sendingData"
                  @click="getDataSend()" 
                  type="button"
                  class="v-btn theme--dark primary">
                     <div class="v-btn__content">
                           guardar
                     </div>
               </button>

              
            </div>
            
         </div>
   
    
   </div>
</template>
<script>
   import typeComponents from "./typeComponents";
   import uploadFile from "./uploadFile";

    export default {
         name : "store",
         components : {uploadFile},
         props:{
            fieldsStore:{
               required : true,
               type : Array
            },
         

            fieldsHidden:{
               required : false,
               type : Array
            },
            url:{
               required : true,
               type : String
            },

            
         },

         data(){
            return{
                errorForm : {
                   value : false,
                   msg : ""
                },
                sendingData : false,
                form : {},
                formSended : false,
                typeComponents : typeComponents,
   
            }
         },
         created(){
          
            this.setFormFields();
   
         },
         methods : {

            /**
             * establecemos  los campos  q se usaran el formulario y adicionamos
             * algunas propiedad para el manejo de errores
             */
            setFormFields(){
               this.fieldsStore.forEach(element => {
                   this.$set(this.form, 
                           element.field, 
                           {  error:false, 
                              value:"",
                              serverErrorMsg : "",
                              rules:  element.rules,
                              type : element.type
                           });
 
                });
              
                
            },


            /**
             * enviar datos al servidor
             * 
             * @param {string}  url La url donde se enviaran los datos
             * @param {object}  params Los parametros que se enviaran
             */
            sendData(url, params){
               let token = document.head.querySelector('meta[name="csrf-token"]');
               if(token)  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

               this.sendingData = true;
               axios.post(url, params)
                .then( response => {
                    
                    const responseData = response.data;
                    if(responseData.error===false){
                        this.addNewDataEvent(responseData.dataEmit)
                        this.resetFormData(this.form);
                        this.dialog =  false;
                    }else{
                        if(responseData.dataError){

                           this.setFieldErrorServer(responseData.dataError)
                            this.setErrorForm(true, "revise los campos del formulario")
                           console.log(responseData.dataError)
 
                        }else{
                           throw new Error('un error al intetar guardar los datos');
                        }        
                    }   

                  this.resetSendingProperties();
                })
                .catch(error => {
                     this.resetSendingProperties();
                     this.setErrorForm(true, "revise los campos del formulario")
                     
                     console.log(error)
                });
            },



             /**
             * metodo para validar si todos los campos estan llenos
             * 
             * @param {object}  objectForm los campos del formulario
             * @return {boolean}  retorna false si  encontro uno o mas campos pendientes
             */
            validateData(objectForm){
              let erros = 0;
              for (const key of Object.keys(objectForm)) {
                    const field= objectForm[key];
                    
                    if(field.rules.required === false) continue;

                    switch(field.type){
                       case "file":
                       case "image":
                            if(!field.value){
                                field.error = true;
                                 ++erros;
                            }
                       break;
                       default:
                         if(field.value.trim().length<=0){
                           field.error = true;
                           ++erros;
                         }
                    }
                   
               }

               return erros <=0 ? true : false;
            },


         setFieldErrorServer(dataServer){
             for (const field of Object.keys(dataServer)) {
                  const item = dataServer[field];

                  if(this.form[field]){
                      this.form[field].error = true;
                      this.form[field].serverErrorMsg = item[0];  
                  }
                 
                    
             }

         },


            /**
             * metodo para obtener los campos del formulario, utiliza el metodo --validateData--
             * para validar los datos, si todo esta bien  envia los datos al server
             */
            getDataSend(){
               this.formSended =  true;
               const objectForm = this.form;
               if(!this.validateData(objectForm)){
                   return;
               } 
              let formData = new FormData();

              //obtenemos y adicionamos la data del formulario
              for (const key of Object.keys(objectForm)) {
                 const fieldItem =  objectForm[key];
                  if(fieldItem.rules.required === false && !fieldItem.value) continue;
                   formData.append(key,  objectForm[key].value);
               }

              if(this.fieldsHidden && this.fieldsHidden.length){
                 formData = this.appendFieldsHidden(formData);
              }
              
              this.sendData(this.url,formData); 
            },



            /**
             * metodo para adicionar los valores de  fieldsHidden  
             * al objeto q contiene los campos del formulario q se enviaran al server
             * 
             * @param {object}  formData  contiene los campos del formulario 
             * @return {object}  formData  retorna el objeto con los valorores adicionados
             */
            appendFieldsHidden(formData) {
                this.fieldsHidden.forEach( (element) => {
                   
                   formData.append(element.field, element.value);
                });

                return formData;
            },



            /**
             * se encarga de emitir el evento  -addNewDataEvent-- 
             * este metodo se llama si los datos enviados al server se han guardados correctamente
             *  
             * @param {object} data data que enviara  al emitir el evento
             */
            addNewDataEvent(data){
               this.$emit("addNewDataEvent", data);
            },



            /**
             * resteamos todos los campos del formulario
             * 
             * @param {object}  objectForm los campos del formulario
             */
            resetFormData(objectForm){
               this.formSended =  false;
              for (const key of Object.keys(objectForm)) {
                    objectForm[key].value = "";
                    objectForm[key].error = false;
               }
 
            },


            /**
             * metodo restablecer algunas propiedades q se usan en 
             * el envio de los datos al server
             * 
             */
            resetSendingProperties(){
                this.sendingData = false;
            },
            

            setErrorForm(error, msg){
               this.errorForm.value = error;
               this.errorForm.msg = msg
            },


            /**
             * metodo asignado a los input del form, cambia la propiedad --error--
             * a false
             * 
             * @param {string}  field hace referencia a un campo del formulario
             */
            inputHideError(field){
                this.form[field].error =false;
                this.form[field].serverErrorMsg = "";
            },


            /**
             * metodo seleccionar el tipo de componente segun
             *  el tipo de elemento del formulario, la busqueda se hace 
             * en objeto importado  -typeComponents-
             * @param {String} inputType
             * @return {String} el tipo de component
             */
            chooseComponent(inputType){
              return this.typeComponents[inputType] || ""
            }

         },

          watch:{
            
         }
        
    }
</script>
