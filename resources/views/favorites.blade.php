<h3>{{'Favorites'}}</h3>

@if(App::isLocale('en'))
    <a href="{{route('translate.french')}}">{{__('Translate To French')}}</a>
@else
    <a href="{{route('translate.english')}}">{{__('Translate To English')}}</a>
@endif

@include('partials.song', ['songs' => $songs] )
