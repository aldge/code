<?php

/**
 * 为别的平台提供访问短信的客户端接口
 * $REQUEST_URL 升级到外网时要修改成相应的外网域名
 * $PLATFORM_KEY和$PLATFORM_SECRET为每个平台独有,在assist后台创建平台时自动生成
 * 每个客户端方法均以数组形式返回：
 * 数组格式范例:
 * Array
 *   (
 *       [timezone] => 8
 *       [version] => 1.0
 *       [my_version] => 20100908
 *       [charset] => utf-8
 *       [language] => zh_CN
 *       [result] => Array ([username] => renhxaaaa [sessionkey] => 任会学session)
 *       [code] => 0
 *       [message] =>
 *   )
 * code=0表示成功,否则为出现错误
 * message中可能有错误提示,若没有,则查看相关文档
 * @author yangtao
 * 相关文档:http://goo.gl/aNf8l
 *          
 */
class AssistAPIClient
{

    var $REQUEST_URL = "http://assist.tuibo.com/index.php?c=assistapi&a="; // 客户端请求地址
    var $PLATFORM_KEY = "ba91a6c964ca721a3ae5de8f88ce20db"; //平台标识
    var $PLATFORM_SECRET = "4bc35f00998f9c4e3079e275e226cbd1"; //用于生产签名

    //var $FORMAT = "PHP"; //请求返回结果的数据格式：PHP:被序列化的对象；JSON；XML

    public function __construct()
    {
    }

    /**
      +----------------------------------------------------------
     * 发送短信
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @param int $userId 用户id
     * @param string $userPhoneNum 手机号
     * @param array或string $smsContent 短信内容 使用模板,则为数组,不适用模板,则为字符串
     * @param int $actionId 操作id
     * @param int $useTemplate 是否使用模板
     * @param int $useMQ 是否使用消息队列
      +----------------------------------------------------------
     */
    public function sendSMS($userId, $userPhoneNum, $smsContent, $actionId, $useTemplate=0, $useMQ=1)
    {
        if ($useTemplate == 1)
        {
            $smsContent = serialize($smsContent);
        }

        $params = array(
            'userId' => $userId,
            'userPhoneNum' => $userPhoneNum,
            'smsContent' => $smsContent,
            'actionId' => $actionId,
            'useTemplate' => $useTemplate,
            'useMQ' => $useMQ,
        );

        $result = $this->my_api_request('sendsms', $params);
        return $result;
    }

    /**
      +----------------------------------------------------------
     * 生成并发送验证码
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @param int $userId 用户id
     * @param string $userPhoneNum 手机号
     * @param array或string $smsContent 短信内容 使用模板,则为数组,不适用模板,则为字符串 详情请看文档
     * @param int $useTemplate 是否使用模板
      +----------------------------------------------------------
     */
    public function sendVCode($userId, $userPhoneNum, $smsContent, $useTemplate=1)
    {
        if ($useTemplate == 1)
        {
            $smsContent = serialize($smsContent);
        }

        $params = array(
            'userId' => $userId,
            'userPhoneNum' => $userPhoneNum,
            'smsContent' => $smsContent,
            'useTemplate' => $useTemplate,
        );

        $result = $this->my_api_request('sendvcode', $params);
        return $result;
    }
    /**
      +----------------------------------------------------------
     * 获取手机短信验证码下发数
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @param int $starttime 开始时间
     * @param int $endtime 结束时间
      +----------------------------------------------------------
     */
    public function GetCodeNum($starttime, $endtime)//xlt,2011.6.2
    {  
        $params = array(
            'starttime' => $starttime,
            'endtime' => $endtime
        );

        $result = $this->my_api_request('getsmssendnum', $params);
        return $result;
    }
    /**
      +----------------------------------------------------------
     * 验证功能（发送验证码与用户提交验证码的一致性）
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @param int $userId 用户id
     * @param string $vCode 用户提交的验证码
      +----------------------------------------------------------
     */
    public function verifyCode($userId, $vCode)
    {
        $params = array(
            'userId' => $userId,
            'vCode' => $vCode,
        );

        $result = $this->my_api_request('verifycode', $params);
        return $result;
    }

    /**
      +----------------------------------------------------------
     * 发送Email
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @param string $toEmailbox 邮件接收者的邮箱,多个用逗号(',')分割
     * @param array $emailSubject 邮件标题 
     * @param array $emailContent 邮件内容 
     * @param int $actionId 操作id
      +----------------------------------------------------------
     */
    public function sendEmail($toEmailbox, $emailSubject, $emailContent, $actionId)
    {
        $params = array(
            'toEmailbox' => $toEmailbox,
            'emailContent' => serialize($emailContent),
            'emailSubject' => serialize($emailSubject),
            'actionId' => $actionId,
        );

        $result = $this->my_api_request('sendemail', $params);
        return $result;
    }

