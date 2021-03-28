@extends('errors::illustrated-layout')

@section('title', __('Internal Server Error'))
@section('code', 500)
@section('message', __('The server encountered an internal error or misconfiguration and was unable to complete your request.'))