<div class="btn-group" role="group">
    <a href="{{ route('genres.show', $genre) }}" class="btn btn-sm btn-info" target="_blank">
        <i class="fas fa-eye"></i>
    </a>
    <a href="{{ route('admin.genres.edit', $genre) }}" class="btn btn-sm btn-primary">
        <i class="fas fa-edit"></i>
    </a>
    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $genre->id }}">
        <i class="fas fa-trash"></i>
    </button>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal{{ $genre->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $genre->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $genre->id }}">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete <strong>{{ $genre->name }}</strong>? This action cannot be undone.
                @if($genre->items()->count() > 0)
                    <div class="alert alert-warning mt-3">
                        <i class="fas fa-exclamation-triangle"></i> This genre has {{ $genre->items()->count() }} manga associated with it. Deleting it may affect these items.
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.genres.destroy', $genre) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

