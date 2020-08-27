<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Exports\ProposalsExport;
use App\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProposalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $proposals = new Proposal();

        $prop = $proposals->join('customers', 'customers.id', '=', 'proposals.customer_id');

        if (!is_null($request->query('option'))) {
            switch ($request->query('option')) {
                case 'customer':
                    $prop = $proposals->where('customers.company_name', 'like', "%{$request->query('s')}%")
                        ->join('customers', 'customers.id', '=', 'proposals.customer_id');
                    break;
                case 'status':
                    $prop = $proposals->where('proposals.status', '=', $request->query('s'))
                        ->join('customers', 'customers.id', '=', 'proposals.customer_id');
                    break;
                case 'created_at':
                    $prop = $proposals->whereBetween('proposals.created_at', ["{$request->query('s')} 00:00:00", "{$request->query('s')} 23:59:59"])
                        ->join('customers', 'customers.id', '=', 'proposals.customer_id');
                    break;
            }
        }

        $data['proposals'] = $prop->get(['proposals.*', 'customers.company_name']);

        return view('proposal.list', $data);
    }

    public function add()
    {
        return view('proposal.add');
    }

    public function edit($id)
    {
        $data = ['proposal' => Proposal::where('proposals.id', $id)->join('customers', 'customers.id', '=', 'proposals.customer_id')->first(['proposals.*', 'customers.company_name'])];
        return view('proposal.edit', $data);
    }

    public function store(Request $request)
    {
        $this->validator($request->all(), null)->validate();

        $file = $request->file('file');

        if (!is_null($file) && $file->isValid())
            $path = $file->store('documents');

        $proposal = Proposal::create([
            'customer_id' => $request->customer_id,
            'constructions_address' => $request->constructions_address,
            'proposal_total' => $request->proposal_total,
            'entry_amount' => $request->entry_amount,
            'installment_qty' => $request->installment_qty,
            'installment_amount' => $request->installment_amount,
            'payment_starts' => $request->payment_starts,
            'installment_date' => $request->installment_date,
            'file' => $path ?? null,
            'status' => $request->status
        ]);

        if ($proposal->save())
            $request->session()->flash('success', 'Proposta cadastrada com sucesso!');

        return redirect()->route('proposal.add');
    }

    public function update(Request $request, $id)
    {
        $this->validator($request->all(), $id)->validate();

        $update = Proposal::find($id)->update([
            'customer_id' => $request->customer_id,
            'constructions_address' => $request->constructions_address,
            'proposal_total' => $request->proposal_total,
            'entry_amount' => $request->entry_amount,
            'installment_qty' => $request->installment_qty,
            'installment_amount' => $request->installment_amount,
            'payment_starts' => $request->payment_starts,
            'installment_date' => $request->installment_date,
            'status' => $request->status
        ]);

        $file = $request->file('file');

        if (!is_null($file) && $file->isValid()) {
            $path = $file->store('documents');
            Proposal::where('id', $id)->update(['file' => $path]);
        }

        if ($update)
            $request->session()->flash('success', 'Proposta atualizada com sucesso!');

        return redirect()->route('proposal.edit', ['id' => $id]);
    }

    public function delete($id)
    {
        Proposal::find($id)->delete();
        return redirect()->route('proposal.index');
    }

    public function loadCustomer(Request $request)
    {
        $term = filter_var($request->query('s'), FILTER_SANITIZE_STRING);

        $customer = Customer::where('company_name', 'like', "%{$term}%")
            ->orWhere('trading_name', 'like', "%{$term}%")->get(['id', 'company_name']);

        return response()
            ->json($customer);
    }

    public function export()
    {
        return (new ProposalsExport)->download('proposals.xlsx');
    }

    private function validator(array $data, $id)
    {
        $attributes = [
            'customer_id' => 'cliente'
        ];

        return Validator::make($data, [
            'customer_id' => ['required', 'numeric'],
            'constructions_address' => ['required'],
            'proposal_total' => ['required', 'numeric'],
            'entry_amount' => ['required', 'numeric'],
            'installment_qty' => ['required', 'numeric'],
            'installment_amount' => ['required', 'numeric'],
            'payment_starts' => ['required', 'date'],
            'installment_date' => ['required', 'numeric'],
            'status' => ['required', 'numeric']
        ], [], $attributes);
    }
}
