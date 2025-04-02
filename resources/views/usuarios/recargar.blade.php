<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recargar Saldo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @extends('layouts.app')

    @section('content')
    <div class="container mt-4">
        <h1>Recargar Saldo</h1>

        @if(Session::has('mensaje'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('mensaje') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
         @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                Recarga para Usuario: {{ $usuario->nombre ?? 'N/A' }} (Documento: {{ $usuario->documento_usuario }})
            </div>
            <div class="card-body">
                <p>Saldo Actual: ${{ number_format($usuario->saldo_actual ?? 0, 2) }}</p>

                <form action="{{ route('usuarios.recargar.process', ['usuario_documento' => $usuario->documento_usuario]) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="cantidad_recarga" class="form-label">Cantidad a Recargar:</label>
                        <input type="number"
                               class="form-control @error('cantidad_recarga') is-invalid @enderror"
                               id="cantidad_recarga"
                               name="cantidad_recarga"
                               min="0.01"
                               step="0.01"
                               required
                               value="{{ old('cantidad_recarga') }}"
                               placeholder="Ingrese el monto">

                        @error('cantidad_recarga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Confirmar Recarga</button>
                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
    @endsection
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>