@extends('layouts.default')
@section('content')
		<!-- begin #content -->
		<div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="text-center">
                    <img src="{{ \Auth::user()->avatar }}" class="img-circle" style="width: 150px;height: 150px;" alt="">
                    {{--上传头像表单--}}
                    {!! Form::open(['method'=>'post','url'=>'/user/avatar', 'files'=>true]) !!}
                    {{--Avatar 上传--}}
                    {!! Form::file('avatar') !!}
                    <!-- 提交 -->
                    {!! Form::submit('更换头像',['class' => 'btn btn-primary pull-right']) !!}
                </div>
            </div>
            <div class="col-md-6 col-md-offset-3">
                @if($errors->any())
                    <ul class="list-group">
                        @foreach($errors->all() as $error)
                            <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
		<!-- end #content -->
@endsection
