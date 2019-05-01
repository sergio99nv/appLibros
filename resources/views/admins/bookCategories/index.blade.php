
@extends('admins/layouts.app')
@section('title', 'categorias')

@section('content')
      <div id="app">
      <keep-alive  :exclude="['books', 'videos']" > <router-view></router-view> </keep-alive> 
    </div>
@endsection


@section('scripts')
<script>
        window.AppBookHelper = {};
        window.AppBookHelper.fileConfig =  <?php echo json_encode($fileConfig, JSON_HEX_TAG); ?>; 
    </script>

    <script  src="/js/vue/vue.min.js"></script>  
    <script src="/js/vuetify/vuetify.js"></script>
   

    <script src="{{ mix('/js/admins/bookCategories/app.js') }}"></script>

@endsection
 