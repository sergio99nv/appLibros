<style>

        .file-wrapper{
            margin-top: 1rem;
            
        }

        

        
        .file-action{
           padding: 1rem 1rem;
           background-color: ghostwhite;
           border: 1.5px dashed #888282;
           
        }

        .file-action button{
            margin-right: 1.1rem;
        }

        .file-action__col--msg strong{
            display: block;
        }

        .file-action__col--remove{
            margin-left: 1rem;
        }

        .file-action__col--remove i{
            cursor: pointer;
        }
 
        
        


</style>
<template>
    <div class="file-wrapper">

       <input  hidden ref="inputFile"  type="file" @change="inputChange($event)" >
       
        <div class="file-action layout row">
            
            <div   v-if="!fileUploadedChecked">
                <button
                   
                     @click="$refs.inputFile.click()"
                   class="v-btn blue-grey darken-2">
                   <span class="white--text v-btn__content">
                        subir  {{label}}  

                         <i 
                            class="v-icon v-icon--right material-icons theme--light">cloud_upload
                        </i>
                   </span>          
                 </button>
                <div class="red--text text-xs-center" v-show="serverErrorMsg.length  || error.value || errorProp">
                        {{
                                serverErrorMsg  || error.msg   || "suba el archivo"
                        }} 
                </div>

                  
              
            </div>
 
           
           <div  v-if="fileUploadedChecked"  class="file-action__uploaded  layout row">

                <button
                        @click="$refs.inputFile.click()"
                        class="v-btn green darken-1">
                            <span class="white--text v-btn__content">
                                    {{label}}   subido
                                     <i 
                                        class="v-icon v-icon--right material-icons theme--light">cloud_upload
                                    </i>
                            </span>     
                </button>   


                 <div  v-if="type=='image'" >
                     <img
                  v-show="imgMiniatureSrc.length"
                 class="file-action__imageMiniature" 
                            :src="imgMiniatureSrc">
                 
                 </div>
                
                 

                       
           </div>

            
            
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
         isUpdate : {
             type : Boolean,
             required : false,
             defaults : false
         }


      },
      name : "upload-file",
        data(){
            return{
              inputFile: this.value,
              error : {
                  value : false,
                  msg : ""
              },
              fileOk :  false,
              imgMiniatureSrc : ""
          }
      }, 
      created(){
           if(this.isUpdate && this.value){
               this.inputFile = this.value;
               this.fileOk =  true;
               this.imgMiniatureSrc =   this.value;

           }
      },
      methods:{
          inputChange(event){
             const input =event.target;
              if(!input.files.length) return;
                

                this.$emit("inputChange", true);    
                this.setError(false, "");
                this.fileOk = false
                this.inputFile = ""
                this.imgMiniatureSrc = ""

                 const inputFile = input.files[0];
                 this.inputFile = inputFile;

                //validamos la extension
                if(!FileHelper.validateExt(inputFile, this.extensions)){
                   // input.value = "";
                    this.setError(true, "extension no permitida")
                    return;
                }
                //validamos el peso del archivo
                if(!FileHelper.validateSize(inputFile, this.maxSize)){
                   // input.value = "";
                    this.setError(true, "peso no valido")
                    return;
                }
               
              
               this.fileOk = true;

              if(this.type==="image"){
                  this.imgReader(inputFile);
              }
              
          },
 

            imgReader(inputFile){
                    const reader = new FileReader();
                    reader.readAsDataURL(inputFile);
                    reader.onload =  (e)=>{
                        this.imgMiniatureSrc = e.target.result;
                    }
              },
          

          setError(error, msg){
              this.error.value = error;
              this.error.msg = msg;
          },

          /**
           * metodo para limpiar  el inpit file
           */
          cleanInputFile(){
                this.$refs["inputFile"].value = ""
                this.inputFile = "",
                this.imgMiniatureSrc = "";
                this.fileOk = false;
                 this.setError(false, "")
          }

      },
       watch: {
            inputFile(val) {
                this.$emit('input', val);
            },
     },
      computed:{
            fileUploadedChecked(){
                return this.fileOk && this.inputFile;
            }
      }
        
     
}
</script>

