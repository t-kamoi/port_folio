# イベント管理アプリ
リンク：[Event Management Page](http://portfolio20221010.herokuapp.com/ems/login.php)

|  | 管理ユーザー | 一般ユーザー |
----|:----|:---- 
| ID | kanri01 | test01 |
| PASS | kanri | test |

利用者は登録されたイベント情報を共有することが出来ます。利用者には一般ユーザーと管理ユーザーの2種類があり、以下の機能を利用出来ます。

1. 登録されたイベントの閲覧（index.php , list_event.php）
    - index.phpでは本日開催予定のイベントを確認することが出来ます。list_event.phpでは登録された全てのイベントを確認することが出来ます。それぞれ1ページに5件ごと表示します。

2. イベントの新規登録（regist_event.php）
    - regist_event.phpではイベントを新規登録することが出来ます。入力フォーム（チェックボックスも含む）は必須項目が未入力の状態で決定ボタンが押されたとき、必須フォームを強調表示して入力を促すメッセージを表示します。そのとき一部入力済みのフォーム内容がある場合はそれを保持します。

3. イベントの編集・削除（index.php , list_event.php）
    - 一覧表示されたイベントの右側にある詳細ボタンを押すと登録されたイベントの詳細を確認することが出来ます。詳細画面ではイベント一覧では表示されていない情報の閲覧に加え、参加ボタンをクリックすることで参加の表明をすることが出来ます。管理ユーザーは更に編集と削除を行うことが出来ます。

4. 新規ユーザーの登録（regist_user.php ※管理ユーザーのみ）
    - 管理ユーザーでログインしている時に限り、ナビゲーションに"新規ユーザー登録"のボタンが表示されます。入力フォーム（プルダウンメニュー・ラジオボタンも含む）は必須項目が未入力の状態で決定ボタンが押されたとき、必須フォームを強調表示して入力を促すメッセージを表示します。そのとき一部入力済みのフォーム内容がある場合はそれを保持します。

5. 登録済みユーザー情報の編集（edit_user.php ※管理ユーザーのみ）
    - 管理ユーザーでログインしている時に限り、ナビゲーションに"ユーザー管理"のボタンが表示されます。ここでは登録済みユーザー情報（氏名・ログインID・パスワード・所属）の編集や、ユーザーの削除を行うことが出来ます。

###開発環境
- OS：windows10 home
- 言語：PHP Version 8.0.9
- CSSフレームワーク：bootstrap@5.2.0-beta1
- サーバー：Apache/2.4.48
- データベース：phpMyAdmin/5.1.1

###本番環境
- サーバー：Heroku
- データベース：mySQL