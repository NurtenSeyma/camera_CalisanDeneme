<div class="modal-header">
<h5 class="modal-title">Fotoğraf Çek</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body" style="overflow: hidden;">

    <video id="video" autoplay style="width:100%;"></video>
    <canvas id="canvas" style="display: none" width=1920 height=1080></canvas>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
<button type="button" class="btn btn-primary" id="camera">Kamera Aç</button>
<button type="button" class="btn btn-warning" id="capture">Fotoğraf Çek</button>
</div>



<script>
(function() {

    const camera = document.getElementById('camera');
    const capture = document.getElementById('capture');
    const video = document.getElementById('video');
    //
    const canvas = document.getElementById('canvas');
    const context = canvas.getContext('2d');

    camera.onclick = function() {
        navigator.mediaDevices.getUserMedia({
            video: true
        })
        .then(stream => {
            window.localStream = stream;
            video.srcObject = stream;
        })
        .catch((err) => {
            console.log(err);
        });
    };


    capture.onclick = function() {
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        var temp = canvas.toDataURL();
        $.ajax({
            url:"include/capture.php",
            type: "POST",
            data: {image:temp},
            success: function (response) {
            

            
            }
        });
        video.style.display="none";
        canvas.style.display="block";
        //
        localStream.getVideoTracks()[0].stop();
        video.src = '';
        $('#globalModal').modal('toggle');
    };


})();
</script>