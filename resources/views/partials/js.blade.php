@section('javascript')
    <script src="{{ asset('soft/assets/js/dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('soft/assets/js/dataTables.bootstrap4.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready( function () {
            $('#DataTable').DataTable();
        } );
    </script>
@endsection
