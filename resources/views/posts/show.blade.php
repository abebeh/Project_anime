<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Posts</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-app-layout>
    <body class="antialiased">
        <small>{{ $post->user->name }}</small>
        <h1 class="title">
           {{ $post->title }}
        </h1>
        <div class='context'>
        <div class="content__post">
                    <h3>本文</h3>
                    <p class='body'>{{ $post->body }}</p>    
        </div>
        </div>
        <div>
            <img src="{{ $post->image_url }}" alt="画像が読み込めません。"/>
        </div>
        <div class='edit'>
            <a href="/posts/{{ $post->id }}/edit">edit</a>
        </div>
        <div id="map" style="height:500px">
	   </div>
	   <script>
	       function initMap() {
                map = document.getElementById("map");
                
                const post = @json($post);
                
                console.log(post.point.coordinates);
                
                let markers = [{lat: post.point.coordinates[1],lng: post.point.coordinates[0]}]
                
                // 東京タワーの緯度、経度を変数に入れる
                let japan_center = {lat: 35.59, lng: 138.27};
                let test_markers = [{lat: 35.6585769, lng: 139.7654506}]
                // オプションの設定
                opt = {
                    // 地図の縮尺を指定
                    zoom: 7,

                    // センターを東京タワーに指定
                    center: japan_center,
                };

                // 地図のインスタンスを作成（第一引数にはマップを描画する領域、第二引数にはオプションを指定）
                mapObj = new google.maps.Map(map, opt);
                console.log(markers,test_markers)
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
        <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{$api_key}}&callback=initMap" async defer></script>
        <div class='footer'>
            <a href="/">戻る</a>
        </div>
    </body>
    </x-app-layout>
</html>