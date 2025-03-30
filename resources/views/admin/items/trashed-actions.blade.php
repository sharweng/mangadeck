<div class="btn-group" role="group">
    <a href="{{ route('admin.items.restore', $item->id) }}" class="btn btn-sm btn-success" onclick="return confirm('Are you sure you want to restore this manga?')">
        <i class="fas fa-trash-restore"></i> Restore
    </a>
    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#forceDeleteModal{{ $item->id }}">
        <i class="fas fa-trash"></i> Delete Permanently
    </button>
</div>

<!-- Force Delete Modal -->
<div class="modal fade" id="forceDeleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="forceDeleteModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="forceDeleteModalLabel{{ $item->id }}">Confirm Permanent Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i> Warning: This action cannot be undone!
                </div>
                <p>Are you sure you want to permanently delete <strong>{{ $item->title }}</strong>?</p>
                <p>This will remove all associated data including images, reviews, and order history.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.items.force-delete', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Permanently</button>
                </form>
            </div>
        </div>
    </div>
</div>

