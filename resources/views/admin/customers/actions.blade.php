<div class="btn-group" role="group">
    <a href="{{ route('admin.customers.show', $customer) }}" class="btn btn-sm btn-info">
        <i class="fas fa-eye"></i>
    </a>
    <button type="button" class="btn btn-sm btn-{{ $customer->status === 'active' ? 'warning' : 'success' }}" data-bs-toggle="modal" data-bs-target="#statusModal{{ $customer->id }}">
        <i class="fas fa-{{ $customer->status === 'active' ? 'ban' : 'check' }}"></i>
    </button>
</div>

<!-- Status Modal -->
<div class="modal fade" id="statusModal{{ $customer->id }}" tabindex="-1" aria-labelledby="statusModalLabel{{ $customer->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel{{ $customer->id }}">
                    {{ $customer->status === 'active' ? 'Deactivate' : 'Activate' }} Customer
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to {{ $customer->status === 'active' ? 'deactivate' : 'activate' }} <strong>{{ $customer->name }}</strong>?
                @if($customer->status === 'active')
                    <div class="alert alert-warning mt-3">
                        <i class="fas fa-exclamation-triangle"></i> This will prevent the customer from logging in.
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.customers.update', $customer) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="{{ $customer->status === 'active' ? 'deactivated' : 'active' }}">
                    <button type="submit" class="btn btn-{{ $customer->status === 'active' ? 'warning' : 'success' }}">
                        {{ $customer->status === 'active' ? 'Deactivate' : 'Activate' }} Customer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

