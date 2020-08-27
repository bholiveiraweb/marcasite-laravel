@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 px-4">
            <div class="card">
                <div class="card-header">{{ __('form.title', ['title' => 'Listar Propostas']) }}</div>
                <div class="card-body">
                    <div class="row mb-4">
                        <form class="form-inline">
                            <div class="form-group mx-sm-1 mb-2">
                                <label for="searchOption" class="sr-only">Seleciona uma opção</label>
                                <select class="form-control mx-1" name="option" id="searchOption">
                                    <option value="customer" selected>Cliente</option>
                                    <option value="status">Status</option>
                                    <option value="created_at">Data</option>
                                </select>
                            </div>
                            <div class="form-group mx-sm-1 mb-2">
                                <label for="s" class="sr-only">Texto da busca</label>
                                <div id="searchTerm">
                                    <input type="text" class="form-control" placeholder="Informe o cliente" name="s">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">
                                <i class="fas fa-search"></i>
                                Buscar
                            </button>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="border-top-0">#</th>
                                    <th scope="col" class="border-top-0">Cliente</th>
                                    <th scope="col" class="border-top-0">Data Proposta</th>
                                    <th scope="col" class="border-top-0">Início Pagto</th>
                                    <th scope="col" class="border-top-0">Qtd Parcelas</th>
                                    <th scope="col" class="border-top-0">Sinal R$</th>
                                    <th scope="col" class="border-top-0">Parcelas R$</th>
                                    <th scope="col" class="border-top-0">Total R$</th>
                                    <th scope="col" class="border-top-0">Status</th>
                                    <th class="border-top-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($proposals as $proposal)
                                <tr>
                                    <th scope="row">{{ $proposal->id }}</th>
                                    <td>{{ $proposal->company_name }}</td>
                                    <td>{{ date('d/m/Y', strtotime($proposal->created_at)) }}</td>
                                    <td>{{ date('d/m/Y', strtotime($proposal->payment_starts)) }}</td>
                                    <td>{{ $proposal->installment_qty }}</td>
                                    <td>{{ $proposal->entry_amount }}</td>
                                    <td>{{ $proposal->installment_amount }}</td>
                                    <td>{{ $proposal->proposal_total }}</td>
                                    <td>
                                        @if($proposal->status == 0)
                                            <span class="badge badge-pill badge-success text-uppercase">aberta</span> 
                                        @else
                                            <span class="badge badge-pill badge-danger text-uppercase">fechada</span>
                                        @endif
                                    </td>
                                    <th>
                                        <a href="{{ route('proposal.edit', ['id' => $proposal->id]) }}" class="btn btn-warning mb-1">
                                            <i class="fas fa-edit"></i>
                                            Editar
                                        </a>
                                        <a href="{{ route('proposal.delete', ['id' => $proposal->id]) }}" onclick="return confirm('Deseja realmente remover o registro?');" class="btn btn-danger mb-1">
                                            <i class="fas fa-trash"></i>
                                            Excluir
                                        </a>
                                    </th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('proposal.export') }}" class="btn btn-success">
                        <i class="fas fa-file-excel"></i>
                        Exportar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('#searchOption').on('change', function () {
            console.log($(this).val());

            if ($(this).val() == 'customer') {
                $('#searchTerm').html('<input type="text" placeholder="Informe o cliente" class="form-control" name="s">');
            }
            
            if ($(this).val() == 'status') {
                $('#searchTerm').html(`
                    <select class="form-control mx-1" name="s">
                        <option value="0" selected>Abertas</option>
                        <option value="1">Fechadas</option>
                    </select>
                `);
            }

            if ($(this).val() == 'created_at') {
                $('#searchTerm').html('<input type="date" class="form-control" name="s">');
            }
        });
    });
</script>
@endsection