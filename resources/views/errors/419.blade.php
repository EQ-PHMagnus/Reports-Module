@extends('errors::minimal')

@section('title', __('Page Expired'))
@section('code', '419')

@section('message', __('Page Expired'))

@section('action')
<a href='{{route('logout')}}'>Click  Here to login again..</a>
@endsection

