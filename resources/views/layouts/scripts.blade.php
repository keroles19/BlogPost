<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
<script>$(document).ready(function () {
        $('.switch-tologin-modal').on('click', function () {
            $('#register-modal').modal('hide');
            $('#login-modal').modal('show');
        })
        $('.switch-toregister-modal').on('click', function () {
            $('#login-modal').modal('hide');
            $('#register-modal').modal('show');
        })
    })</script>