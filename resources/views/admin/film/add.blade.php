@extends('admin.layouts._layout')

@section('title', 'Thêm mới phim')


@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Film</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Add Film
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <form action="/Admin/Film/AddFilm" method="Post" enctype="multipart/form-data" id="frmadd">
                                    {{ csrf_field() }}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Film Name</label>
                                            <input type="text" name="Name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Director</label>
                                            <input type="text" name="Director" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Actor</label>
                                            <input type="text" name="Actor" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Time</label>
                                            <input type="text" name="Time" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Release Date</label>
                                            <input type="date" name="ReleaseDate" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <input type="text"  name="Country" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Age Restriction</label>
                                            <input type="number" min="5" name="AgeRestriction" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" name="Image" accept="image/*">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Trailer</label>
                                            <input type="text"  name="Trailer" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="Description" id="Description" class="form-control" rows="3" placeholder="Enter product description, minimum 200 characters"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <button type="reset" class="btn btn-default">Reset</button>
                                        <button type="submit" class="btn btn-primary">Add New</button>
                                    </div>

                                </form>

                            </div>

                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

@endsection


@section('jsAdmin')

 <script>
        $(document).ready(function () {

            // CKEDITOR.replace('Descriptions');

            // add the rule here
            $.validator.addMethod("select_validate", function (value, element, arg) {
                return arg !== value;
            }, "Value must not equal arg.");
            //Khi bàn phím được nhấn và thả ra thì sẽ chạy phương thức này
            $("#frmadd").validate({
                rules: {
                    Name: "required",
                    Director: "required",
                    Actor: "required",
                    Time: "required",
                    Descriptions: {
                        required: true,
                        minlength: 200
                    },
                    Image: "required",
                    ReleaseDate: "required",
                    AgeRestriction: "required",
                    Trailer: "required",
                    Country: "required"
                },
                messages: {
                    Name: "Please Enter Film Name",
                    Director: "Please Enter Film Director",
                    Actor: "Please Enter Actor",
                    Time: "Please Enter Time",
                    Descriptions: {
                        required: "Please Enter Description",
                        minlength: "Description is too short, at least 200 characters"
                    },
                    Image: "You have not selected a movie image",
                    ReleaseDate: "Please enter movie release date",
                    AgeRestriction: "Please enter the appropriate age to watch the movie",
                    Trailer: "Please enter the movie trailer",
                    Country: "Please enter the country of the movie"
                }
            });
        });
    </script>

@endsection