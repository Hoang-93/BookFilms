@extends('admin.layouts._layout')

@section('title', 'Quản lý feedback')


@section('content')
<div style="display: none;">{{ $dem = 1 }}</div>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Quản lý phản hồi khách hàng</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            @if (Session::get('message') != null)
                <div class="alert alert-success text-center" id="AlertBox">
                    {{ Session::get('message') }}
                </div>
            @endif
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Danh sách phản hồi
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Họ tên KH</th>
                                        <th>Nội dung phản hồi</th>
                                        <th>Điểm đánh giá</th>
                                        <th>Thời gian</th>
                                        <th>Phim đánh giá</th>
                                        <th>Trạng thái</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($query as $item)
                                        <tr>
                                            <td>{{ $dem }}</td>
                                            <td>{{ $item->Fullname }}</td>
                                            <td>{{ $item->Content }}</td>
                                            <td>{{ $item->Rate }}</td>
                                            <td>{{ Carbon\Carbon::parse($item->CreatedDate)->format('h:i A d-m-Y') }}</td>
                                            <td>{{ $item->Name }}</td>
                                            @if ($item->Status != true)
                                                 <td>
                                                    <button class="btn btn-secondary btnStatus" data-id="{{ $item->ID }}" title="Hiện đánh giá">Đã ẩn</button>
                                                </td>
                                            @else
                                                <td>
                                                    <button class="btn btn-info btnStatus" data-id="{{ $item->ID }}" title="ẩn đánh giá">Đang hiện</button>
                                                </td>
                                            @endif
                                           
                                            <td>
                                                <a href="/Admin/Feedback/Detail/{{ $item->ID }}" class="btn btn-default" title="Xem phản hồi đánh giá"><i class="fa fa-ticket"></i>Xem phản hồi</a>
                                            </td>
                                        </tr>
                                        <div style="display: none;">{{ $dem++ }}</div>
                                    @endforeach    

                                </tbody>
                            </table>
                            Trang {{ $query->currentPage() }} / {{ $query->lastPage() }}
                            {{ $query->links() }}
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>

        </div>

    </div>
    <!-- /.container-fluid -->
</div>


@endsection


@section('jsAdmin'){

    <script type="text/javascript">
        $(function () {
            //nếu không có thao tác gì thì ẩn đi
            $('#AlertBox').removeClass('hide');

            //Sau khi hiển thị lên thì delay 1s và cuộn lên trên sử dụng slideup
            $('#AlertBox').delay(2000).slideUp(500);


            $('.btnStatus').off('click').on('click', function () {

                $.ajax({
                    data: {},
                    url: '/Admin/Feedback/changeStatus/' + $(this).data('id'),
                    dataType: 'Json',
                    type: 'GET',
                    success: function () {
                            window.location.href = "/Admin/Feedback";
                            PNotify.success({
                                title: 'THÔNG BÁO!!',
                                text: 'Cập nhật trạng thái thành công.'
                            });
                    }
                });

            });
        });
    </script>
@endsection