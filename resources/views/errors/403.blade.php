@extends('errors::minimal')

@section('title', __('محظور'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
