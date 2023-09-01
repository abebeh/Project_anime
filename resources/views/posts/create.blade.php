<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Posts</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-app-layout>
    <style>
        /* 入力フォーム */
        input[type='text'] {
            width: 80%;
            height: 30px;
            margin-top: 10px;
            border-radius: 8px;
        }
        
        /* セレクトボックス */
        #selectAnime {
            width: 80%;
        }
        
        /* Defaultのボタンのスタイルを無効化する */
        .btn {
            background-color: transparent;
            border: none;
            cursor: pointer;
            outline: none;
            padding: 0;
            appearance: none;
        }
        
        .btn {
            background: #eee;
            border-radius: 3px;
            justify-content: space-around;
            align-items: center;
            margin: 20px 10px;
            max-width: 280px;
            padding: 10px 25px;
            color: #313131;
            transition: 0.3s ease-in-out;
            font-weight: 500;
        }
        .btn:after {
          content: "";
          position: absolute;
          top: 50%;
          bottom: 0;
          right: 2rem;
          font-size: 90%;
          display: flex;
          justify-content: center;
          align-items: center;
          transition: right 0.3s;
          width: 6px;
          height: 6px;
          border-top: solid 2px currentColor;
          border-right: solid 2px currentColor;
          transform: translateY(-50%) rotate(45deg);
        }
        .btn:hover {
          background: #6bb6ff;
          color: #FFF;
        }
        .btn:hover:after {
          right: 1.4rem;
        }
        
    </style>
    <body>
        <h1>投稿名</h1>
        <form action="/posts" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div>
                緯度：<input type="numbers" name="lat">
                経度：<input type="numbers" name="lng">
            </div>
            
            <div class="animes">
                <h2>アニメ名</h2>
                <input>
                <select name="post[anime_id]" id="selectAnime">
                    @foreach($animes as $anime)
                        <option value="{{ $anime->id }}">{{ $anime->value }}</option>
                    @endforeach
                </select>
            
            
                <div style="margin-top: 12px;">
                    <span>検索</span>
                    <input type="text" id="searchbox">
                </div>
                
                <span>
                    <input type="button" id="search" class="btn" value="検索">
                    <input type="button" id="reset" class="btn" value="リセット">
                </span>
                
                <p>選択されたものが表示されます (ボタンを押すと選択が解除されます)</p>
                <div id="disp-select">
                </div>
            </div>
            
            <div class="title">
                <h2>タイトル</h2>
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
        
        <div class="footer">
            <a href="/">戻る</a>
        </div>
        <script>

            // JavaScriptで複数選択と検索が可能なSelectboxを作成する
            
            // [ 実行-Task-List ]
            
                // 1. Serverから受信した optionData から動的に、SelectBoxを作成する
            
                // 2. 検索で、動的にSelectBoxを再作成する
            
                // 3. SelectBoxで選択したOptionは、画面に表示される
                
                // 4. 複数選択が可能である
            
                // 5. 選択したOptionは、選択状態を解除することができる
            
            // 選択肢・Optionの作成と追加を実行する関数
            function OptionCreator (selectAnimeBox, optionList) {

                optionList.forEach((opt, index) => {
            
                // 1. 最初は、<option value="">選択してください</option> を作成する
                if (index == 0) {
                    let option = document.createElement('option');
                    option.setAttribute('value', '');
                    option.innerText = '選択してください';
                    selectAnimeBox.appendChild(option);
                }
            
                let option = document.createElement('option');
                option.setAttribute('value', opt.id);
                option.innerText = opt.value;
                let groupId = opt.groupId;
            
                let belongToGroup = document.getElementById(`${groupId}`);
            
                // 所属するoptgroupがなかったら、追加する
                selectAnimeBox.appendChild(option);
            
                //belongToGroup.appendChild(option);
            
                });
            }
            
            function NoMatchOption (selectAnimeBox) {
                let option = document.createElement('option');
                option.setAttribute('value', '');
                option.innerText = '検索に該当はありません';
                selectAnimeBox.appendChild(option);
            }
            
            // SelectBoxを作成する関数
            function SelectCreator (selectAnimeBox, optionList, searchList, searchBool) {
                
                if (optionList.length == 0) return;
                selectAnimeBox.innerHTML = ''; // 初期化処理
            
                // 1. グループ・カテゴリを作成する
                // optgroupタグを作成 => グループカテゴリを作成する
                
                
                // 2. 選択肢・Optionの作成と追加
                
                if (searchList.length !== 0 && searchBool) OptionCreator(selectAnimeBox, searchList);
                else if (!searchBool) OptionCreator(selectAnimeBox, optionList);
                else NoMatchOption(selectAnimeBox);
            }
            
            
            // [ 1. Serverから受信した optionData から動的に SelectBoxを作成する ]
            
            // 1-1. Serverから受信した、DataSet
            const animes = @json($animes);
            console.log(animes);
            //const optionData = animes;
            const optionData = animes;
            // 1-2. Group-配列 => {id: 'group_1', value: '北海道'}[]
            
            
            
            
            
            
            
            // 1-4. SelectBoxを取得する
            let selectAnimeBox = document.getElementById('selectAnime');
            function sleep(waitMsec) {
              var startMsec = new Date();
            
              // 指定ミリ秒間だけループさせる（CPUは常にビジー状態）
              while (new Date() - startMsec < waitMsec);
            }
            
            sleep(5000);
            // 1-5. 初期のSelectBoxを作成する
            
            
            
            // [ 2. 検索で、動的にSelectBoxを再作成する  ]
            
            // 2-1. 検索のための入力フォームを取得する
            const searchbox = document.getElementById('searchbox');
            
            // 2-2. 検索結果のOption-List
            let searchResult = [];
            
            // 2-3. inputイベントで検索の入力文字列を受け取って、検索結果の配列を作成する
            searchbox.addEventListener('input', (e) => {

                let searchStr = e.target.value; // 検索文字列
            
                searchResult = optionData.filter((anime) => { // 検索文字列から絞り込む
            
                    // 正規表現で変数を使用するためには、RegExp-Classを使用する
                    let reg = new RegExp(`${searchStr}`); // 部分一致
            
                    // 検索文字列のパターンと、登録データがマッチするかでTestをする
                    return reg.test(anime.value);
                });
                console.log({searchResult});
            });

            
            // 2-4. 検索ボタン
            let searchBtn = document.getElementById('search');
            
            // 2-5. 検索ボタンに、clickイベントを追加する
            // searchResultで SelectBoxを作成する
            search.onclick = () => SelectCreator(selectAnimeBox,searchResult, searchResult, true);
            
            // [ 3. SelectBoxで選択したものは、画面に表示される => 複数選択が可能である ]
            
            // 3-1. 選択中のものを表示するInput-Boxを取得する
            let dispDiv = document.getElementById('disp-select');
            console.log(selectAnimeBox);
            // 3-2. SelectBoxに changeイベントを追加する
            selectAnimeBox.addEventListener('change', (e) => {
            console.log('aa');
                // 選択してくださいは、弾く！
                if (!e.target.value) return;
            
                // 1. 上限を5つまでにして、それ以上は、弾く！
                if (6 <= dispDiv.childElementCount + 1) {
                    alert('選択できる数は、5つまでです');
                    return;
                }
            
                // 2. valueにidを付与している
                const id = Number(e.target.value);
            
                // 3. 選択済みの都道府県は、弾く！
                const idList = [...dispDiv.children].map(btn => btn.id);
            
                console.log({idList});
            
                if (idList.some(i => Number(i) == id)) {
                    alert('選択済みです');
                    return;
                }
            
                // 4. 該当の optionデータを��得する
                const option = optionData.find(opt => opt.id === id);
                console.log(option);

            
                // 5. input-btn を作成して、optionのデータを紐付ける
                let input = document.createElement('input');
                input.setAttribute('type', 'button');
                input.setAttribute('id', option.id);
                input.setAttribute('value', option.value);
                input.classList.add('btn');
            
                // 6. 選択を解除する機能を作成した input-btn に付与する
                input.onclick = e => dispDiv.removeChild(e.target);
            
                // 7. 選択されたoptionを input-btnとして画面に表示する
                dispDiv.appendChild(input);
            
            });
            
            // [ 4. 検索状態をResetする機能を作成する ]
            
            // 4-1. 検索・リセットボタンを取得する
            let resetBtn = document.getElementById('reset');
            
            // 4-2. 検索・リセットボタンに、clickイベントを追加する
            // SelectBoxの optionをリセットする
            resetBtn.onclick = () => SelectCreator(selectAnimeBox, optionData, [], false);
            
        </script>
    </body>
    </x-app-layout>
</html>