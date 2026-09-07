

@if(slider('Front Page Slider'))
<div id="wowslider-container1">
    <div class="ws_images">
        <ul>
            @foreach(slider('Front Page Slider')->subSliders as $i=>$slider)
            <li class="{{$i==0?'active':''}}"><img src="{{asset($slider->slideImage())}}" alt="Bengal-Trips" title="Bengal-Trips" id="wows1_0" /></li>
            @endforeach
        </ul>
    </div>
</div>
@endif

<!-- End WOWSlider.com BODY section -->
