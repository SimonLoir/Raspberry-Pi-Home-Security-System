// Pour obtenir une présentation du modèle Vide, consultez la documentation suivante :
// http://go.microsoft.com/fwlink/?LinkID=397704
// Pour déboguer du code durant le chargement d'une page dans cordova-simulate ou sur les appareils/émulateurs Android, lancez votre application, définissez des points d'arrêt, 
// puis exécutez "window.location.reload()" dans la console JavaScript.
var last_state = "";
(function () {
    "use strict";

    document.addEventListener( 'deviceready', onDeviceReady.bind( this ), false );

    function onDeviceReady() {
        // Gérer les événements de suspension et de reprise Cordova
        document.addEventListener( 'pause', onPause.bind( this ), false );
        document.addEventListener( 'resume', onResume.bind( this ), false );
        
        // TODO: Cordova a été chargé. Effectuez l'initialisation qui nécessite Cordova ici.
        getState()
        setInterval(getState, 5000)
    };

    function onPause() {
        // TODO: cette application a été suspendue. Enregistrez l'état de l'application ici.
    };

    function onResume() {
        // TODO: cette application a été réactivée. Restaurez l'état de l'application ici.
    };
})();
server_ip = "http://192.168.1.26/security/";
function getState() {
    AR.GET(server_ip + 'getSate.php', function (data) {

        if (last_state != data) {

            var update = true;
            $('#controls').html('');

        } else {
            var update = false;
        }

        if (data == "on") {
            $("#alarm_state").html("Alarme activée");
            last_state = "on";
            if (update) {
                var username = $('#controls').child('input').get(0);
                username.type = "text";
                username.placeholder = "Nom d'utilisateur";
                var password = $('#controls').child('input').get(0);
                password.type = "password";
                password.placeholder = "Mot de passe";
                $('#controls').child('button').html("Désactiver").click(function () {
                    
                    AR.POST(server_ip + 'alarm.php', {
                        username: username.value,
                        password: password.value
                    }, function (data) {
                        last_state = "";
                        $('#controls').html(data);
                    }, function (data) {
                        $('#controls').html("error");
                    });


                });
            }
        } else {
            $("#alarm_state").html("Alarme désactivée");
            last_state = "off";
            if (update) {
                $('#controls').child('button').html("Activer").click(function () {
                    AR.GET(server_ip + "alarm.php?on", function (data) {
                        $('#controls').html(data);
                    });
                });

            }
        }

    }, function () {
        $("#alarm_state").html("erreur");
    });
}