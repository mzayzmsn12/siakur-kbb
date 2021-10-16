@extends('layouts.app')

@section('title', 'User Management')

@section('sidebar')
@include('component.admin.admin-sidebar')
@endsection

@section('content')
@include('component.admin.content-user')
@endsection
