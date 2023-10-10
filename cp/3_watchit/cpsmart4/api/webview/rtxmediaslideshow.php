<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RTXMODS: Media Slideshow</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: rgba(255, 255, 255, 0.5);
        }

        #slideshow {
            position: relative;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        img, video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            transition: opacity 2s ease-in-out;
        }

        .slide-indicator {
            display: inline-block;
            width: 10px;
            height: 10px;
            background-color: gray;
            border-radius: 50%;
            margin: 5px;
            cursor: pointer;
        }

        .active {
            background-color: rgba(255, 255, 255, 0.5);
        }
    </style>
</head>

<body>
    <div id="slideshow"></div>
    <div id="slide-indicators"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var jsonData = <?php echo base64_decode($_GET['data']); ?>;
            var mediaUrls = jsonData.map(obj => obj.AdUrl);

            var slideshow = document.getElementById("slideshow");
            
            loadSlides(mediaUrls); 
        });

        var slideIndex = 0;

        function getMediaType(url) {
            var extension = url.split('.').pop();
            if (extension === "jpg" || extension === "jpeg" || extension === "png" || extension === "gif") {
                return "image";
            } else if (extension === "mp4") {
                return "video";
            } else {
                return null;
            }
        }

        function loadSlides(mediaUrls) {
            mediaUrls.forEach(function(url) {
                var mediaType = getMediaType(url);
                var slideElement;

                if (mediaType === "image") {
                    slideElement = document.createElement("img");
                } else if (mediaType === "video") {
                    slideElement = document.createElement("video");
                    slideElement.autoplay = true;
                    slideElement.controls = false;
                    slideElement.muted = true;
                    slideElement.loop = false;

                    slideElement.addEventListener('ended', function() {
                        slideIndex++;
                        if (slideIndex >= mediaUrls.length) {
                            slideIndex = 0;
                        }
                        showSlides();
                    });
                }

                slideElement.src = url;
                slideshow.appendChild(slideElement);
            });

            showSlides();
        }

        function showSlides() {
            var slides = slideshow.childNodes;
            var prevIndex = (slideIndex - 1 < 0) ? slides.length - 1 : slideIndex - 1;
            slides[prevIndex].style.opacity = 0;
            slides[slideIndex].style.opacity = 1;

            slideIndex = (slideIndex >= slides.length - 1) ? 0 : slideIndex + 1;

            setTimeout(showSlides, 8000);
        }
    </script>
</body>
</html>