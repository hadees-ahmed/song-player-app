@if(App::isLocale('en'))
    <a href="{{ \Illuminate\Support\Facades\Route::current()->uri()  }}?locale=fr">{{__('Translate To French')}}</a>
@else
    <a href="{{ \Illuminate\Support\Facades\Route::current()->uri()  }}?locale=en">{{__('Translate To English')}}</a>
@endif
