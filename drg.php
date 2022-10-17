<!DOCTYPE html>


<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - DropZone upload</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css'><link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="zone">
<form id="imageform" name="imageform" action="file_upload.php" method="POST" enctype="multipart/form-data">
  <div id="dropZ">
    <i class="fa fa-cloud-upload"></i>
    <div>Drag and drop your file here</div>                    
    <span>OR</span>
    <div class="selectFile">       
      <label for="file">Select file</label>                   
      <input type="file" name="files[]" id="customFile" onchange="this.form.submit()">
	  
    </div>
    <p>File size limit : 10 MB</p>
  </div>
</form>
</div>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="./script.js"></script>

</body>
</html>
