@extends('layouts._layout')

@section('title', 'Đặt vé - chỗ ngồi')

@section('content')

    <div class="place-form-area">
        <section class="container">
            <div class="order-container">
                <div class="order">
                    <img class="order__images" alt='' src="{{ asset('assets/images/tickets.png') }}">
                    <p class="order__title">
                        {{ $film->Name }}
                        <br>
                        <span style="font-size: 17px;">Directors: </span><span
                            class="order__descript">{{ $film->Director }}</span>
                        <br>
                        <span style="font-size: 17px;">Actors: </span><span
                            class="order__descript">{{ $film->Actor }}</span>
                    </p>
                </div>
            </div>
            <div class="order-step-area">
                <div class="order-step first--step order-step--disable ">1. Choose date &amp; Hours</div>
                <div class="order-step second--step">2. Sitting position &amp; snacks and drinks</div>
            </div>

            <div class="choose-sits">
                <div class="choose-sits__info choose-sits__info--first">
                    <ul>
                        <li class="sits-price marker--none"><strong>Price for each type of chair (VND/seat)</strong></li>
                        <li class="sits-price sits-price--cheap">{{ $priceSit[3] }}k</li>
                        <li class="sits-price sits-price--middle">{{ $priceSit[2] }}k</li>
                        <li class="sits-price sits-price--expensive">{{ $priceSit[1] }}k</li>
                    </ul>
                </div>

                <div class="choose-sits__info">
                    <ul>
                        <li class="sits-state sits-state--not">Seats booked</li>
                        <li class="sits-state sits-state--your">You are choosing</li>
                    </ul>
                </div>

                <div class="col-sm-12 col-lg-10 col-lg-offset-1">
                    <div class="sits-area hidden-xs">
                        <div class="sits-anchor">Projection screen</div>

                        <div class="sits">
                            <aside class="sits__line">
                                <div style="display: none;">{{ $sumRow = 0 }}</div>
                                <div style="display: none;">{{ $sumColumn = 0 }}</div>
                                @foreach ($room as $item)
                                    <div style="display: none;">{{ $sumRow += $item->Row }}</div>
                                    <div style="display: none;">{{ $sumColumn = $item->Column }}</div>
                                @endforeach
                                @for ($i = 1; $i <= $sumRow; $i++)
                                    <span class="sits__indecator">{{ $CharRow[$i] }}</span>
                                @endfor
                            </aside>

                            <div style="display: none;">{{ $i = 0 }}</div>
                            <div style="display: none;">{{ $k = 0 }}</div>
                            <div style="display: none;">{{ $m = 0 }}</div>
                            @foreach ($room as $item)
                                @if ($item->Level == 3)
                                    {{-- start cheap --}}
                                    @for ($i = 1; $i <= $item->Row; $i++)
                                        <div class="sits__row">
                                            @for ($j = 1; $j <= $item->Column; $j++)
                                                @if (in_array($CharRow[$i] . $j, $arr_sit))
                                                    <span class="sits__place sits-price--cheap sits-state--not"
                                                        data-place="{{ $CharRow[$i] . $j }}"
                                                        data-price='{{ $item->Price }}'>{{ $CharRow[$i] . $j }}</span>
                                                @else
                                                    <span class="sits__place sits-price--cheap"
                                                        data-place="{{ $CharRow[$i] . $j }}"
                                                        data-price='{{ $item->Price }}'>{{ $CharRow[$i] . $j }}</span>
                                                @endif

                                            @endfor

                                        </div>
                                    @endfor
                                @endif
                            @endforeach

                            @foreach ($room as $item)
                                @if ($item->Level == 2)
                                    {{-- start middle --}}
                                    @for ($k = 1; $k <= $item->Row; $k++)
                                        <div class="sits__row">
                                            @for ($j = 1; $j <= $item->Column; $j++)
                                                @if (in_array($CharRow[$i + $k - 1] . $j, $arr_sit))
                                                    <span class="sits__place sits-price--middle sits-state--not"
                                                        data-place="{{ $CharRow[$i + $k - 1] . $j }}"
                                                        data-price='{{ $item->Price }}'>{{ $CharRow[$i + $k - 1] . $j }}</span>
                                                @else
                                                    <span class="sits__place sits-price--middle"
                                                        data-place="{{ $CharRow[$i + $k - 1] . $j }}"
                                                        data-price='{{ $item->Price }}'>{{ $CharRow[$i + $k - 1] . $j }}</span>
                                                @endif

                                            @endfor

                                        </div>
                                    @endfor
                                @endif
                            @endforeach

                            @foreach ($room as $item)
                                @if ($item->Level == 1)
                                    {{-- start expensive --}}
                                    @for ($m = 1; $m <= $item->Row; $m++)
                                        <div class="sits__row">
                                            @for ($j = 1; $j <= $item->Column; $j++)
                                                @if (in_array($CharRow[$i + $k + $m - 1] . $j, $arr_sit))
                                                    <span class="sits__place sits-price--expensive sits-state--not"
                                                        data-place="{{ $CharRow[$i + $k + $m - 1] . $j }}"
                                                        data-price='{{ $item->Price }}'>{{ $CharRow[$i + $k + $m - 1] . $j }}</span>
                                                @else
                                                    <span class="sits__place sits-price--expensive"
                                                        data-place="{{ $CharRow[$i + $k + $m - 1] . $j }}"
                                                        data-price='{{ $item->Price }}'>{{ $CharRow[$i + $k + $m - 1] . $j }}</span>
                                                @endif

                                            @endfor

                                        </div>
                                    @endfor
                                @endif
                            @endforeach

                            <aside class="sits__checked" style="width: 70px;">
                                <div class="checked-place">

                                </div>
                                <div class="checked-result">
                                    0đ
                                </div>
                            </aside>
                            <footer class="sits__number">
                                @for ($i = 1; $i <= $sumColumn; $i++)
                                    <span class="sits__indecator">{{ $i }}</span>
                                @endfor
                            </footer>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 visible-xs">
                    <div class="sits-area--mobile">
                        <div class="sits-area--mobile-wrap">
                            <div class="sits-select">
                                <select name="sorting_item" class="sits__sort sit-row" tabindex="0">
                                    <option value="1" selected='selected'>A</option>
                                    <option value="2">B</option>
                                    <option value="3">C</option>
                                    <option value="4">D</option>
                                    <option value="5">E</option>
                                    <option value="6">F</option>
                                    <option value="7">G</option>
                                    <option value="8">I</option>
                                    <option value="9">J</option>
                                    <option value="10">K</option>
                                    <option value="11">L</option>
                                </select>

                                <select name="sorting_item" class="sits__sort sit-number" tabindex="1">
                                    <option value="1" selected='selected'>1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                </select>

                                <a href="#" class="btn btn-md btn--warning toogle-sits">Choose sit</a>
                            </div>
                        </div>

                        <a href="#" class="watchlist add-sits-line">Add new sit</a>

                        <aside class="sits__checked">
                            <div class="checked-place">
                                <span class="choosen-place"></span>
                            </div>
                            <div class="checked-result">
                                $0
                            </div>
                        </aside>

                        <img alt="" src="{{ asset('assets/images/components/sits_mobile.png') }}">
                    </div>
                </div>

            </div>

    </div>
    </section>
    </div>

    <div class="clearfix"></div>


    <section class="container">
        <h2 class="page-heading heading--outcontainer">Snacks & Beverages</h2>

        <form id='film-and-time' class="booking-form" method='post' action='/book/checkout'>
            {{ csrf_field() }}

            @foreach ($lstFoodDrink as $item)
                <div class="col-lg-5" style="margin-left: 60px">
                    <!-- Movie preview item -->
                    <div class="movie movie--preview release">
                        <div class="col-sm-5 col-md-3   ">
                            <div class="movie__images">
                                <img alt='' src="{{ asset('assets/images/cinema/' . $item->Image) }}">
                            </div>
                        </div>
    
                        <div class="col-sm-7 col-md-9">
                            <a href='' class="movie__title link--huge">{{ $item->Name }}</a>
                            {!! $item->Description !!}
                            <p class="movie__option">Giá: <strong> {{ number_format($item->Price) }}</strong> ₫</p>
                            <p>
                                <button type="button" class="btn btn-secondary btnDown"
                                    data-id="{{ $item->ID }}">-</button>
                                <input type="number" name="Quantity[]" id="Quantity_{{ $item->ID }}" min=0 value="0"
                                    class="search__field text-center" style="width: 20%; display: initial;">
                                <button type="button" class="btn btn-secondary btnUp"
                                    data-id="{{ $item->ID }}">+</button>
                            </p>
    
                        </div>
                        <input type="hidden" name="BookFood_ID[]" value="{{ $item->ID }}">
                    </div>
                    <!-- end movie preview item -->
                </div>
          
            @endforeach

            <input type='text' name='Film_ID' value="{{ $film->ID }}">
            <input type='text' name='CountTicket' class="choosen-number">
            <input type='text' name='Type-cheap' class="choosen-number--cheap">
            <input type='text' name='Type-middle' class="choosen-number--middle">
            <input type='text' name='Type-expansive' class="choosen-number--expansive">
            <input type='text' name='TotalMoney' class="choosen-cost">
            <input type='text' name='Sits' class="choosen-sits">
            <input type='text' name='Sit-cheap' class="sits-cheap">
            <input type='text' name='Sit-middle' class="sits-middle">
            <input type='text' name='Sit-expansive' class="sits-expansive">


            <div class="container booking-pagination booking-pagination--margin">
                <a href="/book/date-&-time/{{ $film->ID }}" class="booking-pagination__prev">
                    <span class="arrow__text arrow--prev">BACK</span>
                    <span class="arrow__info">Choose Date &amp; Hours</span>
                </a>
                <button type="submit" class="booking-pagination__next">
                    <span class="arrow__text arrow--next">Next</span>
                    <span class="arrow__info">Payment</span>
                </button>
            </div>
        </form>
    </section>

    <section class="container">

    </section>

