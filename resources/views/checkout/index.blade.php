@extends('layouts.checkout')

@section('content')
<section class="bg--gray">

    <div id="full-bg" class="full-bg">
        <div class="signup--middle">
            <div class="loading">
                <div class="loader"></div>
            </div>
            <img src="{{ $system_settings->logo_path() }}" height="110" width="80" alt="Ohram Logo">
        </div>

    </div>


    <checkout-index :config='@json($settings)'
        :settings="{{ $system_settings}}" :csrf="{{ $csrf }}" />
</section>
@endsection

@section('inline-scripts')

@stop