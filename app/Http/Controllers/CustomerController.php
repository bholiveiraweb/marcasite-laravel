<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = ['customers' => Customer::all()];
        return view('customer.list', $data);
    }

    public function add()
    {
        return view('customer.add');
    }

    public function edit($id)
    {
        $data = ['customer' => Customer::find($id)];
        return view('customer.edit', $data);
    }

    public function store(Request $request)
    {
        $this->validator($request->all(), null)->validate();

        $customer = Customer::create($request->all());

        if ($customer->save())
            $request->session()->flash('success', 'Cliente cadastrado com sucesso!');

        return redirect()->route('customer.add');
    }

    public function update(Request $request, $id)
    {
        $this->validator($request->all(), $id)->validate();

        $update = Customer::find($id)->update($request->all());

        if ($update)
            $request->session()->flash('success', 'Cliente atualizado com sucesso!');

        return redirect()->route('customer.edit', ['id' => $id]);
    }

    public function delete($id)
    {
        Customer::find($id)->delete();
        return redirect()->route('customer.index');
    }

    private function validator(array $data, $id)
    {
        $attributes = [
            'registered_number' => 'CNPJ'
        ];

        return Validator::make($data, [
            'company_name' => ['required', 'string'],
            'trading_name' => ['required', 'string'],
            'registered_number' => ['required', 'string', 'unique:customers,registered_number,' . $id],
            'address' => ['required', 'string'],
            'email' => ['required', 'email'],
            'official' => ['required', 'string'],
            'official_document' => ['required', 'string'],
            'celphone' => ['required', 'string'],
        ], [], $attributes);
    }
}
