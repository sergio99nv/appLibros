@extends('students.layouts.app')


@section('title', 'Login')

@section('content')
     <section class="text-xs-center" style="padding:3rem 2rem">
            <div>
                <h1>Se ha registrado exitosamente</h1>
            </div>    

            <div>
                <a  
                href="/login"
                class="v-btn theme--dark blue primary">
                    <div class="v-btn__content">
                            Iniciar sesión
                    </div>
                </a>
            </div>

     </section>
    
@endsection



@section('scripts')
   
@endsection