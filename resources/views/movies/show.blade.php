<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $movie->title }} - GITFLIX</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="container-detalhes-filme">
            <div class="hero-filme" style="background-image: url('{{ asset('storage/' . $movie->cover_image) }}')">
                <div class="conteudo-hero">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h1 class="display-4 fw-bold mb-3">{{ $movie->title }}</h1>
                            <div class="d-flex gap-3 mb-3">
                                <span class="badge-ano">
                                    <i class="fas fa-calendar"></i> {{ $movie->year }}
                                </span>
                                <span class="badge-categoria">
                                    <i class="fas fa-tag"></i> {{ $movie->category->name }}
                                </span>
                            </div>
                        </div>
                        <a href="{{ route('movies.index') }}" class="botao-volta">
                            <i class="fas fa-arrow-left"></i> Voltar
                        </a>
                    </div>
                </div>
            </div>

            <div class="informacoes-filme">
                <div class="row">
                    <div class="col-lg-8">
                        <h3 class="mb-3">Sinopse</h3>
                        <p class="texto-sinopse">{{ $movie->synopsis }}</p>

                        @if($movie->trailer_link)
                            <div class="mt-4">
                                <h3 class="mb-3">Trailer</h3>
                                <div class="container-trailer">
                                    @php
                                        $videoId = null;
                                        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([^&\n?#]+)/', $movie->trailer_link, $matches)) {
                                            $videoId = $matches[1];
                                        }
                                    @endphp
                                    
                                    @if($videoId)
                                        <iframe class="embed-trailer" 
                                                src="https://www.youtube.com/embed/{{ $videoId }}" 
                                                allowfullscreen>
                                        </iframe>
                                    @else
                                        <div class="d-flex align-items-center justify-content-center" style="height: 400px;">
                                            <div class="text-center text-white">
                                                <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                                                <h4>Link do trailer inválido</h4>
                                                <p>O link fornecido não é um link válido do YouTube.</p>
                                                <a href="{{ $movie->trailer_link }}" target="_blank" class="botao-trailer">
                                                    <i class="fab fa-youtube"></i> Abrir Link Externo
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="mt-4">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i>
                                    Este filme não possui trailer disponível.
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-4">
                        <div class="text-center mb-4">
                            <img src="{{ asset('storage/' . $movie->cover_image) }}" 
                                 alt="Capa de {{ $movie->title }}" 
                                 class="img-fluid rounded" 
                                 style="max-width: 300px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                        </div>

                        <div class="estatisticas-filme">
                            <div class="row">
                                <div class="col-6">
                                    <div class="item-estatistica">
                                        <div class="numero-estatistica">{{ $movie->year }}</div>
                                        <div class="label-estatistica">Ano</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-estatistica">
                                        <div class="numero-estatistica">{{ $movie->category->name }}</div>
                                        <div class="label-estatistica">Categoria</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($movie->trailer_link)
                            <div class="text-center mt-3">
                                <a href="{{ $movie->trailer_link }}" target="_blank" class="botao-trailer w-100">
                                    <i class="fab fa-youtube"></i> Ver no YouTube
                                </a>
                            </div>
                        @endif

                        @auth
                            <div class="text-center mt-3">
                                <a href="{{ route('movies.edit', $movie) }}" class="btn btn-outline-primary w-100 botao-editar">
                                    <i class="fas fa-edit"></i> Editar Filme
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
