@extends('students.layouts.app')

@section('title', 'Libros')

@section('cssFile')
  <link rel="stylesheet" href="/css/students/cat-w-books.css">
@endsection

@section('content')
       <div class="cat-w-books-wrapper">
            <section class="cat-w-books">
                        <!-- imprimmir categorias -->
                        <aside class="cat-w-books-aside">
                                @component('students.books.categoriesList', ['categories' => $categories])
                                @endcomponent   
                        </aside>

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
                                                        
                                                </div>
                                        </a>
                                        </article>
                                @endforeach
                              
                        </section>
                </section>

       </div>
@endsection


@section('scripts')
    
@endsection