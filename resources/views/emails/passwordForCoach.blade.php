<div style="direction: rtl; text-align: right;">
    {{-- <x-mail::message> --}}
    @component('mail::message')

        {{-- <x-mail::html> --}}
        <div style="">
            <h1 style="text-align: center">
                أهلا بكم في عائلة سوبر جيم ✨
            </h1>
            <br>
            <b>
                يرجى تحديث كلمة السر الخاصة في المدرب صاحب الايميل : {{$coach->email}}
            </b>
            <br>
        </div>
{{--        @component('mail::panel')--}}
{{--            يرجى تحديث كلمة السر الخاصة في المدرب صاحب الايميل : {{$coach->email}}--}}
{{--        @endcomponent--}}

        {{-- </x-mail::html> --}}

        {{-- The body of your message. --}}

        {{-- <x-mail::panel> --}}
        {{-- </x-mail::panel> --}}
        {{-- <x-mail::string> --}}
        {{-- </x-mail::string> --}}

        شكرًا,
        {{ config('app.name') }}
    @endcomponent
    {{-- </x-mail::html> --}}
</div>
