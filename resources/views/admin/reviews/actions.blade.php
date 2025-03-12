<div class="btn-group" role="group">
    @if(!$review->approved)
        <form action="{{ route('admin.reviews.approve', $review) }}" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-sm btn-success" title="Approve">
                <i class="fas fa-check"></i>
            </button>
        </form>
    @endif
    <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this review?')">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</div>

