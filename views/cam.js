(function mainCam() {
        let saveButton = document.querySelector('#saveButton');
        var streaming = false,
                video = document.querySelector('#video'),
                canvas = document.querySelector('#canvas'),
                startButton = document.querySelector('#startButton'),
                thePic = document.querySelector('.thePic'),
                takePic = document.querySelector('.takePic');
                containUpload = document.querySelector('#containUpload');
        width = parseInt(window.getComputedStyle(takePic).width, 10);
        height = width * 0.75;
        navigator.getMedia = (navigator.getUserMedia ||
                navigator.webkitGetUserMedia ||
                navigator.mozGetUserMedia ||
                navigator.msGetUserMedia);
        if (navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({  audio: false, video: true })
               .then(function (stream) {
                try{
                        video.src = window.URL.createObjectURL(stream);
                } catch (error){
                        video.srcObject = stream;
                }
                video.play();
               })
               .catch(function (e) { return false; });
        } 
        else {
                navigator.getMedia({ audio: false, video: true},function(stream) {
                    video.srcObject = stream;
                    video.play();
                  },
                  function(err) {
                    return false;
                  }
                );
        }
        video.addEventListener('canplay', function (ev) {
                if (!streaming) {
                        canvas.setAttribute('max-width', width);
                        canvas.setAttribute('max-height', height);
                        video.setAttribute('max-width', width);
                        video.setAttribute('max-height', height);
                        streaming = true;
                }
        }, false);

        function takepicture() {
                canvas.width = parseInt(width, 10);
                canvas.height = height;
                canvas.getContext('2d').drawImage(video, 0, 0, width, height);
        }

        startButton.addEventListener('click', function (ev) {
                if (streaming) {
                        takepicture();
                        thePic.style.display = "block";
                        takePic.style.display = "none";
                        containUpload.style.display = "none";
                        ev.preventDefault();
                }
        }, false);

        const stickerList = ['dio', 'gnomed', 'punpun', 'ricardo', 'toby', 'trump-pepe'];
        let i = 0;
        let sticker = document.querySelector('.sticker');
        let sticker2 = document.querySelector('.sticker2');
        sticker.style.backgroundImage = "url('../stickers/" + stickerList[0] + ".png')";
        sticker2.style.backgroundImage = "url('../stickers/" + stickerList[0] + ".png')";
        let leftArrow = document.querySelector('.leftArrow');
        let rightArrow = document.querySelector('.rightArrow');

        leftArrow.addEventListener("click", function () {
                if (i === 0) {
                        i = stickerList.length - 1;
                        sticker.style.backgroundImage = "url('../stickers/" + stickerList[
                                i] + ".png')";
                        sticker2.style.backgroundImage = "url('../stickers/" + stickerList[
                                i] + ".png')";
                } else {
                        i--;
                        sticker.style.backgroundImage = "url('../stickers/" + stickerList[
                                i] + ".png')";
                        sticker2.style.backgroundImage = "url('../stickers/" + stickerList[
                                i] + ".png')";
                }
        })
        rightArrow.addEventListener('click', function () {
                if (i === stickerList.length - 1) {
                        i = 0;
                        sticker.style.backgroundImage = "url('../stickers/" + stickerList[
                                i] + ".png')";
                        sticker2.style.backgroundImage = "url('../stickers/" + stickerList[
                                i] + ".png')";
                } else {
                        i++;
                        sticker.style.backgroundImage = "url('../stickers/" + stickerList[
                                i] + ".png')";
                        sticker2.style.backgroundImage = "url('../stickers/" + stickerList[
                                i] + ".png')";
                }
        })
        startButton.addEventListener('click', function (e) {
                let stickername = stickerList[i];
                let checked = document.querySelector('.' + stickername);
                checked.checked = true;
        })
        saveButton.addEventListener('click', function (e) {
                let stickername = stickerList[i];
                let checked = document.querySelector('.' + stickername);
                checked.checked = true;
        })
})();

function clickUpload(e) {
        let labelUpload = document.querySelector("#ImageSelector");
        labelUpload.click();
}

function displayOnCanva(e) {
        let canvas = document.querySelector('#canvas');
        let startButton = document.querySelector('#startButton');
        let saveButton = document.querySelector('#saveButton');
        let takePic = document.querySelector('.takePic');
        let width = parseInt(window.getComputedStyle(takePic).width, 10);
        let canvasUpload = document.querySelector('#canvasUpload');
        let height = width * 0.75;
        if (e.files[0]) {
                startButton.style.display = "none";
                saveButton.style.display = "block";
                let reader = new FileReader();
                let image = new Image()
                reader.onload = function (e) {
                        document.querySelector('#video').style.display = "none";
                        canvasUpload.style.display = "block";
                        canvasUpload.setAttribute('max-width', width);
                        canvasUpload.setAttribute('max-height', height);
                        image.onload = function () {
                                canvasUpload.width = width;
                                canvasUpload.height = height;
                                canvasUpload.getContext('2d').drawImage(image, 0, 0, width, height);
                                canvas.width = width;
                                canvas.height = height;
                                canvas.getContext('2d').drawImage(image, 0, 0, width, height);
                                document.querySelector(".sticker").style.bottom = "0";
                        }
                        image.src = e.target.result;
                }
                reader.readAsDataURL(e.files[0]);
        }

}

function uploadImage() {
        let imagesUpload = document.querySelector("#imagesUpload");
        imagesUpload.click();
}

function hideThePic(ev) {
        thePic = document.querySelector('.thePic'),
        takePic = document.querySelector('.takePic');
        containUpload = document.querySelector('#containUpload');
        thePic.style.display = "block";
        takePic.style.display = "none";
        containUpload.style.display = "none";
}

