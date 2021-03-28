@extends('errors::illustrated-layout')

@section('title', __('Too Many Requests'))
@section('code', 429)
@section('message', __('You have sent too many requests in a short amount of time. Please try again later.'))