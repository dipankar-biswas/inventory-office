@php
    $setting = App\Models\Setting::where('id',1)->first();
@endphp
<footer>
    <div class="footer-area">
        @if(isset($setting->copyright_text))
            <p>&copy; {{ $setting->copyright_text }}</p>
        @endif
    </div>
</footer>