@extends('admin.layouts._layout')

@section('title', 'Snacks & Beverages')


@section('content')
<div style="display: none;">{{ $dem = 1 }}</div>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Snacks & Beverages</h1>
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
                <button class="btn btn-lg btn-primary" data-toggle="modal" data-target="#addProvider">Add New </button>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addProvider" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add new Snacks & Beverages</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/Admin/FoodDrink/AddFoodDrink" enctype = "multipart/form-data" method="Post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Name of food & drink combo:</label>
                                <input type="text" name="Name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Price:</label>
                                <input type="number" min="45000" name="Price" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Image:</label>
                                <input type="file" name="Image" required>
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea name="Description" id="Description" class="form-control" rows="3" placeholder="Nhập mô tả nhà cung cấp" required>
                                </textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg">Add new</button>
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
                        Food & Drink List
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center" width="20%">Name Combo</th>
                                        <th class="text-center">Image</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center" width="40%">Description</th>
                                        <th class="text-center">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($query as $item)
                                        <tr>
                                            <td class="text-center">{{ $dem }}</td>
                                            <td class="text-center">
                                                <img src="{{ asset('assets/images/cinema/'. $item->Image) }}" alt="" width="110px" />
                                            </td>
                                            <td class="text-center">
                                                {{ $item->Name }}
                                            </td>
                                            <td class="text-center">
                                                {{ number_format($item->Price) }}
                                            </td>
                                            <td>
                                                <div style="height: 150px; overflow: hidden;">
                                                    {!!$item->Description!!}
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-default btnEdit" data-id="{{ $item->ID }}" title="Fix food & drink"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-danger btnDelete" data-id="{{ $item->ID }}" title="Fix food & drink"><i class="fa fa-remove"></i></button>
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

<!-- Modal -->
<div class="modal fade editProvider" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Food & Drink</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/Admin/FoodDrink/EditFoodDrink" enctype = "multipart/form-data" method="Post">
                    {{ csrf_field() }}
                    <input type="hidden" name="ID" id="ID" />
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Name of food & drink combo:</label>
                        <input type="text" name="Name" id="Name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Price:</label>
                        <input type="number" min="45000" name="Price" id="Price" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Image:</label>
                        <label for="file-upload" class="custom-file-upload">
                            <i class="fa fa-cloud-upload"></i>
                        </label>
                        <input id="file-upload" name="Image" type="file" style="display:none;" accept="image/*">

                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="Description" id="Edit_Description" class="form-control" rows="3" placeholder="Enter supplier description" required>
                        </textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
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

@section('jsAdmin')

    <script type="text/javascript">
        $(function () {

            CKEDITOR.replace('Description');
            CKEDITOR.replace('Edit_Description');

            $('#file-upload').change(function() {
              var i = $(this).prev('label').clone();
              var file = '<i class="fa fa-cloud-upload"></i>' + $('#file-upload')[0].files[0].name;
              $(this).prev('label').empty();
              $(this).prev('label').append(file);
            });
            //nếu không có thao tác gì thì ẩn đi
            $('#AlertBox').removeClass('hide');

            //Sau khi hiển thị lên thì delay 1s và cuộn lên trên sử dụng slideup
            $('#AlertBox').delay(2000).slideUp(500);


            $('.btnDelete').off('click').on('click', function () {

                const notice = PNotify.notice({
                    title: 'Notification',
                    text: 'Do you really want to delete? All related data will be lost!!!',
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
                        url: '/Admin/FoodDrink/Delete/' + $(this).data('id'),
                        dataType: 'Json',
                        type: 'GET',
                        success: function () {
                            PNotify.success({
                                title: 'Notification!!',
                                text: 'Remove food & drink successfully.'
                            });
                            window.location.href = "/Admin/FoodDrink";
                            
                        }
                    })

                );
                //notice.on('pnotify:cancel', () => alert('Oh ok. Chicken, I see.'));




            });

            $('.btnEdit').click(function(event) {
                $('.editProvider').modal('show');
                //alert($(this).data('id'));
                var ID = $(this).data('id');
                $.ajax({
                        url: "/Admin/FoodDrink/GetFoodDrinkByID/" + ID,
                        type: 'GET',
                        dataType: 'json',
                        contentType: "application/json; charset=utf-8",
                        success: function (res) {
                            console.log(res.food_drink.Description)
                            CKEDITOR.instances['Edit_Description'].setData(res.food_drink.Description);
                            //$('#Edit_Description').val(res.Description);
                            $('#Name').val(res.food_drink.Name);
                            $('#Price').val(res.food_drink.Price);

                            var file = '<i class="fa fa-cloud-upload"></i>' + res.food_drink.Image;
                            $('.custom-file-upload').empty();
                            $('.custom-file-upload').append(file);
                            $('#ID').val(res.food_drink.ID);
                        }
                    });
            });

        });
    </script>

@endsection

