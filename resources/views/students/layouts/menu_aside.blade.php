
 <div id="asideMainMenuOverlay"  class="v-overlay  v-overlay--absolute asideMainMenuOverlay ">
 </div>

  
    <aside id="asideMainMenu" class="white main-menu ">
          
        
            <div class="main-menu-item">
                    <a class="main-menu-item-link" href="/books">
                        
                        <i class="material-icons  main-menu-item-link__i">
                            book
                        </i>

                        <span>Inicio</span>
                    </a>
             </div>
               
              
             @if(isset($categories))

                <div class="v-navigation-drawer__border"></div>
                <hr class="v-divider theme--light"> 

                <div class="main-menu-list">
                        <div class="main-menu-list-title">
                            
                    
                            Categorías
                        </div>
                        <section class="main-menu-list-data">
                                
                                @foreach($categories as $category)
                                <div class="main-menu-list-data__item">
                                    <a href="{{ '/books/'.$category->id }}" class="main-menu-list-data__item__link"> 
                                        {{
                                            $category->name
                                        }}
        
                                    </a>

                                </div>
                            @endforeach
                                
                            
                        </section>
                </div> 
            @endif
           
    </aside>

        <!--href="/books"    href="/login/closeSession" -->