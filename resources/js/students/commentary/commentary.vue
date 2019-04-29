<style scoped >
    .v-text-field__details{
        display: none!important;
    }

    .v-textarea{
        padding-top: 0!important;
    }
    .commnetary-action{
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }
    .sendingData-circle{
        margin-bottom: 10px;
    }

</style>


<template>
    <div>
         <div   class=" sendingData-circle text-xs-center" v-if="sendingData">
             <v-progress-circular
                indeterminate
                color="primary"
                ></v-progress-circular>

         </div>

        <v-textarea
            v-show="!sendingData"
          rows="1"
          :auto-grow = "true"
          v-model="userCommentary"
         
          placeholder="Dejanos tu opinion"
          value=""
        ></v-textarea>


        <div  v-show="!sendingData" :disabled="sendingData" class="commnetary-action text-xs-right">

            <v-btn flat small color="primary"    @click="hideCommnetary()">cancelar</v-btn>

            <div v-if="isUpdate">
                <button
               @click="getCommentary()"
                :disabled="userCommentaryEmpty || sendingData"
                type="button"
                class="v-btn blue white--text">
                    <div class="v-btn__content">
                            actualizar
                    </div>
                </button>

            </div>
            <div   v-else>
                <button
                @click="getCommentary()"
                :disabled="userCommentaryEmpty || sendingData"
                type="button"
                class="v-btn blue white--text">
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
     name : "commentary",
    components : {},
    props:{
        bookId:{
            requerid : true,
            type : Number
        },
        isUpdate:{
            type : Boolean,
            required : false,
            defaults : false
        },
        updateId:{
            requerid : false,
            type : Number,
            default : -1
        },
        updateIndex:{
            requerid : false,
            type : Number,
             
        },
        userCommentaryProp : {
            type : String,
            required : false,
            defaults : ""
        }
    },
    data(){
        return{
           sendingData : false,  
            userCommentary : "",
            errorData:{
                value : false,
                msg : ""

            }
        }
    },
    mounted(){
        if(this.isUpdate === true){
             this.userCommentary = this.userCommentaryProp;
        }

    },
   methods:{
     getCommentary(){
         if(this.userCommentaryEmpty) return;


        if(this.isUpdate === true){
             const params = {
              updateId : this.updateId,
              bookId : this.bookId,
              text : this.userCommentary
         }

         const url = "/commentaries/update"
         this.update(url, params);
        }else{

        const params = {
              bookId : this.bookId,
              text : this.userCommentary
         }

         const url = "/commentaries/store"
         this.store(url, params);
        }
        

         
    },

    
         /**
          *  guardar el comentario
          * 
          * @param {string}  url La url donde se enviaran los datos
          * @param {object}  params Los parametros que se enviaran
          */
         store(url, params){
            let token = document.head.querySelector('meta[name="csrf-token"]');
            if(token)  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

            this.sendingData = true;
            axios.post(url, params)
               .then( response => {
                  this.sendingData = false;

                  const responseData = response.data;
                  if(responseData.error===false){
                      this.commentariesList = responseData.commentariesList

                       const newCommentaryData = responseData.dataEmit;
                       newCommentaryData.text = params.text;
                       newCommentaryData.bookId = params.bookId,
                       newCommentaryData.allowEdit = true;
                       this.userCommentary = ""

                       this.$emit("newCommentaryEvent", newCommentaryData)
                  }else{
                       
                        throw new Error('un error al procesar los datos');
                            
                  }   
              
               })
               .catch(error => {
                  this.sendingData = false;
                  this.setErrorForm(true, "un error al procesar los datos")
                  console.log(error)
               });
         },

            /**
          *  update  un comentario
          * 
          * @param {string}  url La url donde se enviaran los datos
          * @param {object}  params Los parametros que se enviaran
          */
         update(url, params){
            let token = document.head.querySelector('meta[name="csrf-token"]');
            if(token)  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

            this.sendingData = true;
            axios.post(url, params)
               .then( response => {
                  this.sendingData = false;

                  const responseData = response.data;
                  if(responseData.error===false){
                      this.commentariesList = responseData.commentariesList
 
                       this.$emit("updateCommentaryEvent", this.updateIndex, params.text)
                  }else{
                       
                        throw new Error('un error al procesar los datos');
                            
                  }   
              
               })
               .catch(error => {
                  this.sendingData = false;
                  this.setErrorForm(true, "un error al procesar los datos")
                  console.log(error)
               });
         },

        /**
         * metodo para mostar o ocultar un mensaje de error  
         * @param {boolean}  error si es true muesta el mensaje
         * @param {string} msg  El mensaje que se mostrara
         */
        setErrorForm(error, msg = ""){
            this.errorData.value = error;
            this.errorData.msg = msg
        },


    hideCommnetary(){
        if(this.isUpdate){
              this.$emit("hideCommnetaryEvent",  this.updateIndex)
        }else{
            this.userCommentary = "";
        }
      
        
    }

   },
   computed:{
       userCommentaryEmpty(){
           return !this.userCommentary.trim().length
       }
   }

}
</script>
