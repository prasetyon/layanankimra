@if($isOpen)
<div class="row">
    <div class="col-md-8 col-12">
        <div class="card">
            <div class="card-header">
                <button wire:click="closeModal()" class="btn btn-secondary"><i class="fas fa-angle-left pr-1"></i> Back</button>
            </div>
            <form wire:submit.prevent="store()">
                <div class="card-body">
                    <div class="form-group col-sm-12">
                        <label class="font-weight-bold">Tanggal</label>
                        <input type="date" wire:model="input_tanggal"
                            class="form-control @error('input_tanggal') is-invalid @enderror">
                        @error('input_tanggal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-12">
                        <label for="input_type">Jenis Perkara</label>
                        <select wire:model="input_type" class="form-control select2 @error('input_type') is-invalid @enderror" required="required">
                            <option value="" selected="selected">- Select -</option>
                            @foreach($listType as $t)
                                <option value="{{ $t->id }}">{{ $t->name }}</option>
                            @endforeach
                        </select>
                        @error('input_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group col-12">
                        <label for="input_unit">Unit</label>
                        <select wire:model="input_unit" class="form-control select2 @error('input_unit') is-invalid @enderror" required="required">
                            <option value="" selected="selected">- Select -</option>
                            @foreach($listUnit as $t)
                                <option value="{{ $t->es2 }}">{{ $t->es2 }}</option>
                            @endforeach
                        </select>
                        @error('input_unit') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group col-12">
                        <label for="input_perihal">Perihal</label>
                        <textarea wire:model="input_perihal" id="input_perihal" class="form-control @error('input_perihal') is-invalid @enderror" rows="10"></textarea>
                        @error('input_perihal') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group col-12">
                        <label for="input_keterangan">Keterangan</label>
                        <textarea wire:model="input_keterangan" id="input_keterangan" class="form-control @error('input_keterangan') is-invalid @enderror" rows="10"></textarea>
                        @error('input_keterangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div style="margin-bottom:10px">
                        <label class="font-weight-bold">File Pendukung</label><br>
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
    </div>

    @if(isset($input_id))
    <div class="col-md-4 col-12">
        <div class="card">
            <div class="card-header">
                <button wire:click="closeModal()" class="btn btn-secondary"><i class="fas fa-angle-left pr-1"></i> Back</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead class="text-center" >
                            <tr>
                                <th>No</th>
                                <th class="text-left">Nama File</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse($listFiles as $file)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-left"><a href={{$file->file}} target="_blank">{{ $file->name }}</a></td>
                                <td style="text-align: center; width:10%;">
                                    <button wire:click="deleteFile({{ $file->id }})" class="btn btn-sm btn-danger" style="width:auto; margin: 2px" onclick="confirm('Are you sure want to delete?') || event.stopImmediatePropagation()"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6">No File Uploaded</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
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
                        <th class="text-left">Tanggal</th>
                        <th class="text-left">Unit</th>
                        <th class="text-left">Jenis Perkara</th>
                        <th class="text-left">Perihal</th>
                        <th class="text-left">Keterangan</th>
                        <th class="text-left" width="10%">File</th>
                        @if(in_array($loggedUser->role, ['admin', 'superuser']))
                        <th width="10%">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse($lists as $list)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-left">{{ $list->tanggal }}</td>
                        <td class="text-left">{{ $list->unit }}</td>
                        <td class="text-left">{{ $list->jenisPerkara->name }}</td>
                        <td class="text-left" style="white-space:pre-wrap; word-wrap:break-word">{{ $list->perihal }}</td>
                        <td class="text-left" style="white-space:pre-wrap; word-wrap:break-word">{{ $list->keterangan }}</td>
                        <td class="text-left">
                            @foreach($list->file as $count => $f)
                            {{++$count.'. '}}<a href="{{$f->file}}" target="_blank">{{$f->name}}</a><br/>
                            @endforeach
                        </td>
                        @if(in_array($loggedUser->role, ['admin', 'superuser']))
                        <td style="text-align: center;">
                            <button wire:click="edit({{ $list->id }})" class="btn btn-sm btn-info" style="width:auto; margin: 2px"><i class="fas fa-edit"></i></button>
                            <button wire:click="delete({{ $list->id }})" class="btn btn-sm btn-danger" style="width:auto; margin: 2px" onclick="confirm('Are you sure to delete?') || event.stopImmediatePropagation()"><i class="fas fa-trash"></i></button>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">No Data Available</td>
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
