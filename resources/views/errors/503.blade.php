@extends('errors::illustrated-layout')

@section('title', __('Too Many Requests'))
@section('code', 503)
@section('message', __($exception->getMessage() ?: 'The server is currently unable to handle the request due to a temporary overload or scheduled maintenance, which will likely be alleviated after some delay.'))