@extends('layouts._layout')

@section('title', 'Chi tiết vé')

@section('content')

        <section class="container">
            <div class="col-sm-8 col-md-9" style="margin-top: 50px;">
                <div class="movie">
                    <h2 class="page-heading">Detail ticket</h2>

                    <div class="movie__info">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <p>Customer: <strong>{{ $ticket->Fullname }}</strong></p>
                                    <p>Movie: <strong>{{ $ticket->Name }}</strong></p>
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Number Seat</th>
                                                    <th>Food and Drinks</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $ticket->Sit }}</td>
                                                    <td>
                                                        @foreach($food_drink as $item)
                                                        {{ $item->Name }} x {{ $item->Quantity }} ,
                                                        @endforeach
                                                    </td>
                                                    <td>{{ number_format($ticket->TotalPrice) }} ₫</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <aside class="col-sm-4 col-md-3">
                <div class="sitebar">
                    <div class="banner-wrap">
                        <img alt='banner' style="width: 249px; height: 249px" src="{{asset('assets/images/cinema/action.jpg')}}">
                    </div>

                     <div class="banner-wrap">
                        <img alt='banner' style="width: 249px; height: 249px" src="{{asset('assets/images/cinema/141858.jpg')}}">
                    </div>

                     <div class="banner-wrap banner-wrap--last">
                        <img alt='banner' style="width: 249px; height: 249px" src="{{asset('assets/images/cinema/bg2.jpg')}}">
                    </div>

                    <div class="promo marginb-sm">
                      <div class="promo__head">A.Movie app</div>
                      <div class="promo__describe">for all smartphones<br> and tablets</div>
                      <div class="promo__content">
                          <ul>
                              <li class="store-variant"><a href="#"><img alt='' src="{{asset('assets/images/apple-store.svg')}}"></a></li>
                              <li class="store-variant"><a href="#"><img alt='' src="{{asset('assets/images/google-play.svg')}}"></a></li>
                              <li class="store-variant"><a href="#"><img alt='' src="{{asset('assets/images/windows-store.svg')}}"></a></li>
                          </ul>
                      </div>
                  </div>

                    <div class="category category--discuss category--count marginb-sm mobile-category ls-cat">
                        <h3 class="category__title">Đang công chiếu <br><span class="title-edition">tại rạp</span></h3>
                        <ol>
                            @foreach($MoviePlay as $item)
                                <div style="display: none;">{{ $url = '/phim/' . $item->Metatitle . "/" . $item->ID }}</div>
                                <li><a href="{{ $url }}" class="category__item">{{ $item->Name }}</a></li>
                            @endforeach
                        </ol>
                    </div>

                    <div class="category category--cooming category--count marginb-sm mobile-category rs-cat">
                        <h3 class="category__title">Chuẩn bị chiếu<br><span class="title-edition">movies</span></h3>
                        <ol>
                            @foreach($ComingMovie as $item)
                                <div style="display: none;">{{ $url = '/phim/' . $item->Metatitle . "/" . $item->ID }}</div>
                                <li><a href="{{ $url }}" class="category__item">{{ $item->Name }}</a></li>
                            @endforeach
                        </ol>
                    </div>



                </div>
            </aside>

        </section>

@endsection

@section('jsSection')
    <script>
        $(document).ready(function () {
            $('.btnCancer').off('click').on('click', function () {

                $.ajax({
                    data: {},
                    url: '/Admin/Ticket/changeStatus/' + $(this).data('id'),
                    dataType: 'Json',
                    type: 'GET',
                    success: function () {
                            window.location.href = "/lich-su-dat-ve.html";
                            PNotify.success({
                                title: 'Messages!!',
                                text: 'Update status successfully..'
                            });
                    }
                });

            });
        });
    </script>
@endsection
