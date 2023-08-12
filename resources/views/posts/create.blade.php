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
        <form action="/posts" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                緯度：<input type="numbers" name="lat">
                経度：<input type="numbers" name="lng">
            </div>
            <div class="title">
                <h2>アニメ名</h2>
                <input type="text" name="post[title]" placeholder="タイトル">
                <p class='title__error' style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            <div class="body">
                <h2>内容</h2>
                <textarea name="post[body]" placeholder="今日も1日お疲れ様でした。"></textarea>
                <p class='body__error' style="color:red">{{ $errors->first('post.body') }}</p>
            </div>
            <div class="image">
                <input type="file" name="image">
            </div>
                <input type="submit" value="store">
            
        </form>
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        
        
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
    </x-app-layout>
</html>