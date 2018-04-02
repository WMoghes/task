@extends('layouts.app')

@section('content')
<div class="container" id="login-form">
    @include('auth.includes.login_form')
</div>
@endsection

@section('script')
    <script>
        $(document).on('click', '#submit', function(event) {
            event.preventDefault();

            if ($('#email').val() == '' || $('#password').val() == '') {
                alert('Please make that entered all required data');
                return false;
            }

            $.ajax({
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                type: 'post',
                url: '{{ route('login') }}',
                data: {
                    'email': $('#email').val(),
                    'password': $('#password').val(),
                },
                success: function(data) {
                    if (data == 1) {
                        window.location.href = '{{ url('/1') }}';
                    }
                    $('body').html('');
                    $('body').html(data);
                }
            });
        });
    </script>
@endsection
