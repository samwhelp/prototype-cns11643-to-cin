# prototype-cns11643-to-cin

## 緣起

這個專案只是因應「[這篇討論](http://www.ubuntu-tw.org/modules/newbb/viewtopic.php?post_id=346876#forumpost346876)」，簡單寫出來的轉換程式，
沒有仔細驗證是否正確。
用意只是要提供「樓主」另一種方式來解決問題(改用寫script的方式)。

## 前置作業

安裝「php5-cli」

``` sh
$ sudo apt-get install php5-cli
```

## 使用方式

執行下面的指令

``` sh
$ ./cin.php
```

或是執行

``` sh
$ php cin.php
```

就會產生「CnsPhonetic.cin」這個檔。

## 注意事項

「CNS_phonetic.txt」這個檔是來自於「[http://data.gov.tw/iisi/logaccess/20?dataUrl=http://www.cns11643.gov.tw/AIDB/Open_Data.zip&ndctype=TXT&ndcnid=5961](http://data.gov.tw/iisi/logaccess/20?dataUrl=http://www.cns11643.gov.tw/AIDB/Open_Data.zip&ndctype=TXT&ndcnid=5961)」。連結來自於「[這一頁](http://data.gov.tw/node/5961)」的「資料資源: TXT」。

下載指令。

``` sh
$ wget -c http://data.gov.tw/iisi/logaccess/20?dataUrl=http://www.cns11643.gov.tw/AIDB/Open_Data.zip&ndctype=TXT&ndcnid=5961
```

其餘參考「[這篇討論串](http://www.ubuntu-tw.org/modules/newbb/viewtopic.php?post_id=326994#forumpost326994)」。
