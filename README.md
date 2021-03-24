# pet-camera-webapp
This is a simple web application for watching your pet at home.
This needs a Linux server on the Internet and a simple web camera at home.

自宅にいるペットの様子を単機能のネットワークカメラでリモートで見るための簡易的なウェブアプリケーション。
インターネット上のサーバ(root権限あり、ウェブサーバ、ftpサーバ)と
ネットワークカメラ(定期的に静止画をftpサーバにアップロード)を組み合わせて実現。

---

## Preparation of server
- Add [pet] account(group is [pet]).
- Start proftpd and set [pet] account to read/write its home directory via ftp.
- Install the file monitoring tool by the following command.
<pre>
# apt-get install inotify-tools
</pre>
- Set the helper's permission by the following commands.
<pre>
# chmod 755 /usr/local/sbin/cp1pic2old4everd
# chown root:root /usr/local/sbin/cp1pic2old4everd
# chmod 755 /usr/local/sbin/cp1pic2old4test
# chown root:root /usr/local/sbin/cp1pic2old4test
</pre>
- Enable "short_open_tag" on PHP.

## Assumption
- This web app's URL is "http://<server>/pet/"
- The network camera uploads the picture to "~pet/pet.jpg" via ftp(proftpd).
- The network camera copies the old picture to "pet.odl" before it renews "pet.jpg".
- The network camera's IP address is "192.168.1.111".
- The residential router should have the port forward setting inbound TCP:81 and the network camera's TCP:80.
- The old pictures put on the directory "~pet/old/".
- ftp server's access log file is "/var/log/proftpd/xferlog".

## About Helper
[cppic2old4everd] copies the old picture to the directory "~pet/public_html/old/"
when "~pet/pet.jpg" is renewed.
That file name is the timestamp of uploading.
[cp1pic2old4test] is the test version of [cp1pic2old4everd] for debugging the environment.

## Start the helper
    # nohup cp1pic2old4everd &
    # exit

## Stop the helper
    # pkill cp1pic2old4everd
    # pkill inotifywait

---

## サーバの準備
- このウェブアプリのURLは"http://<サーバ>/pet/"
- petアカウント(グループ名pet)を作成
- proftpdを常時起動させ、petアカウントが自身のホームディレクトリにフルアクセスできるよう設定。
- ファイル監視ツール"inotify-tools"を以下のコマンドでインストール
<pre>
# apt-get install inotify-tools
</pre>
- 補助ツールのパーミッションを以下のコマンドで設定
<pre>
# chmod 755 /usr/local/sbin/cp1pic2old4everd
# chown root:root /usr/local/sbin/cp1pic2old4everd
# chmod 755 /usr/local/sbin/cp1pic2old4test
# chown root:root /usr/local/sbin/cp1pic2old4test
</pre>
- PHPの"short_open_tag"を有効にする

## 前提
ネットワークカメラからftp(サーバにはproftpdを利用)でアップロードする画像ファイルは"~pet/pet.jpg"
ネットワークカメラは"~pet/pet.jpg"が存在する場合はそれを"pet.odl"にコピーしてから
"pet.jpg"をアップロード
ネットワークカメラのIPアドレスは"192.168.1.111"
レジデンシャルルータのNAT設定で外部からのTCP:81ポートをネットワークカメラのTCP:80ポートへポートフォワード
過去の画像ファイルの置き場所は"~pet/old/"ディレクトリ
ftpサーバのアクセスログファイルは"/var/log/proftpd/xferlog"。

## 補助ツールについて
cppic2old4everdを実行中に、"~pet/pet.jpg"を新しいファイルに
上書きすると、古いファイルが"~pet/public_html/old/"ディレクトリにコピー。
ファイル名はアップロード時刻。
cp1pic2old4testはcp1pic2old4everdのテスト用。環境のデバッグ向け。

## 補助ツールの起動
    # nohup cp1pic2old4everd &
    # exit

## 補助ツールの停止
    # pkill cp1pic2old4everd
    # pkill inotifywait

