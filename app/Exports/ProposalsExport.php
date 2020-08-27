<?php

namespace App\Exports;

use App\Proposal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

class ProposalsExport implements FromCollection
{
    use Exportable;
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Proposal::join('customers', 'customers.id', '=', 'proposals.customer_id')
            ->get(['proposals.*', 'customers.company_name']);
    }
}
