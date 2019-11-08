(function mainCam() {
        var saveButton = document.querySelector('#saveButton');
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

        var stickerList = ['dio', 'gnomed', 'punpun', 'ricardo', 'toby', 'trump-pepe'];
        var i = 0;
        var sticker = document.querySelector('.sticker');
        var sticker2 = document.querySelector('.sticker2');
        sticker.style.backgroundImage = "url('/stickers/" + stickerList[0] + ".png')";
        sticker2.style.backgroundImage = "url('/stickers/" + stickerList[0] + ".png')";
        var leftArrow = document.querySelector('.leftArrow');
        var rightArrow = document.querySelector('.rightArrow');

        leftArrow.addEventListener("click", function () {
                if (i === 0) {
                        i = stickerList.length - 1;
                        sticker.style.backgroundImage = "url('/stickers/" + stickerList[
                                i] + ".png')";
                        sticker2.style.backgroundImage = "url('/stickers/" + stickerList[
                                i] + ".png')";
                } else {
                        i--;
                        sticker.style.backgroundImage = "url('/stickers/" + stickerList[
                                i] + ".png')";
                        sticker2.style.backgroundImage = "url('/stickers/" + stickerList[
                                i] + ".png')";
                }
        })
        rightArrow.addEventListener('click', function () {
                if (i === stickerList.length - 1) {
                        i = 0;
                        sticker.style.backgroundImage = "url('/stickers/" + stickerList[
                                i] + ".png')";
                        sticker2.style.backgroundImage = "url('/stickers/" + stickerList[
                                i] + ".png')";
                } else {
                        i++;
                        sticker.style.backgroundImage = "url('/stickers/" + stickerList[
                                i] + ".png')";
                        sticker2.style.backgroundImage = "url('/stickers/" + stickerList[
                                i] + ".png')";
                }
        })
        startButton.addEventListener('click', function (e) {
                var stickername = stickerList[i];
                var checked = document.querySelector('.' + stickername);
                checked.checked = true;
        })
        saveButton.addEventListener('click', function (e) {
                var stickername = stickerList[i];
                var checked = document.querySelector('.' + stickername);
                checked.checked = true;
        })
})();

function clickUpload(e) {
        var labelUpload = document.querySelector("#ImageSelector");
        labelUpload.click();
}

function displayOnCanva(e) {
        var canvas = document.querySelector('#canvas');
        var startButton = document.querySelector('#startButton');
        var saveButton = document.querySelector('#saveButton');
        var takePic = document.querySelector('.takePic');
        var width = parseInt(window.getComputedStyle(takePic).width, 10);
        var canvasUpload = document.querySelector('#canvasUpload');
        var height = width * 0.75;
        if (e.files[0]) {
                startButton.style.display = "none";
                saveButton.style.display = "block";
                var reader = new FileReader();
                var image = new Image()
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
                        if(e.target.result != 'data:')
                                image.src = e.target.result;
                }
                reader.readAsDataURL(e.files[0]);
        }

}

function uploadImage() {
        var imagesUpload = document.querySelector("#imagesUpload");
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

function moveSticker(event){
        var sticker = document.querySelector('.sticker');
        var sticker2 = document.querySelector('.sticker2');
        var takePic = document.querySelector('#video');
        if(takePic.style.display == 'none')
                takePic = document.querySelector('#canvasUpload');
        var inputY = document.querySelector('.posY');
        var inputX = document.querySelector('.posX');
        var stickerWidth = parseInt(window.getComputedStyle(sticker).width, 10);
        var stickerHeight = parseInt(window.getComputedStyle(sticker).height, 10);
        var canvaWidth = parseInt(window.getComputedStyle(takePic).width, 10);
        var canvaHeight = parseInt(window.getComputedStyle(takePic).height, 10);
        posX = (parseInt(sticker.style.left) || 0);
        if(canvaWidth && canvaHeight){
                if(event.keyCode == 65 || event.which == 65){
                        if(posX - Math.floor((canvaWidth - stickerWidth)/3) >= 0){
                                posX -= Math.floor((canvaWidth - stickerWidth)/3);
                        }
                        else{
                                posX = 0;    
                        }
                        sticker.style.left = posX + 'px';
                        sticker2.style.left = posX + 'px';
                }
                if(event.keyCode == 68 || event.which == 68){
                        if(Math.floor((canvaWidth - stickerWidth)/3) + posX  <= Math.floor(canvaWidth - stickerWidth)){
                                posX += Math.floor((canvaWidth - stickerWidth)/3);
                        }
                        sticker.style.left = posX + 'px';
                        sticker2.style.left = posX + 'px';
                }
                posY = (parseInt(sticker.style.bottom) || 0);
                if(event.keyCode == 87 || event.which == 87){
                        if(Math.floor((canvaHeight - stickerHeight)/3) + posY  <= Math.floor(canvaHeight - stickerHeight)){
                                posY += Math.floor((canvaHeight - stickerHeight)/3);
                        }
                        sticker.style.bottom = posY + 'px';
                        sticker2.style.bottom = posY + 'px';
                }
                if(event.keyCode == 83 || event.which == 83){
                        if(posY - Math.floor((canvaHeight - stickerWidth))/3  > 0){
                                posY -= Math.floor((canvaHeight - stickerHeight))/3;
                        }
                        else{
                                posY = 0;    
                        }
                        sticker.style.bottom = posY + 'px';  
                        sticker2.style.bottom = posY + 'px';  
                }
                inputY.value = (posY == 6)?((posY-6)/(canvaHeight - stickerHeight))/(1/3) : (posY/(canvaHeight - stickerHeight))/(1/3);
                inputX.value = (posX/(canvaWidth - stickerWidth))/(1/3);                        
        }          
};
function adaptSticker(){
        var sticker = document.querySelector('.sticker');
        sticker.style.bottom = 6 + 'px'; 
        sticker.style.left = 0 + 'px'; 
}; 
