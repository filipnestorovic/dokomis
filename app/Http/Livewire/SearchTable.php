<?php

namespace App\Http\Livewire;

use App\Models\CompanyCertificate;
use Carbon\Carbon;
use Livewire\Component;

class SearchTable extends Component
{
    public $companyName;
    public $companyVAT;
    public $certificateNumber;
    public $companies;

    public $selectedCertificate;

    protected $listeners = ['showResultTable' => '$refresh'];

    protected $rules = [
        'companyName' => 'nullable|min:3',
        'companyVAT' => 'nullable|numeric|digits:9',
        'certificateNumber' => 'nullable|regex:/^\d{2}-\d{4}-\d{1}\/\d{2}-\d{4,5}$/',
    ];

    protected $messages = [
        'companyName' => 'Naziv firme mora imati bar 3 karaktera',
        'companyVAT' => 'PIB mora imati 9 cifara',
        'certificateNumber' => 'Broj sertifikata mora biti u formatu: 00-0000-0/00-00000',
    ];

    public function render()
    {
//        $this->companies = CompanyCertificate::with('company','certificate')->get();
        return view('livewire.search-table');
    }

    public function updated($name, $value)
    {
        $this->validate();

        if($this->companyName||$this->companyVAT||$this->certificateNumber) {
            $this->showResultTable();
        } else {
            $this->companies = [];
        }
    }

    public function showResultTable()
    {
        $this->companies =
            CompanyCertificate::with('company','certificate')
                ->when($this->certificateNumber, function ($q) {
                    $q->where('certificate_number', 'LIKE', '%'.$this->certificateNumber.'%');
                })
                ->when($this->companyName, function ($q) {
                    return $q->whereHas('company', function ($query) {
                        $query->where('name', 'LIKE', '%'.$this->companyName.'%');
                    });
                })
                ->when($this->companyVAT, function ($q) {
                    return $q->whereHas('company', function ($query) {
                        $query->where('vat', 'LIKE', '%'.$this->companyVAT.'%');
                    });
                })
            ->get();
    }

    public function showModal($id)
    {
        $this->selectedCertificate = CompanyCertificate::with('company','certificate')->find($id);
        $this->dispatchBrowserEvent('show-modal');
    }
}
