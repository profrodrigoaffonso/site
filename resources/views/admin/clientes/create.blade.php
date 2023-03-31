@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Ponto</h1>
</div>
<form method="post" action="{{ route('admin.clientes.store') }}">
    @csrf
    @component('components.forms.input', [
        'id'        => 'nome',
        'name'      => 'nome',
        'label'     => 'Nome',
        'type'      => 'text',
        'value'     => old('nome'),
        'maxlength' => 100
    ])
    @endcomponent
    @component('components.forms.input', [
        'id'        => 'cep',
        'name'      => 'cep',
        'label'     => 'CEP',
        'type'      => 'text',
        'value'     => old('nome'),
        'maxlength' => 9,
        'extra'     => 'onblur=consultaCep()'
    ])
    @endcomponent
    @component('components.forms.input', [
        'id'        => 'endereco',
        'name'      => 'endereco',
        'label'     => 'Endereço',
        'type'      => 'text',
        'value'     => old('nome'),
        'maxlength' => 200
    ])
    @endcomponent
    @component('components.forms.input', [
        'id'        => 'bairro',
        'name'      => 'bairro',
        'label'     => 'Bairro',
        'type'      => 'text',
        'value'     => old('nome'),
        'maxlength' => 200
    ])
    @endcomponent
    @component('components.forms.input', [
        'id'        => 'cidade',
        'name'      => 'cidade',
        'label'     => 'cidade',
        'type'      => 'text',
        'value'     => old('nome'),
        'maxlength' => 200
    ])
    @endcomponent
    @component('components.forms.input', [
        'id'        => 'uf',
        'name'      => 'uf',
        'label'     => 'uf',
        'type'      => 'text',
        'value'     => old('nome'),
        'maxlength' => 200
    ])
    @endcomponent
    @component('components.forms.input', [
        'id'        => 'serial',
        'name'      => 'serial',
        'label'     => 'Serial',
        'type'      => 'text',
        'maxlength' => 20
    ])
    @endcomponent

    <button type="submit" class="btn btn-primary">Salvar</button>
</form>
<script>
    function consultaCep(){

        cep = document.getElementById('cep').value;

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // código a ser executado em caso de sucesso
                var responseObj = JSON.parse(this.responseText)
                console.log(responseObj)
                document.getElementById('endereco').value = responseObj[0]
                document.getElementById('bairro').value = responseObj[1]
                document.getElementById('cidade').value = responseObj[2]
                document.getElementById('uf').value = responseObj[4]
            } else if (this.readyState == 4 && this.status != 200) {
                // código a ser executado em caso de erro
            }
        };
        xhttp.open("POST", "/api/cep", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("cep=" + cep);


    }
</script>
@endsection
