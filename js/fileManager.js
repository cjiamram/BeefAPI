var full = location.pathname;
var res = full.split("/");
var projectPath="/"+res[1];

function makeFolder(folder){
     $.ajax({
        url: projectPath+'/fileManagement/makeFolder.php?folder='+folder,
        type: 'get',
        contentType: false,
        processData: false,
        success: function(response){

        }

     });

  }

  function fileUpload(flDoc,folder){
       makeFolder(folder);
       var fd = new FormData();
       var files = $('#'+flDoc)[0].files[0];
       fd.append('file',files);

       console.log(files);

       $.ajax({
            url: projectPath+'/fileManagement/upload.php?folder='+folder,
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                if(response != 0){
                }
                else{
                }
            }

       });
  }