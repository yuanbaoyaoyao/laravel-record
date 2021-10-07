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

      <div class="float-right">{{ $products->render() }}</div>
    </div>
  </div>
</div>
</div>
</div>
@endsection
