    var video = document.getElementById('video'),
    canvas = document.getElementById('canvas'),
    context = canvas.getContext('2d'),
    WSL = document.getElementById('WSL'),
    hundred = document.getElementById('hundred'),
    alien = document.getElementById('alien');

    navigator.getMedia =    navigator.getUserMedia ||
                            navigator.webkitGetUserMedia ||
                            navigator.mozGetUserMedia ||
                            navigator.msGetUserMedia;

    navigator.getMedia({
            video: true,
            audio: false
        },(function(stream) {
            video.srcObject = stream;
            video.play();
        }), function(error) {
            // An error occurred
            // error.code
        });

        WSL.addEventListener('click', function(){
            context.drawImage(WSL, 10, 150, 150, 150);
        })

        hundred.addEventListener('click', function() {
            context.drawImage(hundred, 290, 200, 105, 100);
        })

        alien.addEventListener('click', function(){
            context.drawImage(alien, 110, 10, 200, 250);
        })

        document.getElementById('capture').addEventListener('click', function () {
            context.drawImage(video, 0, 0, 400, 300);
            document.getElementById('img').value = canvas.toDataURL("img/png");
        });