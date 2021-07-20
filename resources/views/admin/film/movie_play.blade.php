@extends('admin.layouts._layout')

@section('title', 'Phim đang chiếu')


@section('content')
<div style="display: none;">{{ $dem = 1 }}</div>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Now Showing</h1>
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
        <div class="row">
            @if (Session::get('message') != null)
                <div class="alert alert-success text-center" id="AlertBox">
                    {{ Session::get('message') }}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-4" style="margin-bottom: 10px">
                <a href="/Admin/Film/Add" class="btn btn-lg btn-primary">Add Film</a>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Now Showing
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th style="width: 20%">Film Name</th>
                                        <th>Image</th>
                                        <th class="text-center" style="width: 30%">Film Information</th>
                                        <th class="text-center" style="width: 15%;">Genre</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($query as $item)
                                        <tr id="film-{{$item->ID}}">
                                            <td>{{ $dem }}</td>
                                            <td>{{ $item->Name }}</td>
                                            <td><img src="{{ asset('assets/images/film/'. $item->Image) }}" alt="" width="110px" /></td>
                                            <td>
                                                <p>Directors: <strong>{{ $item->Director }}</strong></p>
                                                <p>Actor: <strong>{{ $item->Actor }}</strong></p>
                                                <p>Time: <strong>{{ $item->Time }}</strong></p>
                                                <p>Release Date: <strong>{{ Carbon\Carbon::parse($item->ReleaseDate)->format('d/m/Y') }}</strong></p>
                                                <p>Country:<strong>{{ $item->Country }}</strong></p>
                                            </td>
                                            <td>
                                                @foreach($cate as $jtem)
                                                    @if($jtem->Film_ID == $item->ID)
                                                        {{ $jtem->Name }} |
                                                    @endif
                                                @endforeach
                                            </td>
                                            @if ($item->Status != true)
                                                 <td>
                                                    <button class="btn btn-primary btnStatus" data-id="{{ $item->ID }}" title="Unactive">Active</button>
                                                </td>
                                            @else
                                                <td>
                                                    <button class="btn btn-info btnStatus" data-id="{{ $item->ID }}" title="Active">Unactive</button>
                                                </td>
                                            @endif
                                            <td>
                                                <button class="btn btn-info btnUpdate" data-id="{{ $item->ID }}" title="Update Genre"><i class="fa fa-file-video-o"></i></button>
                                                <a href="/Admin/Film/Edit/{{ $item->ID }}" class="btn btn-default" title="Edit"><i class="fa fa-edit"></i></a>
                                                <button class="btn btn-danger btnDelete" data-id="{{ $item->ID }}" title="Delete"><i class="fa fa-remove"></i></button>
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

