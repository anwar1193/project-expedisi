    var video1 = document.querySelector("#videoElement1");
    var video2 = document.querySelector("#videoElement2");
    var canvas = document.querySelector("#canvas");
    var canvas2 = document.querySelector("#canvas2");
    var snapshot1 = document.querySelector("#snapshot1");
    var snapshot2 = document.querySelector("#snapshot2");
    var captureButton1 = document.querySelector("#capture1");
    var captureButton2 = document.querySelector("#capture2");

    if (navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(function (stream) {
            video1.srcObject = stream;
            video2.srcObject = stream;
        })
        .catch(function (err0r) {
        console.log("Something went wrong!");
        });
    }

    function takeSnapshot(video, canvas) {
        var context = canvas.getContext('2d');
        context.drawImage(video, 0, 0, video.width, video.height);
        return canvas.toDataURL('image/png');
    }