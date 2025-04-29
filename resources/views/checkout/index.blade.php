@extends('layouts.checkout')

@section('content')



<section class="bg--gray">
    <checkout-index :settings="{{ $system_settings}}" :csrf="{{ $csrf }}" />
</section>
@endsection