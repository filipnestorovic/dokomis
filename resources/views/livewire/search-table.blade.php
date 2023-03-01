<div>
    <style>
        #searchFormDiv {
            display: flex;
            flex-direction: row;
        }

        /* Responsive layout - makes a one column layout instead of a two-column layout */
        @media (max-width: 800px) {
            #searchFormDiv {
                flex-direction: column;
            }
        }
    </style>
    <div class="col-md-12">
        <div class="card mb-3 mt-0 wow fadeIn">
         <span class="text-center m-4">
            <div class="text-center">
               <form wire:submit.prevent>
                   <div id="searchFormDiv" class="d-flex justify-content-center">
                       <div class="flex-column mr-3">
                          <div class="input-group mb-2 mr-sm-2">
                             <div class="input-group-prepend">
                                <div class="input-group-text">Naziv firme</div>
                             </div>
                             <input wire:model.debounce.500ms="companyName" type="text" class="form-control py-0" id="companyName">
                          </div>
                          @error('companyName')
                          <div class="text-danger">{{$message}}</div>
                          @enderror
                       </div>
                       <div class="flex-column mr-3">
                          <div class="input-group mb-2 mr-sm-2">
                             <div class="input-group-prepend">
                                <div class="input-group-text">PIB</div>
                             </div>
                             <input wire:model.debounce.500ms="companyVAT" type="text" class="form-control py-0" id="companyVAT">
                          </div>
                          @error('companyVAT')
                          <div class="text-danger">{{$message}}</div>
                          @enderror
                       </div>
                       <div class="flex-column mr-3">
                          <div class="input-group mb-2 mr-sm-2">
                             <div class="input-group-prepend">
                                <div class="input-group-text">Broj sertifikata</div>
                             </div>
                             <input wire:model.debounce.500ms="certificateNumber" type="text" class="form-control py-0" id="certificateNumber">
                          </div>
                          @error('certificateNumber')
                          <div class="text-danger">{{$message}}</div>
                          @enderror
                       </div>
                    </div>
                   @if($companyName||$companyVAT||$certificateNumber)
{{--                       <button wire:click="showResultTable" wire:keydown.enter="showResultTable" type="button"--}}
{{--                               class="btn btn-primary btn-rounded btn-md mt-0">Pretraži</button>--}}
                       <span wire:init="showResultTable"></span>
                   @else
                       <span>Da biste pretražili sertifikate, morate uneti bar jedan kliterijum.</span>
                   @endif
               </form>
            </div>
         </span>
        </div>
    </div>
    @if($companies)
        <div class="col-md-12">
            <div class="card mt-0 wow fadeIn">
                @if($companies->isEmpty())
                    <h4 class="m-4 text-center">Nema rezultata za zadate kriterijume pretrage.</h4>
                @else
                    <table class="table table-hover mt-4 mb-4">
                        <thead>
                        <tr>
                            <th scope="col">Broj sertifikata</th>
                            <th scope="col">Naziv kompanije</th>
                            <th scope="col">Naziv sertifikata</th>
                            <th scope="col">Važi od</th>
                            <th scope="col">Važi do</th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($companies as $singleCompanyCertificate)
                            <tr>
                                <td>{{$singleCompanyCertificate->certificate_number}}</td>
                                <td>{{$singleCompanyCertificate->company->name}}</td>
                                <td>{{$singleCompanyCertificate->certificate->name}}</td>
                                <td>{{$singleCompanyCertificate->valid_from}}</td>
                                <td>{{$singleCompanyCertificate->valid_until}}</td>
                                <td>
                                    @switch($singleCompanyCertificate->status)
                                        @case(1)
                                            <span class="badge badge-pill badge-success">Validan</span>
                                        @break
                                        @case(2)
                                            <span class="badge badge-pill badge-danger">Istekao</span>
                                        @break
                                        @case(3)
                                            <span class="badge badge-pill badge-warning">Suspendovan</span>
                                        @break
                                        @case(4)
                                            <span class="badge badge-pill badge-danger">Povučen</span>
                                        @break
                                    @endswitch
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    @endif
</div>
