(function() {
    var video = document.getElementById('video');
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    var img;
    var vendorURL = window.URL || window.webkitURL;

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

        document.getElementById('capture').addEventListener('click', function () {
            context.drawImage(video, 0, 0, 400, 300);
            document.getElementById('img').value = canvas.toDataURL("img/png");
        });

})();