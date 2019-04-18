<style>

</style>
<template>
   <div>
     
     <!-- <span @click.stop="dialog = true">
           <slot name="title-btn">
          </slot>
     </span> -->

      <v-dialog
        v-model="dialog"
        :persistent="persistentModal"
        max-width="450">

        <div class="v-card v-sheet theme--light">
            
          <div class="v-card__title headline">
             <slot name="title-main"></slot>
          </div>
          <div class="v-card__text" v-show="!sendingData">
              
               <div v-for="(item, index) in fieldsUpdate" :key="index">
                  <v-text-field
                   required
                    :error="form[item.field].error"
                    :rules="formSended ? [form[item.field].rules.required] : []"
                    v-on="form[item.field].error ? { '~keyup': () => inputHideError(item.field) } : {}"
                    v-model="form[item.field].value"
                    :label="item.label"
                  ></v-text-field>

              </div>  
          </div> 

          <div class="v-card__text  text-xs-center" v-if="sendingData">
                   <v-progress-circular
                     :size="50"
                     color="primary"
                     indeterminate
                  ></v-progress-circular>

          </div>
          
           <div class="v-card__actions">         
               <div class="spacer"></div>

                <button 
                 :disabled="sendingData"
                  @click="dialog = false"
                  type="button"
                  class="v-btn v-btn--flat theme--light primary--text">
                     <div class="v-btn__content">
                           cerrar
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
    
      </v-dialog>
    
   </div>
</template>
<script>
    export default {
         name : "update",
        
         props:{
             updatedId: {
                required : true,
                type : Number
            },
            fieldsUpdate:{
               required : true,
               type : Array
            },
            itemsFromCrudIndex:{
                required : true,
                type : Number,
                default:-1
            },
            itemsFromCrud:{
               required : false,
               type : Object
            },
            url:{
               required : true,
               type : String
            },
            getFromServer:{
               required : false,
               type : Boolean,
               defaults : false
            },
            openModalProp:{
               required : true,
               type : Number,
               defaults : 0
            }

         },

         data(){
            return{
                dialog : false,
                persistentModal : false,
                sendingData : false,
                form : {},
                formSended : false
            }
         },
         created(){
            
            this.dialog = true
            if(Object.entries(this.itemsFromCrud).length > 0 && this.itemsFromCrud.constructor === Object){
               let data= this.setFieldFromCrud();
               this.setFormFields(data);
            }else{
                this.setFormFields(this.fieldsUpdate);
            }
            
 
         },
         methods : {


           setFieldFromCrud(){
                const data =  this.fieldsUpdate.map(element =>{
                   element.value = this.itemsFromCrud[element.field];
                   return element;
                });

                return data;
            },
            /**
             * establecemos  los campos  q se usaran el formulario y adicionamos
             * algunas propiedad para el manejo de errores
             */
            setFormFields(fields){
                 fields.forEach(element => {
                  this.$set(this.form, 
                           element.field, 
                           {  error:false, 
                              value: element.value,
                              rules:  element.rules
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
                        this.updateDataEvent(responseData.dataEmit)
                        //this.resetFormData(this.form);
                        this.dialog =  false;
                    }else{
                        if(responseData.dataError){
                           console.log(responseData.dataError)
                         
                        }else{
                           throw new Error('un error al intetar guardar los datos');
                        }        
                    }   

                  this.resetSendingProperties();
                })
                .catch(error => {
                     this.resetSendingProperties();
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
                    if(field.value.trim().length<=0){
                       field.error = true;
                       ++erros;
                    }
               }

               return erros <=0 ? true : false;
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
  
              this.persistentModal = true;
              const formData = new FormData();

              formData.append("id", this.updatedId);

              //obtenemos y adicionamos la data del formulario
              for (const key of Object.keys(objectForm)) {
                   formData.append(key,  objectForm[key].value);
               }
 
              
              this.sendData(this.url,formData); 
            },


            /**
             * se encarga de emitir el evento  -updateDataEvent-- 
             * este metodo se llama si los datos enviados al server se han guardados correctamente
             *  
             * @param {object} data data que enviara  al emitir el evento
             */
            updateDataEvent(data){
               this.$emit("updateDataEvent", data,  this.itemsFromCrudIndex);
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
                this.persistentModal = false;
                this.sendingData = false;
            },



            /**
             * metodo asignado a los input del form, cambia la propiedad --error--
             * a false
             * 
             * @param {string}  field hace referencia a un campo del formulario
             */
            inputHideError(field){
                this.form[field].error =false;
            }

         },
         watch:{
            openModalProp(){
               this.dialog = true
            }
         }
        
    }
</script>
