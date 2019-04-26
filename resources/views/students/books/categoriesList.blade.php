<div role="list" class="v-list theme--light elevation-1">
        <div role="listitem">
                <a class="v-list__tile v-list__tile--link v-list__tile--avatar theme--light">
                        <div class="v-list__tile__content">
                                <h1>Categorias </h1>
                        </div>
                </a>
        </div>
        
        @foreach($categories as $category)
                <div role="listitem">
                        <a class="v-list__tile v-list__tile--link v-list__tile--avatar theme--light">
                                
                        <div class="v-list__tile__content">
                                <div class="v-list__tile__title">
                                        {{
                                        $category->name
                                        }}
                                </div>
                                
                        </div>
                        </a>
                </div>
                <hr class="v-divider  theme--light"> 
        @endforeach
 </div>    