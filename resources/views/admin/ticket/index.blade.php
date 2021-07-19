@extends('admin.layouts._layout')

@section('title', 'Ticket Management')


@section('content')
<div style="display: none;">{{ $dem = 1 }}</div>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Manage pre-booked tickets</h1>
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
                        Ticket List
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer's full name</th>
                                        <th>Cinema ticket</th>
                                        <th>Seats</th>
                                        <th>Watch time</th>
                                        <th>Booking date</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($query as $item)
                                        <tr>
                                            <td>{{ $dem }}</td>
                                            <td>{{ $item->Fullname }}</td>
                                            <td>{{ $item->Name }}</td>
                                            <td>{{ $item->CountTicket }}</td>
                                            <td>{{ Carbon\Carbon::parse($item->Date)->format('d-m-Y') }} , {{ Carbon\Carbon::parse($item->Time)->format('H:i .A') }}</td>
                                            <td>{{ Carbon\Carbon::parse($item->CreatedDate)->format('d-m-Y') }}</td>
                                            
                                            @if ($item->Status == true)
                                                <td>
                                                    <span class="label label-info">Paid</span>
                                                </td>
                                            @else
                                                <td>
                                                    <span class="label label-default">Expiration / Cancellation</span>
                                                </td>
                                            @endif
                                           
                                            <td>
                                                <a href="/Admin/Ticket/Detail/{{ $item->ID }}" class="btn btn-default" title="Chi tiết vé"><i class="fa fa-ticket"></i>See details</a>
                                                <button class="btn btn-danger btnDelete" data-id="{{ $item->ID }}" title="Xóa vé"><i class="fa fa-remove"></i></button>
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


            $('.btnDelete').off('click').on('click', function () {
                const notice = PNotify.notice({
                    title: 'Notification',
                    text: 'To perform the function you have to delete its associated data?',
                    icon: 'fa fa-question-circle',
                    width: '360px',
                    minHeight: '110px',
                    hide: false,
                    closer: false,
                    sticker: false,
                    destroy: true,
                    stack: new PNotify.Stack({
                        dir1: 'down',
                        modal: true,
                        firstpos1: 25,
                        overlayClose: false
                    }),
                    modules: new Map([
                        ...PNotify.defaultModules,
                        [PNotifyConfirm, {
                            confirm: true
                        }]
                    ])
                });

                notice.on('pnotify:confirm', () =>
                    $.ajax({
                        data: {},
                        url: '/Admin/Ticket/Delete/' + $(this).data('id'),
                        dataType: 'Json',
                        type: 'GET',
                        success: function () {
                                window.location.href = "/Admin/Ticket";
                                PNotify.success({
                                    title: 'THÔNG BÁO!!',
                                    text: 'Xóa vé thành công.'
                                });
                           
                        }
                    })

                );


            });

            $('.btnStatus').off('click').on('click', function () {

                $.ajax({
                    data: {},
                    url: '/Admin/Ticket/changeStatus/' + $(this).data('id'),
                    dataType: 'Json',
                    type: 'GET',
                    success: function () {
                            window.location.href = "/Admin/Ticket";
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