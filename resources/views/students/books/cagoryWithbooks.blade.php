@extends('students.layouts.app')

@section('title', 'Libros')

@section('cssFile')
  <link rel="stylesheet" href="/css/students/cat-w-books.css">
@endsection

@section('content')
      
        <section class="cat-w-books-wrapper">
              

               <div>
                        @if(isset($categoryName) && $categoryName!=="todos")
                                <h1>
                                {{$categoryName}}
                                </h1>
                        @elseif(isset($isSearch) && $isSearch == "true")
                                <h2>
                                     Resultados de busqueda   
                                </h2>

                        @endif
               </div>
               <div>
                   <h4>
                        {{
                           count($books)     
                        }}   
                         resultados
                   </h4>     

               </div>
                

                <!-- imprimmir libros -->
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


        </section>
             
@endsection


@section('scripts')
    
@endsection