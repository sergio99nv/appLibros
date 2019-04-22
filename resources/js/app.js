document.addEventListener("DOMContentLoaded", function(event) {
     const asideMainMenuOverlay = document.querySelector("#asideMainMenuOverlay");
     const asideMainMenu = document.querySelector("#asideMainMenu");
     const mainNavBtnMenu = document.querySelector("#mainNavBtnMenu");

     mainNavBtnMenu.addEventListener("click", ()=>{
        asideMainMenu.style.transform = "translateX(0)";
        asideMainMenuOverlay.classList.add("v-overlay--active");
     });


     asideMainMenuOverlay.addEventListener("click", ()=>{
       asideMainMenuOverlay.classList.remove("v-overlay--active");
       asideMainMenu.style.transform = "translateX(-100%)";
    });
});