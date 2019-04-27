<style>

</style>


<template>
    <div>
        <commentary @newCommentaryEvent="newCommentaryEventHandler" 
            :book-id="bookId">
        </commentary>

        <section>
              <h2>Comentarios</h2>
                  <div  v-for="(commentary, index) in commentariesList" :key="commentary.id">
                     
                      <section  v-show="!commentary.edit || commentary.edit===true">
                        {{
                              commentary.text
                        }}
                      </section>

                     <button
                       v-if="commentary.allowEdit"
                        @click="editCommentary(commentary)"
                        type="button"
                        class="v-btn red white--text">
                            <div class="v-btn__content">
                                   editar
                            </div>
                     </button>


                      <commentary 
                       
                      v-if="commentary.allowEdit && commentary.edit && commentary.edit === true"
                         @updateCommentaryEvent="updatecommentaryEventHandler" 
                         :is-update="true"
                         :user-commentary-prop="commentary.text"
                         :update-index="index"
                         :update-id="commentary.id"
                        :book-id="bookId">
                    </commentary>
                </div>
        </section>
    </div>
</template>

<script>

import commentary from "./commentary.vue";

export default {
     name : "commentariesList",
    components : {commentary},
    props:{
        bookId:{
            requerid : true,
            type : Number
        }
    },
     data(){
            return{
                errorData : {
                   value : false,
                   msg : ""
                },
                loadingData : false,
                commentariesList : []
            }
         },
    mounted(){

        const url = "/commentaries/getAll"
        const params = {bookId : this.bookId}
        this.getCommentaries(url,   params);
    },
    methods:{


         /**
          * enviar datos al servidor
          * 
          * @param {string}  url La url donde se enviaran los datos
          * @param {object}  params Los parametros que se enviaran
          */
         getCommentaries(url, params){
            let token = document.head.querySelector('meta[name="csrf-token"]');
            if(token)  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

            this.loadingData = true;
            axios.post(url, params)
               .then( response => {
                  this.loadingData = false;

                  const responseData = response.data;
                  if(responseData.error===false){

                      this.commentariesList = responseData.commentariesList
                     
                  }else{
                       
                        throw new Error('un error al procesar los datos');
                            
                  }   
              
               })
               .catch(error => {
                  this.loadingData = false;
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



          /**
          * metodo para leer el evento  -newCommentaryEvent-
          * se activa cuando el se agrega un nuevo comentario
          * @param {OBject}  newCommentaryData 
          */
        newCommentaryEventHandler(newCommentaryData){
            this.commentariesList.unshift(newCommentaryData);
        },

           /**
          * metodo para leer el evento  -updatecommentaryEvent-
          * se activa cuando el se  actualiza un comentario
          * @param {int}  itemIndex 
           * @param {string}  text 
          *
          */  
        updatecommentaryEventHandler(itemIndex, text){
            this.commentariesList[itemIndex].text = text;
                
             this.commentariesList[itemIndex].edit = false;

        },



        editCommentary(commentary){
            this.$set(commentary, "edit", true)
        }

    }

}
</script>
