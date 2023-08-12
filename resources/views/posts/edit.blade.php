<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Posts</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-app-layout>
    <body>
        <h1>投稿名</h1>
        <form action="/posts/{{ $post->id }}" method="POST">
            @csrf
            <input type="numbers" name=lat placeholder="緯度">
            <input type="numbers" name=lng placeholder="経度">
            @method('PUT')
            <div class="title">
                <h2>アニメ名</h2>
                <input type="text" name=post[title] placeholder="タイトル" value={{ $post->title }}>
                <p class='title__error' style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            <div class="body">
                <h2>内容</h2>
                <textarea name="post[body]" placeholder="今日も1日お疲れ様でした。">{{ $post->body }}</textarea>
                <p class='body__error' style="color:red">{{ $errors->first('post.body') }}</p>
            </div>
            <input type="submit" value="update">
        </form>
        <div id="map" style="height:500px">
	   </div>
        <script>
	       function initMap() {
                map = document.getElementById("map");
                
                
                const post = @json($post);
                
                console.log(post.point.coordinates);
                
                let markers = [{lat: post.point.coordinates[1],lng: post.point.coordinates[0]}]
                let tokyoTower = {lat: 35.6585769, lng: 135.7454506};
                // オプションの設定
                opt = {
                    // 地図の縮尺を指定
                    zoom: 7,

                    // センターを東京タワーに指定
                    center: tokyoTower,
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
	   <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{$api_key}}&callback=initMap" async defer></script>	   </script>

        <div class="footer">
            <a href="/posts/{{ $post->id }}">戻る</a>
        </div>
    </body>
    </x-app-layout>
</html>