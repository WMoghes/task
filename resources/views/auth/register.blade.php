@extends('layouts.app')

@section('content')
<div class="container" id="register-form">
    @include('auth.includes.register_form')
</div>
@endsection

@section('script')
    <script>
        $(document).on('click', '#submit', function(event) {
            event.preventDefault();

            if ($('#username').val() == '' || $('#email').val() == '' ||
                    $('#password').val() == '' || $('#password-confirm').val() == '') {
                alert('Please make that entered all required data');
                return false;
            } else if ($('#password').val() !== $('#password-confirm').val()) {
                alert('The password confirmation does not match.');
                return false;
            } else if (! validateEmail($('#email').val())) {
                alert('Invalid Email');
                return false;
            }

            $.ajax({
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                type: 'post',
                url: '{{ route('register') }}',
                data: {
                    'username': $('#username').val(),
                    'email': $('#email').val(),
                    'address': $('#address').val(),
                    'password': $('#password').val(),
                    'password_confirmation': $('#password-confirm').val(),
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

        function validateEmail(email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }
    </script>
@endsection
