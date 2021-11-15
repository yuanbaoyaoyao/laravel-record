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
            <form class="navbar-form navbar-left search-form">
                {{csrf_field()}}
                <div class="form-group">
                    <input type="text" class="form-control form-control-sm" name="search"
                           placeholder="请输入型号或领用人">
                </div>
                <button class="btn btn-primary">搜索</button>
            </form>
        </div>
        <button onclick="exportData()" type="button" class="btn btn-primary navbar-btn pull-right">导出当前页数据</button>
    </div>


    <div class="table">
        <table class="table table-hover " id="table">
            <thead>
            <tr>
                <th scope="col">耗材型号</th>
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

<link href="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/tableExport.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF/jspdf.min.js"></script>
<script
    src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.19.1/dist/extensions/export/bootstrap-table-export.min.js"></script>
<script src="https://cdn.bootcss.com/xlsx/0.14.2/xlsx.core.min.js"></script>


<script>

    var filters = {!! json_encode($filters) !!};
    $(document).ready(function () {
        $('.search-form input[name=search]').val(filters.search);

    })
    //点击"导出Excle"
    let $table = $('#table')
    $(function () {
        $('#table').bootstrapTable('destroy').bootstrapTable({
            type: 'excel',//导出文件类型，[ 'csv', 'txt', 'sql', 'doc', 'excel', 'xlsx', 'pdf']
            exportDataType: "basic",//'basic':当前页的数据, 'all':全部的数据, 'selected':选中的数据
            fileName: '耗材领用信息',//下载文件名称
            onCellHtmlData: function (cell, row, col, data) {//处理导出内容,自定义某一行、某一列、某个单元格的内容
                return data;
            },
        }).trigger('change')
    })

    function exportData() {
        $('#table').tableExport({
            type: 'excel',
            exportDataType: "all",
            // ignoreColumn: [0],//忽略某一列的索引
            fileName: '耗材领用信息',//下载文件名称
            onCellHtmlData: function (cell, row, col, data) {//处理导出内容,自定义某一行、某一列、某个单元格的内容
                return data;
            },
        });
    }

</script>
