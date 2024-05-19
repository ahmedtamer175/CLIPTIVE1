<?php
include('config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100..900&family=Noto+Sans+Arabic:wdth,wght@85.7,100..900&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />




    <!-- مكتبات js -->
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.7/plyr.css">


    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="menu">
        <ul>
            <li class="profile">
                <div class="img-box">
                    <img src="https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.pngwing.com%2Fen%2Fsearch%3Fq%3Duser&psig=AOvVaw1nwqfR-0PATXIymbhXx5fX&ust=1715777064767000&source=images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCMjOoeWVjYYDFQAAAAAdAAAAABAR">
                </div>
                <h2>user</h2>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-home"></i>
                    <p>home</p>
                </a>
            </li>
            <li>
                <a href="http://localhost/shorts/"  class="actev">
                    <i class="fas fa-chart-pie"></i>
                    <p>Brief</p>
                </a>
            </li>
            <li>
                <a href="http://localhost/shorts/upload/upload.php">
                    <i class="fas fa-table"></i>
                    <p>You</p>
                </a>
            </li>
            
            <li>
                <a href="#">
                    <i class="fas fa-pen"></i>
                    <p>posts</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-star"></i>
                    <p>favoret</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-cog"></i>
                    <p>settings</p>
                </a>
            </li>
            <li class="out">
                <a href="#">
                    <i class="fas fa-sign-out"></i>
                    <p>log out</p>
                </a>
            </li>

        </ul>
    </div>
    



    <br>
    <div class="app_video" id="scoller">
    <?php
    $fetchallvideos = mysqli_query($con,"SELECT * FROM videos ORDER BY id DESC");
    while($row = mysqli_fetch_assoc($fetchallvideos)){
        $location =  $row['location'];
        $subject  =  $row['subject'];
        $title    =  $row['title'];
        
        echo '<div class="vedio">';
        echo '<video loop src="upload/'.$location.'" class="video_player" loading="lazy"></video>';
        echo '<div class="audio"><button class="mute_button">🔊</button><input type="range" class="volume_slider" min="0" max="1" step="0.1" value="1"></div>';
        echo '<div class="footer">';
        echo '<div class="footer_text">';
        echo '<h2>AHMED TAMER</h2>';
        echo '<p class="description">'.$subject.'</p>';
        echo '<marquee>'.$title.'</marquee>';
        echo '<h1 class="rotate">💿</h1>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    ?>
</div>

<script>
    const videos = document.querySelectorAll('video');
    const muteButtons = document.querySelectorAll('.mute_button');
    const volumeSliders = document.querySelectorAll('.volume_slider');

    let currentVolume = 1; // مستوى الصوت الحالي الافتراضي

    for (let i = 0; i < videos.length; i++) {
        const video = videos[i];
        const muteButton = muteButtons[i];
        const volumeSlider = volumeSliders[i];

        video.addEventListener('click', function () {
            if (video.paused) {
                video.play();
            } else {
                video.pause();
            }
        });

        muteButton.addEventListener('click', function () {
            if (video.muted) {
                video.muted = false;
                muteButton.textContent = '🔊';
            } else {
                video.muted = true;
                muteButton.textContent = '🔇';
                volumeSlider.value = 0; // تحديث موضع المقبض لصفر عند كتم الصوت
            }
        });

        volumeSlider.addEventListener('input', function () {
            video.volume = volumeSlider.value;
            currentVolume = volumeSlider.value; // تحديث مستوى الصوت الحالي
            if (currentVolume > 0) {
                muteButton.textContent = '🔊';
            } else {
                muteButton.textContent = '🔇';
            }
        });
    }

    document.getElementById("scoller").addEventListener('scroll', function () {
        const targetvideo = document.elementsFromPoint(window.innerWidth / 2, window.innerHeight / 2).find(el => el.tagName === 'VIDEO');
        const playingvd = document.querySelectorAll('video[isPlaying="true"]');
        console.log('===scroll=Event==', targetvideo);

        if (playingvd && playingvd.length > 0) {
            playingvd.forEach((elm) => {
                elm.setAttribute('isPlaying', 'false');
                elm.pause();
            });
        }

        if (targetvideo) {
            targetvideo.play();
            targetvideo.setAttribute('isPlaying', 'true');
            targetvideo.volume = currentVolume; // تعيين مستوى الصوت للفيديو الجديد
            const targetVolumeSlider = targetvideo.closest('.vedio').querySelector('.volume_slider');
            targetVolumeSlider.value = currentVolume; // تحديث موضع الشريط
        }
        // داخل الحلقة التي تقوم بتكرار الفيديوهات
muteButton.addEventListener('click', function () {
    if (video.muted) {
        video.muted = false;
        muteButton.textContent = '🔊';
        volumeSlider.value = currentVolume; // تحديث موضع المقبض ليعكس حالة الصوت
    } else {
        video.muted = true;
        muteButton.textContent = '🔇';
        volumeSlider.value = 0; // تحديث موضع المقبض لصفر عند كتم الصوت
    }
});

    });
</script>




        

</body>
    
</html>




