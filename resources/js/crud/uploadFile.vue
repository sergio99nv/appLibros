<style scoped>

        .file-component{
        
           padding: 1rem 1rem;
           background-color: ghostwhite;
           border: 1.5px dashed #888282;
            
        }

    
        .file-uploaded {
            align-items: center;
        }

        .file-uploaded__link,
        .file-uploaded__title{
            display: block;
        }
        
    

</style>
<template>
    <div class="file-component">

       <input  hidden ref="inputFile" :accept="getFileExtensions()" type="file" @change="inputChange($event)" >
       
        <div class="file-wrapper">

            <!-- si se esta subiendo el archivo -->
             <section class="v-card__text  text-xs-center" v-if="sendingData">
                  <div class="row">
                       <v-progress-circular
                     :size="25"
                     color="primary"
                     indeterminate
                  ></v-progress-circular>
                    <div>
                        subiendo archivo ...
                    </div>
                  </div>
                 <div class="xs-">
                      <button @click="cancelHttpRequestFn()" 
                        class="v-btn v-btn--outline v-btn--depressed theme--light red--text">
                            <span class="red--text v-btn__content">
                                cancelar
                            </span>         
                      </button>

                  </div>

              </section>        


          
             <!--seccion del boton subir -->
            <section class="sc-btn-upload layout row"   v-show="!sendingData">
               <!-- boton subir -->
                <button
                :disabled="sendingData"                    
                     @click="$refs.inputFile.click()"
                   class="v-btn blue-grey darken-2">
                   <span class="white--text v-btn__content">
                        subir  {{label}}  

                         <i 
                            class="v-icon v-icon--right material-icons theme--light">cloud_upload
                        </i>
                   </span>          
                 </button>

                <!-- si el archivo se  subio -->
                 <section  v-if="fileUploadedChecked"  class="file-uploaded  layout row">
                    <div  v-if="type=='image'" >
                        <img
                            v-show="imgMiniatureSrc.length"
                            class="file-action__imageMiniature" 
                                        :src="imgMiniatureSrc">
                           
                                <strong class="file-uploaded__title  green--text">Imagen subida</strong> 
                                 <a class="file-uploaded__link" :href="urlPath + '/' + inputFile" download>descargar</a>   
                            
                    </div>
                    <div v-else>
                        <strong class="green--text">Archivo subido</strong> 
                         <a class="file-uploaded__link" :href="urlPath + '/' + inputFile" download>descargar</a>   
                    </div>  
                    
                 </section>
                 

            </section>

               <!-- en caso de un error -->
            <section class="red--text " v-show="serverErrorMsg.length  || error.value || errorProp">
                    {{
                            serverErrorMsg  || error.msg   || "suba el archivo"
                    }} 
            </section>
 
        </div>
        
    </div>
</template>

<script>

