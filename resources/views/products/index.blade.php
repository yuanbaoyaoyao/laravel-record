@extends('layouts.app')
@section('title', '耗材列表')

@section('content')
<div class="row">
<div class="col-lg-10 offset-lg-1">
<div class="card">
  <div class="card-body">

    {{-- <div class="row products-list">
      @foreach($products as $product)
        <div class="col-3 product-item">
          <div class="product-content">
            <div class="top">
                <div class="img"><img src="{{ $product->image_url }}" alt=""></div>
                <div class="title">{{ $product->title }}</div>
            </div>
          </div>
        </div>
      @endforeach --}}
      <form action="{{ route('products.index') }}" class="search-form">
        <div class="form-row">
          <div class="col-md-9">
            <div class="form-row">
              <div class="col-auto"><input type="text" class="form-control form-control-sm" name="search" placeholder="搜索"></div>
              <div class="col-auto"><button class="btn btn-primary btn-sm">搜索</button></div>
            </div>
          </div>
          {{-- <div class="col-md-3">
            <select name="order" class="form-control form-control-sm float-right">
              <option value="">排序方式</option>
              <option value="price_asc">价格从低到高</option>
              <option value="price_desc">价格从高到低</option>
              <option value="sold_count_desc">销量从高到低</option>
              <option value="sold_count_asc">销量从低到高</option>
              <option value="rating_desc">评价从高到低</option>
              <option value="rating_asc">评价从低到高</option>
            </select>
          </div> --}}
        </div>
      </form>
      <table class="table table-sm table-striped">
        <thead>
          <tr>
            <th class="text-xs-center">#</th>
            <th>图片</th> <th>耗材名称</th> <th>描述</th>
            <th class="text-xs-right">选项</th>
          </tr>
        </thead>

        <tbody>
          @foreach($products as $product)
          <tr>
            <td class="text-xs-center"><strong>{{$product->id}}</strong></td>

            <td>{{$product->title}}</td> <td>{{$product->title}}</td> <td>{{$product->description}}</td>

            <td class="text-xs-right">
              <a class="btn btn-sm btn-primary" href="#">
                查看详情
              </a>
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
