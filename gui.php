<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alarm system</title>
    <script src="extjs.js"></script>
    <style>
        body{
            background:rgb(64,64,64);
            color:white;
            font-family: sans-serif;

        }

        .security{
            position:fixed;
            top: 0;left: 0;right: 0;bottom: 0;
            height: 100%;
            width: 100%;
            background:rgb(64,64,64);
            
        }

        .security h1 {
            position: absolute;
            top: 50%;
            left: 50%;
            transform:translateX(-50%) translateY(-50%);
            text-align:center;
        }

        .security h1 button {
            background:transparent;
            color:white;
            text-decoration:underline;
            border:none;
        }
    </style>
</head>
<body>
    
    <audio src="siren.mp3" id="alarm"></audio>
    <div class="log"></div>
    <img src="" alt="" style="width:30vh;">
    <div class="security">
        
    </div>
    <script>
        //document.querySelector('#alarm').play();
        $( document ).ready( function () {

            setInterval( alarma , 1000 );

        });

        function alarma(){
            
            AR.GET("alarm_state.txt?" + Math.round ( new Date().getTime() / 1000 ), function (data){
                
                 $('.security').get(0).style.background = "rgb(64,64,64)";
                if(data == 'on'){
                    get();
                    $('.security').html('');
                    $('.security').child('h1').html('Alarme activée');
                    $('.security h1').child('br');
                    $('.security h1').child('button').html('Désactiver l\'alarme intelligente').click(function () {
                        var x = prompt('Password');
                        AR.GET('alarm.php?p=' + x, function () {});
                    });
                }else{
                    document.querySelector('#alarm').pause();
                    $('.security').html('');
                    $('.security').child('h1').html('Alarme désactivée');
                    $('.security h1').child('br');
                    $('.security h1').child('button').html('Activer l\'alarme intelligente').click(function () {
                        AR.GET('alarm.php?on', function () {});
                    });
                };
            })
        }

        function alarm(now) {
            $('.security').get(0).style.background = "red";
            document.querySelector('#alarm').play();
            document.querySelector('img').src="../last.png#" + now;
             $('.log').html('e' + now);
        }
        function get() {
                
               AR.GET( "index.php?ajax&id=0" , function ( data ) {

                    if( data != "" ) {

                        var now = Math.round ( new Date().getTime() / 1000 );

                        if( now - parseFloat( data ) > 20){
                            
                            console.log('Ok');
                            $('.log').html(now)
                            

                        }else{

                            alarm(now);
                            

                        }

                    }else{

                        console.log("Ok");
                        $('.log').html('ok')

                    }

               });
               AR.GET( "index.php?ajax&id=1" , function ( data ) {

                    if( data != "" ) {

                        var now = Math.round ( new Date().getTime() / 1000 );

                        if( now - parseFloat( data ) > 20){
                            
                            console.log('Ok');
                            $('.log').html('ok' + now)

                        }else{

                            alarm(now);

                        }

                    }else{

                        console.log("Ok");

                    }

               });
                AR.GET( "index.php?ajax&id=2" , function ( data ) {

                    if( data != "" ) {

                        var now = Math.round ( new Date().getTime() / 1000 );

                        if( now - parseFloat( data ) > 20){
                            
                            console.log('Ok');
                            $('.log').html('ok' + now)

                        }else{

                            alarm(now);

                        }

                    }else{

                        console.log("Ok");

                    }

               });

            }
    </script>
</body>
</html>