import FileHelper from "@pathRoot/helper/fileHelper";
export default {
      props:{
          extensions:{
              type : Array,
              required : true
          },
          maxSize : {
              type : Number,
              required : true
          },
          urlUpload:{
              type : String,
              required : true,
          },
           urlPath:{
              type : String,
              required : false,
          },
          type: {
            type : String,
            required : true,
            defaults : "Archivo"
          },
          showImgMiniature:{
              type  : Boolean,
              require : false,
              default : false
          },
         label:{
             required : true,
             type : String 
         },
         value:{
             required : true
         },
         errorProp:{
             type : Boolean,
             required : true,
             defaults: false
         },
         serverErrorMsg :{
             type : String,
             required : true,
             default : ""
         },
   

      },
      name : "upload-file",
        data(){
            return{
              inputFile: this.value,
              error : {
                  value : false,
                  msg : ""
              },
             
              imgMiniatureSrc : "",
              cancelHttpRequest : null,
              sendingData : false
          }
      }, 
      created(){
           if(this.type =="image" && this.value && this.value.trim().length){
               this.inputFile = this.value;
               this.imgMiniatureSrc =  this.urlPath + "/" + this.inputFile;
           }

      },
      methods:{

          /**
           * metodo que se asigna al input file,
           * validamos la extension y el peso si todo esta bien
           * se sube el archivo
           * @param {} event
           */
          inputChange(event){
              const input =event.target;
              if(!input.files.length) return;
                
                this.$emit("inputChange", true);    
                this.setError(false, "");
                this.inputFile = ""
                this.imgMiniatureSrc = ""

                const inputFile = input.files[0];

                //validamos la extension
                if(!FileHelper.validateExt(inputFile, this.extensions)){
                    this.setError(true, "solo estan permitidas las siguientes extensiones: " + this.extensions.toString())
                    return;
                }

                //validamos el peso del archivo
                if(!FileHelper.validateSize(inputFile, this.maxSize)){
                    this.setError(true, "peso maximo permitido: " + (this.maxSize / 1024) + "MB")
                    return;
                }
               
                this.$refs["inputFile"].value = "";
                //subimos el archivo
                const formData = new FormData();
                formData.append("file", inputFile);
                this.uploadFile(this.urlUpload, formData);


                if(this.type==="image"){
                    this.imgReader(inputFile);
                }
              
          },
 


        /**
         * metodo para mostar la imagen que se subio
         * @param {Object} inputFile el archivo q subio
         */
        imgReader(inputFile){
                const reader = new FileReader();
                reader.readAsDataURL(inputFile);
                reader.onload =  (e)=>{
                    this.imgMiniatureSrc = e.target.result;
                }
         },
          


          /**
          * metodo para mostar o ocultar en input file
          * @param {boolean}  error si es true muesta el mensaje
          * @param {string} msg  El mensaje que se mostrara
          */
          setError(error, msg){
              this.error.value = error;
              this.error.msg = msg;
          },



          /**
           * metodo para limpiar  el input file
           */
          cleanInputFile(){
                this.$refs["inputFile"].value = ""
                this.inputFile = "",
                this.imgMiniatureSrc = "";
                this.setError(false, "")
          },


         /**
          * crea un token para el envio con ajax
          */
         createHttpToken(){
                const CancelToken = axios.CancelToken;
                this.cancelHttpRequest = CancelToken.source();
         },


        /**
         * cancela peticion http
         */
        cancelHttpRequestFn(){
            if(this.cancelHttpRequest === null) return;
            this.cancelHttpRequest.cancel();
        },

        

        /**
         * subir un archivo al server
         * 
         * @param {string} url   
         * @param {Object} param los parametros q se enviaran
         */
        uploadFile(url, params){
            this.createHttpToken();
            this.sendingData = true;
            this.$emit("fileSendingEvent", true);
            
            axios.post(url, params, {
                cancelToken: this.cancelHttpRequest.token
                })
            .then( (response) => {
                this.sendingData = false;
                
                const responseData = response.data;
                if(responseData.error === false){
                    this.inputFile  = responseData.file;
                   
                }
                else{
                    if(responseData.dataError){
                        this.setError(true,  responseData.dataError.file[0]);    
                        this.$emit("fileSendingEvent", false, true);   
                        this.setError(true, "error al subir el archivo");         
                    }else{
                        throw new Error('un error al intetar guardar los datos');
                    } 
                }
            })
            .catch((error) => {
                console.log(error)
                this.sendingData = false;
                this.inputFile  = "";

                if (axios.isCancel(error)) {
                    this.$emit("fileSendingEvent", false);
                    
                }else{
                    this.$emit("fileSendingEvent", false, true);
                    this.setError(true, "error al subir el archivo");
                }
            });
         },


         getFileExtensions(){
            return this.extensions.map( element => "." + element);
         }

      },
       watch: {
        inputFile(val) {
            this.$emit('input', val);

            if(val.trim().length > 0){
                  
               this.$emit("fileSendingEvent", false);
                  
            }
        },
     },
      computed:{
            fileUploadedChecked(){
                return  this.inputFile && this.inputFile.trim().length > 0;
            }
      },
      
      beforeDestroy(){
            this.cancelHttpRequestFn();
      }
        
     
}
</script>

