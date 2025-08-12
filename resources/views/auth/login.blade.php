<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GITFLIX</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body class="login-page">
    <div class="container-login">
        <div class="text-center mb-4">
            <h2 class="mb-3">
                <i class="fas fa-film text-primary"></i> GITFLIX
            </h2>
            <p class="text-muted">Faça login para gerenciar filmes</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label fw-bold">Email</label>
                <input type="email" class="campo-formulario form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label fw-bold">Senha</label>
                <input type="password" class="campo-formulario form-control" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary botao-login-principal">
                <i class="fas fa-sign-in-alt"></i> Entrar
            </button>
        </form>

        <a href="{{ route('home') }}" class="botao-voltar">
            <i class="fas fa-arrow-left"></i> Voltar ao Site
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
