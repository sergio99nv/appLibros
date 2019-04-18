<style>

        .file-wrapper{
            margin-top: 1rem;
            
        }

        .file-action{
           padding: 1rem 1rem;
           background-color: ghostwhite;
           border: 1.5px dashed #888282;
           display: flex;
           align-items: center;
        }

        .file-action button{
            margin-right: 1rem;
        }


</style>
<template>
    <div class="file-wrapper">

       <input v-show="false" ref="inputUpload"  type="file" @change="inputChange($event)" >
       
        <div class="file-action">
            <button @click="$refs.inputUpload.click()"
                  type="button"
                   class="v-btn green darken-1">
                   <div class="white--text v-btn__content">
                        <span  v-if="fileUploadedChecked">
                       cambiar archivo  
                        </span>
                        <span  v-else>
                        subir archivo
                        </span>
                   </div>          
            </button>
           
            <strong class="green--text" v-if="fileUploadedChecked">
                archivo subido
            </strong>

              <div class="red--text" v-show="errorProp || error.value" v-if="!fileUploadedChecked">
               {{
                   error.msg || "suba el archivo"
               }} 
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
         value:{
             required : true
         },
         errorProp:{
             type : Boolean,
             required : true,
             defaults: false
         }

      },
      name : "store",
        data(){
            return{
              inputVal: this.value,
              error : {
                  value : false,
                  msg : ""
              },
              fileOk :  false
          }
      }, 
      methods:{
          inputChange(event){
             const input =event.target;
              if(!input.files.length) return;

                this.setError(false, "");
                this.fileOk = false
                this.inputVal = ""
               
                const inputFile = input.files[0]
                //validamos la extension
                if(!FileHelper.validateExt(inputFile, this.extensions)){
                    input.value = "";
                    this.setError(true, "extension no permitida")
                    return;
                }
                //validamos el peso del archivo
                if(!FileHelper.validateSize(inputFile, this.maxSize)){
                    input.value = "";
                    this.setError(true, "peso no valido")
                    return;
                }
               
               
               this.inputVal = inputFile
               this.fileOk = true
          },
          

          setError(error, msg){
              this.error.value = error;
              this.error.msg = msg;
          }

      },
       watch: {
            inputVal(val) {
                this.$emit('input', val);
            },
     },
      computed:{
            fileUploadedChecked(){
                return this.fileOk && this.inputVal;
            }
      }
        
     
}
</script>

