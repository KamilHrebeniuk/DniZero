function login() {
    $.post("../login_handler.php",
        {
            login: document.getElementById("login").value
        },
        function(status){
     //   alert(status);
            if(status !== "" && status !== "Error") {
                window.location.href = "index.php";
            } else {
                document.getElementById("error").style.display = "block";
            }
        });



}