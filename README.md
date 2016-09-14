# prototype-cns11643-to-cin

## 注意

(2016-09-14): 驗證發現有一個地方有Bug，待修正。

## 緣起

這個專案只是因應「[這篇討論](http://www.ubuntu-tw.org/modules/newbb/viewtopic.php?post_id=346876#forumpost346876)」，簡單寫出來的轉換程式，

用意只是要提供「樓主」另一種方式來解決問題(改用寫script的方式)。

## 前置作業

安裝「php5-cli」

``` sh
$ sudo apt-get install php5-cli
```

## Clone

``` sh
$ git clone https://github.com/samwhelp/prototype-cns11643-to-cin.git
```

切換到專案資料夾

``` sh
$ cd prototype-cns11643-to-cin
```

## 使用方式

### 轉換產生cin檔

切換資料夾

``` sh
$ cd bin
```

執行下面的指令

``` sh
$ ./cin.php
```

或是執行

``` sh
$ php cin.php
```

就會產生「prototype-cns11643-to-cin/var/CnsPhonetic.cin」這個檔。

注意: 此轉換的過程，除了轉換CNS的對照表之外，還加入了「注音符號」。

### 批次轉換Unicode碼，變成文字。

編輯「var/Unicode.list」。

```
$ vi var/UniCode.list
```

切換資料夾

``` sh
$ cd bin
```

執行下面的指令

``` sh
$ ./uni.php
```

就會執行轉換，產生「var/Unicode.txt」。


## 注意事項

「Asset/CNS11643」這個資料夾裡面的檔案是來自於「[http://data.gov.tw/iisi/logaccess/20?dataUrl=http://www.cns11643.gov.tw/AIDB/Open_Data.zip&ndctype=TXT&ndcnid=5961](http://data.gov.tw/iisi/logaccess/20?dataUrl=http://www.cns11643.gov.tw/AIDB/Open_Data.zip&ndctype=TXT&ndcnid=5961)」，並不是全部，有些檔被我刪掉了。

「Asset/CNS11643」這個資料夾裡面的檔案的版權屬於該單位所有。

上面的下載連結來自於「[這一頁](http://data.gov.tw/node/5961)」的「資料資源: TXT」。

下載指令。

``` sh
$ wget -c "http://data.gov.tw/iisi/logaccess/20?dataUrl=http://www.cns11643.gov.tw/AIDB/Open_Data.zip&ndctype=TXT&ndcnid=5961" -O Open_Data.zip
```

其餘參考「[這篇討論串](http://www.ubuntu-tw.org/modules/newbb/viewtopic.php?post_id=326994#forumpost326994)」。
