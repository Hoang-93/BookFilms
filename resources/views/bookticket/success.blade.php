@extends('layouts._layout')

@section('title', 'Thanh toán thành công')

@section('content')
    
<section class="container" style="margin-top: 90px;">
    <div class="order-container">
        <div class="order">
            <img class="order__images" alt='' src="{{asset('assets/images/tickets.png')}}">
            <p class="order__title">SUCCESSFUL BOOKING <br><span class="order__descript">Wish you have moments of watching movies really comfortable and relaxing.</span></p>
        </div>

        <div class="ticket">
            <div class="ticket-position">
                <div class="ticket__indecator indecator--pre"><div class="indecator-text pre--text">Online tickets</div> </div>
                <div class="ticket__inner">

                    <div class="ticket-secondary">
                        <span class="ticket__item"><strong class="ticket__number">Xstar-Cineplex cinema ticket</strong></span>
                        <span class="ticket__item ticket__date">{{ $datetime[$user_id]['Date'] }}</span>
                        <span class="ticket__item ticket__time">{{ $datetime[$user_id]['Time'] }}</span>
                        <span class="ticket__item">Cinema: <span class="ticket__cinema">Xstar-Cineplex</span></span>
                        <span class="ticket__item">Hall: <span class="ticket__hall">81st floor, Lanmark building 82.</span></span>
                        <span class="ticket__item ticket__price">Total ticket price:
                            <strong class="ticket__cost">{{ number_format($TotalMoney) }} ₫</strong>
                        </span>
                    </div>

                    <div class="ticket-primery">
                        <span class="ticket__item ticket__item--primery ticket__film">Film<br>
                            <strong class="ticket__movie">{{ $film->Name }}</strong>
                        </span>
                        <span class="ticket__item ticket__item--primery">Seat position: <span class="ticket__place">{{ $booksit[$user_id]['Sit'] }}</span></span>
                    </div>


                </div>
                <div class="ticket__indecator indecator--post"><div class="indecator-text post--text">Online Ticket</div></div>
            </div>
        </div>


    </div>
</section>
    
@endsection

@section('jsSection')
    <script>
        $(function(){

            $('.payment__item').click(function (){
                    $('#CartPay').removeAttr('style');
                    $('#CartPay').attr('display', 'block');
                });
        });
    </script>
@endsection