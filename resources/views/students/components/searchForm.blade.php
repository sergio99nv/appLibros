<form method="post"   action="{{ $actionUrl }}">
        <span>@csrf   {{ csrf_field() }} </span>   
        
        <div class="f-search-close text-xs-right">
                <i class="material-icons">
                  close
              </i>
        </div>
        <div class="f-search">
                <select class="f-search__select  select--normal" name="categoryId">
                        <option value="0" selected disabled>Categoria</option>
                        <option value="0">todos</option>

                        @foreach($categories as $category)
                        <option value="{{ $category->id }}"> 
                                {{
                                        $category->name
                                }}
                        </option>
                @endforeach   
                </select>    

                <div class="f-search-wrapper-input">
                        <input name="bookName" type="search" placeholder="Buscar libro o autor">
                        
                        <span class="f-search-input__searchIcon">
                                <i class="material-icons">
                                        search
                                </i>
                        </span>
                </div>
                
        </div>
</form>