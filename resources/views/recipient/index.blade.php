@extends("layouts.app")

@section("title")
Recipients
@endsection

@section("content")
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0 font-size-18">Recipients</h4>
</div>

<div class="row">
    <div class="col-xl-5">
        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex flex-wrap">
                    <h4 class="card-title mb-4">Recipients</h4>

                </div>

                <div class="table-responsive">
                    <table class="table align-middle table-nowrap mb-0">
                        @if (auth()->user()->recipients()->count() > 0)
                        <thead class="table-light">
                            <tr>
                                <th class="align-middle">Name</th>
                                <th class="align-middle">Country</th>
                                <th class="align-middle">View Details</th>
                            </tr>
                        </thead>
                        @endif
                        <tbody>
                            @forelse (auth()->user()->recipients() as $recipient)
                            <tr>
                                <td><a href="javascript: void(0);" class="text-body fw-bold">{{ $recipient->account_name }}</a> </td>
                                <td><a href="javascript: void(0);" class="text-body fw-bold">{{ $recipient->country->name }}</a> </td>
                                <td>
                                    <rd :recipient='{{ $recipient }}' :user_id="{{ auth()->user()->id }}"></rd>
                                </td>
                            </tr>

                            @empty
                                <h1 class="text-center"> <i class="fas fa-folder"></i></h1>
                                <h4 class="text-center">Sorry No Recipient Found</h4>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-7">
        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex flex-wrap">
                    <h4 class="card-title mb-4">Add Recipients</h4>
                    <div class="ms-auto">
                    </div>
                </div>

                <add-recipient user='{{ auth()->user()->id }}'></add-recipient>
            </div>
        </div>
    </div>
</div>


@endsection