<div class="modal fade editForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Genre: <strong id="FilmName"></strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/Admin/Provider/Edit" enctype = "multipart/form-data" method="Post">
                    {{ csrf_field() }}
                    <input type="hidden" name="Film_ID" id="Film_ID" >
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Choose a movie genre:</label>
                        <select name="Category_ID" id="Category_ID" class="form-control">
                            <option value="">---Choose a movie genre---</option>
                            @foreach($category as $item)
                                <option value="{{ $item->ID }}">{{ $item->Name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" id="CategoryFilm">
                        {{-- <span class="label label-warning" style="font-size: 18px">Hài <i class="fa fa-remove"></i></span>
                        <span class="label label-warning">Chính kịch<i class="fa fa-remove"></i></span> --}}
                        
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@endsection


@section('jsAdmin'){

    <script type="text/javascript">
        $(function () {
            //nếu không có thao tác gì thì ẩn đi
            $('#AlertBox').removeClass('hide');

            //Sau khi hiển thị lên thì delay 1s và cuộn lên trên sử dụng slideup
            $('#AlertBox').delay(2000).slideUp(500);




            $('.btnDelete').on('click', function(event) {
               
                swal({
                    title: 'Are you sure?',
                    text: 'This record and it`s details will be permanantly deleted!',
                    icon: 'warning',
                    buttons: ["Cancel", "Yes!"],
                }).then((value)=> {
                    const filmId = $(this).data('id');
                    if (value) {
                        $.ajax({
                        data: {},
                        url: '/Admin/Film/Delete/' + filmId,
                        dataType: 'Json',
                        type: 'GET',
                        success: function (res) {
                            if (res.success && res.success.length > 0) {
                                $('#film-'+filmId).remove();
                                PNotify.success({
                                    title: 'NOTIFICATION!!',
                                    text: res.success
                                });
                            } else if (res.error) {
                                PNotify.error({
                                    title: 'NOTIFICATION!!',
                                    text: res.error
                                });
                            }
                            // window.location.href = "/Admin/Film/MoviePlay";
                        
                        }
                    })
                    }
                });
            });

            // $('.btnDelete').on('click', function () {
            //     const notice = PNotify.notice({
            //         title: 'Notification',
            //         text: 'Can not deleted?',
            //         icon: 'fa fa-question-circle',
            //         width: '360px',
            //         minHeight: '110px',
            //         hide: false,
            //         closer: false,
            //         sticker: false,
            //         destroy: true,
            //         stack: new PNotify.Stack({
            //             dir1: 'down',
            //             modal: true,
            //             firstpos1: 25,
            //             overlayClose: false
            //         }),
            //         modules: new Map([
            //             ...PNotify.defaultModules,
            //             [PNotifyConfirm, {
            //                 confirm: true
            //             }]
            //         ])
            //     });

            //     notice.on('pnotify:confirm', () =>
                //     $.ajax({
                //         data: {},
                //         url: '/Admin/Film/Delete/' + $(this).data('id'),
                //         dataType: 'Json',
                //         type: 'GET',
                //         success: function (json) {

                //                 window.location.href = "/Admin/Film/MoviePlay";
                //                 PNotify.success({
                //                     title: 'NOTIFICATION!!',
                //                     text: 'Delete Successful.'
                //                 });
                           
                //         }
                //     })

                // );


            // });


            $('.btnUpdate').click(function(event) {
                $('.editForm').modal('show');
                //alert($(this).data('id'));
                var ID = $(this).data('id');
                $('#Film_ID').val(ID);
                $.ajax({
                        url: "/Admin/Film/GetCategoryFilmByID/" + ID,
                        type: 'GET',
                        dataType: 'json',
                        contentType: "application/json; charset=utf-8",
                        success: function (res) {
                            $('#CategoryFilm').empty();
                            html = "";
                            $.each(res.cate, function (i, item) {
                                html += '<span class="label label-warning labelCate" >'+ item.Name +
                                            '<a href="javascript:void(0)" class="btnDel" data-id="'+ item.ID +'">'+
                                                '<i class="fa fa-remove fa_icon" title="xóa"></i>'+
                                            '</a>'+
                                        '</span>';

                                $('option[value="'+ item.Category_ID +'"]').remove();
                                console.log(item.Name);
                            });
                            $('#FilmName').text(res.film.Name);
                            $('#CategoryFilm').append(html);
                        }
                    });
            });

            $('#CategoryFilm').on('click', '.btnDel', function(event) {
                var ID = $(this).data('id');
                $.ajax({
                        url: "/Admin/Film/DeleteCate/" + ID,
                        type: 'GET',
                        dataType: 'json',
                        contentType: "application/json; charset=utf-8",
                        success: function (res) {
                            $('.btnDel').parent().remove();
                            $('#Category_ID').append('<option value="'+ res.cate.ID +'">'+ res.cate.Name +'</option>')
                        }
                    });
            });

            $('#Category_ID').change(function(event) {
                
                var Film_ID = $('#Film_ID').val();
                var Category_ID = $(this).val();
                $.ajax({
                        url: "/Admin/Film/AddCate/" + Film_ID + "/" + Category_ID,
                        type: 'GET',
                        dataType: 'json',
                        contentType: "application/json; charset=utf-8",
                        success: function (res) {
                            html = '<span class="label label-warning labelCate">'+ res.cate.Name +
                                        '<a href="javascript:void(0)" class="btnDel" data-id="'+ res.cate.ID +'">'+
                                            '<i class="fa fa-remove fa_icon" title="xóa"></i>'+
                                        '</a>'+
                                    '</span>'
                            $('#CategoryFilm').append(html);

                            $('option[value="'+ Category_ID +'"]').remove();
                        }
                    });
            });

            $(".editForm").on("hidden.bs.modal", function () {
                window.location.href = "/Admin/Film/MoviePlay";
            });

            $('.btnStatus').off('click').on('click', function () {

                $.ajax({
                    data: {},
                    url: '/Admin/Film/changeStatus/' + $(this).data('id'),
                    dataType: 'Json',
                    type: 'GET',
                    success: function () {
                            window.location.href = "/Admin/Film/MoviePlay";
                            PNotify.success({
                                title: 'NOTIFICATION!!',
                                text: 'Update Succesful'
                            });
                    }
                });

            });
        });
        
    </script>
@endsection