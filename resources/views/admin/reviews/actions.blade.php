<div class="btn-group" role="group">
    <button type="button" class="btn btn-sm btn-info view-review" 
            data-toggle="modal" 
            data-target="#reviewModal" 
            data-id="{{ $review->id }}" 
            data-comment="{{ htmlspecialchars($review->comment) }}" 
            data-rating="{{ $review->rating }}" 
            data-user="{{ $review->user->name }}" 
            data-item="{{ $review->item->title }}" 
            title="View">
        <i class="fas fa-eye"></i>
    </button>
    @if(!$review->is_approved)
        <form action="{{ route('admin.reviews.approve', $review) }}" method="POST" class="d-inline">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-sm btn-success" title="Approve">
                <i class="fas fa-check"></i>
            </button>
        </form>
    @endif
    <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this review?')">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</div>