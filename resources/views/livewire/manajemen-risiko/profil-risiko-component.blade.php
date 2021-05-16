@if($isOpen)
<div class="card">
    <div class="card-header">
        <button wire:click="closeModal()" class="btn btn-secondary"><i class="fas fa-angle-left pr-1"></i> Back</button>
    </div>
    <form method="POST" wire:submit.prevent="store()">
        <div class="card-body">
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
                <label class="col-sm-2 col-form-label" for="input_penyebab">Penyebab Risiko</label>
                <div class="col-sm-10">
                    <textarea wire:model="input_penyebab" class="form-control @error('input_penyebab') is-invalid @enderror" rows="4"></textarea>
                    @error('input_penyebab') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="input_dampak">Dampak Risiko</label>
                <div class="col-sm-10">
                    <textarea wire:model="input_dampak" class="form-control @error('input_dampak') is-invalid @enderror" rows="4"></textarea>
                    @error('input_dampak') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="input_kategori">Kategori Risiko</label>
                <div class="col-sm-10">
                    <select wire:model="input_kategori" class="form-control select2 @error('input_kategori') is-invalid @enderror" required="required">
                        <option value="" selected="selected">- Select -</option>
                        <option value="Fraud">Fraud</option>
                        <option value="Operasional">Operasional</option>
                        <option value="Kepatuhan">Kepatuhan</option>
                        <option value="Reputasi">Reputasi</option>
                        <option value="Kebijakan">Kebijakan</option>
                        <option value="Legal">Legal</option>
                        <option value="Risiko Keuangan dan Kekayaan Negara">Risiko Keuangan dan Kekayaan Negara</option>
                    </select>
                    @error('input_kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="input_sistem">Sistem Pengendalian yang Dilaksanakan</label>
                <div class="col-sm-10">
                    <textarea wire:model="input_sistem" class="form-control @error('input_sistem') is-invalid @enderror" rows="4"></textarea>
                    @error('input_sistem') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="input_lk_kemungkinan">LK Kemungkinan</label>
                <div class="col-sm-10">
                    <select wire:model="input_lk_kemungkinan" class="form-control select2 @error('input_lk_kemungkinan') is-invalid @enderror" required="required">
                        <option value="" selected="selected">- Select -</option>
                        <option value="Hampir Pasti Terjadi (5)">Hampir Pasti Terjadi (5)</option>
                        <option value="Sering Terjadi (4)">Sering Terjadi (4)</option>
                        <option value="Kadang Terjadi (3)">Kadang Terjadi (3)</option>
                        <option value="Jarang Terjadi (2)">Jarang Terjadi (2)</option>
                        <option value="Hampir Tidak Terjadi (1)">Hampir Tidak Terjadi (1)</option>
                    </select>
                    @error('input_lk_kemungkinan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="input_penjelasan_kemungkinan">Penjelasan Kemungkinan</label>
                <div class="col-sm-10">
                    <textarea wire:model="input_penjelasan_kemungkinan" class="form-control @error('input_penjelasan_kemungkinan') is-invalid @enderror" rows="4"></textarea>
                    @error('input_penjelasan_kemungkinan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="input_ld_dampak">LD Dampak</label>
                <div class="col-sm-10">
                    <select wire:model="input_ld_dampak" class="form-control select2 @error('input_ld_dampak') is-invalid @enderror" required="required">
                        <option value="" selected="selected">- Select -</option>
                        <option value="Sangat Signifikan (5)">Sangat Signifikan (5)</option>
                        <option value="Signifikan (4)">Signifikan (4)</option>
                        <option value="Moderat (3)">Moderat (3)</option>
                        <option value="Minor (2)">Minor (2)</option>
                        <option value="Tidak Signifikan (1)">Tidak Signifikan (1)</option>
                    </select>
                    @error('input_ld_dampak') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="input_penjelasan_dampak">Penjelasan Dampak</label>
                <div class="col-sm-10">
                    <textarea wire:model="input_penjelasan_dampak" class="form-control @error('input_penjelasan_dampak') is-invalid @enderror" rows="4"></textarea>
                    @error('input_penjelasan_dampak') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="input_besaran_risiko">Besaran Risiko</label>
                <div class="col-sm-10">
                    <input type="text" wire:model="input_besaran_risiko" id="input_besaran_risiko" class="form-control @error('input_besaran_risiko') is-invalid @enderror">
                    @error('input_besaran_risiko') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="input_lr">LR</label>
                <div class="col-sm-10">
                    <input type="text" wire:model="input_lr" id="input_lr" class="form-control @error('input_lr') is-invalid @enderror">
                    @error('input_lr') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="input_prioritas_risiko">Prioritas Risiko</label>
                <div class="col-sm-10">
                    <input type="text" wire:model="input_prioritas_risiko" id="input_prioritas_risiko" class="form-control @error('input_prioritas_risiko') is-invalid @enderror">
                    @error('input_prioritas_risiko') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="input_lk_risiko">LK risiko</label>
                <div class="col-sm-10">
                    <select wire:model="input_lk_risiko" class="form-control select2 @error('input_lk_risiko') is-invalid @enderror" required="required">
                        <option value="" selected="selected">- Select -</option>
                        <option value="Hampir Pasti Terjadi (5)">Hampir Pasti Terjadi (5)</option>
                        <option value="Sering Terjadi (4)">Sering Terjadi (4)</option>
                        <option value="Kadang Terjadi (3)">Kadang Terjadi (3)</option>
                        <option value="Jarang Terjadi (2)">Jarang Terjadi (2)</option>
                        <option value="Hampir Tidak Terjadi (1)">Hampir Tidak Terjadi (1)</option>
                    </select>
                    @error('input_lk_risiko') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="input_ld_risiko">LD risiko</label>
                <div class="col-sm-10">
                    <select wire:model="input_ld_risiko" class="form-control select2 @error('input_ld_risiko') is-invalid @enderror" required="required">
                        <option value="" selected="selected">- Select -</option>
                        <option value="Sangat Signifikan (5)">Sangat Signifikan (5)</option>
                        <option value="Signifikan (4)">Signifikan (4)</option>
                        <option value="Moderat (3)">Moderat (3)</option>
                        <option value="Minor (2)">Minor (2)</option>
                        <option value="Tidak Signifikan (1)">Tidak Signifikan (1)</option>
                    </select>
                    @error('input_ld_risiko') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="input_lr_risiko">LR risiko</label>
                <div class="col-sm-10">
                    <input type="text" wire:model="input_lr_risiko" id="input_lr_risiko" class="form-control @error('input_lr_risiko') is-invalid @enderror">
                    @error('input_lr_risiko') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="input_keputusan_mitigasi">Keputusan Mitigasi</label>
                <div class="col-sm-10">
                    <input type="text" wire:model="input_keputusan_mitigasi" id="input_keputusan_mitigasi" class="form-control @error('input_keputusan_mitigasi') is-invalid @enderror">
                    @error('input_keputusan_mitigasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="input_nama_iru">Nama IRU</label>
                <div class="col-sm-10">
                    <textarea wire:model="input_nama_iru" class="form-control @error('input_nama_iru') is-invalid @enderror" rows="4"></textarea>
                    @error('input_nama_iru') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="input_batasan_nilai">Batasan Nilai IRU</label>
                <div class="col-sm-10">
                    <textarea wire:model="input_batasan_nilai" class="form-control @error('input_batasan_nilai') is-invalid @enderror" rows="4"></textarea>
                    @error('input_batasan_nilai') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                        <th rowspan="2">Sasaran Organisasi</th>
                        <th colspan="4">Risiko</th>
                        <th rowspan="2">Kategori Risiko</th>
                        <th rowspan="2">Sistem Pengendalian yang Dilaksanakan</th>
                        <th colspan="2">Kemungkinan</th>
                        <th colspan="2">Dampak</th>
                        <th rowspan="2">Besaran Risiko</th>
                        <th rowspan="2">LR</th>
                        <th rowspan="2">Prioritas Risiko</th>
                        <th colspan="3">Risiko Residual Harapan</th>
                        <th rowspan="2">Keputusan Mitigasi</th>
                        <th colspan="2">IRU</th>
                        <th width="5%" rowspan="2">Action</th>
                    </tr>
                    <tr>
                        <th>No</th>
                        <th>Kejadian</th>
                        <th>Penyebab</th>
                        <th>Dampak</th>
                        <th>LK</th>
                        <th>Penjelasan</th>
                        <th>LD</th>
                        <th>Penjelasan</th>
                        <th>LK</th>
                        <th>LD</th>
                        <th>LR</th>
                        <th>Nama</th>
                        <th>Batasan Nilai</th>
                    </tr>
                </thead>
                <tbody class="text-center text-xs">
                    @forelse($lists as $list)
                    <tr>
                        <td class="text-left" style="white-space:pre-wrap; word-wrap:break-word">{{ 'SO'.$list->sasaranOrganisasi->id.'. '.$list->sasaranOrganisasi->name }}</td>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-left" style="width:150px;white-space:pre-wrap; word-wrap:break-word">{{ $list->kejadian }}</td>
                        <td class="text-left" style="white-space:pre-wrap; word-wrap:break-word">{{ $list->penyebab }}</td>
                        <td class="text-left" style="white-space:pre-wrap; word-wrap:break-word">{{ $list->dampak }}</td>
                        <td class="text-left" style="white-space:pre-wrap; word-wrap:break-word">{{ $list->kategori }}</td>
                        <td class="text-left" style="white-space:pre-wrap; word-wrap:break-word">{{ $list->sistem }}</td>
                        <td class="text-left" style="white-space:pre-wrap; word-wrap:break-word">{{ $list->lk_kemungkinan }}</td>
                        <td class="text-left" style="white-space:pre-wrap; word-wrap:break-word">{{ $list->penjelasan_kemungkinan }}</td>
                        <td class="text-left" style="white-space:pre-wrap; word-wrap:break-word">{{ $list->ld_dampak }}</td>
                        <td class="text-left" style="white-space:pre-wrap; word-wrap:break-word">{{ $list->penjelasan_dampak }}</td>
                        <td class="text-left" style="white-space:pre-wrap; word-wrap:break-word">{{ $list->besaran_risiko }}</td>
                        <td class="text-left" style="white-space:pre-wrap; word-wrap:break-word">{{ $list->lr }}</td>
                        <td class="text-left" style="white-space:pre-wrap; word-wrap:break-word">{{ $list->prioritas_risiko }}</td>
                        <td class="text-left" style="white-space:pre-wrap; word-wrap:break-word">{{ $list->lk_risiko }}</td>
                        <td class="text-left" style="white-space:pre-wrap; word-wrap:break-word">{{ $list->ld_risiko }}</td>
                        <td class="text-left" style="white-space:pre-wrap; word-wrap:break-word">{{ $list->lr_risiko }}</td>
                        <td class="text-left" style="white-space:pre-wrap; word-wrap:break-word">{{ $list->keputusan_mitigasi }}</td>
                        <td class="text-left" style="white-space:pre-wrap; word-wrap:break-word">{{ $list->nama_iru }}</td>
                        <td class="text-left" style="white-space:pre-wrap; word-wrap:break-word">{{ $list->batasan_nilai }}</td>
                        <td style="text-align: center;">
                            <button wire:click="edit({{ $list->id }})" class="btn btn-sm btn-info" style="width:auto; margin: 2px"><i class="fas fa-edit"></i></button>
                            <button wire:click="delete({{ $list->id }})" class="btn btn-sm btn-danger" style="width:auto; margin: 2px" onclick="confirm('Are you sure to delete?') || event.stopImmediatePropagation()"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="21">No Data Available</td>
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
