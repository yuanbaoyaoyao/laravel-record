@extends('layouts.app')
@section('title', '耗材列表')

@section('content')
<div class="row">
<div class="col-lg-10 offset-lg-1">
<div class="card">
  <div class="card-body">
      <form action="{{ route('products.index') }}" class="search-form">
        <div class="form-row">
          <div class="col-md-9">
            <div class="form-row">
              <div class="col-auto"><input type="text" class="form-control form-control-sm" name="search" placeholder="搜索"></div>
              <div class="col-auto"><button class="btn btn-primary btn-sm">搜索</button></div>
            </div>
          </div>
        </div>
      </form>
      <table class="table table-striped">
        <thead>
        <tr>
          <th>#</th>
          <th>图片</th>
          <th>耗材名称</th>
{{--          <th>描述</th>--}}
          <th>选项</th>
        </tr>
        </thead>
        <tbody class="product_list">
        @foreach($products as $product)
          <tr>
            <td>
                {{ $product->id }}
            </td>
            <td class="product_info">
              <div class="preview">
                <a target="_blank" href="{{ route('products.show', [$product->id]) }}">
                  <img src="{{ $product->image_url }}">
                </a>
              </div>
            </td>
            <td>{{$product->title}}</td>
{{--            <td>{{$product->description}}</td>--}}
            <td>
              <a href="{{route('products.show',['product'=>$product->id])}}">查看详情</a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>

      <div class="float-right">{{ $products->appends($filters)->render() }}</div>
    </div>
  </div>
</div>
</div>
</div>
@endsection

@section('scriptsAfterJs')
  <script>
    var filters = {!! json_encode($filters) !!};
    $(document).ready(function () {
      $('.search-form input[name=search]').val(filters.search);
    })
  </script>
@endsection
