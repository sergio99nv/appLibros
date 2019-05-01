
@extends('admins/layouts.app')
@section('title', 'Login admin')

@section('content')
    <div id="app">
         <login :url="url"  :field-form="fieldForm" title="Iniciar de sesión(Admin)"></login> 
    </div>    
@endsection



@section('scripts')

    <script  src="/js/vue/vue.min.js"></script>  
    <script src="/js/vuetify/vuetify.js"></script>


    <script src="{{ mix('/js/admins/login/app.js') }}"></script>
  
@endsection
 

