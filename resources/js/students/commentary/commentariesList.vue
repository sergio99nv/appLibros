<style scoped>
    .row{
      margin-bottom : 40px!important;
    }

    .wrapper-commentaries{
        margin-top: 1rem;
    }
    .user-commnetary{
        display: grid;
        grid-template-columns: 50px 1fr 50px;
        column-gap: 9px;
    }

    .user-commnetary{
        margin-bottom: 30px;
    }

    .commentary-editing{
        margin: 40px 0;

    }

    .user-commnetary-img__picture{
        border-radius: 50px;
        width: 40px;
    }

    .wrapper-commentaries__count{
        margin-bottom: 20px;
    }

    @media only screen and (min-width: 992px) {
        .wrapper-commentaries{
            margin-top: 5rem;
        }
  }

</style>


<template>
    <div class="wrapper-commentaries">

         <div class="wrapper-commentaries__count">
            {{
                commentariesList.length
            }}
            
            <span> 
                comentario {{
                                 commentariesList.length > 1 ? 's' : ''
                             }}
             </span> 
           
              
        </div>
        

         <section class="row user-commnetary">
                       <div class="user-commnetary-img">
                           <img class="user-commnetary-img__picture" src=/img/userNoPicture.jpg alt="">
                       </div>
                       <commentary @newCommentaryEvent="newCommentaryEventHandler" 
                          :book-id="bookId">
                      </commentary>
                       
        </section>




        <section >
                 
                  <div  v-for="(commentary, index) in commentariesList" :key="commentary.id">
                      
                      <section
                         v-if="!commentary.editing"   
                       class="user-commnetary"
                        v-show="!commentary.edit || commentary.edit===true">
                      
                      
                       <div>
                           <img class="user-commnetary-img__picture" src=/img/userNoPicture.jpg alt="">
                       </div>
                       <div>
                           <div>
                               <strong>
                                   {{commentary.fullName}}
                               </strong>
                           </div>
                            <div>
                                 {{
                                commentary.text
                                }}
                            </div>
                       </div>
                       
                           
                        
                        <v-btn title="Editar"  v-if="commentary.allowEdit"
                                    @click="editCommentary(commentary)"  flat icon color="grey darken-1">
                            <v-icon>edit</v-icon>
                        </v-btn>
                      </section>

                    

                 
         
                    

                     <section  class="user-commnetary commentary-editing" v-if="commentary.allowEdit && commentary.editing && commentary.editing === true">
                       <div class="user-commnetary-img">
                           <img class="user-commnetary-img__picture" src=/img/userNoPicture.jpg alt="">
                       </div>
                       <commentary 

                         @updateCommentaryEvent="updatecommentaryEventHandler" 
                         @hideCommnetaryEvent ="hideCommnetaryEventHandler"
                         :is-update="true"
                         :user-commentary-prop="commentary.text"
                         :update-index="index"
                         :update-id="commentary.id"
                        :book-id="bookId">
                            </commentary>
                       
                 </section>  
                     
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
             this.commentariesList[itemIndex].editing = false;

        },


        hideCommnetaryEventHandler(itemIndex){
            this.commentariesList[itemIndex].editing = false;
             
        },


        editCommentary(commentary){
            this.$set(commentary, "editing", true)
        }


    }

}
</script>
