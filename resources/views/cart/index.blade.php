@extends('layouts.app')
@section('title', '需求单')

@section('content')
<div class="row">
<div class="col-lg-10 offset-lg-1">
<div class="card">
  <div class="card-header">我的需求单</div>
  <div class="card-body">
    <table class="table table-striped">
      <thead>
      <tr>
        <th><input type="checkbox" id="select-all"></th>
        <th>耗材信息</th>
        <th>数量</th>
        <th>操作</th>
      </tr>
      </thead>
      <tbody class="product_list">
      @foreach($cartItems as $item)
        <tr data-id="{{ $item->productSku->id }}">
          <td>
            <input type="checkbox" name="select" value="{{ $item->productSku->id }}" {{ $item->productSku->product->in_warehouse ? 'checked' : 'disabled' }}>
          </td>
          <td class="product_address">
            <div class="preview">
              <a target="_blank" href="{{ route('products.show', [$item->productSku->product_id]) }}">
                <img src="{{ $item->productSku->product->image_url }}">
              </a>
            </div>
            <div @if(!$item->productSku->product->in_warehouse) class="not_in_warehouse" @endif>
              <span class="product_title">
                <a target="_blank" href="{{ route('products.show', [$item->productSku->product_id]) }}">{{ $item->productSku->product->title }}</a>
              </span>
              <span class="sku_title">{{ $item->productSku->title }}</span>
              @if(!$item->productSku->product->in_warehouse)
                <span class="warning">该耗材已下架</span>
              @endif
            </div>
          </td>
          <td>
            <input type="text" class="form-control form-control-sm amount" @if(!$item->productSku->product->in_warehouse) disabled @endif name="amount" value="{{ $item->amount }}">
          </td>
          <td>
            <button class="btn btn-sm btn-danger btn-remove">移除</button>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>

    <div>
        <form class="form-horizontal" role="form" id="order-form">
          <div class="form-group row">
            <label class="col-form-label col-sm-3 text-md-right">选择用户信息</label>
            <div class="col-sm-9 col-md-7">
              <select class="form-control" name="address">
                @foreach($addresses as $address)
                  <option value="{{ $address->id }}">{{ $address->department }} {{ $address->user }} {{ $address->contact_phone }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-form-label col-sm-3 text-md-right">备注</label>
            <div class="col-sm-9 col-md-7">
              <textarea name="remark" class="form-control" rows="3"></textarea>
            </div>
          </div>
          <div class="form-group">
            <div class="offset-sm-3 col-sm-3">
              <button type="button" class="btn btn-primary btn-create-order">提交需求单</button>
            </div>
          </div>
        </form>
      </div>
  </div>
</div>
</div>
</div>
@endsection

@section('scriptsAfterJs')
<script>
  $(document).ready(function () {
    $('.btn-remove').click(function () {
      var id = $(this).closest('tr').data('id');
      swal({
        title: "确认要将该耗材移除？",
        icon: "warning",
        buttons: ['取消', '确定'],
        dangerMode: true,
      })
      .then(function(willDelete) {
        if (!willDelete) {
          return;
        }
        axios.delete('/cart/' + id)
          .then(function () {
            location.reload();
          })
      });
    });
    $('#select-all').change(function() {
      var checked = $(this).prop('checked');
      $('input[name=select][type=checkbox]:not([disabled])').each(function() {
        $(this).prop('checked', checked);
      });
    });

    $('.btn-create-order').click(function () {
      var req = {
        address_id: $('#order-form').find('select[name=address]').val(),
        items: [],
        remark: $('#order-form').find('textarea[name=remark]').val(),
      };
      $('table tr[data-id]').each(function () {
        var $checkbox = $(this).find('input[name=select][type=checkbox]');
        if ($checkbox.prop('disabled') || !$checkbox.prop('checked')) {
          return;
        }
        // 获取当前行中数量输入框
        var $input = $(this).find('input[name=amount]');
        // 如果用户将数量设为 0 或者不是一个数字，则也跳过
        if ($input.val() == 0 || isNaN($input.val())) {
          return;
        }
        req.items.push({
          sku_id: $(this).data('id'),
          amount: $input.val(),
        })
      });
      console.log(req);
      axios.post('{{ route('orders.store') }}', req)
        .then(function (response) {
            swal('订单提交成功', '', 'success')
                .then(() => {
                    location.href = '/orders/' + response.data.id;
                });
        }, function (error) {
          if (error.response.status === 422) {
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
        });
    });

  });
</script>
@endsection
