@extends('admin.layouts._layout')

@section('title', 'Phản hồi đánh giá')


@section('content')
<div style="display: none;">{{ $dem = 1 }}</div>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Các phản hồi đánh giá</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p>Khách hàng: <strong>{{ $comment->Fullname }}</strong></p>
                        <p>Tên phim: <strong>{{ $comment->Name }}</strong></p>
                        <p>Ngày đánh giá: <strong>{{ Carbon\Carbon::parse($comment->CreatedDate)->format('h:i A d-m-Y') }}</strong></p>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Họ tên KH</th>
                                        <th class="text-center">Nội dung</th>
                                        <th>Thời gian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reply as $item)
                                        <tr>
                                            <td>{{ $dem }}</td>
                                            <td>{{ $item->Fullname }}</td>
                                            <td>{{ $item->Content }}</td>
                                            <td>{{ Carbon\Carbon::parse($item->CreatedDate)->format('h:i A d-m-Y') }}</td>
                                        </tr>
                                        <div style="display: none;">{{ $dem++ }}</div>
                                    @endforeach
                                </tbody>
                            </table>
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
           
        });
    </script>
@endsection