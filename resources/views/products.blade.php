@extends('layouts.master')
@section('content')

<header>
    <h1 class="bg-dark text-white text-center p-4">Products</h1>
</header>

    <div class="container">
        <div class="card-lists" id="card-lists">
            @csrf
            <div class="row" id="product_data">
                
            </div>
        </div>
    </div>



@endsection


@push('scripts')

    <script>
        $(document).ready(function() {
            var _token = $('input[name="_token"]').val();


            load_data('', _token);
            
            function load_data(id="", _token) {
           
                $.ajax({
                    url:"{{ route('loadmore.load_data') }}",
                    method:"POST",
                    data:{id: id, _token},
                    success:function(data) {
                        $('#load_more_button').remove();
                        $('#product_data').append(data);
                    }
                });
            }



            $(document).on('click', '#load_more_button', function() {
                var id = $(this).data('id');
                $('#load_more_button').html('<b>Loading....</b>');
                load_data(id, _token);
            });
        });
    </script>

@endpush