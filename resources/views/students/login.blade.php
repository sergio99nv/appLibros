@extends('students.layouts.app')


@section('title', 'Login')

@section('content')

    <div id="app">

         <login :url="url"  :field-form="fieldForm" title="Iniciar sesión"></login> 
    </div> 


    <div class="text-xs-center" style="margin-top:20px">
            <a href="admins/login">Entrar como administrador</a>
     </div> 
   
    
@endsection



@section('scripts')

    <script  src="/js/vue/vue.min.js"></script>  
    <script src="/js/vuetify/vuetify.js"></script>
    

    <script src="{{ mix('/js/students/login/app.js') }}"></script> 
@endsection
 

