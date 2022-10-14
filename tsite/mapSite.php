<!DOCTYPE html>
<?php
  include_once "../config/config.php";
  $cnf=new Config();
  $rootPath=$cnf->path;
?>
<html>
  <head>
    <title></title>
     <style>
    /* CSS comes here */
  
    .contentarea {
        font-size: 16px;
        font-family: Arial;
        text-align: center;
    }
    </style>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link rel="stylesheet" type="text/css" href="<?=$rootPath?>/css/mapSite.css" />

    <?php
        $id=isset($_GET["id"])?$_GET["id"]:0;
    ?>
    <script>

     
        var uri = window.location.protocol+"//"+window.location.host ;

        var markers = [];
        let map;

      
        function initMap() {
          /*var url="/DetectGarment/tgarmentsite/getGarmentSite.php?code=<?=$code?>";*/
          var url ="<?=$rootPath?>/tsite/readOne.php?id=<?=$id?>";
          var data=queryData(url);
         //console.log(data);
         if(data!==undefined){
            map = new google.maps.Map(document.getElementById("map"), {
              center: { lat: data.lat, lng: data.lng },
              zoom: 10,
            });
          }else{
          map = new google.maps.Map(document.getElementById("map"), {
              center: { lat: 14.98443970014398, lng: 102.11295494169933 },
              zoom: 10,
            });
          }


         

          var infoWindows = new google.maps.InfoWindow({
               
           }); 

          //***********************************
          var input = document.getElementById('searchInput');
          map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);

          /***** เพิ่ม Feature ให้กับ textbox ให้สามารถพิมพ์ค้นหาสถานที่ได้*****/
          var autocomplete = new google.maps.places.Autocomplete(input);
          autocomplete.bindTo('bounds', map);

          var infowindow = new google.maps.InfoWindow();

          /***** กำหนดคุณสมบัติให้กับตัวพิกัดจุดหรือ marker *****/
          var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29)
          });
          markers.push(marker); //เก็บค่าการกำหนดจุดพิกัดไว้ในตัวแปร markers เพื่อใช้ล้างข้อมูลการกำหนดจุดได้

          /***** ทำงานกับ event place_changed หรือเมื่อมีการเปลี่ยนแปลงค่าสถานที่ที่ค้นหา*****/
          autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
          window.alert("ไม่ค้นพบพิกัดจากสถานที่ดังกล่าว");
          return;
          }

          /***** แสดงผลบนแผนที่เมื่อพบข้อมูลที่ต้องการค้นหา *****/
          if (place.geometry.viewport) {
          map.fitBounds(place.geometry.viewport);
          } else {
          map.setCenter(place.geometry.location);
          //sv.getPanorama({ location: place.geometry.location, radius: 50 }, processSVData);
          map.setZoom(17);
          }
          marker.setIcon(({
          url: place.icon,
          size: new google.maps.Size(71, 71),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(17, 34),
          scaledSize: new google.maps.Size(35, 35)
          }));
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          /***** แสดงรายละเอียดผลลัพธ์การค้นหา *****/
          var address = '';
          if (place.address_components) {
          address = [
            (place.address_components[0] && place.address_components[0].short_name || ''),
            (place.address_components[1] && place.address_components[1].short_name || ''),
            (place.address_components[2] && place.address_components[2].short_name || '')
          ].join(' ');
          }
          /***** แสดงรายละเอียดผลลัพธ์การค้นหาเป็น popup โดยมีชื่อและสถานที่ดังกล่าว *****/
          infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
          infowindow.open(map, marker);

          /***** แสดงรายละเอียดผลลัพธ์การค้นหา ซึ่งประกอบด้วย ที่อยู่ รหัสไปรษณีย์ ประเทศ ละติจูดและลองจิจูด *****/
          for (var i = 0; i < place.address_components.length; i++) {
          if(place.address_components[i].types[0] == 'postal_code'){
            //document.getElementById('postal_code').innerHTML = place.address_components[i].long_name;
          }
          if(place.address_components[i].types[0] == 'country'){
            //document.getElementById('country').innerHTML = place.address_components[i].long_name;
          }
          }
            //document.getElementById('location').innerHTML = place.formatted_address;
            //document.getElementById('lat').innerHTML = place.geometry.location.lat();
            //document.getElementById('lon').innerHTML = place.geometry.location.lng();
          });


          //***********************************  

        
          //*************************************
          map.addListener("click", (mapsMouseEvent) => {
          // Close the current InfoWindow.
          infoWindows.close();
          // Create a new InfoWindow.
          infoWindows = new google.maps.InfoWindow({
            position: mapsMouseEvent.latLng,
          });
          infoWindows.setContent(
            JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
          );
          infoWindows.open(map);
        });    

          //*************************************


          var url="<?=$rootPath?>/tsite/getAllData.php";
          var datas=queryData(url);
          if(datas!==undefined)
          for(i=0;i<datas.length;i++){
              
                    var marker = new google.maps.Marker({
                        position: { lat: datas[i].lat, lng: datas[i].lng },
                        map: map,
                    });

                    google.maps.event.addListener(marker, 'click', (
                    function(marker, i) {
                      return function() {

                          var content="<table>";
                          content+="<tr>";
                          content+="<td align='right'>ผู้ผลิต :";
                          content+="</td>";
                          content+="<td>"+datas[i].siteName+"</td>";
                          content+="</tr>";
                          content+="<tr>";
                          content+="<td align='right'>ที่อยู่: :";
                          address=datas[i].address+" "+datas[i].district+" จ."+datas[i].province+" "+postalcode;
                          content+="</td>";
                          content+="<td>"+address+"</td>";
                          content+="</tr>";
                          content+="</table>";

                          infoWindows.setContent(content);
                          infoWindows.open(map, marker);
                        }
                        })(marker, i));

                        
         
          }
        }
//MAN KEY: AIzaSyA9iGptTrfXumtJXupoBBzWYBZGwh7TAOA
//ORIGINAL AIzaSyCRbMoDPc_mTv3D3QPqe0Ar84nSvRhA8nk2
//O1 AIzaSyA9iGptTrfXumtJXupoBBzWYBZGwh7TAOA
///<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9iGptTrfXumtJXupoBBzWYBZGwh7TAOA&libraries=places&callback=initMap" async defer></script>

  </script>
  </head>
  <body>
          
  
    <div class="col-sm-12">
        <input
          id="searchInput"
          class="form-control"
          type="text"
          placeholder="Search Box" style="width:300px"
        />
        <div id="map" style="width:700px;height:300px"></div>
    </div>
   
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9iGptTrfXumtJXupoBBzWYBZGwh7TAOA&callback=initMap&libraries=places,geometry&channel=GMPSB_locatorplus_v2_cABCDE" async defer></script>


  </body>
</html>