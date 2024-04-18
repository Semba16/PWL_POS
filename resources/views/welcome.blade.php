@extends('layout.app')

{{-- Customize layout sections --}}

@section('subtitle', 'welcome')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'welcome')

{{-- Content body: main page content --}}

@section('content_body')
    <p>welcome to this beatiful admin panel.</p>
@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheets" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}

@push('js')
    <script> console.log("Hi, I'am using the Laravel-adminLTE package!"); </script>
@endpush