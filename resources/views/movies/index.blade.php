<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GITFLIX - Sua Biblioteca de Filmes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div class="secao-principal">
        <h2 class="display-4 fw-bold mb-3">
            <i class="fas fa-film"></i> GITFLIX
        </h2>
        <p class="lead mb-4">Descubra uma incrível coleção de filmes</p>
        <div class="d-flex gap-2 justify-content-center">
            @auth
                <a href="{{ route('categories.create') }}" class="botao-adicionar">
                    <i class="fas fa-plus"></i> Adicionar Categoria
                </a>
                <a href="{{ route('movies.create') }}" class="botao-adicionar">
                    <i class="fas fa-plus"></i> Adicionar Filme
                </a>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="botao-logout">
                        <i class="fas fa-sign-out-alt"></i> Sair
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="botao-login">
                    <i class="fas fa-sign-in-alt"></i> Fazer Login
                </a>
            @endauth
        </div>
    </div>
    <div class="container container-geral">
        <div class="secao-estatisticas">
            <div class="row">
                <div class="col-md-3">
                    <div class="card-estatistica text-center">
                        <i class="fas fa-film fa-2x mb-2"></i>
                        <h4>{{ $movies->count() }}</h4>
                        <p class="mb-0">Total de Filmes</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card-estatistica text-center">
                        <i class="fas fa-calendar fa-2x mb-2"></i>
                        <h4>{{ $movies->max('year') ?? 'N/A' }}</h4>
                        <p class="mb-0">Ano Mais Recente</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card-estatistica text-center">
                        <i class="fas fa-tags fa-2x mb-2"></i>
                        <h4>{{ $movies->unique('category_id')->count() }}</h4>
                        <p class="mb-0">Categorias</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card-estatistica text-center">
                        <i class="fas fa-video fa-2x mb-2"></i>
                        <h4>{{ $movies->whereNotNull('trailer_link')->count() }}</h4>
                        <p class="mb-0">Com Trailer</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="secao-filtros">
            <form method="GET" action="{{ route('movies.index') }}" class="row g-3">
                <div class="col-md-3">
                    <label for="year" class="form-label fw-bold">Filtrar por Ano</label>
                    <select class="selecao-formulario form-select" id="year" name="year">
                        <option value="">Todos os anos</option>
                        @foreach($years as $year)
                            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="category_id" class="form-label fw-bold">Filtrar por Categoria</label>
                    <select class="selecao-formulario form-select" id="category_id" name="category_id">
                        <option value="">Todas as categorias</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <div class="d-flex gap-2 w-100">
                        <button type="submit" class="btn btn-primary flex-fill botao-filtro">
                            <i class="fas fa-filter"></i> Filtrar
                        </button>
                        <a href="{{ route('movies.index') }}" class="btn btn-outline-secondary botao-limpar">
                            <i class="fas fa-times"></i> Limpar
                        </a>
                        @if($randomMovie)
                            <a href="{{ route('movies.show', $randomMovie) }}" class="btn btn-success botao-sugestao">
                                <i class="fas fa-dice"></i> Sugerir Filme
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="mb-4">
            <h4 class="text-white mb-3">
                <i class="fas fa-list"></i> 
                {{ $movies->count() }} filme(s) encontrado(s)
                @if(request('year') || request('category_id'))
                    <small class="text-light">(com filtros aplicados)</small>
                @endif
            </h4>
        </div>

        @if($movies->count() > 0)
            <div class="row">
                @foreach($movies as $movie)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card-filme">
                            <div class="position-relative">
                                <img src="{{ asset('storage/' . $movie->cover_image) }}" 
                                     alt="Capa de {{ $movie->title }}" 
                                     class="imagem-filme">
                                <div class="overlay-filme">
                                    <a href="{{ route('movies.show', $movie) }}" class="botao-assistir">
                                        <i class="fas fa-eye"></i> Ver Detalhes
                                    </a>
                                </div>
                            </div>
                            <div class="p-3">
                                <h5 class="card-title mb-2">{{ $movie->title }}</h5>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge-ano">
                                        <i class="fas fa-calendar"></i> {{ $movie->year }}
                                    </span>
                                    <span class="badge-categoria">
                                        {{ $movie->category->name }}
                                    </span>
                                </div>
                                <p class="card-text text-muted small">
                                    {{ Str::limit($movie->synopsis, 120) }}
                                </p>
                                @if($movie->trailer_link)
                                    <div class="text-center mb-2">
                                        <a href="{{ $movie->trailer_link }}" target="_blank" class="btn btn-outline-primary btn-sm botao-trailer">
                                            <i class="fab fa-youtube"></i> Ver Trailer
                                        </a>
                                    </div>
                                @endif
                                @auth
                                    <div class="d-flex gap-2 botoes-filme">
                                        <a href="{{ route('movies.edit', $movie) }}" 
                                           class="btn btn-outline-primary botao-acao botao-editar">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        <form action="{{ route('movies.destroy', $movie) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Tem certeza que deseja excluir este filme?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger botao-acao botao-excluir">
                                                <i class="fas fa-trash"></i> Excluir
                                            </button>
                                        </form>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="sem-filmes">
                <i class="fas fa-film fa-4x text-muted mb-4"></i>
                <h3 class="text-muted">Nenhum filme encontrado</h3>
                <p class="text-muted">
                    @if(request('year') || request('category_id'))
                        Não há filmes que correspondam aos filtros aplicados.
                        <a href="{{ route('movies.index') }}" class="text-decoration-none">Limpar filtros</a>
                    @else
                        Ainda não há filmes cadastrados no sistema.
                    @endif
                </p>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
