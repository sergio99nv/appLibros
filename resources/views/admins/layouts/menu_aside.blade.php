 
 <div id="asideMainMenuOverlay"  class="v-overlay  v-overlay--absolute asideMainMenuOverlay ">
 </div>

  
    <aside id="asideMainMenu" class="white main-menu elevation-2">
          
          <div class="main-menu-item ">
                    <a class="main-menu-user-link main-menu-user-link" >
                        
                        <div class="main-menu-user-link__avatar">
                            <img  src="/img/userNoPicture.jpg"  alt="">
                        </div>
                        <span>
                            <strong>
                                {{
                                Session::get("userName")
                                }}
                            </strong>                        
                        </span>
                    </a>
             </div>
            <div class="v-navigation-drawer__border"></div>
            <hr class="v-divider theme--light"> 

            <div class="main-menu-item">
                    <a class="main-menu-item-link" href="/admins/main">
                        
                        <i class="material-icons  main-menu-item-link__i">
                            book
                        </i>

                        <span>Inicio</span>
                    </a>
             </div>


             <div class="v-navigation-drawer__border"></div>
            <hr class="v-divider theme--light"> 



            <div class="main-menu-item">
                    <a class="main-menu-item-link" href="/admins/bookCategories">
                        
                        <i class="material-icons  main-menu-item-link__i">
                            book
                        </i>

                        <span>Gestionar libros</span>
                    </a>
             </div>


             <div class="v-navigation-drawer__border"></div>
            <hr class="v-divider theme--light"> 
            <div class="main-menu-item">
                    <a class="main-menu-item-link" href="/admins/users">
                        
                        <i class="material-icons  main-menu-item-link__i">
                            book
                        </i>

                        <span>Usuarios(admin)</span>
                    </a>
             </div>
               
            

            <div class="v-navigation-drawer__border"></div>
            <hr class="v-divider theme--light"> 

            <div class="main-menu-item">
                    <a class="main-menu-item-link" href="/admins/login/closeSession">
                        
                        <i class="material-icons  main-menu-item-link__i">
                             exit_to_app
                        </i>

                        <span>Salir</span>
                    </a>
             </div>
    </aside>

        <!--href="/books"    href="/login/closeSession" -->