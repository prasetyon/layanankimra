@if($isOpen)
<div class="card">
    <div class="card-header">
        <button wire:click="closeModal()" class="btn btn-secondary"><i class="fas fa-angle-left pr-1"></i> Back</button>
    </div>
    <form method="POST" wire:submit.prevent="store()">
        <div class="card-body">
            <!-- String -->
            <div class="form-group col-12">
                <label for="input_kegiatan">Nama Kegiatan</label>
                <input type="text" wire:model="input_kegiatan" id="input_kegiatan" class="form-control @error('input_kegiatan') is-invalid @enderror">
                @error('input_kegiatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group col-12">
                <label for="input_tahun">Tahun Kegiatan</label>
                <input type="text" wire:model="input_tahun" id="input_tahun" class="form-control @error('input_tahun') is-invalid @enderror">
                @error('input_tahun') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="reset" class="btn btn-danger">Reset</button>
            <button type="button" wire:click.prevent="store()" class="btn btn-success">Save</button>
        </div>
    </form>
</div>
@elseif($isOpenChat)
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
                            <b>Kegiatan</b>
                        </div>
                        <div class="col-lg-10">
                            {{ $selectedData->kegiatan }}
                        </div>
                        <div class="col-lg-2">
                            <b>Tahun Kegiatan</b>
                        </div>
                        <div class="col-lg-10">
                            {{ $selectedData->tahun }}
                        </div>
                        <div class="col-lg-2">
                            <b>Proses</b>
                        </div>
                        <div class="col-lg-10">
                            {{ $input_type }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                @if($input_type == 'pelaksanaan')
                    @foreach ($selectedData->prosesPelaksanaan as $tt)
                    @if(in_array($loggedUser->role, ['admin', 'superuser']) || $loggedUser->es2 == $tt->to
                        || $loggedUser->id == $tt->from || $tt->to == 'all')
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-2">
                                {{ $tt->creator->name }} <br/>
                                {{ $tt->created_at }}
                            </div>
                            <div class="col-lg-10">
                                <p style="white-space:pre-wrap; word-wrap:break-word">{{ $tt->uraian }}</p>
                                @foreach($tt->file as $f)
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <a href={{$f->file}} target="_blank">{{ $f->name }}</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <hr/>
                    </div>
                    @endif
                    @endforeach
                @else
                    @foreach ($selectedData->prosesPelaporan as $tt)
                    @if(in_array($loggedUser->role, ['admin', 'superuser']) || $loggedUser->es2 == $tt->to
                        || $loggedUser->id == $tt->from || $tt->to == 'all')
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-2">
                                {{ $tt->creator->name }} <br/>
                                {{ $tt->created_at }}
                            </div>
                            <div class="col-lg-10">
                                <p style="white-space:pre-wrap; word-wrap:break-word">{{ $tt->uraian }}</p>
                                @foreach($tt->file as $f)
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <a href={{$f->file}} target="_blank">{{ $f->name }}</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <hr/>
                    </div>
                    @endif
                    @endforeach
                @endif
            </div>
        </div>
        @if(stripos($selectedData->status, 'selesai') === false)
        <div class="card-footer">
            <form wire:submit.prevent="storeProses()">
                <div style="margin-bottom:10px">
                    <textarea wire:model="input_uraian" class="form-control @error('input_uraian') is-invalid @enderror" rows="5"></textarea>
                    @error('input_uraian')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                @if(in_array($loggedUser->role, ['admin', 'superuser']))
                <div style="margin-bottom:10px">
                    <label class="font-weight-bold">Kirim ke</label><br/>
                    <select wire:model="input_to" class="form-control select2 @error('input_to') is-invalid @enderror" required="required">
                        <option value="all" selected="selected">Semua Auditee</option>
                        @foreach($selectedData->auditee as $t)
                            <option value="{{ $t->unit }}">{{ $t->unit }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div style="margin-bottom:10px">
                    <label class="font-weight-bold">File Pendukung</label><br>
                    <input type="file" wire:model="photos" multiple>
                    @error('photos.*') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class=" text-right">
                    <button type="button" wire:click.prevent="storeProses()" class="btn btn-success">Kirim Tanggapan</button>
                </div>
            </form>
        </div>
        @endif
    </div>
</div>
@elseif($isOpenAuditee)
<div class="card">
    <div class="card-header">
        <button wire:click="closeModal()" class="btn btn-secondary"><i class="fas fa-angle-left pr-1"></i> Back</button>
    </div>
    <form method="POST" wire:submit.prevent="storeAuditee()">
        <div class="card-body">
            <!-- String -->
            <div class="form-group col-12">
                <label for="input_unit">Unit</label>
                <select wire:model="input_unit" class="form-control select2 @error('input_unit') is-invalid @enderror" required="required">
                    <option value="" selected="selected">- Select -</option>
                    @foreach($listUnit as $t)
                        <option value="{{ $t->es2 }}">{{ $t->es2 }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="reset" class="btn btn-danger">Reset</button>
            <button type="button" wire:click.prevent="storeAuditee()" class="btn btn-success">Save</button>
        </div>
    </form>
</div>
@elseif($isOpenProses)
<div class="card">
    <div class="card-header">
        <button wire:click="closeModal()" class="btn btn-secondary"><i class="fas fa-angle-left pr-1"></i> Back</button>
    </div>
    <form method="POST" wire:submit.prevent="storeProses()">
        <div class="card-body">
            <!-- String -->
            <div class="form-group col-12">
                <label for="input_uraian">Uraian</label>
                <textarea wire:model="input_uraian" class="form-control @error('input_uraian') is-invalid @enderror" rows="10"></textarea>
                    @error('input_uraian') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group col-sm-6 col-12">
                <label class="font-weight-bold">File Pendukung</label><br/>
                <input type="file" wire:model="photos" multiple>
                @error('photos.*') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="reset" class="btn btn-danger">Reset</button>
            <button type="button" wire:click.prevent="storeProses()" class="btn btn-success">Save</button>
        </div>
    </form>
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
                        <th class="text-left">Kegiatan</th>
                        <th class="text-left">Auditee</th>
                        <th class="text-left">Perencanaan</th>
                        <th class="text-left">Pelaksanaan</th>
                        <th class="text-left">Pelaporan</th>
                        <th class="text-left">Status</th>
                        @if(in_array($loggedUser->role, ['admin', 'superuser']))
                        <th width="10%">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse($lists as $list)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-left">{{ $list->kegiatan.' ('.$list->tahun.')' }}</td>
                        <td class="text-left">
                            @foreach ($list->auditee as $item)
                                {{($loop->index+1).'. '}} {{ $item->unit }}
                                @if(in_array($loggedUser->role, ['admin', 'superuser']))
                                <a wire:click="deleteAuditee({{$item->id}})" style="color: red"
                                    wire:onclick="confirm('Are you sure to delete?') || event.stopImmediatePropagation()"> [delete]</a>
                                @endif
                                <br/>
                            @endforeach
                            @if(in_array($loggedUser->role, ['admin', 'superuser']))
                            <br/>
                            <p wire:click="openAuditee({{$list->id}})" style="color: blue;"> [tambah auditee]</p>
                            @endif
                        </td>
                        <td class="text-left">
                            @if($list->perencanaan)
                            <p style="white-space:pre-wrap; word-wrap:break-word">{{ $list->perencanaan->uraian }}</p>
                            File Pendukung :<br/>
                            @foreach ($list->perencanaan->file as $f)
                            <a href="{{$f->file}}" target="_blank" style="color: blue">{{$f->name}}</a>
                            @if(in_array($loggedUser->role, ['admin', 'superuser']))
                            <a wire:click="deleteFile({{$f->id}})" style="color: red"
                                wire:onclick="confirm('Are you sure to delete?') || event.stopImmediatePropagation()"> [delete]</a>
                            @endif
                            <br/>
                            @endforeach
                            @endif
                        </td>
                        <td class="text-left">
                            @if($list->pelaksanaan)
                            <p style="white-space:pre-wrap; word-wrap:break-word">{{ $list->pelaksanaan->uraian }}</p>
                            File Pendukung :<br/>
                            @foreach ($list->pelaksanaan->file as $f)
                            <a href="{{$f->file}}" target="_blank" style="color: blue">{{$f->name}}</a>
                            @if(in_array($loggedUser->role, ['admin', 'superuser']))
                            <a wire:click="deleteFile({{$f->id}})" style="color: red"
                                wire:onclick="confirm('Are you sure to delete?') || event.stopImmediatePropagation()"> [delete]</a>
                            @endif
                            <br/>
                            @endforeach
                            @endif
                            <br/>
                            @if($list->status == 'pelaporan' || $list->status == 'pelaksanaan' || $list->status == 'selesai')
                            <p wire:click="openChat({{$list->id}}, 'pelaksanaan', '{{$loggedUser->role}}')" style="color: blue;"> [lihat proses pelaksanaan]</p>
                            @endif
                        </td>
                        <td class="text-left">
                            @if($list->pelaporan)
                            <p style="white-space:pre-wrap; word-wrap:break-word">{{ $list->pelaporan->uraian }}</p>
                            File Pendukung :<br/>
                            @foreach ($list->pelaporan->file as $f)
                            <a href="{{$f->file}}" target="_blank" style="color: blue">{{$f->name}}</a>
                            @if(in_array($loggedUser->role, ['admin', 'superuser']))
                            <a wire:click="deleteFile({{$f->id}})" style="color: red"
                                wire:onclick="confirm('Are you sure to delete?') || event.stopImmediatePropagation()"> [delete]</a>
                            @endif
                            <br/>
                            @endforeach
                            @endif
                            <br/>
                            @if($list->status == 'pelaporan' || $list->status == 'selesai')
                            <p wire:click="openChat({{$list->id}}, 'pelaporan', '{{$loggedUser->role}}')" style="color: blue;"> [lihat proses pelaporan]</p>
                            @endif
                        </td>
                        <td class="text-left">{{ $list->status }}</td>
                        @if(in_array($loggedUser->role, ['admin', 'superuser']))
                        <td style="text-align: center;">
                                <button wire:click="openProses({{ $list->id }}, 'perencanaan')" class="btn btn-sm btn-secondary" style="width:auto; margin: 2px"><i class="fas fa-bullseye"></i></button>
                                <button wire:click="approve({{ $list->id }}, '{{ $list->status }}')" title="Approve" class="btn btn-sm btn-success" style="width:auto; margin: 2px" onclick="confirm('Are you sure to update status?') || event.stopImmediatePropagation()"><i class="fas fa-check"></i></button>
                                <button wire:click="edit({{ $list->id }})" class="btn btn-sm btn-warning" style="width:auto; margin: 2px"><i class="fas fa-edit"></i></button>
                                <button wire:click="delete({{ $list->id }})" class="btn btn-sm btn-danger" style="width:auto; margin: 2px" onclick="confirm('Are you sure to delete?') || event.stopImmediatePropagation()"><i class="fas fa-trash"></i></button>
                        </td>
                        @endif
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
