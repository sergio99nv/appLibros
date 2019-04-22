@extends('layouts.app')


@section('title', 'Login')

@section('content')
    <div id="app">
         <login :url="url"  :field-form="fieldForm" title="login"></login> 
    </div>    
@endsection



@section('scripts')
    <script src="/js/students/login/app.js"></script>   
@endsection
 

