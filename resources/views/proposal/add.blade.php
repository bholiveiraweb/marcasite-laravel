@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 px-4">
            <div class="card">
                <div class="card-header">{{ __('form.title', ['title' => 'Nova Proposta']) }}</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('proposal.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="autocomplete" class="col-md-4 col-form-label text-md-right">{{ __('Cliente') }}</label>

                            <div class="col-md-6">
                                <input id="autocomplete" type="text" class="form-control" name="autocomplete" required autofocus autocomplete="off">
                                <input id="customer_id" type="hidden" name="customer_id" autocomplete="off">

                                <div id="suggests-container">
                                    <ul id="autocomplete-suggests" class="list-group"></ul>
                                </div>

                                @error('customer_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="constructions_address" class="col-md-4 col-form-label text-md-right">{{ __('Endereço da Obra') }}</label>

                            <div class="col-md-6">
                                <input id="constructions_address" type="text" class="form-control @error('constructions_address') is-invalid @enderror" name="constructions_address" value="{{ old('constructions_address') }}" required autocomplete="constructions_address">

                                @error('constructions_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="proposal_total" class="col-md-4 col-form-label text-md-right">{{ __('Valor Total') }}</label>

                            <div class="col-md-6">
                                <input id="proposal_total" type="text" class="form-control @error('proposal_total') is-invalid @enderror" name="proposal_total" value="{{ old('proposal_total') }}" required autocomplete="proposal_total">

                                @error('proposal_total')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="entry_amount" class="col-md-4 col-form-label text-md-right">{{ __('Sinal') }}</label>

                            <div class="col-md-6">
                                <input id="entry_amount" type="text" class="form-control @error('entry_amount') is-invalid @enderror" name="entry_amount" value="{{ old('entry_amount') }}" required autocomplete="entry_amount">

                                @error('entry_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="installment_qty" class="col-md-4 col-form-label text-md-right">{{ __('Quantidade de Parcelas') }}</label>

                            <div class="col-md-6">
                                <input id="installment_qty" type="text" class="form-control @error('installment_qty') is-invalid @enderror" name="installment_qty" value="{{ old('installment_qty') }}" required autocomplete="installment_qty">

                                @error('installment_qty')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="installment_amount" class="col-md-4 col-form-label text-md-right">{{ __('Valor das Parcelas') }}</label>

                            <div class="col-md-6">
                                <input id="installment_amount" type="text" class="form-control @error('installment_amount') is-invalid @enderror" name="installment_amount" value="{{ old('installment_amount') }}" required autocomplete="installment_amount">

                                @error('installment_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="payment_starts" class="col-md-4 col-form-label text-md-right">{{ __('Início do Pagamento') }}</label>

                            <div class="col-md-6">
                                <input id="payment_starts" type="date" class="form-control @error('payment_starts') is-invalid @enderror" name="payment_starts" value="{{ old('payment_starts') }}" required autocomplete="payment_starts">

                                @error('payment_starts')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="installment_date" class="col-md-4 col-form-label text-md-right">{{ __('Data das Parcelas') }}</label>

                            <div class="col-md-6">
                                <input id="installment_date" type="text" class="form-control @error('installment_date') is-invalid @enderror" name="installment_date" value="{{ old('installment_date') }}" required autocomplete="installment_date">

                                @error('installment_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('Anexar Arquivo (PDF ou DOC)') }}</label>

                            <div class="col-md-6">
                                <input id="file" type="file" class="form-control @error('file') is-invalid @enderror" name="file" value="{{ old('file') }}" accept="application/pdf|application/msword">

                                @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                            <div class="col-md-6">
                                <select name="status" class="form-control @error('file') is-invalid @enderror">
                                    <option value="0">Aberta</option>
                                    <option value="1">Fechada</option>
                                </select>

                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i>
                                    {{ __('Salvar') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script>
    $(function () {
        $('#autocomplete').keyup(function() {
        var $this = $(this);

        clearTimeout(autocomplete);

        var autocomplete = setTimeout(function() {
          if ($this.val().length > 0) {
            $.ajax({
              method: 'GET',
              url: '{{ route('proposal.load-customer') }}?s=' + $this.val(),
              contentType: false,
              dataType: 'json'
            }).done(function(data) {
              $('#autocomplete-suggests').empty();
              if (data.length > 0) {
                $('#suggests-container').addClass('active');
                data.forEach(function(item) {
                  $('#autocomplete-suggests').prepend(`<li class="suggest-item" data-id="${item.id}" onclick="complete(this)">${item.company_name}</li>`);
                });
              } else {
                $('#suggests-container').removeClass('active');
              }
            });
          } else {
            $('#autocomplete-suggests').empty();
            $('#suggests-container').removeClass('active');
          }
        }, 1000);
      });
    });

    function complete(el) {
        $('#autocomplete').val(el.innerHTML);
        $('#customer_id').val(el.dataset.id);
        $('#suggests-container').removeClass('active');
    }
</script>
@endsection