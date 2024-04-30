@extends('layouts.app')

@section('content')
    <div>
        <h1>Sales Activation Email</h1>
        <p>Dear {{ $user->name }},</p>
        <p>Your sales account has been activated.</p>
        <p>Thank you for joining our sales team!</p>
    </div>
@endsection