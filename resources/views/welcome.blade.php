@extends('students.layouts.app')


@section('title', 'inicio')
       
@section('cssFile')
  <link rel="stylesheet" href="/css/students/landing.css">
@endsection


@section('content')
   <section class="sc-presentation">
       <section class="sc-presentation-content">
      
                <div class="sc-presentation-content-desc">
                   
                    <div class="sc-presentation-content-desc__title">
                       <div>
                            <h1 class="white--text">App libros</h1>
                              <p class="white--text">Libros y videos</p>

                              <div>
                                <a  
                                href="/register"
                                class="v-btn theme--dark orange primary">
                                    <div class="v-btn__content">
                                            registrate
                                    </div>
                                </a>

                                <a  
                                href="/login"
                                class="v-btn theme--dark blue primary">
                                    <div class="v-btn__content">
                                            Iniciar sesión
                                    </div>
                                </a>
                              </div>
                             
                       </div>
                      
                    </div>

                   
                </div>
       </section>

       
       
   </section>
@endsection

@section('scripts')
    
@endsection
 