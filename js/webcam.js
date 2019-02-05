(function() {
    var video = document.getElementById('video'),
    canvas = document.getElementById('canvas'),
    context = canvas.getContext('2d'),
    photo = document.getElementById('photo'),
    vendorURL = window.URL || window.webkitURL;

    navigator.getMedia = (navigator.getUserMedia ||
        navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia ||
        navigator.msGetUserMedia);

    navigator.getMedia({
            video: true,
            audio: false
        }),(function(stream) {
            video.src = vendorURL.createObjectURL(stream);
            video.play();
        });

    document.getElementById("capture").addEventListener('click', function() {
        context.drawImage(video, 0, 0, 400, 300);
    });

})();