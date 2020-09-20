@extends('layouts.dashboard.app')
@section('title')
Uploadfile
@stop
@section('contenido')
    <upload-component route-excel="{{ route('importarExcel') }}"></upload-component>
@endsection