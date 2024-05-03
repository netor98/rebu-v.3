<div class="flex items-center">
    @if (Route::currentRouteName() == 'dashboard' || Route::currentRouteName() == 'profile')
        <img src="{{asset('logo.png')}}" class="w-10 mx-2">
        <h3 class="font-bold text-2xl mx-2">Rebu</h3>
    @else
        <img src="{{asset('logo.png')}}" class="w-10 mx-2">
        <h3 class="font-bold text-2xl mx-2">Rebu</h3>
    @endif
    
</div>