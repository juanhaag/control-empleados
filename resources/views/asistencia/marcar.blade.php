@extends('layouts.app')

@section('content')
    <div class="container d-flex align-items-center justify-content-center vh-100">
        <div class="card">
            <div class="card-header">Marcar Asistencia</div>

            <div class="card-body">
                @if(session('mensaje'))
                    <div class="alert alert-success" role="alert">
                        {{ session('mensaje') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('asistencia.marcar') }}">
                    @csrf
                    <div class="form-group">
                        <label for="dni">DNI del Empleado:</label>
                        <input type="text" class="form-control @error('dni') is-invalid @enderror" id="dni" name="dni" required>
                        @error('dni')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="accion" id="entrada" value="entrada" checked>
                        <label class="form-check-label" for="entrada">
                            Marcar Entrada
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="accion" id="salida" value="salida">
                        <label class="form-check-label" for="salida">
                            Marcar Salida
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary">Marcar Asistencia</button>
                </form>
            </div>
        </div>
    </div>
@endsection
