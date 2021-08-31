# Rosetta.ai 專題考題（2021 Q2 版）

---
## 前言
非常榮幸收到您申請 Rosetta.ai 的 Software Engineer, Backend 職缺，為了更加瞭解您的技術實力，我們設計了一組專題考題，讓我們在接下來的面試過程前能夠相互瞭解彼此。

如果對於考題有任何疑問或指教，歡迎在考試時不吝提問與指教。我們非常重視每一位面試者的意見，您的回饋將成為本公司持續改善的基礎。
介紹
規則
本題目專為 Senior Software Engineer, Backend 所設計，如果您需要其它領域請立即反應

考試時間為 2 周，時間從考題寄出後開始計算，若您提早完成可以以 Email 與我們聯繫（若打算執行加分題，則考試時間可延長為 3 周，請提前來信告知）

請使用 Git 作為版本控制工具，並建立一個或多個可公開存取的 GitHub Repository，我們將在上面為您評份
評分結束後我們會通知您（如果一個月後都未收到通知，您可以自由處置該 Repository）

該 Repository 版權歸面試者所有，您可以用任何授權條款釋出或封存

評分時，我們會 Fork Repository。若有需要時，會提出 issue 或 pull request 給您，請務必建立 Readme.md 或 wiki 頁面，讓我們知道該如何運行環境

### 評分標準
* 功能完成度（75%）
* 程式碼風格（15%） 
* 文件（10%）

#### 備註
我們保證您的專題成果絕不會成為我們營利系統中的任何一部份

## 簡訊實聯制（Web 簡化版）

### 簡介
近日，政府為因應 COVID-19 疫情，行政院開發簡訊實聯制[[1]]系統供民眾使用。

### 需求
假設您是該系統的開發者，考量以下需求， 您會如何設計這個系統：
1. 提供一個 HTTP API 讓商家能夠申請場所代碼，場所代碼統一為 15 碼數字
2. 提供一個 HTTP API 讓用戶能夠傳送實聯制資訊
3. 提供一個 HTTP API 讓疫調人員能夠輸入確診者資訊（電話號碼、時間），並得出可能感染範圍

您的程式必須為上述的功能撰寫測試

為了方便疫調，我們至少需要儲存或取得以下資訊：
1. 儲存每個商家所申請的場所代碼的實際位置（WGS84）
   * 我們可以假設場所申請時就會代入 WGS84 的資訊
   * （加分題）假設商家申請時僅代入其地址，需自動取得 WGS84 資訊
2. 儲存每位用戶傳送實聯制資訊的時間、電話號碼與場所代碼
3. 可取得高風險區域的民眾名單
   * 輸入確診者資料（場所代碼、時間），取得該場所七天內其它民眾的資訊
   * （加分題）得出「附近場所」的所有民眾。「附近場所」係指以該場所為圓心，半徑 50 公尺以內的其它場所

為了確保系統的一致性，我們假設
1. 所有的資料都採 JSON 格式（除指定外，你可以自由訂立合適的資料格式）
    * [用戶傳送的 JSON Payload 格式會固定以此格式](https://gist.github.com/chivincent-rosetta/1019e6e05a797c48478175ff7f3b00d5)
2. 可以由任何程式語言或框架實作，使用的程式語言與框架並不影響評分
3. 可以搭配任何 Open Source 的解決方案，以下提供一些範例
    * 允許：MySQL, PostgreSQL, Elasticsearch, MongoDB, Redis, Docker
    * 不允許：Oracle RDBMS, Microsoft SQL Server
    * 如果不確定軟體是否能夠使用，歡迎來信詢問
4. 服務需可包裏為 OCI 相容的格式，並提供如何執行的說明，例如：Docker Image 搭配 Docker Compose

#### 參考資料
以下提供一些數據，可能會有助於您設計
根據經濟部公司統計資料[[2]]顯示，截至 2021 年 4 月底時，台灣共有 72 萬餘間企業

根據新聞資料[[3]]顯示，自 5/19 到 6/15 這段期間，約有 3.5 億筆實聯制資訊，此系統需容許每個月（30天）有 5 億筆實聯制資訊

註：可以選擇不處理、儲存億級的資料量，此部份會視處理方式給予合理評分

#### 注意事項
* 核心功能程式碼必須是可人類閱讀的，任何需要編譯的內容若沒有原始碼將不予計分
* 需考量 API 的使用者體驗（如過長的 API Response 延遲可能導致體驗變差）
* 您必須自行處理 Database Schema、資料結構、演算法與系統架構
* 不必完全達成題目要求，請盡量做到自己能力範圍內的即可
* 可以使用現成的套件、軟體或函式庫，只要注意符合題目規則即可
* 請勿將此專題視為簡單的 CRUD 題目，請以正式產品規格的專案規劃設計

#### 備註
* 【HackMD】行政院 1922 簡訊實聯制相關 Q&A: https://g0v.hackmd.io/@au/HkmyoS-Fu#1922-%E7%B0%A1%E8%A8%8A%E5%AF%A6%E8%81%AF%E5%88%B6-amp-%E4%BD%BF%E7%94%A8-QA
* 【經濟部】公司統計資料查詢: https://serv.gcis.nat.gov.tw/StatisticQry/cmpy/StaticFunction1.jsp
* 【中央社】 簡訊實聯制上路近1個月 NCC：已使用 3.5 億則: https://www.cna.com.tw/news/firstnews/202106150087.aspx

[1]: https://g0v.hackmd.io/@au/HkmyoS-Fu#1922-%E7%B0%A1%E8%A8%8A%E5%AF%A6%E8%81%AF%E5%88%B6-amp-%E4%BD%BF%E7%94%A8-QA
[2]: https://serv.gcis.nat.gov.tw/StatisticQry/cmpy/StaticFunction1.jsp
[3]: https://www.cna.com.tw/news/firstnews/202106150087.aspx
