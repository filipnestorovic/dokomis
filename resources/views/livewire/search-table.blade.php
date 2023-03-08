<div>
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
            <div class="card mt-0 wow fadeIn table-responsive">
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
                            <th scope="col">Više</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($companies as $singleCompanyCertificate)
                            <tr wire:click="showModal({{ $singleCompanyCertificate->id }})" class="clickableTr">
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
                                <td>
                                    <i class="fas fa-search fa-lg mt-2"></i>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
        @if($selectedCertificate)
        <div wire:ignore.self wire:prevent class="modal fade modal-dialog-centered" tabindex="-1">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{$selectedCertificate->certificate_number}}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-borderless">
                            <tr>
                                <td>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td>
                                                <h5 class="dokomis-blue">Naziv</h5>
                                                <span>{{$selectedCertificate->company->name}}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5 class="dokomis-blue">PIB</h5>
                                                <span>{{$selectedCertificate->company->vat}}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5 class="dokomis-blue">Adresa</h5>
                                                <span>{{$selectedCertificate->company->address}}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5 class="dokomis-blue">Grad</h5>
                                                <span>{{$selectedCertificate->company->city}}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5 class="dokomis-blue">Država</h5>
                                                <span>{{$selectedCertificate->company->country}}</span>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td>
                                                <h5 class="dokomis-blue">Sertifikat</h5>
                                                <span>{{$selectedCertificate->certificate->name}}</span>
                                                <br><br>
                                                <span>{{$selectedCertificate->certificate->description}}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5 class="dokomis-blue">Oblast primene</h5>
                                                <span>{{$selectedCertificate->application_area}}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5 class="dokomis-blue">Status sertifikata</h5>
                                                <span>
                                                    @switch($selectedCertificate->status)
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
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="https://dokomis.rs/complaints/" target="_blank"><span class="dokomis-blue">Imate žalbu ili prigovor? Molimo popunite formu na našem sajtu.</span></a></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endif
    @push('styles')
        <style>
            #searchFormDiv {
                display: flex;
                flex-direction: row;
            }
            @media (max-width: 800px) {
                #searchFormDiv {
                    flex-direction: column;
                }
            }
            .clickableTr {
                cursor: pointer;
            }
            .dokomis-blue {
                color: #5cafc2;
            }
            .table td, .table th {
                border-top: none !important;
            }
            a {
                text-decoration: none;
            }
        </style>
    @endpush
    @push('scripts')
        <script>
            window.addEventListener('show-modal', event => {
                $('.modal').modal('show');
            });
        </script>
    @endpush
</div>
