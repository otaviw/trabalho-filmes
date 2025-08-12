<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Filme - GITFLIX</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container-formulario">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="mb-0">
                            <i class="fas fa-edit text-primary"></i> Editar Filme
                        </h2>
                        <a href="{{ route('home') }}" class="botao-secundario btn btn-secondary botao-voltar">
                            <i class="fas fa-arrow-left"></i> Voltar
                        </a>
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

                    <form action="{{ route('movies.update', $movie) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label fw-bold">Título</label>
                                    <input type="text" class="campo-formulario form-control" id="title" name="title" value="{{ old('title', $movie->title) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="synopsis" class="form-label fw-bold">Sinopse</label>
                                    <textarea class="campo-formulario form-control" id="synopsis" name="synopsis" rows="4" required>{{ old('synopsis', $movie->synopsis) }}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="year" class="form-label fw-bold">Ano</label>
                                            <input type="number" class="campo-formulario form-control" id="year" name="year" value="{{ old('year', $movie->year) }}" min="1900" max="{{ date('Y') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="category_id" class="form-label fw-bold">Categoria</label>
                                            <select class="selecao-formulario form-select" id="category_id" name="category_id" required>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old('category_id', $movie->category_id) == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="trailer_link" class="form-label fw-bold">Link do Trailer (YouTube)</label>
                                    <input type="url" class="campo-formulario form-control" id="trailer_link" name="trailer_link" value="{{ old('trailer_link', $movie->trailer_link) }}" placeholder="https://www.youtube.com/watch?v=...">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="cover_image" class="form-label fw-bold">Nova Imagem de Capa</label>
                                    <input type="file" class="campo-formulario form-control" id="cover_image" name="cover_image" accept="image/*">
                                    <small class="text-muted">Deixe em branco para manter a imagem atual</small>
                                </div>

                                @if($movie->cover_image)
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Imagem Atual</label>
                                        <div class="text-center">
                                            <img src="{{ asset('storage/' . $movie->cover_image) }}" alt="Capa atual" class="imagem-atual img-fluid">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="d-flex gap-2 justify-content-end">
                            <button type="submit" class="botao-primario btn btn-primary botao-confirmar-filme">
                                <i class="fas fa-save"></i> Atualizar Filme
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
