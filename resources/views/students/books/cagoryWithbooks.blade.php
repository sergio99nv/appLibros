@extends('students.layouts.app')

@section('title', 'Libros')

@section('cssFile')
  <link rel="stylesheet" href="/css/students/cat-w-books.css">
@endsection

@section('content')
      
         <form method="post"   action="/searchBookAuthor">
           <span>@csrf   {{ csrf_field() }} </span>

            <input name="bookName" type="search" placeholder="Buscar libro o autor">
         </form>


        <section class="cat-w-books-wrapper">
              

               <div>
                  <h1>
                        {{
                               count($books)
                        }}
                       
                      Resultados
                      @if($isSearch == "true")
                         <span> de busqueda</span>
                      @endif
                  </h1>  
                     
               </div>
                

                <!-- imprimmir libros -->
                <section  class="cat-w-books-books">
                        @foreach($books as $bookItem)
                                <article>
                                <a class="">
                                        
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


        </section>
             
@endsection


@section('scripts')
    
@endsection