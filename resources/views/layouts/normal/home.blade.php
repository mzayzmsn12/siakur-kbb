@extends('layouts.app')

@section('title', 'Dashboard')

@section('sidebar')
@include('component.normal.sidebar')
@endsection

@section('content')
@include('component.normal.content-user')
@endsection
