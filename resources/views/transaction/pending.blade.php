@extends("layouts.app")

@section("title")
Send money
@endsection

@section("content")
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0 font-size-18">Transaction History</h4>
</div>
<div class="row p-0">
    <div class="col-md-8 p-0">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Kindly follow the instructions below to complete your transaction</h4><hr>
                <div class="mt-3 alert alert-info text-center">Transfer <currency :amount="{{ $transaction->amount }}" sign="{{ $transaction->fromCurrency->Symbol }}"></currency> to Tranzfar Ltd IBAN: LT923780000016016683 via SEPA using {{ $transaction->reference }} as Reference.</div>

                <div class="mt-3 add-border py-3 px-3 d-flex justify-content-between">
                    <div class="">
                        <h5 class="text-left text-uppercase tr-f">YOU SENT</h5>
                        <h5 class="text-left tr-n2">
                            <currency :amount="{{ $transaction->amount }}" sign="{{ $transaction->fromCurrency->Symbol }}"></currency>
                        </h5>
                    </div>

                    <div class="">
                        <h5 class="text-right text-uppercase tr-f">{{ $transaction->receiver_name }} RECEIVED</h5>
                        <h5 class="text-right tr-n2">
                            <currency :amount="{{ $transaction->amountReceiver }}" sign="{{ $transaction->toCurrency->Symbol }}"></currency>
                        </h5>
                    </div>

                </div>

                <div class="mt-3 add-border px-3 py-3">
                    <div class="py-2">
                        <h5 class="text-uppercase tr-f">Recipient </h5>
                        <h5 class="tr-n2">
                            {{ $transaction->receiver_name }}
                        </h5>
                    </div>

                    <div class="py-2">
                        <h5 class="text-uppercase tr-f">bank </h5>
                        <h5 class="tr-n2">
                            {{ $transaction->receiver->bank->Name }}
                        </h5>
                    </div>

                    <div class="py-2">
                        <h5 class="text-uppercase tr-f">transfer rate</h5>
                        <h5 class="tr-n2">
                            <currency :amount="{{ $transaction->rate->rate }}" sign="{{ $transaction->toCurrency->Symbol }}"></currency>
                        </h5>
                    </div>

                    <div class="py-2">
                        <h5 class="text-uppercase tr-f">transfer fee</h5>
                        <h5 class="tr-n2">
                            <currency :amount="0.6" sign="{{ $transaction->fromCurrency->Symbol }}"></currency>
                        </h5>
                    </div>

                    <div class="py-2">
                        <h5 class="text-uppercase tr-f">transaction number</h5>
                        <h5 class="tr-n2">
                            {{ $transaction->trans_id }}
                        </h5>
                    </div>

                    <div class="py-2">
                        <h5 class="text-uppercase tr-f">account number</h5>
                        <h5 class="tr-n2">
                            {{ $transaction->receiver->account_number }}
                        </h5>
                    </div>

                </div>
                <div class="py-2 mt-2">
                    @if ($transaction->status == 0)
                        <div class="alert alert-warning text-center">Pending</div>
                    @endif

                    @if ($transaction->status == 2)
                        <div class="alert alert-success text-center">Delivered</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">Tracking</h4>
                <div class="">
                    <ul class="verti-timeline list-unstyled">
                        <li class="event-list {{ $transaction->status == 0 ? 'active' : ''}}">
                            <div class="event-timeline-dot">
                                <i class="bx bx-right-arrow-circle {{ $transaction->status == 0 ? 'bx-fade-right' : ''}}"></i>
                            </div>
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <i class="bx bx-copy-alt h2 text-primary"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5>Ordered</h5>
                                        <p class="text-muted">
                                            You Initait a payment of <currency :amount="{{ $transaction->amount }}" sign="{{ $transaction->fromCurrency->Symbol }}"></currency> for {{ $transaction->receiver_name }}.
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </li>
                        @if (!$transaction->status == 0)
                            <li class="event-list">
                                <div class="event-timeline-dot">
                                    <i class="bx bx-right-arrow-circle"></i>
                                </div>
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <i class="bx bx-package h2 text-primary"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div>
                                            <h5>Payment Received</h5>
                                            <p class="text-muted">We received your payment of <currency :amount="{{ $transaction->amount }}" sign="{{ $transaction->fromCurrency->Symbol }}"></currency></p>

                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endif

                        @if ($transaction->status !== 0 &&  $transaction->status !== 2)
                            <li class="event-list {{ $transaction->status !== 0 &&  $transaction->status !== 2 ? 'active' : ''}}">
                                <div class="event-timeline-dot">
                                    <i class="bx bx-right-arrow-circle {{ $transaction->status !== 0 &&  $transaction->status !== 2 ? 'bx-fade-right' : ''}}"></i>
                                </div>
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <i class="bx bx-car h2 text-primary"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div>
                                            <h5>Moving</h5>
                                            <p class="text-muted">We currently moving your money to {{ $transaction->receiver_name }}</p>

                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endif

                        @if ($transaction->status == 2)
                            <li class="event-list {{ $transaction->status == 2 ? 'active' : ''}}">
                                <div class="event-timeline-dot">
                                    <i class="bx bx-right-arrow-circle {{ $transaction->status == 2 ? 'bx-fade-right' : ''}}"></i>
                                </div>
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <i class="bx bx-badge-check h2 text-primary"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div>
                                            <h5>Delivered</h5>
                                            <p class="text-muted">Your payment of <currency :amount="{{ $transaction->amount }}" sign="{{ $transaction->fromCurrency->Symbol }}"></currency> to {{ $transaction->receiver_name}} was deleivered successfully.</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
