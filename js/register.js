function register_workshop(target) {
	
	let c = confirm("Czy na pewno chcesz się zapisć?");

	if(c){
		if(target < 10) {
			$.post("../register/register_workshop_1.php",
				{
					target: target
				},
				function (status) {
					alert(status);
				});
		}
		else{
			$.post("../register/register_workshop_2.php",
				{
					target: target
				},
				function (status) {
					alert(status);
				});
		}
	}
}


function register_day_game(){
    $.post("../register/register_day_game.php",
        {
            name: document.getElementsByClassName('register-input')[0].value,
            person1: document.getElementsByClassName('register-input')[1].value,
            person2: document.getElementsByClassName('register-input')[2].value,
            person3: document.getElementsByClassName('register-input')[3].value,
            person4: document.getElementsByClassName('register-input')[4].value,
            person5: document.getElementsByClassName('register-input')[5].value,
            person6: document.getElementsByClassName('register-input')[6].value,
            person7: document.getElementsByClassName('register-input')[7].value,
            person8: document.getElementsByClassName('register-input')[8].value,
            person9: document.getElementsByClassName('register-input')[9].value,
            person10: document.getElementsByClassName('register-input')[10].value
        },
        function(status){
                alert(status);
            /*    if(status !== "" && status !== "Error") {
                    window.location.href = "index.php";
                } else {
                    document.getElementById("error").style.display = "block";
                }*/
        });
}