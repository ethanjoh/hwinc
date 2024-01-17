<?php

include_once 'config.php';
include_once 'simple_html_dom.php';

$connect = mysqli_connect($host, $dbid, $dbpass, $dbname);

/**
 * Returns the URL of the current page as a string.
 *
 * @return string The URL of the current page.
 */
function getUrl()
{
    // Determine the protocol to use based on the 'HTTPS' server variable.
    $url = isset($_SERVER['HTTPS']) && 'on' === $_SERVER['HTTPS'] ? 'https' : 'http';
    
    // Append the server name to the URL.
    $url .= '://' . $_SERVER['SERVER_NAME'];

    // Append the port number to the URL if it is not the default port (80 for HTTP and 443 for HTTPS).
    $url .= in_array($_SERVER['SERVER_PORT'], array('80', '443')) ? '' : ':' . $_SERVER['SERVER_PORT'];

    // Append the request URI to the URL.
    $url .= $_SERVER['REQUEST_URI'];

    // Return the final URL.
    return $url;
}


/**
 * Establishes a MySQL database connection and returns the connection object.
 *
 * @param string $host The name of the host to connect to.
 * @param string $id The username to use for the connection.
 * @param string $pass The password to use for the connection.
 * @param string $db The name of the database to select.
 * @return object|false The MySQL database connection object on success, or false on failure.
 */
function my_connect($host, $id, $pass, $db)
{
    // Attempt to establish a MySQL database connection using the specified host, username, and password.
    $connect = mysqli_connect($host, $id, $pass);

    // If the connection was successful, select the specified database.
    if ($connect) {
        mysqli_select_db($connect, $db);
    }

    // Return the connection object or false if the connection failed.
    return $connect;
}

/**
 * Displays a message in an alert box and redirects the user to a new URL.
 *
 * @param string $msg The message to display in the alert box.
 * @param string $url The URL to redirect the user to.
 * @return void
 */
