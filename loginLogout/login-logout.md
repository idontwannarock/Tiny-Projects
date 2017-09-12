---
title: "實作簡單登入系統"
date: 2017-09-11T07:11:59+08:00
draft: false
tag: ["PHP", "MySQL", "登入系統"]
share: true
---
## 學習目標
實作簡單登入系統，簡單寫就帳密寫死在程式碼，有時間就順便練習一下串資料庫，再有點時間就練習一下 md5或 hash加密。
#### 學習內容
* 構思
* 版面設定
* 切換功能
* 設置資料庫
* 連接資料庫
* 設計結構
* ajax傳資料

##### 構思
坦白說，我有自學過一點點前後端的 Udemy網路課程，課程的老師其實有教過這個部分，但當時似懂非懂，幾乎就是 copy老師的程式碼，糊里糊塗就寫出來，PHP跟 MySQL的部分一片模糊，所以先來嘗試自己重新寫一遍，再來找找看網路解法。  
  
要寫登入登出的功能，我第一個想到就是要用 HTML的<code>form</code>先做三個</code>input</code>跟一個<code>button</code>，若要串接資料庫，應該還要再作一個<code>button</code>切換 Signup跟 Login畫面來作區別。預計應該要用 jQuery控制切換 Signup/Login的功能。  
  
然後後端邏輯應該就是先作 Login的部分，用<code>ajax</code>傳輸資料到後端，先檢查輸入的<code>username</code>、<code>email</code>跟<code>password</code>是否空白、格式是否正確以及是否重複，再把<code>password</code> <code>md5</code>或<code>hash</code>加密後存進資料庫。中間檢查的部分可能要用<code>echo</code>輸出錯誤提示訊息。然後最後再輸出 Login成功訊息。這邊會感覺會需要了解<code>$_COOKIE</code>怎麼運作。  
  
接著作 Signup的部分，應該就是用到<code>$_SESSION</code>來登記資料到資料庫。應該是這部分會要順便了解什麼是 SQL Injection跟如何防範。  
##### 版面設定
所以就從寫個<code>form</code>、三個</code>input</code>跟兩個按鈕開始好了。我猶豫了一下要不要用 Bootstrap，還是用好了，畢竟練習的重點在後端，畫面就直接套用現成的版就好。  
  
所以直接就貼上 Bootstrap 4的 Starter template，因為後面要用<code>ajax</code>，所以 jQeury的版本記得從 slim換成最起碼 min的版本。然後直接用 Bootstrap的 Forms作模板。
##### 切換功能
接下來就是複習 jQuery語法的時候，因為不難所以不多講。大概方向就是在<code>click</code>動作上建立一個判斷式，判斷目前是要 Login轉 Signup要做什麼事；Signup轉 Login要做什麼事。這部分<code>script</code>我是寫在<code>body</code>的最後。
  
切換畫面有個小技巧記錄一下，作一個隱藏的</code>input</code>，然後設定<code>value="1"</code>，後面在判斷的時候用這個值作判斷條件會比較簡單。  
  
前段的部分就這樣，接下來開始練習後端部分。
##### 設置資料庫
先去 XAMPP的 Control Panel把 MySQL打開，然後去瀏覽器輸入<code>http://localhost:8080</code>來進去 Apache Friend頁面，點選右上角的 phpMyAdmin進入資料庫管理的頁面。直接左邊點選 New來建立一個新的資料庫，我設定資料庫名字為<code>user</code>，新 table名稱<code>userdata</code>，四欄分別是<code>id</code>、<code>username</code>、<code>email</code>跟<code>password</code>，並設定<code>id</code>欄位為 Primary Key以及 Auto Increment。  
  
設定 Primary Key的目的是確保此欄位的每一筆資料都是獨一無二的；Auto Increment則是讓資料庫自動遞增設定<code>id</code>。
##### 連接資料庫
接下來就要用 MySQL語法嘗試連接資料庫，我是用以下方法，用 PHP的<code>print_r</code>來顯示連結問題。
    
    $link = mysqli_connect("localhost:3306", "root", "", "user");  
    if(mysqli_connect_errno()) {  
        print_r(mysqli_connect_error());  
        exit();  
    }

