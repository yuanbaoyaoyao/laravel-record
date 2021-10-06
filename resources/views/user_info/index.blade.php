@extends('layouts.app')
@section('title', '领用信息列表')

@section('content')
  <div class="row">
    <div class="col-md-10 offset-md-1">
      <div class="card panel-default">
        <div class="card-header">
            领用信息列表
            <a href="{{ route('user_info.create') }}" class="float-right">新增领用信息</a>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>部门</th>
              <th>使用人</th>
              <th>联系电话</th>
              <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($info as $i)
              <tr>
                <td>{{ $i->department }}</td>
                <td>{{ $i->user }}</td>
                <td>{{ $i->contact_phone }}</td>
                <td>
                    <a href="{{ route('user_info.edit', ['user_info' => $i->id]) }}" class="btn btn-primary">修改</a>
                    <button class="btn btn-danger">删除</button>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
