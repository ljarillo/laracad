@include('admin.includes.alerts')
@csrf
<div class="form-group">
    <label for="name">Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $athlete->name ?? old('name') }}">
</div>
<div class="form-group">
    <label for="email">Email:</label>
    <input type="email" name="email" class="form-control" placeholder="Email:" value="{{ $athlete->email ?? old('email') }}">
</div>
<div class="form-group">
    <label for="password">Senha:</label>
    <input type="password" name="password" class="form-control" placeholder="Senha:">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>