記錄一下<code>mysqli_connect</code>的語法是<code>(host, username, password, dbname)</code>。這邊因為是本機，所以<code>host</code>就是<code>localhost:3306</code>，3306是 XAMPP預設給 MySQL的 port，如果你有調整，這邊就要相應的更改；本機上的<code>username</code>就是<code>root</code>，不確定可以到 phpMyAdmin的首頁看；<code>password</code>預設應該就是沒有，如果有設定（我還真不知道怎麼設定）這邊就要改；最後<code>dbname</code>是剛剛設定的<code>user</code>。  
[mysqli_connect](http://php.net/manual/en/function.mysqli-connect.php)  
  
<code>mysqli</code>是 PHP的 MySQL函數庫增強版，功能更強，安全性更好；所以之前的<code>mysql</code>已經漸漸淘汰不用。  
  
接著則是用<code>mysqli_connect_errno()</code>來判斷連接是否有錯誤，若有錯誤則用<code>print_r</code>來顯示<code>mysqli_connect_error()</code>的錯誤訊息。  
  
<code>mysqli_connect_errno()</code>是回傳最近一次連接的錯誤「代碼」；<code>mysqli_connect_error()</code>則是回傳最近一次連接的錯誤「訊息」。  
[mysqli_connect_errno()](http://php.net/manual/en/mysqli.connect-errno.php)  
[mysqli_connect_error()](http://php.net/manual/en/mysqli.connect-error.php)  
  
最後則用<code>exit()</code>來停止繼續執行 script（官方文件側面證明 PHP是 script？XD）。括號裡面可以填上停止執行同時要顯示的訊息，若裡面填上 integer（0-254之間），則會被用來當錯誤代碼而且不會顯示出來。功能跟<code>die()</code>是一樣的。
##### 設計結構
再來先講一下設計的結構。  
  
因為我在 Udemy上的課最後的作業是把常用的 function單獨存成一個<code>function.php</code>的檔案，然後把會跟<code>index.php</code>直接互動的部分放在<code>action.php</code>並且在開頭就<code>include("function.php");</code>這樣來操作。  
  
據說這叫 MVC啦，我也不是很懂，但覺得這樣分開蠻清楚的，就這樣作吧~
##### ajax傳資料
接著要寫<code>ajax</code>傳資料的功能。  
  
在前面切換 Login/Signup按鈕的後面，我是先寫這樣來測試：  
    
    $.ajax({  
        type: "POST",  
        url: "action.php?action=loginSignup",  
        data: 
            "username=" + $("#username").val()
            + "&email=" + $("#email").val()
            + "&password=" + $("#password").val()
            + "&loginActive=" + $("#loginActive").val(),  
        success: function() {  
            alert("username=" + $("#username").val()
            + "&email=" + $("#email").val()
            + "&password=" + $("#password").val()
            + "&loginActive=" + $("#loginActive").val());  
        }  
    })
  
這邊其實是設定用<code>POST</code>傳送<code>data</code>的訊息，但也同時用<code>GET</code>的方式傳送一個<code>action=loginSignup</code>的訊息來說明要作 Login/Signup的動作，讓後端知道要做哪個動作。  
  
如果按了 Submit按鈕有跳出<code>alert</code>顯示<code>data</code>的內容，就表示作對了。
##### Login驗證功能
先不要動<code>ajax</code>的<code>function</code>，先到<code>action.php</code>作驗證功能。  
  
用各種判斷式判斷<code>username</code>、<code>email</code>跟<code>password</code>是否空白或符合格式，若不符合，就儲存一段顯示錯誤的話進變數<code>$error</code>，到最後判斷<code>$error</code>是否空白，若否則<code>echo $error;</code>並<code>exit();</code>。  
  
這時候先到<code>index.php</code>表格上方增加一個隱藏的<code>div</code>，<code>id</code>設為<code>loginAlert</code>。  
  
接著到<code>ajax</code>的<code>success</code>改成以下：  
    
    success: function(result) {  
        if (result) {
            $("#loginAlert").html(result).show();
        }  
    }
  
用意是當我<code>action.php</code>回傳有東西，表示<code>$error</code>有錯誤訊息，則傳到<code>loginAlert</code>這個<code>div</code>並顯示出來。  
  
但想像是美好的，現實是骨感的，立刻就碰到問題，alert區塊一閃而逝，好像畫面重新刷新，所以 alert區塊又重新回到隱藏的狀態。  
  
這邊很顯然是 Submit按鈕的問題，剛好作個筆記，要記得把 Submit按鈕的<code>type</code>改成<code>button</code>，若是維持原來的<code>submit</code>，就會重新刷新畫面，效果就都跑掉了。  
  
對了，記得要去 XAMPP Control Panel把 MySQL也打開，不然會悲劇XD