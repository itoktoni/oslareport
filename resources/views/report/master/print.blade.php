@extends('layouts.print')

@section('header')

<x-action_print/>

@endsection

@section('content')
@include(Template::print(SharedData::get('template'),'data'))
@endsection