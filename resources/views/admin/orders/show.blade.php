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
          <!-- 订单发货开始 -->
          <!-- 如果订单未发货，展示发货表单 -->
          @if($order->ship_status === \App\Models\Order::SHIP_STATUS_PENDING)
          <tr>
            <td colspan="4">
              <form action="{{ route('admin.orders.ship', [$order->id]) }}" method="post" class="form-inline">
                <!-- 别忘了 csrf token 字段 -->
                {{ csrf_field() }}
                <button type="submit" class="btn btn-success" id="ship-btn">发货</button>
              </form>
            </td>
          </tr>

          @else
          <tr>
            <td colspan="4">
                {{$order->ship_status}}
            </td>
          </tr>
          @endif
          </tbody>
      </table>
    </div>
  </div>
