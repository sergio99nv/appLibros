<style>

</style>

<template>
   <div class="store">
        <div class="v-card v-sheet theme--light">
          
         <!-- titulo del formulario -->
          <div class="v-card__title headline">
             <slot name="title-main"></slot>
          </div>

            <!-- mostar un error  -->
           <div class="error-server  red--text" v-if="errorForm.value">
                  {{  errorForm.msg}}
            </div>
         
           <!--  campos del formulario -->
          <section class="v-card__text store-form" v-show="!sendingFormData">
              
              <div class=" store-form__item"  v-for="(item, index) in fieldForm"    :key="index">
                 <!-- si es input text -->
                  <v-text-field
                        :type="item.type"
                        is="v-text-field" 
                        :error="form[item.field].error"
                        :error-messages="formSended && form[item.field].serverErrorMsg.length ? [form[item.field].serverErrorMsg] : ''"
                        :rules="formSended ? [form[item.field].rules.required] : []"
                        v-on="form[item.field].error ? { '~keyup': () => inputHideError(item.field) } : {}"
                        v-model="form[item.field].value"
                        :label="item.label"
                        >
                  </v-text-field>
 

                 

              </div>
        </section> 
 
          

          <!-- accciones(btns) -->
         <div class="v-card__actions">
               
               <div class="spacer"></div>
 
         
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

 
export default {
    name : "register",
    components : {},
    props:{
     
        url:{
            required : true,
            type : String
        },
        title:{
            type : String,
            required : true,
        },
        fieldForm:{
           type : Array,
           required : true
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
                
              
            }
         },
         created(){
            this.setFormFields();
         },
         methods:{

              /**
          * establecemos  los campos  q se usaran el formulario y adicionamos
          * algunas propiedad para el manejo de errores
          */
         setFormFields(){
            this.fieldForm.forEach(element => {
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
                formData.append(key,  objectForm[key].value);
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
                     window.location = responseData.redirecTo
                  }else{
                      if(responseData.dataError){
                        this.setFieldErrorServer(responseData.dataError)
                        this.setErrorForm(true, "Revise los campos del formulario");
                       
                     } else{
                        throw new Error('un error al procesar los datos');
                     }        
                  }   
              
               })
               .catch(error => {
                  this.sendingFormData = false;
                  this.setErrorForm(true, "un error al procesar los datos")
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
                  if(field.value.trim().length<=0){
                        field.error = true;
                        ++erros;
                  }
                  
            }

            return erros <=0 ? true : false;
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
          * metodo para mostar o ocultar un mensaje de error en el formulario
          * @param {boolean}  error si es true muesta el mensaje
          * @param {string} msg  El mensaje que se mostrara
          */
         setErrorForm(error, msg = ""){
            this.errorForm.value = error;
            this.errorForm.msg = msg
         },


    }
}
</script>


