<div class="card">
    <div class="card-body table-responsive p-3">
        <h4 class="card-title">Transactions</h4>
        <p class="card-title-desc">Below shows the list of your transaction</p>
        <table class="table table-hover text-nowrap" id="DataTable">
            @if (auth()->user()->getTransactions()->count() > 0)
            <thead class="table-light">
                <tr>
                    <th>Transaction ID</th>
                    <th>Reference</th>
                    <th>Receiver</th>
                    <th>Amount</th>
                    <th>Amount Received</th>
                    <th>Status</th>
                    <th>Date Sent</th>
                    <th>Action</th>
                </tr>
            </thead>
            @endif
            <tbody>
                @forelse (auth()->user()->getTransactions() as $transaction )
                    <tr>
                        <td>{{ $transaction->trans_id }}</td>
                        <td>{{ $transaction->reference }}</td>
                        <td>{{ $transaction->receiver_name }}</td>
                        <td><currency :amount="{{ $transaction->amount }}" sign="{{ $transaction->fromCurrency->Symbol }}"></currency></td>
                        <td><currency :amount="{{ $transaction->amountReceiver }}" sign="{{ $transaction->toCurrency->Symbol }}"></currency></td>
                        <td>
                            @if ($transaction->status == 0)
                                <span class="badge badge-pill badge-soft-info font-size-11">Pending</span>
                            @elseif ($transaction->status == 1)
                                <span class="badge badge-pill badge-soft-warning font-size-11">Payment received</span>
                            @elseif ($transaction->status == 2)
                                <span class="badge badge-pill badge-soft-success font-size-11">Delivered</span>
                            @elseif ($transaction->status == 3)
                                <span class="badge badge-pill badge-soft-danger font-size-11">Cancelled</span>
                            @endif

                        </td>
                        <td><timeago time="{{ $transaction->created_at }}"></timeago></td>
                        <td>
                            <a href="{{ route('transaction.show', $transaction->trans_id) }}" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">Details</a>
                        </td>
                    </tr>
                @empty
                    <tr class="text-center">
                        <td><i class="fas fa-folder-open"></i> No Transaction found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
