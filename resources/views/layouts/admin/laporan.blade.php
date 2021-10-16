@extends('layouts.app')

@section('title', 'Laporan')

@section('sidebar')
@include('component.admin.admin-sidebar')
@endsection

@section('content')
@include('component.admin.content-laporan')
@endsection
