@extends('errors::illustrated-layout')

@section('title', __('Unauthorized'))
@section('code', 401)
@section('message', __('The request has not been applied because it lacks valid authentication credentials for the target resource.'))