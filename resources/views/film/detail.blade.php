@extends('layouts._layout')

@section('title', $film->Name)

@section('content')

        <section class="container">
            <div class="col-sm-8 col-md-9" style="margin-top: 50px;">
                <div class="movie">
                    <h2 class="page-heading">{{ $film->Name }}</h2>
                    
                    <div class="movie__info">
                        <div class="col-sm-6 col-md-4 movie-mobile">
                            <div class="movie__images">
                                <span class="movie__rating">{{ $film->Vote }}</span>
                                <img alt='' src="{{ asset('assets/images/film/'. $film->Image) }}" style="width: 526px">
                            </div>
                            {{-- <div class="movie__rate">Your vote: <div id='score' class="score"></div></div> --}}
                        </div>

                        <div class="col-sm-6 col-md-8">
                            <p class="movie__time">{{ $film->Time }}</p>

                            <p class="movie__option"><strong>Country: </strong><a href="#">{{ $film->Country }}</a></p>
                            <p class="movie__option"><strong>Year: </strong><a href="#">{{ Carbon\Carbon::parse($film->ReleaseDate)->format('Y') }}</a></p>
                            <p class="movie__option"><strong>Genre: </strong>
                                @foreach($lstCate as $item)
                                    {{ $item->Name }}
                                @endforeach
                            </p>
                            <p class="movie__option"><strong>Release Date: </strong>{{ Carbon\Carbon::parse($film->ReleaseDate)->format('d/m/Y') }}</p>
                            <p class="movie__option"><strong>Director: </strong><a href="#">{{ $film->Director }}</a></p>
                            <p class="movie__option"><strong>Actor: </strong>{{ $film->Actor }}</p>
                            <p class="movie__option"><strong>Age: </strong>{{ $film->AgeRestriction }}</p>

                            <a href="#" class="comment-link">Rate:  {{ count($lstComment) + count($lstReply) }}</a>

                            @if($film->ReleaseDate < Carbon\Carbon::now('Asia/Ho_Chi_Minh'))
                            <div class="movie__btns">

                                <a href="/book/date-&-time/{{ $film->ID }}" class="btn btn-md btn--warning">Book Ticket</a>
                                {{-- <a href="#" class="watchlist">Add to watchlist</a> --}}
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="clearfix"></div>
                    
                    <h2 class="page-heading">Content</h2>

                    <p class="movie__describe">{{ $film->Description }}</p>

                    <h2 class="page-heading">Trailer</h2>
                    
                    <iframe width="878" height="491" src="{{ $film->Trailer }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                </div>

                <div class="choose-container">

                    <h2 class="page-heading">Rating ({{ count($lstComment) + count($lstReply) }})</h2>

                    <div class="comment-wrapper">
                        @if(Session::get('user') != null)
                        <form id="comment-form" class="comment-form" method='get'>
                            <div class="col-sm-4">
                                <label style="margin-top: 3px;">Rate Point</label>
                            </div>
                            <div class="col-sm-12" style="color: gold;">
                                <input type="hidden" id="point_review" class="rating" data-filled="fa fa-star fa-3x" data-empty="fa fa-star-o fa-3x" data-start="5" data-stop="10" />
                            </div>
                            <div class="col-sm-4">
                                <label style="margin-top: 3px;">Your review</label>
                            </div>
                            <textarea class="comment-form__text" placeholder="Enter your review..." id="text_review" style="color: black" required>
                            </textarea>
                            <button type='button' data-userid="{{ Session::get('user')->ID }}" class="btn btn-md btn--danger comment-form__btn" id="btn-review">
                                Send
                            </button>
                        </form>
                        @endif
                        

                        <div class="comment-sets">

                        @foreach($lstComment as $item)
                            <div class="comment">
                                <div class="comment__images">
                                    <img alt='' src="{{ asset('assets/images/user.ico') }}" style="width: 50px">
                                </div>
                                <a href='#' class="comment__author" style="padding-left: 0px">{{ $item->Fullname }}</a>
                                <a href="">
                                    <div style="color: gold; font-size:5px">
                                        <input type="hidden" value="{{ $item->Rate }}" class="rating" data-filled="fa fa-star fa-3x" data-empty="fa fa-star-o fa-3x" data-start="5" data-stop="10" disabled />
                                    </div>
                                </a>
                                <p class="comment__date">

                                    {{ Carbon\Carbon::parse($item->CreatedDate)->format('d/m/Y') }} | 
                                    {{ Carbon\Carbon::parse($item->CreatedDate)->format('H:i') }}

                                </p>
                                <p class="comment__message">{{ $item->Content }}</p>
                                @if(Session::get('user') != null)
                                    <a href='#' class="comment__reply" data-userid="{{ Session::get('user')->ID }}" data-cmtid="{{ $item->ID }}">Reply</a>
                                @endif
                                
                            </div>
                            @foreach($lstReply as $jtem)
                                @if($item->ID == $jtem->Comment_ID)
                                <div class="comment comment--answer">
                                    <div class="comment__images">
                                        <img alt='' src="{{ asset('assets/images/user.ico') }}" style="width: 50px">
                                    </div>

                                    <a href='#' class="comment__author" style="padding-left: 0px">{{ $jtem->Fullname }}</a>
                                    <p class="comment__date">
                                        {{ Carbon\Carbon::parse($jtem->CreatedDate)->format('d/m/Y') }} | 
                                        {{ Carbon\Carbon::parse($jtem->CreatedDate)->format('H:i') }}
                                    </p>
                                    <p class="comment__message">{{ $jtem->Content }}</p>
                                    @if(Session::get('user') != null)
                                        <a href='#' class="comment__reply" data-userid="{{ Session::get('user')->ID }}" data-cmtid="{{ $item->ID }}">Reply</a>
                                    @endif
                                </div>
                                @endif
                            @endforeach
                        @endforeach
                       

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
                      <div class="promo__head">Xstar-Cineplex app</div>
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
                        <h3 class="category__title">Now Showing <br><span class="title-edition">At The Cinema</span></h3>
                        <ol>
                            @foreach($MoviePlay as $item)
                                <div style="display: none;">{{ $url = '/phim/' . $item->Metatitle . "/" . $item->ID }}</div>
                                <li><a href="{{ $url }}" class="category__item">{{ $item->Name }}</a></li>
                            @endforeach
                        </ol>
                    </div>

                    <div class="category category--cooming category--count marginb-sm mobile-category rs-cat">
                        <h3 class="category__title">Comming Soon<br><span class="title-edition">X-Star</span></h3>
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
    <script src="{{ asset('assets/js/rating.js')}}"></script>
    <script>
        $('.rating').on('change', function () {
            // $(this).next('.label').text($(this).val());
            // alert($(this).val());
            $('#point_review').val($(this).val());
        });

        $(document).ready(function () {
            $("#btn-review").click(function () {
                var user_id = $(this).data('userid');
                var film_id = {{$film->ID}};
                var content = $('#text_review').val();
                var rate = $('#point_review').val();

                var json_review = [];
                json_review.push({
                    Content: content,
                    Rate: rate,
                    User_ID: user_id,
                    Film_ID: film_id
                });

                console.log(json_review);
                var token = $("meta[name='csrf-token']").attr("content");
                $.ajax({
                    url: '/phim/add-comment/' + user_id + '/' + film_id + '/' + content + '/' + rate,
                    data: {},
                    type: 'GET',
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function () {
                        window.location.href = "/phim/" + '{{ $film->Metatitle }}' + "/" + film_id;
                        PNotify.success({
                            title: 'NOTIFICATION!!',
                            text: 'Successful'
                        });
                    }
                });
            });


            $('.comment__reply').click( function (e) {
                e.preventDefault();
                var cmt_id = $(this).data('cmtid');
                var userid = $(this).data('userid');
                var filmid = {{ $film->ID }};
                $('.comment').find('.comment-form').remove();
                var reply = 
                "<form class='comment-form' action='/phim/reply' method='Post'>" +
                    "<input type='hidden' name='_token' value='{{ csrf_token() }}' />"+
                    "<input type='hidden' name='User_ID' value='"+ userid +"'/>" +
                    "<input type='hidden' name='Comment_ID' value='"+ cmt_id +"'/>" +
                    "<input type='hidden' name='Film_ID' value='"+ filmid +"'/>" +
                    "<textarea class='comment-form__text' name='Content' style='color: black' placeholder='Comment..................' required></textarea>"+
                    "<label class='comment-form__info'>250 characters left</label>"+
                    "<button type='submit' class='btn btn-md btn--danger comment-form__btn'>"+
                        "Reply"+
                    "</button>"+
                "</form>";
                $(this).parent().append(reply);
            });

            
        });
    </script>
@endsection