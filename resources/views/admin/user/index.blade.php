@extends('admin.layouts._layout')

@section('title', 'Quản lý người dùng')


@section('content')
    <div style="display: none;">{{ $dem = 1 }}</div>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Manage User's account</h1>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif

                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            User registered in the system
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Account</th>
                                            <th>Informatin User</th>
                                            <th>Point Rewards</th>
                                            <th>Membership</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($query as $item)
                                            <tr>
                                                <td>{{ $dem }}</td>
                                                <td>{{ $item->Account }}</td>
                                                <td>
                                                    <p>Fullname: <strong>{{ $item->Fullname }}</strong></p>
                                                    <p>Address: <strong>{{ $item->Address }}</strong></p>
                                                    <p>Phone number: <strong>{{ $item->Phone }}</strong></p>
                                                    <p>Gender: <strong>{{ $item->Sex }}</strong></p>
                                                    <p>Birthday:
                                                        <strong>{{ Carbon\Carbon::parse($item->BirthDay)->format('d/m/Y') }}</strong>
                                                    </p>
                                                </td>
                                                {{-- @if (count($member) > 0)
                                                @foreach ($member as $jtem)
                                                    @if ($jtem->User_ID == $item->ID)
                                                         <td>{{ $jtem->Point }}</td>
                                                         <td>{{ $jtem->Name }}</td>
                                                    @endif
                                                @endforeach
                                            @else
                                                <td>Chưa cập nhật</td>
                                                <td>Chưa cập nhật</td>
                                            @endif --}}

                                                <td>
                                                    @if (count($member) > 0)
                                                        @foreach ($member as $jtem)
                                                            @if ($jtem->User_ID == $item->ID)
                                                                {{ $jtem->Point }}
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </td>

                                                <td>
                                                    @if (count($member) > 0)
                                                        @foreach ($member as $jtem)
                                                            @if ($jtem->User_ID == $item->ID)
                                                                {{ $jtem->Name }}
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($item->Status != true)
                                                        <button class="btn btn-secondary btnStatus"
                                                            data-id="{{ $item->ID }}"
                                                            title="Khóa tài khoản">Locked</button>
                                                    @else
                                                        <button class="btn btn-info btnStatus"
                                                            data-id="{{ $item->ID }}"
                                                            title="Kích hoạt tài khoản">Unlocked</button>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="/Admin/User/Delete/{{ $item->ID }}"
                                                        class="btn btn-danger btnDelete"> <i class="fa fa-remove"></i></a>
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


@endsection


@section('jsAdmin'){

    <script type="text/javascript">
        $(function() {
            //nếu không có thao tác gì thì ẩn đi
            $('#AlertBox').removeClass('hide');

            //Sau khi hiển thị lên thì delay 1s và cuộn lên trên sử dụng slideup
            $('#AlertBox').delay(2000).slideUp(500);



            $('.btnStatus').off('click').on('click', function() {

                $.ajax({
                    data: {},
                    url: '/Admin/User/changeStatus/' + $(this).data('id'),
                    dataType: 'Json',
                    type: 'GET',
                    success: function() {
                        window.location.href = "/Admin/User";
                        PNotify.success({
                            title: 'Messages!!',
                            text: 'Status update successful.'
                        });
                    }
                });

            });

            $('.btnDelete').on('click', function(event) {
                event.preventDefault();
                const url = $(this).attr('href');
                swal({
                    title: 'Are you sure?',
                    text: 'This record and it`s details will be permanantly deleted!',
                    icon: 'warning',
                    buttons: ["Cancel", "Yes!"],
                }).then(function(value) {
                    if (value) {
                        window.location.href = url;
                    }
                });
            });
        });
    </script>
@endsection
