@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 px-4">
            <div class="card">
                <div class="card-header">{{ __('form.title', ['title' => 'Listar Clientes']) }}</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="border-top-0">#</th>
                                    <th scope="col" class="border-top-0">Razão Social</th>
                                    <th scope="col" class="border-top-0">CNPJ</th>
                                    <th scope="col" class="border-top-0">E-mail</th>
                                    <th class="border-top-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $customer)
                                <tr>
                                    <th scope="row">{{ $customer->id }}</th>
                                    <td>{{ $customer->company_name }}</td>
                                    <td>{{ $customer->registered_number }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <th>
                                        <a href="{{ route('customer.edit', ['id' => $customer->id]) }}" class="btn btn-warning mb-1">
                                            <i class="fas fa-edit"></i>
                                            Editar
                                        </a>
                                        <a href="{{ route('customer.delete', ['id' => $customer->id]) }}" onclick="return confirm('Deseja realmente remover o registro?');" class="btn btn-danger mb-1">
                                            <i class="fas fa-trash"></i>
                                            Excluir
                                        </a>
                                    </th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection