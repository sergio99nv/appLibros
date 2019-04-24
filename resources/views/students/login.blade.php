@extends('students.layouts.app')


@section('title', 'Login')

@section('content')
 
    <div id="app">
         <login :url="url"  :field-form="fieldForm" title="Iniciar sesión"></login> 
    </div>    
@endsection



@section('scripts')
    <script src="/js/students/login/app.js"></script>   
@endsection
 

