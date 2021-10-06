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
                    <button class="btn btn-danger btn-del-info" type="button" data-id="{{ $i->id }}">删除</button>
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

@section('scriptsAfterJs')
<script>
$(document).ready(function() {
  // 删除按钮点击事件
  $('.btn-del-info').click(function() {
    // 获取按钮上 data-id 属性的值，也就是地址 ID
    var id = $(this).data('id');
    // 调用 sweetalert
    swal({
        title: "确认要删除该地址？",
        icon: "warning",
        buttons: ['取消', '确定'],
        dangerMode: true,
      })
    .then(function(willDelete) { // 用户点击按钮后会触发这个回调函数
      // 用户点击确定 willDelete 值为 true， 否则为 false
      // 用户点了取消，啥也不做
      if (!willDelete) {
        return;
      }
      // 调用删除接口，用 id 来拼接出请求的 url
      axios.delete('/user_info/' + id)
        .then(function () {
          // 请求成功之后重新加载页面
          location.reload();
        })
    });
  });
});
</script>
@endsection
