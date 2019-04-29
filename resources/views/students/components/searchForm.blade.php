<form method="post" id="formSearch"  action="{{ $actionUrl }}">
        <span>@csrf   {{ csrf_field() }} </span>   
        
        <div  style="cursor:pointer" id="f-search-close" class="f-search-close text-xs-right">
                <i class="material-icons">
                  close
              </i>
        </div>
        <div class="f-search">
   
                <select class="f-search__select  select--normal" name="categoryId">
                        <option value="-1" disabled  selected>Categoria</option>

                        @if(!is_null($categoryId) && $categoryId == 0)
                                <option value="0" selected>Todas</option>
                        @else
                                <option value="0">Todas</option>
                        @endif

                        @foreach($categories as $category)
                                @if(!is_null($categoryId) && $categoryId == $category->id )
                                        <option selected value="{{ $category->id }}"> 
                                                {{
                                                        $category->name
                                                }}
                                                 
                                        </option>
                                @else
                                        <option value="{{ $category->id }}"> 
                                                {{
                                                        $category->name
                                                }}
                                        </option>
                                
                                @endif
                               
                     @endforeach   
                </select>    

                <div class="f-search-wrapper-input">
                        <input id="formSearchInput" name="bookName" type="search" placeholder="Buscar libro o autor">
                        
                        <button type="submit" title="buscar" class="f-search-input__searchIcon">
                                <i class="material-icons">
                                        search
                                </i>
                        </button>
                </div>
                
        </div>
</form>