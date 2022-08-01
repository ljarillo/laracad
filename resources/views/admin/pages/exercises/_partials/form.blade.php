@include('admin.includes.alerts')
@csrf
<div class="form-group">
    <label for="name">Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $exercise->name ?? old('name') }}">
</div>
<div class="form-group">
    <label for="image">Imagem:</label>
    <input type="file" name="image" class="form-control">
</div>
<div class="form-group">
    <label for="description">Descrição:</label>
    <textarea name="description" cols="30" rows="5" class="form-control">{{ $exercise->description ?? old('description') }}</textarea>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>
