@extends('layouts.app')
@section('title', $product->title)

@section('content')
<div class="row">
<div class="col-lg-10 offset-lg-1">
<div class="card">
  <div class="card-body product-info">
    <div class="row">
      <div class="col-5">
        <img class="cover" src="{{ $product->image_url }}" alt="">
      </div>
      <div class="col-7">
        <div class="title">{{ $product->title }}</div>
        <div class="skus">
          <label>选择</label>
          <div class="btn-group btn-group-toggle" data-toggle="buttons">
            @foreach($product->skus as $sku)
            <label
                class="btn sku-btn"
                data-price="{{ $sku->price }}"
                data-stock="{{ $sku->stock }}"
                data-toggle="tooltip"
                title="{{ $sku->description }}"
                data-placement="bottom">
              <input type="radio" name="skus" autocomplete="off" value="{{ $sku->id }}"> {{ $sku->title }}
            </label>
          @endforeach
          </div>
        </div>
        <div class="cart_amount"><label>数量</label><input type="text" class="form-control form-control-sm" value="1"><span>件</span><span class="stock"></span></div>
        <div class="buttons">
          <button class="btn btn-primary btn-add-to-cart">加入需求单</button>
        </div>
      </div>
    </div>
    <div class="product-detail">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" href="#product-detail-tab" aria-controls="product-detail-tab" role="tab" data-toggle="tab" aria-selected="true">耗材详情</a>
        </li>
      </ul>
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="product-detail-tab">
          {!! $product->description !!}
        </div>
        <div role="tabpanel" class="tab-pane" id="product-reviews-tab">
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
@endsection

@section('scriptsAfterJs')
<script>
  $(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip({trigger: 'hover'});
    $('.sku-btn').click(function () {
      $('.product-info .stock').text('库存：' + $(this).data('stock') + '件');
    });
    $('.btn-add-to-cart').click(function () {

    // 请求加入需求单接口
    axios.post('{{ route('cart.add') }}', {
    sku_id: $('label.active input[name=skus]').val(),
    amount: $('.cart_amount input').val(),
    })
    .then(function () {
        swal('加入需求单成功', '', 'success')
        .then(function() {
          location.href = '{{ route('cart.index') }}';
        });
    }, function (error) {
        if (error.response.status === 401) {

        swal('请先登录', '', 'error');

        } else if (error.response.status === 422) {

        var html = '<div>';
        _.each(error.response.data.errors, function (errors) {
            _.each(errors, function (error) {
            html += error+'<br>';
            })
        });
        html += '</div>';
        swal({content: $(html)[0], icon: 'error'})
        } else {

        swal('系统错误', '', 'error');
        }
    })
    });

});
</script>
@endsection
