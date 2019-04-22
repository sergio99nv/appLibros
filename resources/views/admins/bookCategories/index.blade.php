
@extends('admins/layouts.app')
@section('title', 'categorias')

@section('content')
      <div id="app">
         <router-view></router-view>
    </div>
@endsection


@section('scripts')
<script>
        window.AppBookHelper = {};
        window.AppBookHelper.fileConfig =  <?php echo json_encode($fileConfig, JSON_HEX_TAG); ?>; 
    </script>
    <script src="/js/admins/bookCategories/app.js"></script>
@endsection
 