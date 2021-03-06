<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">需求单流水号：{{ $order->no }}</h3>
      <div class="box-tools">
        <div class="btn-group float-right" style="margin-right: 10px">
          <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-default"><i class="fa fa-list"></i> 列表</a>
        </div>
      </div>
    </div>
    <div class="box-body">
      <table class="table table-bordered">
        <tbody>
        <tr>
          <td>使用人：</td>
          <td>{{ $order->user->name }}</td>
          <td>确认时间：</td>
          <td>{{ $order->confirmed_at->format('Y-m-d H:i:s') }}</td>
        </tr>
        <tr>
          <td>领用信息</td>
          <td colspan="3">{{ $order->address['address'] }} {{ $order->address['user'] }} {{ $order->address['contact_phone'] }}</td>
        </tr>
        <tr>
          <td rowspan="{{ $order->items->count() + 1 }}">耗材列表</td>
          <td>耗材名称</td>
          <td>数量</td>
        </tr>
        @foreach($order->items as $item)
        <tr>
          <td>{{ $item->product->title }} {{ $item->productSku->title }}</td>
          <td>{{ $item->amount }}</td>
        </tr>
        @endforeach

        <tr>
            <td>发货状态：</td>
            <td>{{ \App\Models\Order::$shipStatusMap[$order->ship_status] }}</td>
          </tr>
          @if($order->ship_status === \App\Models\Order::SHIP_STATUS_PENDING)
          @if($order->refund_status !== \App\Models\Order::REFUND_STATUS_SUCCESS)
          <tr>
            <td colspan="4">
              <form action="{{ route('admin.orders.ship', [$order->id]) }}" method="post" class="form-inline">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-success" id="ship-btn">发货</button>
              </form>
            </td>
          </tr>
          @endif
          @else
          <tr>
          </tr>
          @endif
          @if($order->refund_status !== \App\Models\Order::REFUND_STATUS_PENDING)
          <tr>
            <td>退货状态：</td>
            <td colspan="2">{{ \App\Models\Order::$refundStatusMap[$order->refund_status] }}，理由：{{ $order->extra['refund_reason'] }}</td>
            <td>
              @if($order->refund_status === \App\Models\Order::REFUND_STATUS_APPLIED)
              <button class="btn btn-sm btn-success" id="btn-refund-agree">同意</button>
              <button class="btn btn-sm btn-danger" id="btn-refund-disagree">不同意</button>
              @endif
            </td>
          </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      $('#btn-refund-disagree').click(function() {
        swal({
          title: '输入拒绝退货理由',
          input: 'text',
          showCancelButton: true,
          confirmButtonText: "确认",
          cancelButtonText: "取消",
          showLoaderOnConfirm: true,
          preConfirm: function(inputValue) {
            if (!inputValue) {
              swal('理由不能为空', '', 'error')
              return false;
            }
            // Laravel-Admin 没有 axios，使用 jQuery 的 ajax 方法来请求
            return $.ajax({
              url: '{{ route('admin.orders.handle_refund', [$order->id]) }}',
              type: 'POST',
              data: JSON.stringify({   // 将请求变成 JSON 字符串
                agree: false,
                reason: inputValue,
                _token: LA.token,
              }),
              contentType: 'application/json',  // 请求的数据格式为 JSON
            });
          },
          allowOutsideClick: false
        }).then(function (ret) {
          if (ret.dismiss === 'cancel') {
            return;
          }
          swal({
            title: '操作成功',
            type: 'success'
          }).then(function() {
            location.reload();
          });
        });
      });
    $('#btn-refund-agree').click(function() {
      swal({
        title: '确认允许用户退货？',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: "确认",
        cancelButtonText: "取消",
        showLoaderOnConfirm: true,
        preConfirm: function() {
          return $.ajax({
            url: '{{ route('admin.orders.handle_refund', [$order->id]) }}',
            type: 'POST',
            data: JSON.stringify({
              agree: true, // 代表同意退货
              _token: LA.token,
            }),
            contentType: 'application/json',
          });
        },
        allowOutsideClick: false
      }).then(function (ret) {
        if (ret.dismiss === 'cancel') {
          return;
        }
        swal({
          title: '操作成功',
          type: 'success'
        }).then(function() {
          location.reload();
        });
      });
    });

});
</script>
