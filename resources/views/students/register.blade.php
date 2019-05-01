@extends('students.layouts.app')


@section('title', 'Registro')

@section('content')
    <div id="app">
         <register :url="url"  title="registro" :field-form="fieldForm"></register> 

        <div class="text-xs-center" style="margin-top:20px">
             ¿Ya tienes una cuenta  ?
            <a href="/login">Inicia session</a>
            
        </div> 
    </div>
       
@endsection



@section('scripts')

    <script  src="/js/vue/vue.min.js"></script>  
    <script src="/js/vuetify/vuetify.js"></script>
    

     <script src="{{ mix('/js/students/register/app.js') }}"></script> 
@endsection