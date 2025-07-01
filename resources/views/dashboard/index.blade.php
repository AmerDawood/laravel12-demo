@extends('dashboard.master')




@section('content')

     @livewire('dashboard', ['role' => $role])
@endsection
