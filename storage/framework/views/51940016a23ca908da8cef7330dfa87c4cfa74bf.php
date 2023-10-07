<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
    中略
    </head>
    <body>
	   <div id="map" style="height:500px">
	   </div>
	   <script>
	       function initMap() {
                map = document.getElementById("map");
                
                // 東京タワーの緯度、経度を変数に入れる
                let japan_center = {lat: 35.59, lng: 138.27};
                let markers = [{lat: 35.6585769, lng: 139.7454506},{lat: 35.6685769, lng: 139.7454506},{lat: 35.6585769, lng: 139.7654506}]
                // オプションの設定
                opt = {
                    // 地図の縮尺を指定
                    zoom: 7,

                    // センターを東京タワーに指定
                    center: japan_center,
                };

                // 地図のインスタンスを作成（第一引数にはマップを描画する領域、第二引数にはオプションを指定）
                mapObj = new google.maps.Map(map, opt);
                console.log(markers)
                for (let i = 0;i<markers.length;i++){
                    console.log(i)
                    marker = new google.maps.Marker({
                    // ピンを差す位置を東京タワーに設定
                        position: markers[i],
    
                        // ピンを差すマップを指定
                        map: mapObj,
    
                        // ホバーしたときに「tokyotower」と表示されるように指定
    
                        title: '番目',
                    });
                }
                
            }
	   </script>
        <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=<?php echo e($api_key); ?>&callback=initMap" async defer></script>	   </script>
</body>
</html>

<?php /**PATH /home/ec2-user/environment/blog/resources/views/map.blade.php ENDPATH**/ ?>