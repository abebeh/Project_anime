<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <title>Posts</title>
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
    <body>
        <h1>投稿名</h1>
        <form action="/posts/<?php echo e($post->id); ?>" method="POST">
            <?php echo csrf_field(); ?>
                緯度：<input type="numbers" name="lat">
                経度：<input type="numbers" name="lng">
            <?php echo method_field('PUT'); ?>
            <div class="title">
                <h2>アニメ名</h2>
                <input type="text" name=post[title] placeholder="タイトル" value=<?php echo e($post->title); ?>>
                <p class='title__error' style="color:red"><?php echo e($errors->first('post.title')); ?></p>
            </div>
            <div class="body">
                <h2>内容</h2>
                <textarea name="post[body]" placeholder="今日も1日お疲れ様でした。"><?php echo e($post->body); ?></textarea>
                <p class='body__error' style="color:red"><?php echo e($errors->first('post.body')); ?></p>
            </div>
            <input type="submit" value="update">
        </form>
        <div id="map" style="height:500px">
	   </div>
        <script>
	       function initMap() {
                map = document.getElementById("map");
                
                
                const post = <?php echo json_encode($post, 15, 512) ?>;
                
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
	   <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=<?php echo e($api_key); ?>&callback=initMap" async defer></script>	   </script>

        <div class="footer">
            <a href="/posts/<?php echo e($post->id); ?>">戻る</a>
        </div>
    </body>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
</html><?php /**PATH /home/ec2-user/environment/blog/resources/views/posts/edit.blade.php ENDPATH**/ ?>