@extends('layouts._layout')

@section('title', 'Đặt vé-ngày & giờ')

@section('content')
    
    <section class="container"  style="margin-top: 90px;">
            <div class="order-container">
                <div class="order">
                    <img class="order__images" alt='' src="{{asset('assets/images/tickets.png')}}">
                    <p class="order__title">
                        {{ $film->Name }}
                        <br>
                        <span style="font-size: 17px;">Directors: </span><span class="order__descript">{{ $film->Director }}</span>
                        <br>
                        <span style="font-size: 17px;">Actors: </span><span class="order__descript">{{ $film->Actor }}</span>
                    </p>
                </div>
            </div>
                <div class="order-step-area">
                    <div class="order-step first--step">1. Choose date &amp; Hours</div>
                </div>

        </section>
        

        <section class="container">
            <div class="col-sm-12">

                <h2 class="page-heading">Choose movie date:</h2>

                <div class="choose-container choose-container--short">
                    <div class="datepicker">
                      <span class="datepicker__marker"><i class="fa fa-calendar"></i>Date</span>
                      <input type="text" class="datepicker__input" value=''>
                    </div>
                </div>
                <div class="choose-indector choose-indector--time" style="margin-top: 20px;">
                    <strong>Choose date: </strong><span class="choosen-date"></span>
                </div>
                <h2 class="page-heading">Choose hours</h2>

                <div class="time-select time-select--wide">
                        <div class="time-select__group">
                            <div class="col-sm-3">
                                <p class="time-select__place"></p>
                            </div>
                            <ul class="col-sm-6 items-wrap">
                                <li class="time-select__item active" data-time='09:00'>09:00</li>
                                <li class="time-select__item" data-time='11:00'>11:00</li>
                                <li class="time-select__item" data-time='13:00'>13:00</li>
                                <li class="time-select__item" data-time='15:00'>15:00</li>
                                <li class="time-select__item" data-time='17:00'>17:00</li>
                                <li class="time-select__item" data-time='19:00'>19:00</li>
                                <li class="time-select__item" data-time='21:00'>21:00</li>
                                <li class="time-select__item" data-time='23:00'>23:00</li>
                                <li class="time-select__item" data-time='01:00'>01:00</li>
                            </ul>
                        </div>
                        
                    </div>

                <div class="choose-indector choose-indector--time">
                    <strong>Selected hour: </strong><span class="choosen-area"></span>
                </div>
            </div>

        </section>

        <div class="clearfix"></div>

        <form id='film-and-time' class="booking-form" method='post' action='/book/sit'>
            {{ csrf_field() }}
            <input type='text' name='Date' class="choosen-date">
            <input type='text' name='Time' class="choosen-time">
            <input type='hidden' name='Film_ID' value="{{ $film->ID }}">
        

            <div class="booking-pagination">
                    <a href="#" class="booking-pagination__prev hide--arrow">
                        <span class="arrow__text arrow--prev"></span>
                        <span class="arrow__info"></span>
                    </a>
                    <button type="submit" class="booking-pagination__next">
                        <span class="arrow__text arrow--next">Next</span>
                        <span class="arrow__info">Choose seats</span>
                    </button>
            </div>

        </form>
        
        <div class="clearfix"></div>

@endsection

@section('jsSection')
    <script>
        $(function(){
            var date = new Date();
            var today = new Date(date.getFullYear(), date.getMonth(), date.getDate() + 1);
            $('.datepicker__input').datepicker({
                startDate: today,
                format: 'dd/mm/yyyy'
            });
            $('.datepicker__input').datepicker('setDate', today);

            $('.choosen-date').text($('.datepicker__input').val());
            $('.choosen-date').val($('.datepicker__input').datepicker({ dateFormat: 'yyyy-mm-dd' }).val());
            
            $('.choosen-time').val('09:00');
            $('.choose-indector--time').find('.choosen-area').text('09:00');
            $('.datepicker__input').change(function()
            {
                var chooseDate = $(this).val();
                $('.choosen-date').text(chooseDate);

                    //data element set
                $('.choosen-date').val(chooseDate);    
            });

            $('.time-select__item').click(function (){
                    //visual iteractive for choose
                    $('.time-select__item').removeClass('active');
                    $(this).addClass('active');

                    //data element init
                    var chooseTime = $(this).attr('data-time');
                    $('.choose-indector--time').find('.choosen-area').text(chooseTime);

                    //data element set
                    $('.choosen-time').val(chooseTime);
                });
        });
    </script>
@endsection