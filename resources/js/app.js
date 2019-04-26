import AppHelper from "./appHelper";



document.addEventListener("DOMContentLoaded", function(event) {
   const showDeskMenuDeskMedia = 1200; 
  


 
    const mainAppContent =document.querySelector("#main-app-content");
     const asideMainMenuOverlay = document.querySelector("#asideMainMenuOverlay");
     const asideMainMenu = document.querySelector("#asideMainMenu");
     const mainNavBtnMenu = document.querySelector("#mainNavBtnMenu");


     const showDeskMenu =  AppHelper.matchMediaMinWidth(showDeskMenuDeskMedia)
     console.log(showDeskMenu)
     if(showDeskMenu){
         asideMainMenu.classList.add("asideMainMenu--open")
         mainAppContent.classList.add("mainAppContent--open")
     }

     mainNavBtnMenu.addEventListener("click", ()=>{
       const hasCssClass =   asideMainMenu.classList.contains("asideMainMenu--open")

    

       if(hasCssClass){
         asideMainMenu.classList.remove("asideMainMenu--open")
         mainAppContent.classList.remove("mainAppContent--open")
         asideMainMenuOverlay.classList.remove("v-overlay--active")
         
       }else{
         asideMainMenu.classList.add("asideMainMenu--open")
         mainAppContent.classList.add("mainAppContent--open")
         asideMainMenuOverlay.classList.add("v-overlay--active")
       }
     
        
     });


     asideMainMenuOverlay.addEventListener("click", ()=>{     
         asideMainMenu.classList.remove("asideMainMenu--open")
         mainAppContent.classList.remove("mainAppContent--open")
         asideMainMenuOverlay.classList.remove("v-overlay--active")
    });




    AppHelper.addEvent(window, "resize", ()=>{
      const showDeskMenu =  AppHelper.matchMediaMinWidth(showDeskMenuDeskMedia)
     
      if(showDeskMenu){
         asideMainMenu.classList.add("asideMainMenu--open")
         mainAppContent.classList.add("mainAppContent--open")
         
      }else{
         asideMainMenu.classList.remove("asideMainMenu--open")
         mainAppContent.classList.remove("mainAppContent--open")
         asideMainMenuOverlay.classList.remove("v-overlay--active")
      }

    });

    //busqueda mobile

    const navMainIconSearch  = document.querySelector("#nav-main-i-search");
    const navMainForm  = document.querySelector("#nav-main-form");
    const navMainFormClass = "nav-main-form--full";
        
    navMainIconSearch.addEventListener("click", ()=>{
      const hasCssClass =   navMainForm.classList.contains(navMainFormClass)
 
      if(hasCssClass){
        navMainForm.classList.remove(navMainFormClass)
        
        
      }else{
        navMainForm.classList.add(navMainFormClass)
      }
    
       
    });



    
});