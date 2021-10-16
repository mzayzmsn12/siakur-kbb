@extends('layouts.app')

@section('title', 'Pekerjaan')

@section('sidebar')
@include('component.admin.admin-sidebar')
@endsection

@section('content')
@include('component.admin.content-pekerjaan')
@endsection