    /**
      +----------------------------------------------------------
     * 批量发送Email
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @param string $toEmailbox 邮件接收者的邮箱,多个用逗号(',')分割
     * @param array $emailSubject 邮件标题 
     * @param array $emailContent 邮件内容 
     * @param int $actionId 操作id
     * @param int $batchNo 批量编号
     * @param int $batchCount 一共多少批
     * @param int $batchSerial 当前是第几批
     * @param int $time 定时时间
      +----------------------------------------------------------
     */
    public function batchEmail($toEmailbox, $emailSubject, $emailContent, $actionId, $batchNo, $batchCount, $batchSerial, $time=0)
    {
        $params = array(
            'toEmailbox' => $toEmailbox,
            'emailContent' => serialize($emailContent),
            'emailSubject' => serialize($emailSubject),
            'actionId' => $actionId,
            'batchNo' => $batchNo,
            'batchCount' => $batchCount,
            'batchSerial' => $batchSerial,
            'time' => $time,
        );

        $result = $this->my_api_request('batchemail', $params);
        return $result;
    }

    /**
      +----------------------------------------------------------
     * 根据$actionId获取发送邮箱和模板标题,内容
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @param int $actionId 操作id
      +----------------------------------------------------------
     * @return array 
     *   (
     *       [result] => Array ([mailbox] => 发送邮箱 [subject] => 模板标题 [content] => 模板内容)
     *       [code] => 0
     *       [message] =>
     *   )
      +----------------------------------------------------------
     */
    public function getActionInfo($actionId)
    {
        $params = array(
            'actionId' => $actionId,
        );

        $result = $this->my_api_request('getactioninfo', $params);
        return $result;
    }

    /**
      +----------------------------------------------------------
     * 根据$batchNo获取发送情况
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @param int $batchNo 批量编号
      +----------------------------------------------------------
     * @return array 
     *   (
     *       [result] => Array ([count] => 一共有多少批 [doneno] => 已完成多少批 )
     *       [code] => 0
     *       [message] =>
     *   )
      +----------------------------------------------------------
     */
    public function getEmailSuccess($batchNo)
    {
        $params = array(
            'batchNo' => $batchNo,
        );

        $result = $this->my_api_request('getemailsuccess', $params);
        return $result;
    }

    /**
     * 请求API方法
     * params $arr['module'] $arr['method'] $arr['url'] $arr['platformKey'] $arr['timeout']
     * 		  $params 参数数组，键值对形式
     */
    private function my_api_request($method, $params=array())
    {

        $sign = $this->PLATFORM_KEY . '|' . $this->PLATFORM_SECRET . '|' . $params[0];
        $sign = md5($sign);
        $params['sign'] = $sign;
        $params['platformKey'] = $this->PLATFORM_KEY;

        $post = '';

        foreach ($params as $key => $value)
        {
            $p = $key . '=' . $value . '&';
            $post.=$p;
        }

        $timeout = 3600;

        $backArr = $this->uc_fopen($this->REQUEST_URL . $method, 0, urldecode($post), '', FALSE, '', $timeout, TRUE);
      //  echo $backArr;die;
        $backArr = unserialize($backArr);
        return $backArr;
    }

    private function uc_fopen($url, $limit = 0, $post = '', $cookie = '', $bysocket = FALSE, $ip = '', $timeout = 15, $block = TRUE)
    {
        $return = '';
        $matches = parse_url($url);
        !isset($matches['host']) && $matches['host'] = '';
        !isset($matches['path']) && $matches['path'] = '';
        !isset($matches['query']) && $matches['query'] = '';
        !isset($matches['port']) && $matches['port'] = '';
        $host = $matches['host'];
        $path = $matches['path'] ? $matches['path'] . ($matches['query'] ? '?' . $matches['query'] : '') : '/';
        $port = !empty($matches['port']) ? $matches['port'] : 80;

        if ($post)
        {
            $out = "POST $path HTTP/1.0\r\n";
            $out .= "Accept: */*\r\n";
            //$out .= "Referer: $boardurl\r\n";
            $out .= "Accept-Language: zh-cn\r\n";
            $out .= "Content-Type: application/x-www-form-urlencoded\r\n";
            $out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
            $out .= "Host: $host\r\n";
            $out .= 'Content-Length: ' . strlen($post) . "\r\n";
            $out .= "Connection: Close\r\n";
            $out .= "Cache-Control: no-cache\r\n";
            $out .= "Cookie: $cookie\r\n\r\n";
            $out .= $post;
        }
        else
        {
            $out = "GET $path HTTP/1.0\r\n";
            $out .= "Accept: */*\r\n";
            //$out .= "Referer: $boardurl\r\n";
            $out .= "Accept-Language: zh-cn\r\n";
            $out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
            $out .= "Host: $host\r\n";
            $out .= "Connection: Close\r\n";
            $out .= "Cookie: $cookie\r\n\r\n";
        }
        $fp = @fsockopen(($ip ? $ip : $host), $port, $errno, $errstr, $timeout);
        if (!$fp)
        {
            return ''; //note $errstr : $errno \r\n
        }
        else
        {
            stream_set_blocking($fp, $block);
            stream_set_timeout($fp, $timeout);
            @fwrite($fp, $out);
            $status = stream_get_meta_data($fp);
            if (!$status['timed_out'])
            {
                while (!feof($fp))
                {
                    if (($header = @fgets($fp)) && ($header == "\r\n" || $header == "\n"))
                    {
                        break;
                    }
                }

                $stop = false;
                while (!feof($fp) && !$stop)
                {
                    $data = fread($fp, ($limit == 0 || $limit > 8192 ? 8192 : $limit));
                    $return .= $data;
                    if ($limit)
                    {
                        $limit -= strlen($data);
                        $stop = $limit <= 0;
                    }
                }
            }
            @fclose($fp);
            return $return;
        }
    }

}

?>
