@extends("layouts.app")

@section("title")
Send money
@endsection

@section("content")
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0 font-size-18">Send money</h4>
</div>

<transaction :recipients="{{ auth()->user()->recipients() }}" :user="{{ auth()->user() }}"></transaction>


@endsection
