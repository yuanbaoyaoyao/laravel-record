@extends('layouts.app')
@section('title', ($i->id?'修改':'新增').'领用信息')

@section('content')
<div class="row">
<div class="col-md-10 offset-lg-1">
<div class="card">
  <div class="card-header">
    <h2 class="text-center">
      {{$i->id?'修改':'新增'}}领用信息
    </h2>
  </div>
  <div class="card-body">
    <!-- 输出后端报错开始 -->
    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <h4>有错误发生：</h4>
        <ul>
          @foreach ($errors->all() as $error)
            <li><i class="glyphicon glyphicon-remove"></i> {{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <!-- 输出后端报错结束 -->
    @if($i->id)

    <form class="form-horizontal" role="form" action="{{route('user_info.update',['user_info'=>$i->id])}}" method="POST">
        {{method_field('PUT')}}
    @else
    <form class="form-horizontal" role="form" action="{{route('user_info.store')}}" method="POST">
    @endif
        <!-- 引入 csrf token 字段 -->
      {{ csrf_field() }}
        <div class="form-group row">
          <label class="col-form-label text-md-right col-sm-2">部门</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="department" value="{{ old('department', $i->department) }}">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label text-md-right col-sm-2">使用人</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="user" value="{{ old('user', $i->user) }}">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label text-md-right col-sm-2">电话</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="contact_phone" value="{{ old('contact_phone', $i->contact_phone) }}">
          </div>
        </div>
        <div class="form-group row text-center">
          <div class="col-12">
            <button type="submit" class="btn btn-primary">提交</button>
          </div>
        </div>
      </form>
  </div>
</div>
</div>
</div>
@endsection
