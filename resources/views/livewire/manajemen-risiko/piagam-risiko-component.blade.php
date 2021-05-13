@if($isOpen)
<div class="card">
    <div class="card-header">
        <button wire:click="closeModal()" class="btn btn-secondary"><i class="fas fa-angle-left pr-1"></i> Back</button>
    </div>
    <form method="POST" wire:submit.prevent="store()">
        <div class="card-body">
            <!-- String -->
            <div class="form-group col-12">
                <label for="input_name">Name</label>
                <input type="text" wire:model="input_name" id="input_name" class="form-control @error('input_name') is-invalid @enderror">
                @error('input_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
        <div class="row">
        @for($i=0; $i<5; $i++)
            <div class="col-xl-3 col-lg-4 col-md-6 col-12"
                style="padding: 50px 100px;">
                <div style="background-color:gray;">
                    <div style="text-align:center">
                        <button wire:click="edit()" class="btn btn-sm btn-success" style="width:auto; margin: 4px"><i class="fas fa-eye"></i></button>
                        <button wire:click="edit()" class="btn btn-sm btn-info" style="width:auto; margin: 4px"><i class="fas fa-edit"></i></button>
                        <button wire:click="edit()" class="btn btn-sm btn-danger" style="width:auto; margin: 4px"><i class="fas fa-trash"></i></button>
                    </div>
                    <div style="padding:5px;color:white; text-align:center;">
                        <p>NOMOR KONTRAK INI</p>
                        <hr style="border: 1px solid white">
                        <p>TANGGAL AWAL<br/>
                            s/d<br/>
                            TANGGAL SELESAI<br/>
                        </p>
                        <p>TAHUN</p>
                    </div>
                </div>
            </div>
        @endfor
        </div>
    </div>
</div>
@endif
