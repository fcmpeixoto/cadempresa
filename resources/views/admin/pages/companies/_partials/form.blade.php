<div class="card-body">
    <form class="row g-3">
        <div class="col-md-12">
            <label for="formFile" class="form-label">Logotipo</label>
            <input class="form-control" type="file" name="filelogotipo" value="{{ $rsCompanies->logotipo ?? old('filelogotipo') }}">
        </div>
        <div class="col-md-12">
            <label for="inputEmail4" class="form-label">Nome</label>
            <input type="text" class="form-control" name="txtnome" value="{{ $rsCompanies->name ?? old('txtnome') }}">
        </div>
        <div class="col-md-12">
            <label for="inputPassword4" class="form-label">Endereço</label>
            <input type="text" class="form-control" name="txtendereco" value="{{ $rsCompanies->address ?? old('txtendereco') }}">
        </div>
        <div class="col-6">
            <label for="inputAddress" class="form-label">Site</label>
            <input type="text" class="form-control" name="txtsite" value="{{ $rsCompanies->website ?? old('txtsite') }}">
        </div>
        <div class="col-6">
            <label for="inputAddress2" class="form-label">E-mail</label>
            <input type="email" class="form-control" name="txtemail" value="{{ $rsCompanies->email ?? old('txtemail') }}">
        </div>

    </form>
</div>

<div class="card-footer">
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Gravar</button>
    </div>
</div>
