     function loadUserHeadAsURL() {
         var filesSelected = document.getElementById("userHead_src").files;
         
         if (filesSelected.length > 0)
         {
             var fileToLoad = filesSelected[0];

             var f = document.getElementById("userHead_src").value;
 
             if (!/\.(png|jpg|jpeg)$/.test(f)){

               alert("图片类型必须是PNG,JPEG,JPG中的一种")
               return false;
             }
             else if (fileToLoad.size > 2*1024*1024 ) {
                alert("文件不能大于2M，请再次选择！");
                return false;
             }
             
             var fileReader = new FileReader();

             fileReader.onload = function(fileLoadedEvent) 
             {
                 var logo_encoded = document.getElementById("userHead_logo");
                 var logo_preview = document.getElementById("userHead_logo_preview");
                 logo_encoded.value = fileLoadedEvent.target.result;
                 logo_preview.setAttribute('src', fileLoadedEvent.target.result);
             };

             fileReader.readAsDataURL(fileToLoad);
         }
     }