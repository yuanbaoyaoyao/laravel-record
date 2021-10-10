@extends('layouts.app')
@section('title', '查看需求单')

@section('content')
<div class="row">
<div class="col-lg-10 offset-lg-1">
<div class="card">
  <div class="card-header">
    <h4>需求单详情</h4>
  </div>
  <div class="card-body">
    <table class="table">
      <thead>
      <tr>
        <th>耗材信息</th>
        <th class="text-center">数量</th>
      </tr>
      </thead>
      @foreach($order->items as $index => $item)
        <tr>
          <td class="product-info">
            <div class="preview">
              <a target="_blank" href="{{ route('products.show', [$item->product_id]) }}">
                <img src="{{ $item->product->image_url }}">
              </a>
            </div>
            <div>
              <span class="product-title">
                 <a target="_blank" href="{{ route('products.show', [$item->product_id]) }}">{{ $item->product->title }}</a>
              </span>
              <span class="sku-title">{{ $item->productSku->title }}</span>
            </div>
          </td>
          <td class="sku-amount text-center vertical-middle">{{ $item->amount }}</td>
        </tr>
      @endforeach
      <tr><td colspan="4"></td></tr>
    </table>
    <div class="order-bottom">
      <div class="order-info">
        <div class="line"><div class="line-label">领用信息：</div><div class="line-value">{{ join(' ', $order->address) }}</div></div>
        <div class="line"><div class="line-label">需求单备注：</div><div class="line-value">{{ $order->remark ?: '-' }}</div></div>
        <div class="line"><div class="line-label">需求单编号：</div><div class="line-value">{{ $order->no }}</div></div>
        @if($order->confirmed_at && $order->refund_status !== \App\Models\Order::REFUND_STATUS_PENDING)
        <div class="line">
          <div class="line-label">退货状态：</div>
          <div class="line-value">{{ \App\Models\Order::$refundStatusMap[$order->refund_status] }}</div>
        </div>
        <div class="line">
          <div class="line-label">退货理由：</div>
          <div class="line-value">{{ $order->extra['refund_reason'] }}</div>
        </div>
        @endif
      </div>
      <div class="order-summary text-right">
        <div>
          <span>需求单状态：</span>
          <div class="value">
            @if($order->confirmed_at)
              @if($order->refund_status === \App\Models\Order::REFUND_STATUS_PENDING)
                已确认订单
              @else
                {{ \App\Models\Order::$refundStatusMap[$order->refund_status] }}
              @endif
            @elseif($order->closed)
              已关闭
            @else
              未确认
            @endif

            @if(!$order->confirmed_at && !$order->closed)
            <div class="confirmation-buttons">
              <a class="btn btn-primary btn-sm " href="{{ route('confirmation.store', ['order' => $order->id]) }}">确认需求单</a>
            </div>
            @endif
            <!-- 如果订单的发货状态为已发货则展示确认收货按钮 -->
            @if($order->ship_status === \App\Models\Order::SHIP_STATUS_DELIVERED)
            <div class="receive-button">
              <button type="button" id="btn-receive" class="btn btn-sm btn-success">确认收货</button>
            </div>
            @endif

            @if($order->confirmed_at && $order->refund_status === \App\Models\Order::REFUND_STATUS_PENDING)
            <div class="refund-button">
              <button class="btn btn-sm btn-danger" id="btn-apply-refund">申请退货</button>
            </div>
            @endif
          </div>
        </div>

        @if(isset($order->extra['refund_disagree_reason']))
        <div>
          <span>拒绝退货理由：</span>
          <div class="value">{{ $order->extra['refund_disagree_reason'] }}</div>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
</div>
</div>
@endsection
@section('scriptsAfterJs')
<script>
  $(document).ready(function() {
    $('#btn-receive').click(function() {
      // 弹出确认框
      swal({
        title: "确认已经收到耗材？",
        icon: "warning",
        dangerMode: true,
        buttons: ['取消', '确认收到'],
      })
      .then(function(ret) {
        if (!ret) {
          return;
        }
        axios.post('{{ route('orders.received', [$order->id]) }}')
          .then(function () {
            location.reload();
          })
      });
    });

    $('#btn-apply-refund').click(function () {
      swal({
        text: '请输入退货理由',
        content: "input",
      }).then(function (input) {
        // 当用户点击 swal 弹出框上的按钮时触发这个函数
        if(!input) {
          swal('退货理由不可空', '', 'error');
          return;
        }
        axios.post('{{ route('orders.apply_refund', [$order->id]) }}', {reason: input})
          .then(function () {
            swal('申请退货成功', '', 'success').then(function () {
              location.reload();
            });
          });
      });
    });

  });
</script>
@endsection
