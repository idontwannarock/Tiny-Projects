# 練習用 Hugo架部落格在Github Pages
## 源起
17年9月7日在ptt Soft_Job版看到胡立po文準備作一個計劃-建立Slack群組來幫助大家練習討論一些網頁相關的東西，而我需要多作一些練習，並且最好能有人詢問或討論所以加入  
而9月8日胡立回信如下，包含第一個練習
>Hi,  
>大家好，因為信件滿多的所以我就統一回信了  
>有個別問題的之後都可以再來找我問  
>先感謝大家參與這個計畫，然後在開始前我有幾點要說明  
>  
> 1. 這個計畫比起授課，更像是讀書會，意思就是大家一起鑽研同一個主題然後討論之類的  
>2. 所以比起老師，我會比較像助教，會丟一些資源跟關鍵字給大家，然後有問題可以問  
>3. 因此呢，來這邊還是要靠自己學習才有效果，不要妄想我會一直幫大家上課XD  
>4. 這個計畫沒有任何權利義務關係，意思就是你想退出隨時可以退，也不用跟我講XD  
>5. 大概就是這樣，大家加油  
>  
>那關於這個計畫會講到的東西，我目前只有稍微規劃一下，更詳細的我下禮拜再跟大家說  
>1. 資訊安全相關（SQL Injection, CSRF, XSS）  
>2. 網頁後端相關（Session, Database, Server）這邊會以 PHP 為主  
>3. 網頁前端相關（HTML, JavaScript, CSS, jQuery, React(maybe)）  
>4. 程式解題相關（帶大家做一些 ACM 一二星題或是基本演算法資料結構）  
>  
>期間會有多久我不知道，如果順利搞不好一直開著也說不定  
>  
>身為一個軟體工程師，我認為要有下列的能力：  
>1. 碰到一個不會的主題，主動找資源去學習  
>2. 試著去分析問題並且找出解決問題的方法  
>3. 把解決問題的過程重新省思過後整理，最好是能夠把心得記錄成文字  
>  
>所以在這次讀書會的過程中，希望大家都能夠培養上面的能力  
>也就是自學、解決問題以及歸納知識  
>  
>如果你確定要加入這次讀書會了，有幾件事情要麻煩你  
>1. 到這邊填寫 email，就會收到 slack 邀請，沒用過的請自己去研究一下  
>進去之後會有一個 #mentor 的 channel，就是這次讀書會主要討論的地方  
>https://slackpass.io/lidemy  
>  
>2. 請到這邊簡單填寫自介，背景那欄就填現在職業或是你現在在的培訓機構（資策會）之類的  
>因為大家都可以編輯，所以請小心不要蓋到別人的  
>https://docs.google.com/spreadsheets/d/1IgxN2mlM8BJJs0nqX6qP2NVEiECtRPd7rOr57Inqgu4/edit?usp=sharing  
>  
>3. 如果可以，希望大家能養成紀錄心得的好習慣，因此請大家開一個 blog。最推薦的方式是去學習怎麼用靜態部落格產生系統，例如說 hexo 或是 hugo，並且把部落格架在 Github pages 上面。如果你覺得太難你不會的話，也可以考慮直接用現成的系統，例如說 blogger, logdown, medium 等等  
>  
>但推薦前者，因為你可以學習到怎麼使用靜態部落格產生系統跟 git 的基本操作以及 github 的相關知識，算是這個讀書會的第一個挑戰吧  
>  
>之後更詳細的計畫會在下週或是這週末跟大家講，大家就先進去 slack 閒聊吧！  
>  
>huli  
## 學習目標
學習怎麼用靜態部落格產生系統 Hugo，並且把部落格架在 Github Pages 上面。  
## 學習內容
* 什麼是靜態、動態
* 什麼是靜態部落格（網頁）產生系統 Static Site Generator
* 什麼是 Markdown語法
* 什麼是 Github
* 什麼是 Github Pages
* 怎麼使用 Hugo架設網頁在 Github Pages

