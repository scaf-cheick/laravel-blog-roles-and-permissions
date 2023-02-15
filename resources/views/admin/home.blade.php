@extends('layouts.admin')

@section('title') DASHBOARD - Home  @endsection

@section('content')

    <div class="">

        @include('layouts.partials._successOrerror')

        <blockquote>Welcome back <b>{{ Auth::user()->name }}</b> !</blockquote>

    </div>

@endsection

@push('js')

    @include('layouts.partials._notification')

@endpush