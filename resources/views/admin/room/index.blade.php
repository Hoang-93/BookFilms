@extends('admin.layouts._layout')

@section('title', 'Cinema Room Management')


@section('content')
<div style="display: none;">{{ $dem = 1 }}</div>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Cinema Room Management</h1>
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
        <!-- Modal -->
        <div class="modal fade" id="addForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update ticket price</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/Admin/Room/Update" enctype = "multipart/form-data" method="Post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Price:</label>
                                <input type="number" min="40000" name="TicketPrice" id="TicketPrice" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg">Update</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Ticket price: <strong> {{ number_format($ticket->TicketPrice) }}</strong> ₫/ticket
                        <a href="#" class="btnTicketPrice">
                            Update
                        </a>
                    </div>
                    <div class="panel-heading">
                        Types of seat in the cinema room
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center">Type seat</th>
                                        <th class="text-center">horizontal rows</th>
                                        <th class="text-center">vertical rows</th>
                                        <th class="text-center">Price(₫)</th>
                                        <th class="text-center">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($query as $item)
                                        <tr>
                                            <td class="text-center">{{ $dem }}</td>
                                            <td class="text-center">
                                                Class seats {{ $item->Level }}
                                            </td>
                                            <td class="text-center">
                                                {{ $item->Row }}
                                            </td>
                                            @if($dem == 1)
                                                <td class="text-center" rowspan="3">
                                                    {{ $item->Column }}
                                                </td>
                                            @endif
                                            <td class="text-center">
                                                {{ number_format($item->Price * 1000) }}
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-default btnEdit" data-id="{{ $item->ID }}" title="Cập nhật số ghế"><i class="fa fa-edit"></i></button>
                                            </td>
                                        </tr>
                                        <div style="display: none;">{{ $dem++ }}</div>
                                    @endforeach
                                </tbody>
                            </table>
                            Page {{ $query->currentPage() }} / {{ $query->lastPage() }}
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

<!-- Modal -->
<div class="modal fade editForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Updating the number of class seats<span id="Level"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/Admin/Room/Edit" enctype = "multipart/form-data" method="Post">
                    {{ csrf_field() }}
                    <input type="hidden" name="ID" id="ID" />
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Number of horizontal rows:</label>
                        <input type="number" min="2" name="Row" id="Row" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Number of vertical rows:</label>
                        <input type="number" min="5" name="Column" id="Column" class="form-control" required>
                        <p class="help-block">The number of vertical rows (>5) will be shared for all seats.</p>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Price:</label>
                        <input type="number" min="5000" name="Price" id="Price" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('jsAdmin')

    <script type="text/javascript">
        $(function () {

            //nếu không có thao tác gì thì ẩn đi
            $('#AlertBox').removeClass('hide');

            //Sau khi hiển thị lên thì delay 1s và cuộn lên trên sử dụng slideup
            $('#AlertBox').delay(2000).slideUp(500);


            $('.btnEdit').click(function(event) {
                $('.editForm').modal('show');
                //alert($(this).data('id'));
                var ID = $(this).data('id');
                $.ajax({
                        url: "/Admin/Room/GetRoomDetailByID/" + ID,
                        type: 'GET',
                        dataType: 'json',
                        contentType: "application/json; charset=utf-8",
                        success: function (res) {

                            $('#Level').text(res.room.Level);
                            $('#Row').val(res.room.Row);
                            $('#Column').val(res.room.Column);
                            $('#Price').val(res.room.Price * 1000);

                            $('#ID').val(res.room.ID);
                        }
                    });
            });

            $('.btnTicketPrice').click(function(event) {
                $('#addForm').modal('show');
                //alert($(this).data('id'));
                var ID = $(this).data('id');
                $.ajax({
                        url: "/Admin/Room/GetPriceTicket",
                        type: 'GET',
                        dataType: 'json',
                        contentType: "application/json; charset=utf-8",
                        success: function (res) {
                            $('#TicketPrice').val(res.ticket.TicketPrice);
                        }
                    });
            });

        });
    </script>

@endsection

