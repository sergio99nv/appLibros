@extends('students.layouts.app')

@section('title', 'Libros')

@section('cssFile')
  <link rel="stylesheet" href="/css/students/cat-w-books.css">
@endsection

@section('content')
      

 
  
        <section class="cat-w-books-wrapper">
         
                 @if($type !== "search" && $categoryId!=null)
                        <nav class="v-toolbar theme--light elevation-1 blue-grey lighten-5 nav-books-links" data-booted="true" style="margin-top: 0px; padding-right: 0px; padding-left: 0px; transform: translateY(0px);">
                        <div 
                        class="{{
                                'v-toolbar__content   nav-books-links_content--'.$type      
                            }}"
                          style="height: 64px;">
                         
                                <div class="v-toolbar__items ">
                               
                                <a href="{{'/books/'.$categoryId}}"  class="link-b-books v-btn v-btn--flat theme--light">
                                          <div class="v-btn__content">Libros</div>
                                </a>

                                <a href="{{'/books/videos/'.$categoryId}}"  class="link-b-videos v-btn v-btn--flat theme--light">
                                          <div class="v-btn__content">Videos</div>
                                </a>
                                
                                
                                </div>
                        </div>
                @endif
        </nav>



                <div class="cat-w-books-wrapper__row">
               
                        @if(isset($categoryName) && $categoryName!=="todos")
                                <h1>
                                {{$categoryName}}
                                </h1>
                        @elseif ($type === "search")
                                <h2>
                                Resultados de busqueda   
                                </h2>

                        @endif
              
                        @if($type === "books" || $type === "search")
                                <h4>
                                        {{
                                        count($books)     
                                        }}   
                                        resultados
                                </h4>     
                         @endif
                
                </div>
                
        
                <!-- imprimmir libros -->
                @if($type === "books" || $type === "search")
                      @include('students.books.booksData') 
                @else
                   @include('students.books.videosData')                   
                @endif 


        </section>
             
@endsection


@section('scripts')
    
@endsection