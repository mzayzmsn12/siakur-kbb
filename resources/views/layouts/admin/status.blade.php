@extends('layouts.app')

@section('title', 'Status Usulan')

@section('sidebar')
@include('component.admin.admin-sidebar')
@endsection

@section('content')
@include('component.admin.content-status')
@endsection
