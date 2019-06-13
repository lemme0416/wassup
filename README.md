使用安裝手冊
===
[github](https://github.com/MeaningLessss/wassup.git)

[使用安裝手冊網址](https://hackmd.io/@TUzG6tCgSCyUFU8FisIazw/Hyxe3tJyH)

## Beginners Guide

If you use our website and set up it 

1. 建立php可執行的環境 [參考網站](https://www.tad0616.net/modules/tad_book3/html.php?tbdsn=450)
2. [download mysql workbench]( https://www.mysql.com/products/workbench/)
3. 建立mysql database
4. 修改login.php內的帳密 ($CFG['username'], $CFG['pw'])
5. 在mysql database 中設置名為 [users](#users_table) 與 [music](#music_table) 的 table (相關參數往後閱讀)
7. :congratulations: 基本的資料庫設置完成了


## users_table
---


| colum name  | data type |PK|NN|UQ|
| --------    | --------  |--|--|--|
|id           |varchar(40)|Y |Y |Y |
|pw           |varchar(45)|N |Y |N |
|name         |varchar(45)|Y |Y |N |
|gender       |varchar(45)|N |Y |N |
|problem      |varchar(45)|N |Y |N |


## music_table
---
| colum name  | data type  |PK|NN|UQ|AI|
| --------    | --------   |--|--|--|--|
|id           |int(11)     |Y |Y |Y |Y |
|name         |varchar(100)|Y |Y |Y |N |
|language     |varchar(45) |N |Y |N |N |

# Wassup!

<!-- Put the link to this slide here so people can follow -->
website: http://wassup.2y.cc/

---
:::success
It is a stylish and free music platform
:::

---
#	**注意事項!!!**
:::warning
以下填入資料時，請勿輸入空格，若想輸入空格，請輸入底線

:o:  new_name
:x:  new name
:::

---

# which browser can use our website?

- edge 
- chrome 
- firefox 

---

# how to use it?

---
## 	登入畫面

![](https://i.imgur.com/f68H9ri.png)
填入正確的帳號密碼可以登入
sign up 可註冊新帳號 forget password 可以幫你找回密碼


---

### 	註冊畫面

---
![](https://i.imgur.com/tebj51f.png)

依據指示填入帳號 密碼 暱稱 性別 防盜問題 即可創立帳號
若想回到登入畫面 按上方Register!便可回到登入畫面

![](https://i.imgur.com/1oehBYo.png)
若成功註冊 便會出現此畫面 按確定便可回到登入畫面


---

### forget password 

---

![](https://i.imgur.com/ZYEpVIP.png)
按下登入畫面的forget password 便會進入這個畫面，填入你的帳號與防盜問題，若是完全正確便可進行修改密碼的動作，按下homepage便可回到登入畫面

![](https://i.imgur.com/iCciklf.png)

填入新的密碼並再度確認後 按下confirm便成功修改密碼了。若是成功便可看到下圖

![](https://i.imgur.com/jfj4Bis.png)

---
##	會員畫面
---
### home page
---
以下圖片皆為開發中畫面

![](https://i.imgur.com/9KUsHph.png)

首頁是個可愛的小遊戲，讓你可以邊玩遊戲邊聽音樂，享受生活
#### 遊戲說明
* 空白鍵開始跟暫停
* R重來、上下左右控制方向
* 
#### 功能簡介
* 按左上的WassUp!便可回到首頁。
* 按下登出即可登出。
* 按下修改密碼便能修改密碼。
* 按下上傳音樂就能上傳自己喜歡的音樂。
* 按下新增清單便能增加自己的清單列表，此時我尚未有自己的清單，因此下方沒有任何的清單。
* ~~按排行榜便能看到我們所有的音樂。~~
* 按下分類排行榜便能看到那一類型的所有音樂

---
#### 亞洲排行榜與歐美排行榜

---
![](https://i.imgur.com/0ZDuzEl.png)
* 我們在此將所有音樂進行分類，讓你能夠從你喜歡的音樂類型中快速尋找
* 先在旁邊的select選擇想加入的清單名字，在按下旁邊的加號，便能夠成功地將喜歡的歌曲加到自己的播放清單中
* 按旁邊播放的圖示便能夠讓你希望播放的音樂「插隊」，先於清放清單前播放。


---
### 修改密碼
---
![](https://i.imgur.com/ENsojlV.png)

就如同在之前所說修改密碼的方式，只是這次按Modify!並不會回到登入畫面

---
### Upload
---
![](https://i.imgur.com/6kwyjFm.png)

你可以在這裡上傳音樂檔案，同時告知大家這首歌的音樂風格為何

**Notice!!!**
你只能上傳mp3檔，其他檔案類型我們一律不接受

---
### 新增清單
---

![](https://i.imgur.com/8We6gc4.png)![](https://i.imgur.com/WsJieGe.png)![](https://i.imgur.com/2YclNB1.png)

如圖所示按下新增清單後填入清單的名稱便可在下方新增自己的清單


---
### 私人清單
---

![](https://i.imgur.com/eY76qxL.png)

在加入幾首自己喜歡的歌到自己的清單之後便可以清楚的看到有哪些歌在自己的播放清單裡面，同時在這裡隨便播放一首歌的話那麼就會在這份清單中循環播放，而不會播到別首歌。
![](https://i.imgur.com/XhgBPrL.png)

在按下"Delete This List"之後便會將這份清單刪掉，並重新回到排行榜的頁面，同時左方的清單列表也就不會再出現被刪除的那份清單了

---
### 搜尋功能
---
![](https://i.imgur.com/BMgmkos.png)

在上方有個搜尋功能，能夠精確地找到你想要的歌，當然，若是你不記得完整的歌名，你也能夠只打其中的幾個關鍵字，這依然能夠找到你所愛的歌曲。
**注意!**
關鍵字不分大小寫喔

---
### player
---
![](https://i.imgur.com/iJtIZaV.png)

如圖所示 
1. 上一曲
2. 下一曲
3. 播放和暫停
4. 進度條
5. 音量
6. 點開可以下載
7. 播放模式 有三種功能 從左至右分別為
    1.循環播放(整份清單輪流波)
    2.單曲循環(從頭到尾都是同一首)
    3.隨機播放(誰都不知道下一首歌是啥)
8. 顯示歌名

---
## 彩蛋
---
![](https://i.imgur.com/9GY0KMb.png)
當你按下途中被標記的那個音符後，便會觸發彩蛋，會變成下圖
![](https://i.imgur.com/v8LSQcN.png)
除了畫面變成這樣之外還會放處好聽的音樂。

註: 按下在相同位置的同一片葉子便能回到原本的樣子

