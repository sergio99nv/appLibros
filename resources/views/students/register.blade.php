@extends('layouts.app')


@section('title', 'Login')

@section('content')
    <div id="app">
         <register :url="url"  title="registro" :field-form="fieldForm"></register> 
    </div>    
@endsection



@section('scripts')
    <script src="/js/students/register/app.js"></script>   
@endsection