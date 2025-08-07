
<div>
    <h1>GitMovies</h1>
    <button href="{{ route('movies.edit') }}">Adicionar filme</button>
</div>

@foreach($movies as $movie)
    <div>
        <h2>{{ $movie->title }}</h2>
        <img src="{{ asset('storage/' . $movie->cover_image) }}" alt="Capa de {{ $movie->title }}" width="150">
        <p>{{ $movie->synopsis }}</p>
        <a href="{{ route('movies.edit', $movie) }}">Editar</a>
        <form action="{{ route('movies.destroy', $movie) }}" method="POST" onsubmit="return confirm('Tem certeza?')">
            @csrf
            @method('DELETE')
            <button type="submit">Excluir</button>
        </form>
    </div>
@endforeach
