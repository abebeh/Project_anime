<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-app-layout>
    <body>
        <h1>投稿一覧</h1>
        <a href="/posts/create">投稿作成</a>
        <div class='posts'>
            @foreach ($posts as $post)

                <div class='posts'>
                    
                    <small>ユーザー名：{{ $post->user->name }}</small>
                    
                    <h2 class='title'>
                        <a href="/posts/{{ $post->id }}">アニメ名：{{ $post->anime->value }}</a>
                    </h2>
                    
                    <h2 class='title'>
                        <a href="/posts/{{ $post->id }}">タイトル：{{ $post->title }}</a>
                    </h2>
                    <p class='body'>内容：{{ $post->body }}</p>
                    
                    <form action="/posts/{{ $post->id }}" id="form_{{$post->id}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePost({{ $post->id }})">投稿を削除</button>
                    </form>

                </div>
                <div>
                    <img src="{{ $post->image_url }}" alt="画像が読み込めません。"/>
                </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $posts->links()}}
        </div>
        <div class="fixed w-2/4 h-full right-0 top-16 z-0">
        <div id="map" style="height:100%">
	    </div>
	    </div>
	   <script>
	       function initMap() {
                map = document.getElementById("map");
                
                const posts = @json($posts);
                let markers = []
                for (let i = 0 ;i < posts.data.length ; i++ ){
                    console.log(i)
                    markers.push({position: {lat: posts.data[i].point.coordinates[1],lng: posts.data[i].point.coordinates[0]},
                        title: posts.data[i].title,
                        body: posts.data[i].body,
                        image_url: posts.data[i].image_url,
                        id: posts.data[i].id})
                }
                console.log(markers,'test')
                //let markers = [{lat: post.point.coordinates[0],lng: post.point.coordinates[1]}]
                
                // 東京タワーの緯度、経度を変数に入れる
                let tokyoTower = {lat: 35.6585769, lng: 139.7454506};
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
                    if (posts){
                       let infoWindow = new google.maps.InfoWindow({
                        content: `<div class="custom-info">
                        <div class="custom-info-item title">
                            ${markers[i].title}
                        </div>
                        <div class="custom-info-item body">
                           ${markers[i].body}
                        </div>
                        </div>
                        <div class="custom-info-item image">
                            <a href="/posts/${markers[i].id}">
                                <img src=${markers[i].image_url}>
                            </a>
                        </div>`,
                    })
                    
                    console.log(i)
                    let posts = new google.maps.Marker({
                    // ピンを差す位置を東京タワーに設定
                        position: markers[i].position,
    
                        // ピンを差すマップを指定
                        map: mapObj,
                        
                        
                        pixelOffset: new google.maps.Size(0, -20)
                    })
                    posts.addListener('click', () => {
                        infoWindow.open(map,posts);
                    });    
                    }
                    

                        
                };
                
            }
	   </script>
        <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{$api_key}}&callback=initMap" async defer></script>	   
	   <script>
            function deletePost(id){
                'use strict'
                
                if(confirm('削除すると復元できません。\n本当に削除しますか？')){
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </body>
    </x-app-layout>
</html>