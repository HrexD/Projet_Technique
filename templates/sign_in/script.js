document.addEventListener("DOMContentLoaded", function() {
    var videoElement = document.getElementById("video-element");
    var screenshotButton = document.getElementById("screenshot-button");
    var saveButton = document.getElementById("save-button");
    var capturedImage = null;
    var mediaStream;

    screenshotButton.addEventListener("click", function() {
        var canvas = document.createElement("canvas");
        canvas.width = videoElement.videoWidth;
        canvas.height = videoElement.videoHeight;

        var context = canvas.getContext("2d");
        context.drawImage(videoElement, 0, 0, canvas.width, canvas.height);

        capturedImage = canvas.toDataURL("image/png");
    });

    saveButton.addEventListener("click", function() {
        if (capturedImage) {
            var a = document.createElement("a");
            a.href = capturedImage;
            a.download = "capture.png";
            a.click();
        }
    });

    navigator.mediaDevices
        .getUserMedia({ video: true })
        .then(function(stream) {
            videoElement.srcObject = stream;
            mediaStream = stream;
        })
        .catch(function(error) {
            console.error("Erreur lors de l'accès à la webcam :", error);
        });

    // Arrêter la lecture de la vidéo et la libérer lorsque la page se ferme
    window.addEventListener("beforeunload", function() {
        if (mediaStream) {
            mediaStream.getTracks().forEach(function(track) {
                track.stop();
            });
        }
    });
});
