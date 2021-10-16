@extends('layouts.app')

@section('title', 'Dashboard')

@section('sidebar')
@include('component.admin.admin-sidebar')
@endsection

@section('content')
@include('component.admin.content-admin')
@endsection
