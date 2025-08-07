<!DOCTYPE html>
<html>
<head>
    <title>Cadastrar Filme</title>
</head>
<body>
    <h1>Cadastrar Filme</h1>

    <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label>Título:</label>
            <input type="text" name="title" required>
        </div>

        <div>
            <label>Sinopse:</label>
            <textarea name="synopsis" required></textarea>
        </div>

        <div>
            <label>Ano:</label>
            <input type="number" name="year" required min="1900" max="{{ date('Y') }}">
        </div>

        <div>
            <label>Categoria:</label>
            <select name="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Imagem de Capa:</label>
            <input type="file" name="cover_image" required>
        </div>

        <div>
            <label>Link do Trailer:</label>
            <input type="url" name="trailer_link">
        </div>

        <button type="submit">Salvar</button>
    </form>
</body>
</html>
