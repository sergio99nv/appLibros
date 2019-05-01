@extends('students.layouts.app')

@section('title', '')

@section('cssFile')
  <link rel="stylesheet" href="/css/students/book-info.css">
@endsection

@section('content')
       <section class="book-info-wrapper">
            <section class="book-info">
                    
                    <div class="book-info-cover">
                            @if(strlen($bookInfo->cover) > 0)
                                <img 
                                src=" {{
                                                $fileUlrs['image'].'/'.$bookInfo->cover
                                        }}" 
                                alt="">
                            @else
                                <img 
                                src="/img/no_cover.png"
                                alt="">
                            @endif
                    </div>  
                    <div class="book-info-desc">
                           <h2 class="book-info-desc__title">
                               {{
                                   $bookInfo->name
                               }}
                           </h2>
                           <h4 class="book-info-desc__author blue-grey--text text--darken-4">
                               <span>Autor: </span>
                               {{
                                   $bookInfo->author
                               }}
                           </h4>

                           <div class="book-info-desc__desc">
                            
                             <p>    
                                  {{
                                        $bookInfo->description
                                  }}
                               
                               </p>
                           </div>
                    </div>  
                    
            </section> 
            
            
            <section class="book-actions">
                   <a class="v-btn theme--dark primary" href="{{ 
                        $fileUlrs['file'].'/'.$bookInfo->file
                   }}"  download="libro">

                    <i class="material-icons v-icon v-icon--left">
                        get_app
                        </i>
                    Descargar
                 
                  </a>

                  <a class="v-btn green primary"
                          target="_blank" 
                        href="{{ 
                        $fileUlrs['file'].'/'.$bookInfo->file}}">

                   <i class="material-icons v-icon v-icon--left">
                     open_in_new
                    </i>
                    Leer libro

                    
                 
                  </a>
                    
             </section> 
 

       <section id="appCommentaries" class="book-comentaries">

            <commentaries-list :book-id="@json($bookInfo->id)"></commentaries-list>
       </section>
@endsection


@section('scripts')

    <script  src="/js/vue/vue.min.js"></script>  
    <script src="/js/vuetify/vuetify.js"></script>
     
   

    <script src="{{ mix('/js/students/commentary/app.js') }}"></script> 
@endsection