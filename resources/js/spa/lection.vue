<template>
    <div class="container">
        
        {{

            ramdomId
        }}


               <router-link 
                
                :to="{  name: 'lection', 
                        params:{ 
                                'lectionId' : parseInt(lectionId) + 1
                              
                            }
                        }">
                
                 
                lección
        </router-link>   
    </div>

    
</template>

<script>
    export default {
        props:{
            lectionId : {
                required : true
            }
        },
        data(){
            return{
                ramdomId : 50
            }
        },
        mounted() {
           this.getData();
        },
        methods:{
            getData(){
                let token = document.head.querySelector('meta[name="csrf-token"]');
                if(token)  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

                const url = "/getData";
                axios.get(url).
                then((response)=>{
                    console.log(response.data)  
                    this.ramdomId = response.data.ramdomId;
                })
                console.log('Component mounted.')
            }
        },
         beforeRouteUpdate (to, from, next) {
            // react to route changes...
            // don't forget to call next()
            console.log("next")
             this.getData();
            next();
        }
    }
</script>
