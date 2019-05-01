 <style scope>
   .error-server{
      padding-left: 16px;
      padding-right: 16px;
   }
   
   .progress__load, .progress__title{
      margin-bottom: 20px;
   }
   
   .store-title{
      justify-content: space-between;
      align-items: center;
   }
   

   
 </style>
<template>
   <div class="store">
        <div class="v-card v-sheet theme--light">
          
         <!-- titulo del formulario -->
          <div class="v-card__title headline store-title" v-show="!sendingFormData">
             <slot name="title-main"></slot>

             
              <slot name="close-modal-x" ></slot>
              
          </div>

            <!-- mostar un error  -->
           <div class="error-server  red--text" v-if="errorForm.value">
                  {{  errorForm.msg}}
            </div>
         
           <!--  campos del formulario -->
          <section class="v-card__text store-form" v-show="!sendingFormData">
              
              <div class=" store-form__item"  v-for="(item, index) in fieldsStore"    :key="index">
                 <!-- si es input text -->
                  <componet
                        v-if="item.type=='text'"
                        is="v-text-field" 
                        :error="form[item.field].error"
                        :error-messages="formSended && form[item.field].serverErrorMsg.length ? [form[item.field].serverErrorMsg] : ''"
                        :rules="formSended ? [form[item.field].rules.required] : []"
                        v-on="form[item.field].error ? { '~keyup': () => inputHideError(item.field) } : {}"
                        v-model="form[item.field].value"
                        :label="item.label"
                        >
                  </componet>

                  <!-- si es textarea -->
                   <v-textarea
                        :auto-grow="true"
                        rows="1"
                        v-else-if="item.type=='textArea'"
                         
                        :error="form[item.field].error"
                        :error-messages="formSended && form[item.field].serverErrorMsg.length ? [form[item.field].serverErrorMsg] : ''"
                        :rules="formSended ? [form[item.field].rules.required] : []"
                        v-on="form[item.field].error ? { '~keyup': () => inputHideError(item.field) } : {}"
                        v-model="form[item.field].value"
                        :label="item.label"
                        >
                  </v-textarea>
                  
                   <!-- si es tipo file -->
              
                  <uploadFile  v-else-if="item.type=='file' || item.type=='image'"
                              :show-img-miniature="item.type=='image' ? true : false"
                              :type="item.type"  
                              :label="item.label"
                               :required="form[item.field].rules.required"
                              v-model="form[item.field].value"
                              :extensions="item.fileConfig.extensions"
                               v-on="form[item.field].error ? { '~inputChange': () => inputHideError(item.field) } : {}"
                              :max-size="item.fileConfig.maxSize"  
                               :url-path="item.fileConfig.urlPath"
                              :url-upload="item.fileConfig.urlUpload"
                              @fileSendingEvent="fileSendingHandler"
                               :server-error-msg="formSended && form[item.field].serverErrorMsg.length ? form[item.field].serverErrorMsg : ''"
                              :error-prop="form[item.field].error">
                  </uploadFile>

                 

              </div>
        </section> 

      <!-- progress -->
         <div class="progress v-card__text  text-xs-center" v-show="sendingFormData">
                 <div class="progress__load">
                           <v-progress-circular
                        class=""
                        :size="45"
                        color="primary"
                        indeterminate
                     ></v-progress-circular>
                 </div>
               <div class="progress__title">
                  guardando ...
               </div>

               <button @click="()=> sendingFormData = false"
                   v-show="sendingFiles > 0"
                    :disabled="sendingFiles<=0"
                   type="button" 
                   class="v-btn v-btn--depressed v-btn--small theme--light">
                  <div class="v-btn__content  blue--text">
                      <i class="material-icons   v-icon--left">
                     arrow_back
                    </i>
                      formulario
                   </div>
               </button>
         </div>
          

          <!-- accciones(btns) -->
         <div  class="v-card__actions"  v-show="!sendingFormData">
               
               <div class="spacer"></div>
                  <span>
                     <slot name="close-modal">
                     </slot>
                  </span>
               <button :disabled="sendingFormData"
               @click="dataFormHandler()" 
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
            }
         },
         data(){
            return{
                errorForm : {
                   value : false,
                   msg : ""
                },
                sendingFormData : false,
                form : {},
                formSended : false,
                gettingFormData : false,
                sendingFiles : 0
            
   
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
          * si se recibe un error al validar los campos en el server
          * adicionamos los errores recibidos al campo correspondiente
          * 
          * Si un campo tiene un erro asignamos el error en la propiedad
          * -serverErrorMsg-
          * @param {Object} dataServer  contiene los errores 
          */
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
          * metodo para validar  y obtener los campos del formulario,  
          *  si todo esta bien obtenemos y enviamos los datos al server
          */
         dataFormHandler(){
            this.sendingFormData = true;
            this.formSended =  true;
            const objectForm = this.form;
            //validamos

             if(this.sendingFiles > 0){
                if(!this.validateData(objectForm, true)){
                  this.sendingFormData = false; 
                }
                return;
             }


            if(!this.validateData(objectForm)){
                this.sendingFormData = false;
               return;
            } 

         
            //obtenmos la data
            const formData = this.getDataForm(objectForm);
            //enviamos la data al server
            this.sendDataForm(this.url,formData); 
         },


         /**
          * obtenemos los campos del formulario
          * 
          * @param {object}  objectForm los campos del formulario
          * @param {object}  formData retornamos los campos
          */
         getDataForm(objectForm){
            
            
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
            
            return formData;
         },




         /**
          * enviar datos al servidor
          * 
          * @param {string}  url La url donde se enviaran los datos
          * @param {object}  params Los parametros que se enviaran
          */
         sendDataForm(url, params){
            let token = document.head.querySelector('meta[name="csrf-token"]');
            if(token)  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

           
            axios.post(url, params)
               .then( response => {
                  this.sendingFormData = false;
                  const responseData = response.data;
                  if(responseData.error===false){
                     this.addNewDataEvent(responseData.dataEmit);
                    
                  }else{
                     if(responseData.dataError){
                        this.setFieldErrorServer(responseData.dataError)
                        this.setErrorForm(true, "Revise los campos del formulario");
                         this.sendingFormData = false;
                     }else{
                        throw new Error('un error al intetar guardar los datos');
                     }        
                  }   
              
               })
               .catch(error => {
                  this.sendingFormData = false;
                  this.setErrorForm(true, "revise los campos del formulario")
                  console.log(error)
               });
         },



         /**
          * metodo para validar si todos los campos estan llenos
          * 
          * @param {object}  objectForm los campos del formulario
          * @param {boolean}  omitFiles si es true se omite la validacion de archivos/imgs
          * @return {boolean}  retorna false si  encontro uno o mas campos pendientes
          */
         validateData(objectForm, omitFiles = false){
            
            let erros = 0;
            for (const key of Object.keys(objectForm)) {
                  const field= objectForm[key];
               
                  if(omitFiles === true 
                     && (field.type==="image" || field.type==="file")){
                     continue;
                  }

                  if(field.rules.required === false) continue;
                  if(field.value.trim().length<=0){
                        field.error = true;
                        ++erros;
                  }
                  
            }

            return erros <=0 ? true : false;
         },



         /**
          * metodo para adicionar los valores del prop -fieldsHidden-
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


         fileSendingHandler(sending, showError){
               //si hay algun error subiendi imgs paramaos todoel envio
               if(showError === true){
                  this.sendingFormData  = false;
                  
               }

               if(sending === true){
                  ++this.sendingFiles
               }else{
                  --this.sendingFiles
               }
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
                  objectForm[key].serverErrorMsg ="";  
            }

         },
 

         /**
          * metodo para mostar o ocultar un mensaje de error en el formulario
          * @param {boolean}  error si es true muesta el mensaje
          * @param {string} msg  El mensaje que se mostrara
          */
         setErrorForm(error, msg = ""){
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

      },
       watch:{
            sendingFiles(newVal){
                //si se esta obtiendo los datos  y la cantidad de arhivos o imgs
                //que se enstan subiendo es cero o llega a zero
                //realizamos el proceso de  obtenemos los datos del form para el envio
                if(newVal===0 && this.sendingFormData === true){
                  
                     this.dataFormHandler();
                   
                }
            },
        }   
        
    }
</script>
