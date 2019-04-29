<div class="wrapper-videos">
   @foreach($videos as $video)
    <div class="videoWrapper">
     <iframe 
        src="{{  'https://www.youtube.com/embed/'.$video->url }}" 
        frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" 
        allowfullscreen>
        </iframe>
    </div>
     
   @endforeach
</div>