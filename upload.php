<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>upload video</title>

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


    <link rel="stylesheet" href="style.css">

    <?php
include('config.php');

$subject = '';
$title = '';

if(isset($_POST['subject'])){
    $subject = $_POST['subject'];
}
if(isset($_POST['title'])){
    $title = $_POST['title'];
}

if(isset($_POST['but_upload'])){
    $maxsize = 1073741824; // حد أقصى لحجم الملف بالبايت (1 جيجابايت)
    $name = ''; // تعيين قيمة افتراضية للمتغير
    $videofiletype = ''; // تعيين قيمة افتراضية للمتغير

    if(isset($_FILES['file'])) {
        $name = $_FILES['file']['name'];
        $target_dir = "videos/";
        $target_file = $target_dir . basename($_FILES['file']['name']);
        $videofiletype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $extension_arr = array("mp4","mpeg","avi","3gp");
        
        if(in_array($videofiletype, $extension_arr)){
            if($_FILES['file']['size'] > $maxsize || $_FILES['file']['size'] == 0){
                echo "<center><h1 class='failed'>نعتذر! الملف كبير جداً، يجب أن يكون حجمه أقل من 5 ميغابايت</h1></center>";
                exit; // إيقاف تنفيذ الكود بعد عرض الرسالة
            } else {
                if(move_uploaded_file($_FILES['file']['tmp_name'], $target_file)){
                    $location =  $target_file; // تعيين الموقع بقيمة المجلد الذي يتم فيه حفظ ملفات الفيديو
                    $query = "INSERT INTO videos (name, location, subject, title) VALUES ('".$name."', '".$location."', '$subject', '$title')";
                    mysqli_query($con , $query);
                    echo "<div class='success_div' id='failed'><center><h1 class='success'>تم رفع الفيديو بنجاح</h1><button class='hidden_btn' id='hidden_btn'>حسنا</button></center></div>";
                } else {
                    echo "<div class='failed' id='failed'><center><h1 class='failed'>حدث خطأ أثناء رفع الملف</h1></center></div>";
                }
            }
        } else {
            echo "<div class='failed' id='failed'><center><h1 class='failed_text'>  MP4, MPEG, AVI, أو 3GP نوع الملف غير مدعوم، يرجى اختيار ملف من نوع</h1><button class='hidden_btn' id='hidden_btn'>حاول مجددا</button></center></div>";
        }
    }
}
?>







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
                <a href="http://localhost/shorts/">
                    <i class="fas fa-chart-pie"></i>
                    <p>Brief</p>
                </a>
            </li>
            <li>
                <a href="http://localhost/shorts/upload/upload.php"   class="actev">
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



<center>
<div class="mi">
    <img src="images/images.jpg" class="logo_img">
    <h1 class="start_text">كن جزءا من</h1>
    <h1 class="Cliptive">Cliptive</h1>

    

    <div class="countainer">
        <div class="form">
            
            <form method="post" enctype="multipart/form-data">
            <label for="file" class="labelFile"
  ><span
    ><svg
      xml:space="preserve"
      viewBox="0 0 184.69 184.69"
      xmlns:xlink="http://www.w3.org/1999/xlink"
      xmlns="http://www.w3.org/2000/svg"
      id="Capa_1"
      version="1.1"
      width="60px"
      height="60px"
    >
      <g>
        <g>
          <g>
            <path
              d="M149.968,50.186c-8.017-14.308-23.796-22.515-40.717-19.813
				C102.609,16.43,88.713,7.576,73.087,7.576c-22.117,0-40.112,17.994-40.112,40.115c0,0.913,0.036,1.854,0.118,2.834
				C14.004,54.875,0,72.11,0,91.959c0,23.456,19.082,42.535,42.538,42.535h33.623v-7.025H42.538
				c-19.583,0-35.509-15.929-35.509-35.509c0-17.526,13.084-32.621,30.442-35.105c0.931-0.132,1.768-0.633,2.326-1.392
				c0.555-0.755,0.795-1.704,0.644-2.63c-0.297-1.904-0.447-3.582-0.447-5.139c0-18.249,14.852-33.094,33.094-33.094
				c13.703,0,25.789,8.26,30.803,21.04c0.63,1.621,2.351,2.534,4.058,2.14c15.425-3.568,29.919,3.883,36.604,17.168
				c0.508,1.027,1.503,1.736,2.641,1.897c17.368,2.473,30.481,17.569,30.481,35.112c0,19.58-15.937,35.509-35.52,35.509H97.391
				v7.025h44.761c23.459,0,42.538-19.079,42.538-42.535C184.69,71.545,169.884,53.901,149.968,50.186z"
              style="fill: aliceblue;"
            ></path>
          </g>
          <g>
            <path
              d="M108.586,90.201c1.406-1.403,1.406-3.672,0-5.075L88.541,65.078
				c-0.701-0.698-1.614-1.045-2.534-1.045l-0.064,0.011c-0.018,0-0.036-0.011-0.054-0.011c-0.931,0-1.85,0.361-2.534,1.045
				L63.31,85.127c-1.403,1.403-1.403,3.672,0,5.075c1.403,1.406,3.672,1.406,5.075,0L82.296,76.29v97.227
				c0,1.99,1.603,3.597,3.593,3.597c1.979,0,3.59-1.607,3.59-3.597V76.165l14.033,14.036
				C104.91,91.608,107.183,91.608,108.586,90.201z"
              style="fill: aliceblue;"
            ></path>
          </g>
        </g>
      </g></svg></span>
  <p class="file_text">اختر ملف الفيديو</p></label>
<input class="input" name="file" id="file" type="file" />
<br><br>
<a href="#scroll" class="button">
  <span class="text">تم</span>
  <svg class="arrow" viewBox="0 0 448 512" height="1em" xmlns="http://www.w3.org/2000/svg"><path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"></path></svg>
</a>
</div>

        <div class="main">
                <br><br><br><br><br><br><h1 id="scroll"></h1><br><br><br><br><br><br><br>
                <h1 id="scroll"></h1>
                <input type="text" name="subject" id="subject" placeholder="اكتب عنوانا للفيديو">
                <br>
                <input type="text" name="title" id="title" placeholder="وصف الفيديو" min="1" max="11">
                <br>
                <input class="submit" type="submit" id="submit" value="رفع الفيديو" name="but_upload">
        </div>


            </form>
        </div>
    </div>
</center>


<script>
    var hidden_btn = document.getElementById('hidden_btn'),
      failed = document.getElementById('failed');

  hidden_btn.onclick= function(){
    failed.style.display='none';
  }
</script>

</body>
</html>


