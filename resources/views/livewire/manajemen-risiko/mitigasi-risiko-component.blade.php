@if($isOpen)
<div class="card">
    <div class="card-header">
        <button wire:click="closeModal()" class="btn btn-secondary"><i class="fas fa-angle-left pr-1"></i> Back</button>
    </div>
    <form method="POST" wire:submit.prevent="store()">
        <div class="card-body">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="input_unit">Unit</label>
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
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="input_tahun">Tahun</label>
                <div class="col-sm-10">
                    <input type="text" wire:model="input_tahun" id="input_tahun" class="form-control @error('input_tahun') is-invalid @enderror">
                    @error('input_tahun') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="input_kejadian">Kejadian Risiko</label>
                <div class="col-sm-10">
                    <textarea wire:model="input_kejadian" class="form-control @error('input_kejadian') is-invalid @enderror" rows="4"></textarea>
                    @error('input_kejadian') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="input_opsi">Opsi Mitigasi Risiko</label>
                <div class="col-sm-10">
                    <textarea wire:model="input_opsi" class="form-control @error('input_opsi') is-invalid @enderror" rows="4"></textarea>
                    @error('input_opsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="input_rencana_aksi">Rencana Aksi Mitigasi Risiko</label>
                <div class="col-sm-10">
                    <textarea wire:model="input_rencana_aksi" class="form-control @error('input_rencana_aksi') is-invalid @enderror" rows="4"></textarea>
                    @error('input_rencana_aksi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="input_output">Output</label>
                <div class="col-sm-10">
                    <textarea wire:model="input_output" class="form-control @error('input_output') is-invalid @enderror" rows="4"></textarea>
                    @error('input_output') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="input_target">Target</label>
                <div class="col-sm-10">
                    <textarea wire:model="input_target" class="form-control @error('input_target') is-invalid @enderror" rows="4"></textarea>
                    @error('input_target') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="input_kendala">Kendala</label>
                <div class="col-sm-10">
                    <textarea wire:model="input_kendala" class="form-control @error('input_kendala') is-invalid @enderror" rows="4"></textarea>
                    @error('input_kendala') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="input_sumberdaya">Sumber Daya yang Dibutuhkan</label>
                <div class="col-sm-10">
                    <textarea wire:model="input_sumberdaya" class="form-control @error('input_sumberdaya') is-invalid @enderror" rows="4"></textarea>
                    @error('input_sumberdaya') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="input_jadwal">Jadwal Implementasi</label>
                <div class="col-sm-10">
                    <textarea wire:model="input_jadwal" class="form-control @error('input_jadwal') is-invalid @enderror" rows="4"></textarea>
                    @error('input_jadwal') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="input_penanggung_jawab">Penanggung Jawab</label>
                <div class="col-sm-10">
                    <textarea wire:model="input_penanggung_jawab" class="form-control @error('input_penanggung_jawab') is-invalid @enderror" rows="4"></textarea>
                    @error('input_penanggung_jawab') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="reset" class="btn btn-danger">Reset</button>
            <button type="button" wire:click.prevent="store()" class="btn btn-success">Save</button>
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
                        <th width="5%" rowspan="2">No</th>
                        <th width="15%" rowspan="2">Kejadian Risiko</th>
                        <th colspan="8">Rencana Mitigasi</th>
                        <th width="5%" rowspan="2">Action</th>
                    </tr>
                    <tr>
                        <th>Opsi Mitigasi Risiko</th>
                        <th>Rencana Aksi Mitigasi Risiko</th>
                        <th>Output</th>
                        <th>Target</th>
                        <th>Kendala</th>
                        <th>Sumber Daya yang Dibutuhkan</th>
                        <th>Jadwal Implementasi</th>
                        <th>Penanggung Jawab</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse($lists as $list)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-left" style="white-space:pre-wrap; word-wrap:break-word">{{ $list->kejadian }}</td>
                        <td class="text-left" style="white-space:pre-wrap; word-wrap:break-word">{{ $list->opsi }}</td>
                        <td class="text-left" style="white-space:pre-wrap; word-wrap:break-word">{{ $list->rencana_aksi }}</td>
                        <td class="text-left" style="white-space:pre-wrap; word-wrap:break-word">{{ $list->output }}</td>
                        <td class="text-left" style="white-space:pre-wrap; word-wrap:break-word">{{ $list->target }}</td>
                        <td class="text-left" style="white-space:pre-wrap; word-wrap:break-word">{{ $list->kendala }}</td>
                        <td class="text-left" style="white-space:pre-wrap; word-wrap:break-word">{{ $list->sumberdaya }}</td>
                        <td class="text-left" style="white-space:pre-wrap; word-wrap:break-word">{{ $list->jadwal }}</td>
                        <td class="text-left" style="white-space:pre-wrap; word-wrap:break-word">{{ $list->penanggung_jawab }}</td>
                        <td style="text-align: center;">
                            <button wire:click="edit({{ $list->id }})" class="btn btn-sm btn-info" style="width:auto; margin: 2px"><i class="fas fa-edit"></i></button>
                            <button wire:click="delete({{ $list->id }})" class="btn btn-sm btn-danger" style="width:auto; margin: 2px" onclick="confirm('Are you sure to delete?') || event.stopImmediatePropagation()"><i class="fas fa-trash"></i></button>
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
        @if($lists->hasPages())
            {{ $lists->links() }}
        @endif
    </div>
</div>
@endif
