@extends('errors::illustrated-layout')

@section('title', __('Forbidden'))
@section('code', 401)
@section('message', __($exception->getMessage() ?: 'The access to the requested resource is forbidden.'))