#### 什麼是靜態、動態
就我看網路多種說法，結論大概是不需要碰到server端的就算靜態，反之就算動態  
#### 什麼是靜態部落格（網頁）產生系統 Static Site Generator
在網路上找到這篇文章，講得蠻清楚的：https://www.sitepoint.com/7-reasons-use-static-site-generator/    
在講什麼是靜態部落格（網頁）產生系統 Static Site Generator(SSG)之前，應該講一下內容管理系統 Content Management System(CMS)，例如 Wordpress。    
CMS的理念其實也是讓作者不用擔心部落格，也就是網頁輸出的各種問題，只需要選擇喜歡的模板template，就可以使用CMS提供的文字編輯器寫作，節省很多麻煩，相信有用過 Wordpress都能理解。   
但相對之下 CMS就有一些壞處，例如只能使用 CMS提供的編輯功能（不然還是要會網頁或程式知識去作修改）、因為很多動態功能所以伺服器工作比較重可能影響效能、可能因為某些軟體或功能升級或資料庫出問題而導致網頁也出問題。　　  
而 SSG算是在 CMS跟完全自己寫網頁架部落格的中間，比較知名的有 Jekyll、Hugo，或胡立提到的 Hexo。   
對 SSG我的認知是有點像簡化的 CMS，在前端方面簡化。還是有 template，但寫作部分一般用 Markdown語法寫作來簡化文字編輯功能；但也給予很大的自由度，因為有些近似自己寫 html，所以要修改什麼功能或加什麼 widget都不用像 Wordpress要透過 Plugin的方式加入，而是可以直接嵌入，但相對的其實也需要對 html語法有一些認識。   
而後端方面 SSG跟 CMS就很相似，通常兩者都有作後端一條龍的服務，也可以自己另外選擇伺服器儲存網頁內容。    
所以 SSG好處就跟 CMS相反，就是自由度比較大、因為靜態網頁不需要一直跟伺服器來回而提高效能、因為原則上只使用基本 html+Markdown所以網頁出問題機會小。    
另外有一些其他好處，如因為幾乎沒有伺服器端的功能所以安全性高、因為類似在寫網頁而能作到版本控管（事實上 Wordpress也有這個功能，但只限於草稿的樣子）。
#### 什麼是 Markdown語法
剛剛講到 Markdown語法，算是一種更簡化的 html語法，我是因為 Github的 README說明檔都用 Markdown寫而接觸過。   
因為簡化過，所以非常簡單，可以參考 http://markdown.tw/   
當然 Markdown語法的簡化導致它並不能作太多美化，但相對的好處就是一致性，這在寫筆記或說明的時候相當有用。    
另外，若習慣寫筆記歸類在 Evernote上，其實 Evernote也能讀 Markdown，只是沒辦法直接在 Evernote上編輯，方法需要自己找，我自己是用 Sublime Text的 Plugin來編輯跟上傳 Markdown筆記到 Evernote上，這應該能給大家一個方向。
#### 什麼是 Github
剛剛提到 Github，感覺這是目前寫程式必備，因為是基於版本管理工具 Git建立，算是跟其他工程師交流兼有履歷的功能吧，工作上不知道使用度如何。   
我有點把它當文件儲存空間，因為基本上沒有空間限制，只有針對單檔、repository的大小限制。
#### 什麼是 Github pages
Github有提供靜態網頁的 hosting功能，可以把網頁直接存在 Github的 repository裡面。    
Github Pages有一些限制請參考 https://help.github.com/articles/what-is-github-pages/
#### 怎麼使用 Hugo架設網頁在 Github Pages
我選 Hugo是因為他用 Go寫的，感覺很潮，呵呵。    
我個人覺得官網並沒有寫得很好，不管中文還是英文都一樣。   
後來找到一個講的比較清楚 https://brent-li.github.io/post/build-personal-site-with-hugo/   
然後我不知為何，從來無法用git clone的方式下載theme，所以只能直接下載zip檔解壓縮到themes資料夾，給大家作參考   
