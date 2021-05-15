@include('layout.function')
@if($isOpen)
<div class="card">
    <div class="card-header">
        <button wire:click="closeModal()" class="btn btn-secondary"><i class="fas fa-angle-left pr-1"></i> Back</button>
    </div>
    <form method="POST" wire:submit.prevent="store()">
        <div class="card-body">
            <div class="card">
                <div class="card-body">
                    <!-- String -->
                    <div class="form-group row">
                        <label for="input_nomor" class="col-sm-2 col-form-label">Nomor Kontrak</label>
                        <div class="col-sm-10">
                            <input type="text" wire:model="input_nomor" id="input_nomor" class="form-control @error('input_nomor') is-invalid @enderror">
                            @error('input_nomor') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input_mulai" class="col-sm-2 col-form-label">Tanggal Mulai</label>
                        <div class="col-sm-10">
                            <input type="date" wire:model="input_mulai" class="form-control @error('input_mulai') is-invalid @enderror">
                            @error('input_mulai') <div class="invalid-feedback"> {{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input_selesai" class="col-sm-2 col-form-label">Tanggal Selesai</label>
                        <div class="col-sm-10">
                            <input type="date" wire:model="input_selesai" class="form-control @error('input_selesai') is-invalid @enderror">
                            @error('input_selesai') <div class="invalid-feedback"> {{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input_tahun" class="col-sm-2 col-form-label">Tahun Kontrak</label>
                        <div class="col-sm-10">
                            <input type="number" wire:model="input_tahun" class="form-control @error('input_tahun') is-invalid @enderror">
                            @error('input_tahun') <div class="invalid-feedback"> {{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input_unit" class="col-sm-2 col-form-label">Unit</label>
                        <div class="col-sm-10">
                            <select wire:model="input_unit" class="form-control select2 @error('input_unit') is-invalid @enderror" required="required">
                                <option value="" selected="selected">- Select -</option>
                                @foreach($listUnit as $t)
                                    <option value="{{ $t->es2 }}">{{ $t->es2 }}</option>
                                @endforeach
                            </select>
                            @error('input_unit') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="reset" class="btn btn-danger">Reset</button>
            <button type="button" wire:click.prevent="store()" class="btn btn-success">Save</button>
        </div>
    </form>
</div>
@elseif($isOpenRisiko)
<div class="card">
    <div class="card-header">
        <button wire:click="closeRisiko()" class="btn btn-secondary"><i class="fas fa-angle-left pr-1"></i> Back</button>
    </div>
    <form method="POST" wire:submit.prevent="storeRisiko()">
        <div class="card-body">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2">
                            Nomor Kontrak
                        </div>
                        <div class="col-lg-4">
                            {{ $selectedPiagam->nomor }}
                        </div>
                        <div class="col-lg-2">
                            Tanggal Mulai
                        </div>
                        <div class="col-lg-4">
                            {{ formatDate($selectedPiagam->mulai) }}
                        </div>
                        <div class="col-lg-2">
                            Tanggal Selesai
                        </div>
                        <div class="col-lg-4">
                            {{ formatDate($selectedPiagam->selesai) }}
                        </div>
                        <div class="col-lg-2">
                            Tahun Kontrak
                        </div>
                        <div class="col-lg-4">
                            {{ $selectedPiagam->tahun }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <!-- String -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="input_so">Sasaran Organisasi</label>
                        <div class="col-sm-10">
                            <select wire:model="input_so" class="form-control select2 @error('input_so') is-invalid @enderror" required="required">
                                <option value="" selected="selected">- Select -</option>
                                @foreach($listSO as $t)
                                    <option value="{{ $t->id }}">{{ $t->kode.' '.$t->name }}</option>
                                @endforeach
                            </select>
                            @error('input_so') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="input_risiko">Risiko</label>
                        <div class="col-sm-10">
                            <textarea wire:model="input_risiko" class="form-control @error('input_risiko') is-invalid @enderror" rows="2"></textarea>
                            @error('input_risiko') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="input_iru">IRU</label>
                        <div class="col-sm-10">
                            <textarea wire:model="input_iru" class="form-control @error('input_iru') is-invalid @enderror" rows="2"></textarea>
                            @error('input_iru') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="input_deskripsi">Deskripsi IRU</label>
                        <div class="col-sm-10">
                            <textarea wire:model="input_deskripsi" class="form-control @error('input_deskripsi') is-invalid @enderror" rows="3"></textarea>
                            @error('input_deskripsi') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="input_formula">Formula</label>
                        <div class="col-sm-10">
                            <textarea wire:model="input_formula" class="form-control @error('input_formula') is-invalid @enderror" rows="3"></textarea>
                            @error('input_formula') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="input_satuan">Satuan Pengukuran</label>
                        <div class="col-sm-10">
                            <input type="text" wire:model="input_satuan" id="input_satuan" class="form-control @error('input_satuan') is-invalid @enderror">
                            @error('input_satuan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="input_jenis_periode">Jenis Konsolidasi Periode</label>
                        <div class="col-sm-10">
                            <select wire:model="input_jenis_periode" class="form-control select2 @error('input_jenis_periode') is-invalid @enderror" required="required">
                                <option value="" selected="selected">- Select -</option>
                                <option value="Sum">Sum</option>
                                <option value="Average">Average</option>
                                <option value="Take Last Known">Take Last Known</option>
                            </select>
                            @error('input_jenis_periode') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="input_jenis_lokasi">Jenis Konsolidasi Lokasi</label>
                        <div class="col-sm-10">
                            <select wire:model="input_jenis_lokasi" class="form-control select2 @error('input_jenis_lokasi') is-invalid @enderror" required="required">
                                <option value="" selected="selected">- Select -</option>
                                <option value="Sum">Sum</option>
                                <option value="Average">Average</option>
                                <option value="Raw Data">Raw Data</option>
                            </select>
                            @error('input_jenis_lokasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="input_polarisasi">Polarisasi</label>
                        <div class="col-sm-10">
                            <select wire:model="input_polarisasi" class="form-control select2 @error('input_polarisasi') is-invalid @enderror" required="required">
                                <option value="" selected="selected">- Select -</option>
                                <option value="Maximize">Maximize</option>
                                <option value="Minimize">Minimize</option>
                                <option value="Stabilize">Stabilize</option>
                            </select>
                            @error('input_polarisasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="input_penanggung_jawab">Unit Penanggungjawab</label>
                        <div class="col-sm-10">
                            <input type="text" wire:model="input_penanggung_jawab" id="input_penanggung_jawab" class="form-control @error('input_penanggung_jawab') is-invalid @enderror">
                            @error('input_penanggung_jawab') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="input_penyedia_data">Unit Penyedia Data</label>
                        <div class="col-sm-10">
                            <input type="text" wire:model="input_penyedia_data" id="input_penyedia_data" class="form-control @error('input_penyedia_data') is-invalid @enderror">
                            @error('input_penyedia_data') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="input_sumber_data">Sumber Data</label>
                        <div class="col-sm-10">
                            <input type="text" wire:model="input_sumber_data" id="input_sumber_data" class="form-control @error('input_sumber_data') is-invalid @enderror">
                            @error('input_sumber_data') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="input_periode_pelaporan">Periode Pelaporan</label>
                        <div class="col-sm-10">
                            <select wire:model="input_periode_pelaporan" class="form-control select2 @error('input_periode_pelaporan') is-invalid @enderror" required="required">
                                <option value="" selected="selected">- Select -</option>
                                <option value="Bulanan">Bulanan</option>
                                <option value="Triwulanan">Triwulanan</option>
                                <option value="Semesteran">Semesteran</option>
                            </select>
                            @error('input_periode_pelaporan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="input_batas_aman">Batas Aman</label>
                        <div class="col-sm-10">
                            <input type="text" wire:model="input_batas_aman" id="input_batas_aman" class="form-control @error('input_batas_aman') is-invalid @enderror">
                            @error('input_batas_aman') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    @if(stripos($input_polarisasi, 'minimize')!==false || stripos($input_polarisasi, 'stabilize')!==false)
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="input_batas_atas">Batas Atas</label>
                        <div class="col-sm-10">
                            <input type="text" wire:model="input_batas_atas" id="input_batas_atas" class="form-control @error('input_batas_atas') is-invalid @enderror">
                            @error('input_batas_atas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    @endif
                    @if(stripos($input_polarisasi, 'maximize')!==false || stripos($input_polarisasi, 'stabilize')!==false)
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="input_batas_bawah">Batas Bawah</label>
                        <div class="col-sm-10">
                            <input type="text" wire:model="input_batas_bawah" id="input_batas_bawah" class="form-control @error('input_batas_bawah') is-invalid @enderror">
                            @error('input_batas_bawah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="input_q1">Risiko Aktual Q1</label>
                        <div class="col-sm-10">
                            <input type="text" wire:model="input_q1" id="input_q1" class="form-control @error('input_q1') is-invalid @enderror">
                            @error('input_q1') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="input_q2">Risiko Aktual Q2</label>
                        <div class="col-sm-10">
                            <input type="text" wire:model="input_q2" id="input_q2" class="form-control @error('input_q2') is-invalid @enderror">
                            @error('input_q2') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="input_q3">Risiko Aktual Q3</label>
                        <div class="col-sm-10">
                            <input type="text" wire:model="input_q3" id="input_q3" class="form-control @error('input_q3') is-invalid @enderror">
                            @error('input_q3') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="input_q4">Risiko Aktual Q4</label>
                        <div class="col-sm-10">
                            <input type="text" wire:model="input_q4" id="input_q4" class="form-control @error('input_q4') is-invalid @enderror">
                            @error('input_q4') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="reset" class="btn btn-danger">Reset</button>
            <button type="button" wire:click.prevent="storeRisiko()" class="btn btn-success">Save</button>
        </div>
    </form>
</div>
@elseif($isOpenDetail)
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <button wire:click="closeModal()" class="btn btn-secondary"><i class="fas fa-angle-left pr-1"></i> Back</button>
            </div>
            <div class="col-lg-6 text-right">
                <button wire:click="openRisiko()" class="btn btn-success"><i class="fas fa-plus pr-1"></i>Buat IRU</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="card" style="margin-bottom: 20px">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2">
                            Nomor Kontrak
                        </div>
                        <div class="col-lg-4">
                            {{ $selectedPiagam->nomor }}
                        </div>
                        <div class="col-lg-2">
                            Tanggal Mulai
                        </div>
                        <div class="col-lg-4">
                            {{ formatDate($selectedPiagam->mulai) }}
                        </div>
                        <div class="col-lg-2">
                            Tanggal Selesai
                        </div>
                        <div class="col-lg-4">
                            {{ formatDate($selectedPiagam->selesai) }}
                        </div>
                        <div class="col-lg-2">
                            Tahun Kontrak
                        </div>
                        <div class="col-lg-4">
                            {{ $selectedPiagam->tahun }}
                        </div>
                    </div>
                </div>
        </div>

        <div class="table-responsive" style="margin-bottom: 20px">
            <table class="table table-striped table-bordered table-hover">
                <thead class="text-center">
                    <tr>
                        <th width="5%" rowspan="2">No</th>
                        <th rowspan="2">Kode SO</th>
                        <th rowspan="2">Kode Risiko</th>
                        <th rowspan="2">Nama Risiko</th>
                        <th rowspan="2">Besaran Risiko Awal</th>
                        <th colspan="4">Besaran Risiko Aktual</th>
                        <th rowspan="2">Target Residual</th>
                        <th width="10%" rowspan="2">Action</th>
                    </tr>
                    <tr>
                        <th>Q1</th>
                        <th>Q2</th>
                        <th>Q3</th>
                        <th>Q4</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse($selectedPiagam->data as $list)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-left">{{ $list->sasaranOrganisasi->kode}}</td>
                        <td class="text-left">{{ "RE#".$loop->iteration }}</td>
                        <td class="text-left">{{ $list->nama }}</td>
                        <td class="text-left">
                            {{ "BA: ".$list->batas_atas }}<br/>
                            {{ "BM: ".$list->batas_aman }}<br/>
                            {{ "BB: ".$list->batas_bawah }}<br/>
                        </td>
                        <td class="text-center" style="background-color:{{formatColor($list->q1, $list->batas_bawah, $list->batas_atas, $list->batas_aman, $list->polarisasi)}}">{{ $list->q1 }}</td>
                        <td class="text-center" style="background-color:{{formatColor($list->q2, $list->batas_bawah, $list->batas_atas, $list->batas_aman, $list->polarisasi)}}">{{ $list->q2 }}</td>
                        <td class="text-center" style="background-color:{{formatColor($list->q3, $list->batas_bawah, $list->batas_atas, $list->batas_aman, $list->polarisasi)}}">{{ $list->q3 }}</td>
                        <td class="text-center" style="background-color:{{formatColor($list->q4, $list->batas_bawah, $list->batas_atas, $list->batas_aman, $list->polarisasi)}}">{{ $list->q4 }}</td>
                        <td class="text-center">{{ "??" }}</td>
                        <td style="text-align: center;">
                            <button wire:click="editRisiko({{ $list->id }})" class="btn btn-sm btn-info" style="width:auto; margin: 2px"><i class="fas fa-edit"></i></button>
                            <button wire:click="deleteRisiko({{ $list->id }})" class="btn btn-sm btn-danger" style="width:auto; margin: 2px" onclick="confirm('Are you sure to delete?') || event.stopImmediatePropagation()"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11">No Data Available</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-right">
    </div>
</div>
@else
<div class="card">
    <div class="card-header text-right">
        <div class="row">
            <div class="col-3">

            </div>
            <div class="col-6">
                <input type="text" wire:model="searchTerm" placeholder="Search Something..." class="form-control">
            </div>
            <div class="col-3">
                <button wire:click="openModal()" class="btn btn-dark"><i class="fas fa-plus pr-1"></i> Add New</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
        @foreach($lists as $list)
            <div class="col-xl-3 col-lg-4 col-md-6 col-12"
                style="align-items: center; text-align: center">
                @if(date('Y') != $list->tahun)
                <div style="background-color:gray; width: 200px; height: 250px; margin: 20px auto">
                @else
                <div style="background-color:chocolate; width: 200px; height: 250px; margin: 20px auto">
                @endif
                    <div>
                        <button wire:click="openDetail({{$list->id}})" class="btn btn-sm btn-success" style="width:auto; margin: 4px"><i class="fas fa-eye"></i></button>
                        <button wire:click="edit({{$list->id}})" class="btn btn-sm btn-info" style="width:auto; margin: 4px"><i class="fas fa-edit"></i></button>
                        <button wire:click="delete({{$list->id}})" class="btn btn-sm btn-danger" style="width:auto; margin: 4px" onclick="confirm('Are you sure to delete?') || event.stopImmediatePropagation()"><i class="fas fa-trash"></i></button>
                    </div>
                    <div style="padding:5px;color:white;">
                        <p>No. <br/> {{ $list->nomor }}</p>
                        <hr style="border: 1px solid white">
                        <p>{{ formatDate($list->mulai) }}<br/>
                            s/d<br/>
                            {{ formatDate($list->selesai) }}<br/>
                        </p>
                        <p>{{ $list->tahun }}</p>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>
@endif
