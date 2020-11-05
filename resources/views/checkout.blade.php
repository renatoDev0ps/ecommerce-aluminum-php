@extends('layouts.front')

@section('stylesheets')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
@endsection

@section('content')
    <div class="container">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-8">
                    <h2>Dados de Pagamento</h2>
                    <hr>
                </div>
            </div>
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-8 form-group">
                        <label>Número de Cartão <span class="brand"></span></label>
                        <input type="text" class="form-control" name="card_number">
                        <input type="hidden" name="card_brand">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 form-group">
                        <label>Titular do Cartão</label>
                        <input type="text" class="form-control" name="card_name">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>Mês de Expiração</label>
                        <input type="text" class="form-control" name="card_month">
                    </div>

                    <div class="col-md-4 form-group">
                        <label>Ano de Expiração</label>
                        <input type="text" class="form-control" name="card_year">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2 form-group">
                        <label>CVV</label>
                        <input type="text" class="form-control" name="card_cvv">
                    </div>

                    <div class="installments col-md-6 form-group"></div>
                </div>

                <button class="btn btn-lg btn-success processCheckout">Efetuar Pagamento</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

    <script>
        const sessionId = '{{session()->get('pagseguro_session_code')}}';
        const urlThanks = '{{route('checkout.thanks')}}';
        const urlProcess = '{{route('checkout.process')}}';
        const amountTransaction = '{{$cartItems}}';
        const csrf = '{{csrf_token()}}';

        PagSeguroDirectPayment.setSessionId(sessionId);
    </script>
    <script src="{{asset('js/pagseguro_functions')}}"></script>
    <script src="{{asset('js/pagseguro_events')}}"></script>
@endsection
