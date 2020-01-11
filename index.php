

<?PHP
	//2020年1月11日　コメントをテストでいれました（消してＯＫ）
	//branchにsub1を作ってみたよ

	phpinfo();

	header('Content-Type: text/html; charset=UTF-8');

	// 言語
	mb_language('Japanese');
	// 文字コード
	mb_internal_encoding('utf-8');


	$mbox = imap_open ("{imap.gmail.com:993/imap/ssl}INBOX", "protomodel01raven@gmail.com", "spriggun0503");

	// メールボックスチェック
	$mboxes = imap_check($mbox);

	//debug log 
	print ( "<hr>" );
	var_dump( $mboxes );
	print ( "<hr>" );

	// 未読メール数
	$cnt_midoku = $mboxes->Recent;

	print ( "未読メール数:".$cnt_midoku."<BR>" );

    $head=imap_header($mbox, 8);

	    // アドレスの取得
    	$mail[7]['差出人']=$head->from[0]->mailbox.'@'.$head->from[0]->host;
    	// タイトルの有無
    	if( !empty($head->subject) ) {
       		// タイトルをデコード
       		$mhead=imap_mime_header_decode($head->subject);

       		foreach( $mhead as $key=>$value) {
          		if( $value->charset != 'default' ) {
              		$mail[7]['件名']=mb_convert_encoding($value->text,'UTF-8',$value->charset);
          		}else{
              		$mail[7]['件名']=$value->text;
          		}
       		}
			echo "title use";
    	}else{
      		// タイトルがない場合の処理を記述...
       		echo "no title";
    	}


		$body=imap_fetchbody($mbox, 8, 1, FT_INTERNAL);
        $body=trim($body);
		$mail[7]['本文']=mb_convert_encoding($body, "UTF-8", $value->charset);

	print_r ( $mail[7] );


	// メール閉じる
	imap_close($mbox);

?>