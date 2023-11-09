@extends('main.core')

@section('content')
    <view-password-reset :token="{{ json_encode($token) }}" :email="{{ json_encode($email) }}">
    </view-password-reset>
@endsection
