<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $(document).on('click','#profilepiclogin',function(e){
            e.preventDefault();
            $("#loginRegisterModal").modal('show');
        });

        $("#toggleLoginRegister").click(function() {
            $("#loginform, #UserRegistrationForm").toggleClass("d-none");
            var loginHeader = $("#loginRegisterModalLabel");
            var toggleBtn = $(this);
            if (loginHeader.text() === "Login / Register") {
                loginHeader.text("Register");
                toggleBtn.text("Already have an account? Login here.");
            } else {
                loginHeader.text("Login / Register");
                toggleBtn.text("Don't have an account? Register here.");
            }
        });
    });
</script>