@endsection

@section('jsSection')
    <script>
        $(function() {
            var numberTicket = $('.choosen-number'), //Tổng số vé
                sumTicket = $('.choosen-cost'), //Tổng tiền vé
                cheapTicket = $('.choosen-number--cheap'), //Số vé hạng 3
                middleTicket = $('.choosen-number--middle'), //Số vé hạng 2
                expansiveTicket = $('.choosen-number--expansive'), //Số vé hạng 1
                sits = $('.choosen-sits'), //Chỗ ngồi cụ thể
                sitsCheap = "", //Danh sách chỗ ngồi hạng 3
                sitsMiddle = "", //Danh sách chỗ ngồi hạng 2
                sitsExpansive = ""; //Danh sách chỗ ngồi hạng 1

            var sum = 0;
            var dem = 0;
            var cheap = 0;
            var middle = 0;
            var expansive = 0;

            $('.sits__place').click(function(e) {
                e.preventDefault();
                var place = $(this).attr('data-place');
                var ticketPrice = $(this).attr('data-price');

                if (!$(e.target).hasClass('sits-state--your')) {

                    if (!$(this).hasClass('sits-state--not')) {
                        $(this).addClass('sits-state--your');

                        $('.checked-place').prepend('<span class="choosen-place ' + place + '">' + place +
                            '</span>');

                        switch (ticketPrice) {
                            case '{{ $priceSit[3] }}':
                                sum += {{ $priceSit[3] * 1000 }};
                                dem++;
                                cheap += 1;
                                sitsCheap += place + ", ";
                                break;
                            case '{{ $priceSit[2] }}':
                                sum += {{ $priceSit[2] * 1000 }};
                                dem++;
                                middle += 1;
                                sitsMiddle += place + ", ";
                                break;
                            case '{{ $priceSit[1] }}':
                                sum += {{ $priceSit[1] * 1000 }};
                                dem++;
                                expansive += 1;
                                sitsExpansive += place + ", ";
                                break;
                        }

                        $('.checked-result').text(sum + ' đ');
                    }
                } else {
                    $(this).removeClass('sits-state--your');

                    $('.' + place + '').remove();
                    console.log("place => " + place);
                    switch (ticketPrice) {
                        case '{{ $priceSit[3] }}':
                            sum -= {{ $priceSit[3] * 1000 }};
                            dem--;
                            cheap -= 1;
                            sitsCheap = sitsCheap.replace('' + place + ',', '');
                            break;
                        case '{{ $priceSit[2] }}':
                            sum -= {{ $priceSit[2] * 1000 }};
                            dem--;
                            middle -= 1;
                            sitsMiddle = sitsMiddle.replace('' + place + ',', '');
                            break;
                        case '{{ $priceSit[1] }}':
                            sum -= {{ $priceSit[1] * 1000 }};
                            dem--;
                            expansive -= 1;
                            sitsExpansive = sitsExpansive.replace('' + place + ',', '');
                            break;
                    }

                    $('.checked-result').text(sum + ' đ')
                }

                //data element init
                var number = $('.checked-place').children().length;

                //data element set 
                numberTicket.val(dem);
                sumTicket.val(sum);
                cheapTicket.val(cheap);
                middleTicket.val(middle);
                expansiveTicket.val(expansive);

                $('.sits-cheap').val(sitsCheap); //Danh sách chỗ ngồi hạng 3
                $('.sits-middle').val(sitsMiddle); //Danh sách chỗ ngồi hạng 2
                $('.sits-expansive').val(sitsExpansive); //Danh sách chỗ ngồi hạng 1

                console.log('sitsCheap: ' + sitsCheap);
                console.log('sitsMiddle: ' + sitsMiddle);
                console.log('sitsExpansive: ' + sitsExpansive);
                console.log('numberTicket: ' + dem);
                console.log('sumTicket: ' + sum);
                console.log('cheapTicket: ' + cheap);
                console.log('middleTicket: ' + middle);
                console.log('expansiveTicket: ' + expansive);
                //data element init
                var chooseSits = '';
                $('.choosen-place').each(function() {
                    chooseSits += ', ' + $(this).text();
                });

                //data element set 
                sits.val(sitsCheap + sitsMiddle + sitsExpansive);
                console.log('Sits: ' + sits.val());
            });


            $('.btnDown').click(function() {
                var id = $(this).data('id');
                var quantity = $('#Quantity_' + id).val();
                if (quantity == 0)
                    return;
                else {
                    $('#Quantity_' + id).val(parseInt(quantity) - 1);
                }
            });

            $('.btnUp').click(function() {
                var id = $(this).data('id');
                var quantity = $('#Quantity_' + id).val();
                $('#Quantity_' + id).val(parseInt(quantity) + 1);
            });

            $('button[type="submit"]').click(function() {

                if (sits.val() == '') {
                    alert('Bạn vui lòng chọn vị trí ghế ngồi!!')
                    return false;
                }

            });
        });
    </script>
@endsection
