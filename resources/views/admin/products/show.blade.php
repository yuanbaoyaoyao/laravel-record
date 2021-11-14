<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">耗材名称：{{ $product->title }}</h3>
        <div class="box-tools">
            <div class="btn-group float-right" style="margin-right: 10px">
                <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-default"><i
                        class="fa fa-list"></i> 列表</a>
            </div>
        </div>
    </div>

    <div class="box-header with-border">
        <div class="dropdown">
            <form class="search-form">
                {{csrf_field()}}
                <div class="form-row">
                    <div class="col-md-9">
                        <div class="form-row">
                            <div class="col-auto"><input type="text" class="form-control form-control-sm" name="search"
                                                         placeholder="请输入耗材型号"></div>
                            <div class="col-auto">
                                <button class="btn btn-primary btn-sm">搜索</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="table">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">领用人</th>
                <th scope="col">领用时间</th>
                <th scope="col">领用数量</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $d)
                <tr>
                    <th>{{$d->title}}</th>
                    <th>{{$d->name}}</th>
                    <th>{{$d->confirmed_at}}</th>
                    <th>{{$d->amount}}</th>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="float-right pull-right">{{ $data->appends($filters)->render() }}</div>
    </div>
</div>

<script>
    var filters = {!! json_encode($filters) !!};
    $(document).ready(function () {
        $('.search-form input[name=search]').val(filters.search);
    })
</script>
