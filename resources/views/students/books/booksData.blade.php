<section  class="cat-w-books-books">
                        @foreach($books as $bookItem)
                                <article>
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
                                                        src="https://vinylfiction.com/wp-content/uploads/2018/09/norm.jpg"
                                                        alt="">
                                                        @endif
                                                </div>
                                                <div>
                                                        {{
                                                                $bookItem->name
                                                        }}
                                                </div>
                                                <div>
                                                        {{
                                                                $bookItem->author
                                                        }}
                                                </div>
                                                
                                        </div>
                                </a>
                                </article>
                        @endforeach
                        
                </section>