function show_msg($msg, $url)
{
    // Display an alert box containing the specified message and redirect the user to the specified URL.
    echo "<meta HTTP-EQUIV='CONTENT-TYPE' content='text/html;charset=UTF-8'>
          <script language=\"JavaScript\">
               window.alert(\"$msg\");
               document.location.replace(\"$url\");
            </script>";
}

/**
* Generates a mobile-friendly pagination bar with links to previous and next pages, as well as a range of page numbers
* @param int $totalpage The total number of pages to display
* @param int $cpage The current page number
* @param string $url The URL to use for the pagination links
* @param int $pagenumber The maximum number of pages to display in the pagination bar (default: 5)
* @return void
*/
function page_mobile($totalpage, $cpage, $url)
{

    if (!isset($pagenumber)) {
        $pagenumber = 5;
    }

    $startpage = intval(($cpage - 1) / $pagenumber) * $pagenumber + 1;
    $endpage   = intVal(((($startpage - 1) + $pagenumber) / $pagenumber) * $pagenumber);

    if ($totalpage <= $endpage) {
        $endpage = $totalpage;
    }

    if ($cpage > $pagenumber) {

        $curpage  = intval($startpage - 1);
        $url_page = '<li><a href="' . $url . '&amp;page=' . $curpage . '" >' . "\r\n";
        echo $url_page;
        echo '<i class="fa fa-chevron-left"></i> </a></li>' . "\r\n";
    } else {
        echo "";
    }

    $curpage = $startpage;

    while ($curpage <= $endpage):

        if ($curpage == $cpage) {
            echo '<li class="active"><a href="#" >' . $cpage . '</a></li>' . "\r\n";
        } else {
            $url_page = '<li><a href="' . $url . '&amp;page=' . $curpage . '" >';
            echo $url_page;
            echo $curpage . '</a></li>' . "\r\n";
        }
        $curpage++;

    endwhile;

    if ($totalpage > $endpage) {
        $curpage  = intval($endpage + 1);
        $url_page = '<li><a href="' . $url . '&amp;page=' . $curpage . '" >';
        echo $url_page;
        echo '<i class="fa fa-chevron-right"></i></a></li>' . "\r\n";
    }

}

/**
 * Displays an error message and exits the script.
 *
 * @param string $msg The error message to display.
 * @param bool $bool Whether or not to display the error message. Defaults to true.
 * @return void
 */
function err_msg($msg, $bool = "1")
{
    if ($bool) {
        echo "  <meta http-equiv='content-type' content='text/html; charset=UTF-8' />
              <script>
              window.alert('$msg');
              history.go(-1);
              </script>
        ";
        exit;
    }
}

/**
 * Displays a JavaScript alert message with the given text.
 *
 * @param string $msg The text to be displayed in the alert message.
 * @return void
 */
function msg($msg)
{
    echo ("<meta http-equiv='content-type' content='text/html; charset=UTF-8' />
          <script>
          window.alert('$msg')
          </script>
        ");
}

/**
 * Redirects the user to a different URL using a meta tag with the specified URL.
 *
 * @param string $re_url The URL to redirect the user to.
 * @return void
 */
function redirect($re_url)
{
    echo "<meta http-equiv='Refresh' content='0; URL=" . $re_url . "'>";
    exit;
}

/**
 * Cuts a UTF-8 encoded string to a specified length and appends a suffix.
 *
 * @param string $str The input string to cut.
 * @param int $max_len The maximum length of the resulting string, including the suffix.
 * @param string $suffix The suffix to append to the resulting string if it was cut.
 * @return string The resulting string, with a length no greater than $max_len.
 */
function cut_string_utf8($str, $max_len, $suffix)
{
    $n   = 0;
    $noc = 0;
    $len = strlen($str);
    while ($n < $len) {
        $t = ord($str[$n]);
        if ($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
            $tn = 1;
            $n++;
            $noc++;
        } else if (194 <= $t && $t <= 223) {
            $tn = 2;
            $n += 2;
            $noc += 2;
        } else if (224 <= $t && $t < 239) {
            $tn = 3;
            $n += 3;
            $noc += 2;
        } else if (240 <= $t && $t <= 247) {
            $tn = 4;
            $n += 4;
            $noc += 2;
        } else if (248 <= $t && $t <= 251) {
            $tn = 5;
            $n += 5;
            $noc += 2;
        } else if ($t == 252 || $t == 253) {
            $tn = 6;
            $n += 6;
            $noc += 2;
        } else { $n++;}
        if ($noc >= $max_len) {break;}
    }
    if ($noc <= $max_len) {
        return $str;
    }

    if ($noc > $max_len) {$n -= $tn;}
    return substr($str, 0, $n) . $suffix;
}

/**
 * 타이틀 텍스트 줄이기
 * @param  string $tite
 * @param  integer $end
 * @return string $str
 */
function get_short($title, $end)
{
    $str = mb_strimwidth($title, '0', $end, '&#183;&#183;&#183;', 'utf-8');
    return stripslashes($str);
}

/**
 * make thumbnail images
 * @param  image $source_file
 * @param  integer $_width
 * @param  integer $_height
 * @param  image $object_file
 * @return boolean
 * 이미지소스와 타겟 경로는 상대경로를 쓴다.
 */
function make_thumbnail($source_path, $width, $height, $thumbnail_path)
{
    list($img_width, $img_height, $type) = getimagesize($source_path);
    if ($type != 1 && $type != 2 && $type != 3 && $type != 15) {
        return;
    }

    if ($type == 1) {
        $img_sour = imagecreatefromgif($source_path);
    } else if ($type == 2) {
        $img_sour = imagecreatefromjpeg($source_path);
    } else if ($type == 3) {
        $img_sour = imagecreatefrompng($source_path);
    } else if ($type == 15) {
        $img_sour = imagecreatefromwbmp($source_path);
    }

    if ($img_width > $img_height) {
        $w      = round($height * $img_width / $img_height);
        $h      = $height;
        $x_last = round(($w - $width) / 2);
        $y_last = 0;
    } else {
        $w      = $width;
        $h      = round($width * $img_height / $img_width);
        $x_last = 0;
        $y_last = round(($h - $height) / 2);
    }
    if ($img_width < $width && $img_height < $height) {
        $img_last = imagecreatetruecolor($width, $height);
        $x_last   = round(($width - $img_width) / 2);
        $y_last   = round(($height - $img_height) / 2);

        imagecopy($img_last, $img_sour, $x_last, $y_last, 0, 0, $w, $h);
        imagedestroy($img_sour);
        $white = imagecolorallocate($img_last, 255, 255, 255);
        imagefill($img_last, 0, 0, $white);
    } else {
        $img_dest = imagecreatetruecolor($w, $h);
        imagecopyresampled($img_dest, $img_sour, 0, 0, 0, 0, $w, $h, $img_width, $img_height);
        $img_last = imagecreatetruecolor($width, $height);
        imagecopy($img_last, $img_dest, 0, 0, $x_last, $y_last, $w, $h);
        imagedestroy($img_dest);
    }
    if ($thumbnail_path) {
        if ($type == 1) {
            imagegif($img_last, $thumbnail_path, 100);
        } else if ($type == 2) {
            imagejpeg($img_last, $thumbnail_path, 100);
        } else if ($type == 3) {
            imagepng($img_last, $thumbnail_path, 0);
        } else if ($type == 15) {
            imagebmp($img_last, $thumbnail_path, 100);
        }

    } else {
        if ($type == 1) {
            imagegif($img_last);
        } else if ($type == 2) {
            imagejpeg($img_last);
        } else if ($type == 3) {
            imagepng($img_last);
        } else if ($type == 15) {
            imagebmp($img_last);
        }

    }

    imagedestroy($img_last);

}

function getRelativePath($from, $to)
{
    $from = explode('/', $from);
    $to   = explode('/', $to);
    foreach ($from as $depth => $dir) {

        if (isset($to[$depth])) {
            if ($dir === $to[$depth]) {
                unset($to[$depth]);
                unset($from[$depth]);
            } else {
                break;
            }
        }
    }
    //$rawresult = implode('/', $to);
    for ($i = 0; $i < count($from) - 1; $i++) {
        array_unshift($to, '..');
    }
    $result = implode('/', $to);
    return $result;
}

/**
 * 첫번째 img 태그 src 구하기
 * 에디터의 img src는 절대경로(/bbs/upload)로 업로드
 * 썸네일을 만들 때는 상대경로로 바꿈(./thumbnail)
 *
 */
function get_img_src($html_src)
{

    $html = str_get_html($html_src);

    //본문에 이미지가 없을 경우 대체이미지 리턴하도록 수정
    if ($html == null) {
        return $target = "./thumbnail/no-img.gif";
    } else {

        $source = $html->find('img', 0)->src;

        // $search = 'http://www.' . $_SERVER['SERVER_NAME'];
        $search = '/bbs';

        // 절대경로를 상대경로로 바꿈
        $src_path  = str_replace($search, '.', $source);
        $save_file = explode('/', $src_path);
        $save_dir  = "./thumbnail/";
        $target    = $save_dir . "thumb-" . $save_file[2];

        //  디버깅
        // $txt  = print_r($save_file, true);
        // $file = fopen("log.txt", "a+b");
        // fwrite($file, $txt);
        // fclose($file);

        if (!file_exists($target)) {
            make_thumbnail($src_path, 200, 160, $target);
            // @unlink($target);
        }

        return $target;
    }
}

function get_video_src($html_src)
{

    $html   = str_get_html($html_src);
    $source = $html->find('iframe', 0);

    return $source;
}

/**
 * [set_var GET, POST, SESSION 등 어레이값이 있는지 확인]
 * @param [type] &$ary [description]
 */
function set_var(&$ary)
{
    if (isset($ary) == true) {
        return $ary;
    } else {
        return null;
    }

}

/**
 * [show_notice 팝업창 띄우기]
 * @return [type] [description]
 */
function show_notice()
{
    global $connect;

    $query  = "SELECT * FROM popup where 1";
    $result = mysqli_query($connect, $query);
    $rows   = mysqli_fetch_array($result);

    if ('Y' == $rows['chk']) {

        $title  = _('공지사항');
        $dnopen = _('오늘 이 창을 다시 열지 않음');
        $close  = _('닫기');

        echo <<<HEREDOC

        <div class="modal fade" id="notice" style="z-index: 3000000000;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-center">{$title}</h4>
                    </div>
                    <div id="popup" title="notice" class="modal-body">
                        {$rows['contents']}
                    </div>
                    <div class="modal-footer">
                        <form name="formpop">
                        <input type="checkbox" id="chkNotice" name="chkNotice">
                        <span style="font-size:9pt;color:#000000">{$dnopen}</span>
                        <a class="btn btn-sm c-theme-btn c-btn-square c-btn-bold" onclick="closeWin();" data-dismiss="modal">{$close}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            var ntc = jQuery;
            $(window).load(function(){
                if ( getCookie( "chkNotice" ) != "done" ) {
                    ntc('#notice').modal('show');
                }
            });
        </script>

HEREDOC;

    } else {
        echo <<<HEREDOC

        <script type="text/javascript">
            var ntc = jQuery;
            $(window).load(function(){
                ntc('#notice').modal('hide');
            });
        </script>

HEREDOC;
    }

}

// get random salt code
function getRandSaltCode($iLen = 8)
{
    $sRes = '';

    $sChars = '23456789abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
    for ($i = 0; $i < $iLen; $i++) {
        $z = rand(0, strlen($sChars) - 1);
        $sRes .= $sChars[$z];
    }
    return $sRes;
}

/**
 * [GenerateString 사용자 비밀번호 랜덤생성]
 * @param [type] $length [description]
 */
function GenerateString($length)
{
    $characters = "0123456789";
    $characters .= "abcdefghijkmnopqrstuvwxyz"; //비밀번호 l, i가 구분이 안되니 삭제
    $characters .= "ABCDEFGHJKLMNOPQRSTUVWXYZ"; //비밀번호 I 구분이 안되니 삭제

    $string_generated = "";

    $nmr_loops = $length;
    while ($nmr_loops--) {
        $string_generated .= $characters[mt_rand(0, strlen($characters))];
    }

    return $string_generated;
}

function getContent($id)
{
    global $host, $dbid, $dbpass, $dbname;
    $connection = mysqli_connect($host, $dbid, $dbpass, $dbname);

    $sql = "SELECT * FROM session_comment WHERE id='" . $id . "' ";
    $res = mysqli_query($connection, $sql);
    $row = mysqli_num_rows($res);

    if ($row == 1) {
        $rows = mysqli_fetch_array($res);

        $result = preg_replace("/\r|\n/", "", $rows['comment']);
        // return $rows['comment'];
        return $result;
    }

}
