@include('layout.function')
@if($isOpen)
<div class="card">
    <div class="card-header">
        <button wire:click="closeModal()" class="btn btn-secondary"><i class="fas fa-angle-left pr-1"></i> Back</button>
    </div>
    <form method="POST" wire:submit.prevent="store()">
        <div class="card-body">
            <div class="form-group col-12">
                <label for="input_tahun">Tahun Kegiatan</label>
                <input type="text" wire:model="input_tahun" id="input_tahun" class="form-control @error('input_tahun') is-invalid @enderror">
                @error('input_tahun') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group col-12">
                <label for="input_aparat">Aparat Pemeriksa</label>
                <select wire:model="input_aparat" class="form-control select2 @error('input_aparat') is-invalid @enderror" required="required">
                    <option value="" selected="selected">- Select -</option>
                    @foreach($listAparatPemeriksa as $base)
                        <option value="{{ $base->id }}">{{ $base->name }}</option>
                    @endforeach
                </select>
                @error('input_aparat') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group col-12">
                <label for="input_jenis">Jenis</label>
                <select wire:model="input_jenis" class="form-control select2 @error('input_jenis') is-invalid @enderror" required="required">
                    <option value="" selected="selected">- Select -</option>
                    @foreach($listJenisPengawasan as $base)
                        <option value="{{ $base->id }}">{{ $base->name }}</option>
                    @endforeach
                </select>
                @error('input_jenis') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group col-12">
                <label for="input_kegiatan">Kegiatan</label>
                <input type="text" wire:model="input_kegiatan" id="input_kegiatan" class="form-control @error('input_kegiatan') is-invalid @enderror">
                @error('input_kegiatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group col-12">
                <label for="input_st">Surat Tugas</label>
                <input type="text" wire:model="input_st" id="input_st" class="form-control @error('input_st') is-invalid @enderror">
                @error('input_st') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group col-12">
                <label for="input_kontak">Kontak</label>
                <input type="text" wire:model="input_kontak" id="input_kontak" class="form-control @error('input_kontak') is-invalid @enderror">
                @error('input_kontak') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group col-12">
                <label for="input_jangka_waktu">Jangka Waktu (s.d.)</label>
                <input type="date" wire:model="input_jangka_waktu" class="form-control @error('input_jangka_waktu') is-invalid @enderror">
                @error('input_jangka_waktu') <div class="invalid-feedback"> {{ $message }}</div> @enderror
            </div>

            <div class="form-group col-sm-6 col-12">
                <label class="font-weight-bold">File Pendukung</label><br/>
                <input type="file" wire:model="photos" multiple>
                @error('photos.*') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="reset" class="btn btn-danger">Reset</button>
            <button type="button" wire:click.prevent="store()" class="btn btn-success">Save</button>
        </div>
    </form>
</div>
@elseif($isOpenMeeting)
<div class="card">
    <div class="card-header">
        <button wire:click="closeModalInput()" class="btn btn-secondary"><i class="fas fa-angle-left pr-1"></i> Back</button>
    </div>
    <form method="POST" wire:submit.prevent="storeMeeting()">
        <div class="card-body">
            <div class="form-group col-12">
                <label for="input_nd">ND</label>
                <input type="text" wire:model="input_nd" id="input_nd" class="form-control @error('input_nd') is-invalid @enderror">
                @error('input_nd') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group col-12">
                <label for="input_peserta">Peserta</label>
                <textarea wire:model="input_peserta" class="form-control @error('input_peserta') is-invalid @enderror" rows="4"></textarea>
                    @error('input_peserta') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group col-12">
                <label for="input_pelaksanaan">Pelaksanaan</label>
                <input type="date" wire:model="input_pelaksanaan" class="form-control @error('input_pelaksanaan') is-invalid @enderror">
                @error('input_pelaksanaan') <div class="invalid-feedback"> {{ $message }}</div> @enderror
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="reset" class="btn btn-danger">Reset</button>
            <button type="button" wire:click.prevent="storeMeeting()" class="btn btn-success">Save</button>
        </div>
    </form>
</div>
@elseif($isOpenUnit)
<div class="card">
    <div class="card-header">
        <button wire:click="closeModalInput()" class="btn btn-secondary"><i class="fas fa-angle-left pr-1"></i> Back</button>
    </div>
    <form method="POST" wire:submit.prevent="storeUnit()">
        <div class="card-body">
            <div class="form-group col-12">
                <label for="input_unit_req">Unit</label>
                @if(in_array($loggedUser->role, ['admin', 'superuser']))
                <select wire:model="input_unit_req" class="form-control select2 @error('input_unit_req') is-invalid @enderror" required="required">
                    <option value="" selected="selected">- Select -</option>
                    @foreach($listUnit as $t)
                        <option value="{{ $t->es2 }}">{{ $t->es2 }}</option>
                    @endforeach
                </select>
                @else
                <input type="text" wire:model="input_unit_req" id="input_unit_req" class="form-control @error('input_unit_req') is-invalid @enderror" readonly>
                @endif
                @error('input_unit_req') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group col-12">
                <label for="input_keterangan_req">Keterangan</label>
                <textarea wire:model="input_keterangan_req" id="input_keterangan_req" class="form-control @error('input_keterangan_req') is-invalid @enderror" rows="10"></textarea>
                @error('input_keterangan_req') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group col-12">
                <label for="input_status_req">Status</label>
                <select wire:model="input_status_req" class="form-control select2 @error('input_status_req') is-invalid @enderror" required="required">
                    <option value="" selected="selected">- Select -</option>
                    @if(in_array($loggedUser->role, ['admin', 'superuser']))
                    <option value="Menunggu Respon Unit">Menunggu Respon Unit</option>
                    @endif
                    <option value="Menunggu Respon Admin">Menunggu Respon Admin</option>
                    @if(in_array($loggedUser->role, ['admin', 'superuser']))
                    <option value="Diterima">Diterima</option>
                    @endif
                </select>
                @error('input_status_req') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group col-sm-6 col-12">
                <label class="font-weight-bold">File Pendukung</label><br/>
                <input type="file" wire:model="photos" multiple>
                @error('photos.*') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="reset" class="btn btn-danger">Reset</button>
            <button type="button" wire:click.prevent="storeUnit()" class="btn btn-success">Save</button>
        </div>
    </form>
</div>
@elseif($isOpenPermindok)
<div class="card">
    <div class="card-header">
        <button wire:click="closeModalInput()" class="btn btn-secondary"><i class="fas fa-angle-left pr-1"></i> Back</button>
    </div>
    <form method="POST" wire:submit.prevent="storePermindok()">
        <div class="card-body">
            <div class="form-group col-12">
                <label for="input_surat_permindok">Nomor Surat Permindok</label>
                <input type="text" wire:model="input_surat_permindok" id="input_surat_permindok" class="form-control @error('input_surat_permindok') is-invalid @enderror">
                @error('input_surat_permindok') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group col-12">
                <label for="input_nd_permindok">ND Permindok</label>
                <input type="text" wire:model="input_nd_permindok" id="input_nd_permindok" class="form-control @error('input_nd_permindok') is-invalid @enderror">
                @error('input_nd_permindok') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group col-12">
                <label for="input_deadline_permindok">Deadline</label>
                <input type="date" wire:model="input_deadline_permindok" class="form-control @error('input_deadline_permindok') is-invalid @enderror">
                @error('input_deadline_permindok') <div class="invalid-feedback"> {{ $message }}</div> @enderror
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="reset" class="btn btn-danger">Reset</button>
            <button type="button" wire:click.prevent="storePermindok()" class="btn btn-success">Save</button>
        </div>
    </form>
</div>
@elseif($isOpenEkspose)
<div class="card">
    <div class="card-header">
        <button wire:click="closeModalInput()" class="btn btn-secondary"><i class="fas fa-angle-left pr-1"></i> Back</button>
    </div>
    <form method="POST" wire:submit.prevent="storeEkspose()">
        <div class="card-body">
            <div class="form-group col-12">
                <label for="input_surat_ekspose">Nomor Surat Ekspose</label>
                <input type="text" wire:model="input_surat_ekspose" id="input_surat_ekspose" class="form-control @error('input_surat_ekspose') is-invalid @enderror">
                @error('input_surat_ekspose') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group col-12">
                <label for="input_und_ekspose">UND Ekspose</label>
                <input type="text" wire:model="input_und_ekspose" id="input_und_ekspose" class="form-control @error('input_und_ekspose') is-invalid @enderror">
                @error('input_und_ekspose') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group col-12">
                <label for="input_tanggal_ekspose">Tanggal</label>
                <input type="date" wire:model="input_tanggal_ekspose" class="form-control @error('input_tanggal_ekspose') is-invalid @enderror">
                @error('input_tanggal_ekspose') <div class="invalid-feedback"> {{ $message }}</div> @enderror
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="reset" class="btn btn-danger">Reset</button>
            <button type="button" wire:click.prevent="storeEkspose()" class="btn btn-success">Save</button>
        </div>
    </form>
</div>
@elseif($isOpenEkspose)
<div class="card">
    <div class="card-header">
        <button wire:click="closeModalInput()" class="btn btn-secondary"><i class="fas fa-angle-left pr-1"></i> Back</button>
    </div>
    <form method="POST" wire:submit.prevent="storeEkspose()">
        <div class="card-body">
            <div class="form-group col-12">
                <label for="input_surat_ekspose">Nomor Surat Ekspose</label>
                <input type="text" wire:model="input_surat_ekspose" id="input_surat_ekspose" class="form-control @error('input_surat_ekspose') is-invalid @enderror">
                @error('input_surat_ekspose') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group col-12">
                <label for="input_und_ekspose">UND Ekspose</label>
                <input type="text" wire:model="input_und_ekspose" id="input_und_ekspose" class="form-control @error('input_und_ekspose') is-invalid @enderror">
                @error('input_und_ekspose') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group col-12">
                <label for="input_tanggal_ekspose">Tanggal</label>
                <input type="date" wire:model="input_tanggal_ekspose" class="form-control @error('input_tanggal_ekspose') is-invalid @enderror">
                @error('input_tanggal_ekspose') <div class="invalid-feedback"> {{ $message }}</div> @enderror
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="reset" class="btn btn-danger">Reset</button>
            <button type="button" wire:click.prevent="storeEkspose()" class="btn btn-success">Save</button>
        </div>
    </form>
</div>
@elseif($isOpenUndangan)
<div class="card">
    <div class="card-header">
        <button wire:click="closeModalInput()" class="btn btn-secondary"><i class="fas fa-angle-left pr-1"></i> Back</button>
    </div>
    <form method="POST" wire:submit.prevent="storeUndangan()">
        <div class="card-body">
            <div class="form-group col-12">
                <label for="input_nomor_undangan">Undangan</label>
                <input type="text" wire:model="input_nomor_undangan" id="input_nomor_undangan" class="form-control @error('input_nomor_undangan') is-invalid @enderror">
                @error('input_nomor_undangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="reset" class="btn btn-danger">Reset</button>
            <button type="button" wire:click.prevent="storeUndangan()" class="btn btn-success">Save</button>
        </div>
    </form>
</div>
@elseif($isOpenKriteria || $isOpenHasil)
<div class="card">
    <div class="card-header">
        <button wire:click="closeModalInput()" class="btn btn-secondary"><i class="fas fa-angle-left pr-1"></i> Back</button>
    </div>
    <form method="POST" wire:submit.prevent="storeKriteria()">
        <div class="card-body">
            <div class="form-group col-12">
                <label for="input_surat_kriteria">Nomor Surat @if($isOpenKriteria) Kriteria @else Hasil Pemeriksaan @endif</label>
                <input type="text" wire:model="input_surat_kriteria" id="input_surat_kriteria" class="form-control @error('input_surat_kriteria') is-invalid @enderror">
                @error('input_surat_kriteria') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group col-12">
                <label for="input_nd_kriteria">ND @if($isOpenKriteria) Kriteria @else Hasil Pemeriksaan @endif</label>
                <input type="text" wire:model="input_nd_kriteria" id="input_nd_kriteria" class="form-control @error('input_nd_kriteria') is-invalid @enderror">
                @error('input_nd_kriteria') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group col-12">
                <label for="input_deadline_kriteria">Deadline</label>
                <input type="date" wire:model="input_deadline_kriteria" class="form-control @error('input_deadline_kriteria') is-invalid @enderror">
                @error('input_deadline_kriteria') <div class="invalid-feedback"> {{ $message }}</div> @enderror
            </div>
            <div class="form-group col-12">
                <label for="input_tanggapan_kriteria">Tanggapan @if($isOpenKriteria) Kriteria @else Hasil Pemeriksaan @endif</label>
                <input type="text" wire:model="input_tanggapan_kriteria" id="input_tanggapan_kriteria" class="form-control @error('input_tanggapan_kriteria') is-invalid @enderror">
                @error('input_tanggapan_kriteria') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group col-12">
                <label for="input_tanggal_kriteria">Tanggal Tanggapan</label>
                <input type="date" wire:model="input_tanggal_kriteria" class="form-control @error('input_tanggal_kriteria') is-invalid @enderror">
                @error('input_tanggal_kriteria') <div class="invalid-feedback"> {{ $message }}</div> @enderror
            </div>
            <div class="form-group col-sm-6 col-12">
                <label class="font-weight-bold">File Pendukung</label><br/>
                <input type="file" wire:model="photos" multiple>
                @error('photos.*') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="reset" class="btn btn-danger">Reset</button>
            <button type="button" wire:click.prevent="storeKriteria()" class="btn btn-success">Save</button>
        </div>
    </form>
</div>
@elseif($isDetail)
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-4 col-xs-4 col-4">
                <button wire:click="closeModal()" class="btn btn-secondary"><i class="fas fa-angle-left pr-1"></i> Back</button>
            </div>

            @if(in_array($loggedUser->role, ['admin', 'superuser']))
            <div class="col-md-8 col-xs-8 col-8">
                <div style="float:right">
                    <button wire:click="openMeeting({{ $selectedData }}, 'entry')"
                        style="margin-bottom:2px; margin-left:2px" class="col-xs-6 btn btn-success">
                        <i class="fas fa-sign-in-alt pr-1"></i> Entry Meeting
                    </button>
                    <button wire:click="openPermindok()"
                        style="margin-bottom:2px; margin-left:2px" class="col-xs-6 btn btn-info">
                        <i class="fas fa-file pr-1"></i> Permindok
                    </button>
                    <button wire:click="openEkspose()"
                        style="margin-bottom:2px; margin-left:2px" class="col-xs-6 btn btn-warning">
                        <i class="fas fa-users pr-1"></i> Ekspose
                    </button>
                    <button wire:click="openKriteria('D1')"
                        style="margin-bottom:2px; margin-left:2px" class="col-xs-6 btn btn-secondary">
                        <i class="fas fa-list pr-1"></i> Kriteria
                    </button>
                    <button wire:click="openKriteria('D2')"
                        style="margin-bottom:2px; margin-left:2px" class="col-xs-6 btn btn-primary">
                        <i class="fas fa-envelope pr-1"></i> Hasil Pemeriksaan
                    </button>
                    <button wire:click="openMeeting({{ $selectedData }}, 'exit')"
                        style="margin-bottom:2px; margin-left:2px" class="col-xs-6 btn btn-danger">
                        <i class="fas fa-sign-out-alt pr-1"></i> Exit Meeting
                    </button>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="card-body">
        <div class="card card-outline card-purple">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-2">
                        <b>Tahun Kegiatan</b>
                    </div>
                    <div class="col-lg-4">
                        {{ $selectedData->tahun }}
                    </div>
                    <div class="col-lg-2">
                        <b>Aparat Pengawas</b>
                    </div>
                    <div class="col-lg-4">
                        {{ $selectedData->aparatPemeriksa->name }}
                    </div>
                    <div class="col-lg-2">
                        <b>Kegiatan</b>
                    </div>
                    <div class="col-lg-4">
                        {{ $selectedData->kegiatan }}
                    </div>
                    <div class="col-lg-2">
                        <b>Jenis Pengawasan</b>
                    </div>
                    <div class="col-lg-4">
                        {{ $selectedData->jenisPengawasan->name }}
                    </div>
                    <div class="col-lg-2">
                        <b>Kontak</b>
                    </div>
                    <div class="col-lg-4">
                        {{ $selectedData->kontak }}
                    </div>
                </div>
            </div>
        </div>

        <div class="card-group" style="margin-top: 5px">
            <div class="card card-outline card-purple">
                <div class="card-body">
                    <h5 class="card-title"><b>Surat Tugas</b></h5>
                    <p class="card-text">
                        ST: {{ $selectedData->st }} <br/>
                        Jangka Waktu: s/d {{ formatDate($selectedData->jangka_waktu) }}
                    </p>
                    <p class="card-text">
                        File Pendukung : <br/>
                        @foreach($selectedData->file as $f)
                        <a href="{{$f->file}}" target="_blank" style="color: blue">{{$f->name}}</a>
                        @if(in_array($loggedUser->role, ['admin', 'superuser']))
                            <a wire:click="deleteFile({{$f->id}})" style="color: red"
                                wire:onclick="confirm('Are you sure to delete?') || event.stopImmediatePropagation()"> [delete]</a>
                        @endif
                        <br/>
                        @endforeach
                    </p>
                </div>
            </div>
            <div class="card card-outline card-success" style="margin-left: 5px; margin-right: 5px">
                <div class="card-body">
                    <h5 class="card-title"><b>Entry Meeting</b></h5>
                    <p class="card-text">
                        ND: {{ $selectedData->nd_entry }} <br/>
                        Pelaksanaan: {{ formatDate($selectedData->tanggal_entry) }}
                    </p>
                    <p class="card-text" style="white-space:pre-wrap; word-wrap:break-word">Peserta :<br/>{{ $selectedData->peserta_entry }}</p>
                </div>
            </div>
            <div class="card card-outline card-danger">
                <div class="card-body">
                    <h5 class="card-title"><b>Exit Meeting</b></h5>
                    <p class="card-text">
                        ND: {{ $selectedData->nd_exit }} <br/>
                        Pelaksanaan: {{ formatDate($selectedData->tanggal_exit) }}
                    </p>
                    <p class="card-text" style="white-space:pre-wrap; word-wrap:break-word">Peserta :<br/>{{ $selectedData->peserta_exit }}</p>
                </div>
            </div>
        </div>

        <div class="card card-outline card-info" style="margin-top: 20px">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <b>Lalu Lintas Data / Dokumen ({{$selectedData->permindok->count()}})</b>
                        <a wire:click="showMenu('permindok')" style="color: blue"> [@if(!$showPermindok) show @else hide @endif]</a>
                    </div>
                </div>
            </div>
        </div>

        @if($showPermindok)
        <div class="card card-outline card-info" style="margin-top: 5px">
            @foreach ($selectedData->permindok as $permindok)
            <div class="card-body">
                <h5 class="card-title">Permindok
                    <b>{{ $permindok->surat }}</b>
                    @if(in_array($loggedUser->role, ['admin', 'superuser']))
                    <a wire:click="openPermindok({{$permindok->id}})" style="color: blue"> [edit]</a>
                    @endif
                </h5>
                <p class="card-text">
                    ND: {{ $permindok->nd }} <br/>
                    Deadline: {{ formatDate($permindok->deadline) }}
                </p>
                <div class="row" style="margin-bottom: 5px">
                    <p class="card-text col-md-2 col-xs-3" style="margin-bottom: 0"><b>Unit Tujuan</b></p>
                    <p class="card-text col-md-2 col-xs-3" style="margin-bottom: 0"><b>File</b></p>
                    <p class="card-text col-md-2 col-xs-2" style="margin-bottom: 0"><b>Status</b></p>
                    <p class="card-text col-md-2 col-xs-2" style="margin-bottom: 0"><b>Keterangan</b></p>
                    <p class="card-text col-md-2 col-xs-2" style="margin-bottom: 0"><b>Aksi</b></p>
                </div>

                @foreach ($permindok->requestUnit as $reqUnit)
                <div class="row" style="margin-bottom: 5px">
                    <p class="card-text col-md-2 col-xs-3" style="margin-bottom: 0">{{ $reqUnit->unit }} <br/> {{ $reqUnit->updated_at }}</p>
                    <p class="card-text col-md-2 col-xs-3" style="margin-bottom: 0">
                        @foreach ($reqUnit->file as $f)
                        <a href="{{$f->file}}" target="_blank" style="color: blue">{{$f->name}}</a><br/>
                        @endforeach
                    </p>
                    <p class="card-text col-md-2 col-xs-2" style="margin-bottom: 0">{{ $reqUnit->status }}</p>
                    <p class="card-text col-md-2 col-xs-2" style="margin-bottom: 0">{{ $reqUnit->keterangan }}</p>
                    <p class="card-text col-md-2 col-xs-2" style="margin-bottom: 0">
                        @if($loggedUser->es2==$reqUnit->unit || in_array($loggedUser->role, ['admin', 'superuser']))
                        <a wire:click="openUnit('B', {{$permindok->id}}, {{$reqUnit->id}})" style="color: blue"> [edit]</a>
                        @endif
                    </p>
                </div>
                @endforeach
                @if(in_array($loggedUser->role, ['admin', 'superuser']))
                <a wire:click="openUnit('B', {{$permindok->id}})" style="color: blue"> [tambah unit tujuan]</a>
                @endif
            </div>
            <hr/>
            @endforeach
        </div>
        @endif

        <div class="card card-outline card-warning" style="margin-top: 20px">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <b>Ekspose ({{$selectedData->ekspose->count()}})</b>
                        <a wire:click="showMenu('ekspose')" style="color: blue"> [@if(!$showEkspose) show @else hide @endif]</a>
                    </div>
                </div>
            </div>
        </div>

        @if($showEkspose)
        <div class="card card-outline card-warning" style="margin-top: 5px">
            @foreach ($selectedData->ekspose as $ekspose)
            <div class="card-body">
                <h5 class="card-title">Ekspose
                    <b>{{ $ekspose->surat }}</b>
                    @if(in_array($loggedUser->role, ['admin', 'superuser']))
                    <a wire:click="openEkspose({{$ekspose->id}})" style="color: blue"> [edit]</a>
                    @endif
                </h5>
                <p class="card-text">
                    UND: {{ $ekspose->und }} <br/>
                    Deadline: {{ formatDate($ekspose->tanggal) }}
                </p>
                <div class="row" style="margin-bottom: 5px">
                    <p class="card-text col-md-2 col-xs-3" style="margin-bottom: 0"><b>Unit Tujuan</b></p>
                    <p class="card-text col-md-2 col-xs-3" style="margin-bottom: 0"><b>File</b></p>
                    <p class="card-text col-md-2 col-xs-2" style="margin-bottom: 0"><b>Status</b></p>
                    <p class="card-text col-md-2 col-xs-2" style="margin-bottom: 0"><b>Keterangan</b></p>
                    <p class="card-text col-md-2 col-xs-2" style="margin-bottom: 0"><b>Aksi</b></p>
                </div>

                @foreach ($ekspose->requestUnit as $reqUnit)
                <div class="row" style="margin-bottom: 5px">
                    <p class="card-text col-md-2 col-xs-3" style="margin-bottom: 0">{{ $reqUnit->unit }} <br/> {{ $reqUnit->updated_at }}</p>
                    <p class="card-text col-md-2 col-xs-3" style="margin-bottom: 0">
                        @foreach ($reqUnit->file as $f)
                        <a href="{{$f->file}}" target="_blank" style="color: blue">{{$f->name}}</a><br/>
                        @endforeach
                    </p>
                    <p class="card-text col-md-2 col-xs-2" style="margin-bottom: 0">{{ $reqUnit->status }}</p>
                    <p class="card-text col-md-2 col-xs-2" style="margin-bottom: 0">{{ $reqUnit->keterangan }}</p>
                    <p class="card-text col-md-2 col-xs-2" style="margin-bottom: 0">
                        @if($loggedUser->es2==$reqUnit->unit || in_array($loggedUser->role, ['admin', 'superuser']))
                        <a wire:click="openUnit('C', {{$ekspose->id}}, {{$reqUnit->id}})" style="color: blue"> [edit]</a>
                        @endif
                    </p>
                </div>
                @endforeach
                @if(in_array($loggedUser->role, ['admin', 'superuser']))
                <a wire:click="openUnit('C', {{$ekspose->id}})" style="color: blue"> [tambah unit tujuan]</a>
                @endif
            </div>
            <hr/>
            @endforeach
        </div>
        @endif

        <div class="card card-outline card-secondary" style="margin-top: 20px">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <b>Kriteria ({{$selectedData->kriteria->count()}})</b>
                        <a wire:click="showMenu('kriteria')" style="color: blue"> [@if(!$showKriteria) show @else hide @endif]</a>
                    </div>
                </div>
            </div>
        </div>

        @if($showKriteria)
        <div class="card card-outline card-secondary" style="margin-top: 5px">
            @foreach ($selectedData->kriteria as $kriteria)
            <div class="card-body">
                <h5 class="card-title">Kriteria
                    <b>{{ $kriteria->surat }}</b>
                    @if(in_array($loggedUser->role, ['admin', 'superuser']))
                    <a wire:click="openKriteria('D1', {{$kriteria->id}})" style="color: blue"> [edit]</a>
                    @endif
                </h5>
                <p class="card-text">
                    ND: {{ $kriteria->nd }} <br/>
                    Deadline: {{ formatDate($kriteria->deadline) }}
                    <br/><br/>
                    <b>Tanggapan / Penyampaian</b> <br/>
                    {{ $kriteria->tanggapan }} <br/>
                    {{ formatDate($kriteria->tanggal_tanggapan) }}<br/>
                    @foreach($kriteria->file as $f)
                    <a href="{{$f->file}}" target="_blank" style="color: blue">{{$f->name}}</a>
                    @if(in_array($loggedUser->role, ['admin', 'superuser']))
                        <a wire:click="deleteFile({{$f->id}})" style="color: red"
                            wire:onclick="confirm('Are you sure to delete?') || event.stopImmediatePropagation()"> [delete]</a>
                    @endif
                    <br/>
                    @endforeach
                </p>
                <br/>
                @foreach ($kriteria->requestUndangan as $reqUndangan)
                    <div class="row" style="margin-bottom: 5px; margin-top:15px">
                        <div class="col-12">
                            <h6 class="card-title">Undangan
                                <b>{{ $reqUndangan->und }}</b>
                                @if(in_array($loggedUser->role, ['admin', 'superuser']))
                                <a wire:click="openUndangan('D1', {{$kriteria->id}}, {{$reqUndangan->id}})" style="color: blue"> [edit]</a>
                                @endif
                            </h6>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 5px">
                        <p class="card-text col-md-2 col-xs-3" style="margin-bottom: 0"><b>Unit Tujuan</b></p>
                        <p class="card-text col-md-2 col-xs-3" style="margin-bottom: 0"><b>File</b></p>
                        <p class="card-text col-md-2 col-xs-2" style="margin-bottom: 0"><b>Status</b></p>
                        <p class="card-text col-md-2 col-xs-2" style="margin-bottom: 0"><b>Keterangan</b></p>
                        <p class="card-text col-md-2 col-xs-2" style="margin-bottom: 0"><b>Aksi</b></p>
                    </div>

                    @foreach ($reqUndangan->requestUnit as $reqUnit)
                    <div class="row" style="margin-bottom: 5px">
                        <p class="card-text col-md-2 col-xs-3" style="margin-bottom: 0">{{ $reqUnit->unit }} <br/> {{ $reqUnit->updated_at }}</p>
                        <p class="card-text col-md-2 col-xs-3" style="margin-bottom: 0">
                            @foreach ($reqUnit->file as $f)
                            <a href="{{$f->file}}" target="_blank" style="color: blue">{{$f->name}}</a><br/>
                            @endforeach
                        </p>
                        <p class="card-text col-md-2 col-xs-2" style="margin-bottom: 0">{{ $reqUnit->status }}</p>
                        <p class="card-text col-md-2 col-xs-2" style="margin-bottom: 0">{{ $reqUnit->keterangan }}</p>
                        <p class="card-text col-md-2 col-xs-2" style="margin-bottom: 0">
                            @if($loggedUser->es2==$reqUnit->unit || in_array($loggedUser->role, ['admin', 'superuser']))
                            <a wire:click="openUnit('D1', {{$reqUndangan->id}}, {{$reqUnit->id}})" style="color: blue"> [edit]</a>
                            @endif
                        </p>
                    </div>
                    @endforeach
                    @if(in_array($loggedUser->role, ['admin', 'superuser']))
                    <p wire:click="openUnit('D1', {{$reqUndangan->id}})" style="color: blue;"> [tambah unit tujuan]</p>
                    @endif
                @endforeach
                <br/>
                @if(in_array($loggedUser->role, ['admin', 'superuser']))
                <a wire:click="openUndangan('D1', {{$kriteria->id}})" style="color: blue" style="margin-top: 15px"> [tambah undangan baru]</a>
                @endif
            </div>
            <hr/>
            @endforeach
        </div>
        @endif

        <div class="card card-outline card-primary" style="margin-top: 20px">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <b>Penyampaian Hasil Pemeriksaan ({{$selectedData->hasil->count()}})</b>
                        <a wire:click="showMenu('hasil')" style="color: blue"> [@if(!$showHasil) show @else hide @endif]</a>
                    </div>
                </div>
            </div>
        </div>

        @if($showHasil)
        <div class="card card-outline card-primary" style="margin-top: 5px">
            @foreach ($selectedData->hasil as $hasil)
            <div class="card-body">
                <h5 class="card-title">Penyampaian Hasil Pemeriksaan
                    <b>{{ $hasil->surat }}</b>
                    @if(in_array($loggedUser->role, ['admin', 'superuser']))
                    <a wire:click="openKriteria('D2', {{$hasil->id}})" style="color: blue"> [edit]</a>
                    @endif
                </h5>
                <p class="card-text">
                    ND: {{ $hasil->nd }} <br/>
                    Deadline: {{ formatDate($hasil->deadline) }}
                    <br/><br/>
                    <b>Tanggapan / Penyampaian</b> <br/>
                    {{ $hasil->tanggapan }} <br/>
                    {{ formatDate($hasil->tanggal_tanggapan) }}<br/>
                    @foreach($hasil->file as $f)
                    <a href="{{$f->file}}" target="_blank" style="color: blue">{{$f->name}}</a>
                    @if(in_array($loggedUser->role, ['admin', 'superuser']))
                        <a wire:click="deleteFile({{$f->id}})" style="color: red"
                            wire:onclick="confirm('Are you sure to delete?') || event.stopImmediatePropagation()"> [delete]</a>
                    @endif
                    <br/>
                    @endforeach
                </p>
                @foreach ($hasil->requestUndangan as $reqUndangan)
                    <div class="row" style="margin-bottom: 5px; margin-top:15px">
                        <div class="col-12">
                            <h6 class="card-title">Undangan
                                <b>{{ $reqUndangan->und }}</b>
                                @if(in_array($loggedUser->role, ['admin', 'superuser']))
                                <a wire:click="openUndangan('D2', {{$hasil->id}}, {{$reqUndangan->id}})" style="color: blue"> [edit]</a>
                                @endif
                            </h6>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 5px">
                        <p class="card-text col-md-2 col-xs-3" style="margin-bottom: 0"><b>Unit Tujuan</b></p>
                        <p class="card-text col-md-2 col-xs-3" style="margin-bottom: 0"><b>File</b></p>
                        <p class="card-text col-md-2 col-xs-2" style="margin-bottom: 0"><b>Status</b></p>
                        <p class="card-text col-md-2 col-xs-2" style="margin-bottom: 0"><b>Keterangan</b></p>
                        <p class="card-text col-md-2 col-xs-2" style="margin-bottom: 0"><b>Aksi</b></p>
                    </div>

                    @foreach ($reqUndangan->requestUnit as $reqUnit)
                    <div class="row" style="margin-bottom: 5px">
                        <p class="card-text col-md-2 col-xs-3" style="margin-bottom: 0">{{ $reqUnit->unit }} <br/> {{ $reqUnit->updated_at }}</p>
                        <p class="card-text col-md-2 col-xs-3" style="margin-bottom: 0">
                            @foreach ($reqUnit->file as $f)
                            <a href="{{$f->file}}" target="_blank" style="color: blue">{{$f->name}}</a><br/>
                            @endforeach
                        </p>
                        <p class="card-text col-md-2 col-xs-2" style="margin-bottom: 0">{{ $reqUnit->status }}</p>
                        <p class="card-text col-md-2 col-xs-2" style="margin-bottom: 0">{{ $reqUnit->keterangan }}</p>
                        <p class="card-text col-md-2 col-xs-2" style="margin-bottom: 0">
                            @if($loggedUser->es2==$reqUnit->unit || in_array($loggedUser->role, ['admin', 'superuser']))
                            <a wire:click="openUnit('D2', {{$reqUndangan->id}}, {{$reqUnit->id}})" style="color: blue"> [edit]</a>
                            @endif
                        </p>
                    </div>
                    @endforeach
                    @if(in_array($loggedUser->role, ['admin', 'superuser']))
                    <p wire:click="openUnit('D2', {{$reqUndangan->id}})" style="color: blue;"> [tambah unit tujuan]</p>
                    @endif
                @endforeach
                <br/>
                @if(in_array($loggedUser->role, ['admin', 'superuser']))
                <a wire:click="openUndangan('D2', {{$hasil->id}})" style="color: blue" style="margin-top: 15px"> [tambah undangan baru]</a>
                @endif
            </div>
            <hr/>
            @endforeach
        </div>
        @endif
    </div>
</div>
@else
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
                <thead class="text-center">
                    <tr>
                        <th width="5%">No</th>
                        <th class="text-left">Tahun Kegiatan</th>
                        <th class="text-left">Aparat Pengawas</th>
                        <th class="text-left">Jenis Pengawasan</th>
                        <th class="text-left">Kegiatan</th>
                        <th class="text-left">ST</th>
                        <th class="text-left">Kontak</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse($lists as $list)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-left">{{ $list->tahun }}</td>
                        <td class="text-left">{{ $list->aparatPemeriksa->name }}</td>
                        <td class="text-left">{{ $list->jenisPengawasan->name }}</td>
                        <td class="text-left">{{ $list->kegiatan }}</td>
                        <td class="text-left">{{ $list->st }}</td>
                        <td class="text-left">{{ $list->kontak }}</td>
                        <td style="text-align: center;">
                            <button wire:click="openDetail({{ $list->id }})" class="btn btn-sm btn-primary" style="width:auto; margin: 2px"><i class="fas fa-eye"></i></button>

                            @if(in_array($loggedUser->role, ['admin', 'superuser']))
                            <button wire:click="edit({{ $list->id }})" class="btn btn-sm btn-info" style="width:auto; margin: 2px"><i class="fas fa-edit"></i></button>
                            <button wire:click="delete({{ $list->id }})" class="btn btn-sm btn-danger" style="width:auto; margin: 2px" onclick="confirm('Are you sure to delete?') || event.stopImmediatePropagation()"><i class="fas fa-trash"></i></button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">No Data Available</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($lists->hasPages())
            {{ $lists->links() }}
        @endif
    </div>
</div>
@endif
