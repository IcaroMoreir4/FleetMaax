@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Motorista</h1>

    <form action="{{ route('motoristas.update', $motorista->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome_completo" class="form-label">Nome Completo</label>
            <input type="text" class="form-control" name="nome_completo" value="{{ old('nome_completo', $motorista->nome_completo) }}" required>
        </div>

        <div class="mb-3">
            <label for="cpf" class="form-label">CPF</label>
            <input type="text" class="form-control" name="cpf" value="{{ old('cpf', $motorista->cpf) }}" required>
        </div>

        <div class="mb-3">
            <label for="cnh" class="form-label">CNH</label>
            <input type="text" class="form-control" name="cnh" value="{{ old('cnh', $motorista->cnh) }}" required>
        </div>

        <div class="mb-3">
            <label for="data_nascimento" class="form-label">Data de Nascimento</label>
            <input type="date" class="form-control" name="data_nascimento" value="{{ old('data_nascimento', $motorista->data_nascimento) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" name="email" value="{{ old('email', $motorista->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" class="form-control" name="telefone" value="{{ old('telefone', $motorista->telefone) }}" required>
        </div>

        <div class="mb-3">
            <label for="data_admissao" class="form-label">Data de Admissão</label>
            <input type="date" class="form-control" name="data_admissao" value="{{ old('data_admissao', $motorista->data_admissao) }}" required>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="ativo" value="1" {{ old('ativo', $motorista->ativo) ? 'checked' : '' }}>
            <label class="form-check-label" for="ativo">Ativo</label>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="{{ route('motoristas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
