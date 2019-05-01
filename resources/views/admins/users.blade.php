
@extends('admins/layouts.app')
@section('title', 'usuarios')

@section('content')
 
      <div id="app">
         <users></users>
    </div>
@endsection


@section('scripts')

    <script  src="/js/vue/vue.min.js"></script>  
    <script src="/js/vuetify/vuetify.js"></script>
    
    
    <script src="{{ mix('/js/admins/users/app.js') }}"></script>
    
@endsection
 