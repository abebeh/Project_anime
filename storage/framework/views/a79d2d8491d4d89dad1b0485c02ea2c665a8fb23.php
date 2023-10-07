<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>投稿内容</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <body class="antialiased">
        <small><?php echo e($post->user->name); ?></small>
        <h1 class="animes">
           <?php echo e($post->anime->value); ?>

        </h1>
        <h1 class="title">
           <?php echo e($post->title); ?>

        </h1>
        
        <div class='context'>
        <div class="content__post">
                    <h3>内容</h3>
                    <p class='body'><?php echo e($post->body); ?></p>    
        </div>
        </div>
        
        <div class="fixed w-2/4 h-2/4 -right-1/4 top-16">
            <img src="<?php echo e($post->image_url); ?>" class="h-full" alt="画像が読み込めません。"/>
        </div>
        
        <div class='edit'>
            <a href="/posts/<?php echo e($post->id); ?>/edit">edit</a>
        </div>
        <div class="fixed w-2/4 h-2/4 right-0 bottom-0">
        <div id="map" style="height:100%">
	   </div>
	   </div>
	   <script>
	       function initMap() {
                var map = document.getElementById("map");
                
                const post = <?php echo json_encode($post, 15, 512) ?>;
                
                console.log(post.point.coordinates);
                
                let markers = [{lat: post.point.coordinates[1],lng: post.point.coordinates[0]}];
                
                // 東京タワーの緯度、経度を変数に入れる
                let center = {lat: post.point.coordinates[1],lng: post.point.coordinates[0]};
                // オプションの設定
                var opt = {
                    // 地図の縮尺を指定
                    zoom: 16,
                    
                    
                    // センターを東京タワーに指定
                    center: center,
                };
                
                //吹き出し（情報ウィンドウ）作成
                //マーカーをクリックしたら情報ウィンドウを開く
                // 地図のインスタンスを作成（第一引数にはマップを描画する領域、第二引数にはオプションを指定）
                mapObj = new google.maps.Map(map, opt);
                console.log(markers)
                for (let i = 0;i<markers.length;i++){
                    let infoWindow = new google.maps.InfoWindow({
                        content: `<div class="custom-info">
                        <div class="custom-info-item title">
                            <?php echo e($post->title); ?>

                        </div>
                        <div class="custom-info-item body">
                            <?php echo e($post->body); ?>

                        </div>
                        </div>
                        <div class="custom-info-item image">
                            <a href= <?php echo e($post->image_url); ?> target="_blank">IMAGE</a>
                        </div>`,
                    })
                    
                    console.log(i)
                    let posts = new google.maps.Marker({
                    // ピンを差す位置を東京タワーに設定
                        position: markers[i],
    
                        // ピンを差すマップを指定
                        map: mapObj,
                        
                        
                        pixelOffset: new google.maps.Size(0, -20)
                    })
                    posts.addListener('click', () => {
                        infoWindow.open(map,posts);
                    });   

                        
                };
                    
            }
                
                
            
	   </script>
        <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=<?php echo e($api_key); ?>&callback=initMap" async defer></script>
        <div class='footer'>
            <a href="/">戻る</a>
        </div>
    </body>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
</html><?php /**PATH /home/ec2-user/environment/blog/resources/views/posts/show.blade.php ENDPATH**/ ?>