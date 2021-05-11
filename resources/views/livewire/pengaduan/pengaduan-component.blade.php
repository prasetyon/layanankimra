<div class="row">
    @if($isOpen)
    <div class="col-xl-12 col-12">
        <div class="card">
            <div class="card-header">
                <button wire:click="closeModal()" class="btn btn-secondary"><i class="fas fa-angle-left pr-1"></i> Back</button>
            </div>
            <form wire:submit.prevent="store()">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-lg-6 col-sm-12">
                            <label for="input_type">Jenis Laporan</label>
                            <select wire:model="input_type" class="form-control select2 @error('input_type') is-invalid @enderror" required="required">
                                <option value="" selected="selected">- Select -</option>
                                @foreach($listTypes as $t)
                                    <option value="{{ $t->id }}">{{ $t->name }}</option>
                                @endforeach
                            </select>
                            @error('input_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group col-lg-6 col-sm-12">
                            <label class="font-weight-bold">Tanggal Kejadian</label>
                            <input type="date" wire:model="input_tanggal"
                                class="form-control @error('input_tanggal') is-invalid @enderror">
                            @error('input_tanggal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6 col-sm-12">
                            <label class="font-weight-bold">Perihal</label>
                            <input type="text" wire:model="input_perihal"
                                class="form-control @error('input_perihal') is-invalid @enderror">
                            @error('input_perihal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6 col-sm-12">
                            <label class="font-weight-bold">Lokasi Kejadian</label>
                            <input type="text" wire:model="input_lokasi"
                                class="form-control @error('input_lokasi') is-invalid @enderror">
                            @error('input_lokasi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6 col-sm-12">
                            <label class="font-weight-bold">Pihak yang Terlibat</label>
                            <textarea wire:model="input_pihak" class="form-control @error('input_pihak') is-invalid @enderror" rows="5"></textarea>
                            @error('input_pihak')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6 col-sm-12">
                            <label class="font-weight-bold">Kronologi Kejadian</label>
                            <textarea wire:model="input_kronologi" class="form-control @error('input_kronologi') is-invalid @enderror" rows="5"></textarea>
                            @error('input_kronologi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6 col-sm-12">
                            <label class="font-weight-bold">Motif Kejadian</label>
                            <textarea wire:model="input_motif" class="form-control @error('input_motif') is-invalid @enderror" rows="5"></textarea>
                            @error('input_motif')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        @if(!$this->input_id)
                        <div class="form-group col-lg-6 col-sm-12">
                            <label class="font-weight-bold">File Pendukung</label><br/>
                            <input type="file" wire:model="photos" multiple>
                            @error('photos.*') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="button" wire:click.prevent="store()" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
    @elseif($isTimeline)
    <div wire:poll class="col-xl-12 col-12">
        <div class="card">
            <div class="card-header">
                <button wire:click="closeModal()" class="btn btn-secondary"><i class="fas fa-angle-left pr-1"></i> Back</button>
            </div>
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-2">
                                <b>Judul Laporan</b>
                            </div>
                            <div class="col-lg-10">
                                {{ $selectedAduan->perihal }}
                            </div>
                            <div class="col-lg-2">
                                <b>Tanggal Terlapor</b>
                            </div>
                            <div class="col-lg-10">
                                {{ $selectedAduan->tanggal }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($selectedAduan->data as $tt)
                    <div class="col-lg-12" style="margin-bottom: 20px">
                        <div class="row">
                            <div class="col-lg-2">
                                {{ $tt->creator->name }} <br/>
                                {{ $tt->created_at }}
                            </div>
                            <div class="col-lg-10">
                                <p style="white-space:pre-wrap; word-wrap:break-word">{{ $tt->tanggapan }}</p>
                                @foreach($tt->file as $f)
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <a href={{$f->file}} target="_blank">{{ $f->name }}</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @if(stripos($selectedAduan->status, 'selesai') === false)
            <div class="card-footer">
                <form wire:submit.prevent="storeSidang()">
                    <div style="margin-bottom:10px">
                        <textarea wire:model="tanggapan" class="form-control @error('tanggapan') is-invalid @enderror" rows="2"></textarea>
                        @error('tanggapan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div style="margin-bottom:10px">
                        <label class="font-weight-bold">File Pendukung</label><br>
                        <input type="file" wire:model="photos" multiple>
                        @error('photos.*') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class=" text-right">
                        <button type="button" wire:click.prevent="storeSidang()" class="btn btn-success">Kirim Tanggapan</button>
                    </div>
                </form>
            </div>
            @endif
        </div>
    </div>
    @else
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <button wire:click="create()" class="btn btn-dark"><i class="fas fa-plus pr-1"></i> Add New</button>
                    </div>
                    <div class="col-6">
                        <input type="text" wire:model="searchTerm" placeholder="Search Something..." class="form-control">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead class="text-center" >
                            <tr>
                                <th>No</th>
                                <th class="text-left">Perihal</th>
                                <th class="text-left">Pihak Terlibat</th>
                                <th class="text-left">Tanggal Kejadian</th>
                                <th class="text-left">Lokasi Kejadian</th>
                                <th class="text-left">Kronologis</th>
                                <th class="text-left">Motif</th>
                                <th class="text-left">Pelapor</th>
                                <th class="text-left">Jenis Laporan</th>
                                <th class="text-left">Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse($lists as $list)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-left">{{ $list->perihal }}</td>
                                <td class="text-left">{{ $list->pihak }}</td>
                                <td class="text-left">{{ $list->tanggal }}</td>
                                <td class="text-left" style="white-space:pre-wrap; word-wrap:break-word">{{ $list->lokasi }}</td>
                                <td class="text-left" style="white-space:pre-wrap; word-wrap:break-word">{{ $list->kronologi }}</td>
                                <td class="text-left" style="white-space:pre-wrap; word-wrap:break-word">{{ $list->motif }}</td>
                                <td class="text-left">
                                    {{ $list->creator->name }} <br/>
                                    {{ $list->creator->email }} <br/>
                                    {{ $list->creator->nik }} <br/>
                                    {{ $list->creator->phone }} <br/>
                                </td>
                                <td class="text-left">{{ $list->jenisAduan->name }}</td>
                                <td class="text-left">{{ $list->status }}</td>
                                <td style="text-align: center; width:10%;">
                                    @if(stripos($list->status, 'on progress')!==false)
                                    <button wire:click="openTimeline({{ $list->id }})" title="Lihat Timeline" class="btn btn-sm btn-primary" style="width:auto; margin: 2px"><i class="fas fa-comments"></i></button>
                                    @endif

                                    @if(($loggedUser->role == 'admin' || $loggedUser->role == 'superuser') && stripos($list->status, 'selesai') === false)
                                        <button wire:click="approve({{ $list->id }}, '{{ $list->status }}')" title="Approve" class="btn btn-sm btn-success" style="width:auto; margin: 2px" onclick="confirm('Are you sure to update status?') || event.stopImmediatePropagation()"><i class="fas fa-check"></i></button>
                                        <button wire:click="edit({{ $list->id }})" title="Ubah Data" class="btn btn-sm btn-warning" style="width:auto; margin: 2px"><i class="fas fa-edit"></i></button>
                                        <button wire:click="delete({{ $list->id }})" title="Hapus Data" class="btn btn-sm btn-danger" style="width:auto; margin: 2px" onclick="confirm('Are you sure to delete?') || event.stopImmediatePropagation()"><i class="fas fa-trash"></i></button>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="11">No Data Recorded</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($lists->hasPages())
                    {{ $lists->links() }}
                @endif
            </div>
        </div>
    </div>
    @endif
</div>
