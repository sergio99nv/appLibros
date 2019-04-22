
@extends('admins/layouts.app')


@section('title', 'Login admin')

@section('content')
    <div id="app">
         <login :url="url"  :field-form="fieldForm" title="login"></login> 
    </div>    
@endsection



@section('scripts')
    <script src="/js/admins/login/app.js"></script>   
@endsection
 

