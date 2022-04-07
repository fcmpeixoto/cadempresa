<div class="card-body">
    <form class="row g-3">
        <div class="col-md-6">

            <select class="form-select" aria-label="Default select example" name="cboempresa">
                <option selected>Selecione uma Empresa</option>
                @foreach($rsCompanie as $dtCompanie)
                    <option value="{{ $dtCompanie->id ?? old('cboempresa') }}"
                        {{ isset($rsEmployee) ? ($dtCompanie->id == $rsEmployee->companies_id ? 'selected' : '') :
                                                            (old('cboempresa') == $dtCompanie->id ? 'selected' : '') }}>
                        {{ $dtCompanie->name }}
                    </option>
                @endforeach
            </select>
        </div>        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Nome</label>
            <input type="text" class="form-control" name="txtnome" value="{{ $rsEmployee->name ?? old('txtnome') }}">
        </div>
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">SobreNome</label>
            <input type="text" class="form-control" name="txtsobrenome" value="{{ $rsEmployee->last_name ?? old('txtsobrenome') }}">
        </div>
        <div class="col-6">
            <label for="inputAddress2" class="form-label">E-mail</label>
            <input type="email" class="form-control" name="txtemail" value="{{ $rsEmployee->email ?? old('txtemail') }}">
        </div>
        <div class="col-md-12">
            <label for="inputPassword4" class="form-label">Telefone</label>
            <input type="text" class="form-control" name="txttelefone" value="{{ $rsEmployee->telephone ?? old('txttelefone') }}">
        </div>
    </form>
</div>

<div class="card-footer">
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Gravar</button>
    </div>
</div>
