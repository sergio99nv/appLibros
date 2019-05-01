<section  class="book-data-wrapper">
        @foreach($books as $bookItem)
                <article class="book-item">
                <a class="" href="{{ '/book/info/'.$bookItem->id }}">
                        
                        <div class="">
                                <div>               
                                        @if(strlen($bookItem->cover) > 0)
                                        <img 
                                        src=" {{
                                                        $fileUlrs['image'].'/'.$bookItem->cover
                                                }}" 
                                        alt="">
                                        @else
                                        <img 
                                        src="/img/no_cover.png"
                                        alt="">
                                        @endif
                                </div>
                                <div class="black--text book-item__bookName  book-item__truncate">
                                        {{
                                                $bookItem->name
                                        }}
                                </div>

                                <div class=" blue-grey--text text--darken-4 book-item__autor  book-item__truncate">
                                    Autor :   {{
                                                $bookItem->author
                                            }}
                                </div>
                               
                                
                        </div>
                </a>
                </article>
        @endforeach
        
</section>