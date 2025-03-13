<div class="btn-group" role="group">
    <a href="{{ route('admin.items.show', $item) }}" class="btn btn-sm btn-info">
        <i class="fas fa-eye"></i>
    </a>
    <a href="{{ route('admin.items.edit', $item) }}" class="btn btn-sm btn-primary">
        <i class="fas fa-edit"></i>
    </a>
    <form action="{{ route('admin.items.destroy', $item) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this manga?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</div>