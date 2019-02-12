(function() {
    var video = document.getElementById('video'),
    canvas = document.getElementById('canvas'),
    context = canvas.getContext('2d'),
    mask = document.getElementById('mask'),
    hundred = document.getElementById('hundred'),
    thuglife = document.getElementById('thuglife'),
    vendorURL = window.URL || window.webkitURL;

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

        mask.addEventListener('click', function(){
            context.drawImage(mask, 30, 60, 350, 175);
        })

        hundred.addEventListener('click', function() {
            context.drawImage(hundred, 290, 10, 105, 100);
        })

        thuglife.addEventListener('click', function(){
            context.drawImage(thuglife, 150, 50, 140, 100);
        })

        document.getElementById('capture').addEventListener('click', function () {
            context.drawImage(video, 0, 0, 400, 300);
            document.getElementById('img').value = canvas.toDataURL("img/png");
        });
})();