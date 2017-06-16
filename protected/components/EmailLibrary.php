<?php

class EmailLibrary {

    protected $_sTo;
    protected $_sFrom;
    protected $_sSender;
    protected $_sSubject;
    protected $_sText;
    protected $_sHtml;
    protected $_sCc;
    protected $_sReplyTo;
    protected $_sReplyToName;
    
    public $_sHostname    = '';
    public $_sUsername    = '';
    public $_sPassword    = '';
    protected $_aAttachments = array();
    public $_sProtocol    = 'mail';
    public $_iPort        = 25;
    public $_iTimeout     = 5;
    public $_sNewline     = "\n";
    public $_sCrlf        = "\r\n";
    public $_bVerp        = false;
    public $_sParameter   = '';

    public function setProtocol($protocol){
        $this->_sProtocol = $protocol;
    }
    
    public function setTimeOut($timeOut){
        $this->_iTimeout = $timeOut;
    }
    public function setPort($port){
        $this->_iPort = $port;
    }
    public function setCc($sCc) {
        $this->_sCc = $sCc;
    }

    public function setTo($sTo) {
        $this->_sTo = $sTo;
    }

    public function setFrom($sFrom) {
        $this->_sFrom = $sFrom;
    }

    public function setSender($sSender) {
        $this->_sSender = $sSender;
    }

    public function setSubject($sSubject) {
        $this->_sSubject = $sSubject;
    }

    public function setText($sText) {
        $this->_sText = $sText;
    }

    public function setHtml($sHtml) {
        $this->_sHtml = $sHtml;
    }

    public function setReplyTo($sReplyTo){
        $this->_sReplyTo = $sReplyTo;
    }
    public function setReplyToName($sReplyToName){
        $this->_sReplyToName = $sReplyToName;
    }
    
    public function addAttachment($sFilename, $sFilePath) {
        $this->_aAttachments[$sFilename] = $sFilePath;
    }

    public function send() {
        if (!$this->_sTo) {
            trigger_error('Error: E-Mail to required!');
            return 0;
        }

        if (!$this->_sFrom) {
            trigger_error('Error: E-Mail from required!');
            return 0;
        }

        if (!$this->_sSender) {
            trigger_error('Error: E-Mail sender required!');
            return 0;
        }

        if (!$this->_sSubject) {
            trigger_error('Error: E-Mail subject required!');
            return 0;
        }

        if ((!$this->_sText) && (!$this->_sHtml)) {
            trigger_error('Error: E-Mail message required!');
            return 0;
        }

        if (is_array($this->_sTo)) {
            $sTo = implode(',', $this->_sTo);
        } else {
            $sTo = $this->_sTo;
        }

        $sBoundary = '----=_NextPart_' . md5(time());

        $sHeader = '';

        $sHeader .= 'MIME-Version: 1.0' . $this->_sNewline;

        if ($this->_sProtocol != 'mail') {
            $sHeader .= 'To: ' . $sTo . $this->_sNewline;
            $sHeader .= 'Subject: ' . $this->_sSubject . $this->_sNewline;
        }

        if ($this->_sCc) {
            $sHeader .= 'Cc: ' . $this->_sCc . $this->_sNewline;
        }

        $sHeader .= 'Date: ' . date("D, d M Y H:i:s O") . $this->_sNewline;
        $sHeader .= 'From: ' . '=?UTF-8?B?' . base64_encode($this->_sSender) . '?=' . '<' . $this->_sFrom . '>' . $this->_sNewline;
        $sHeader .= 'Reply-To: ' . $this->_sReplyToName . '<' . $this->_sReplyTo . '>' . $this->_sNewline;
        $sHeader .= 'Return-Path: ' . $this->_sFrom . $this->_sNewline;
        $sHeader .= 'X-Mailer: PHP/' . phpversion() . $this->_sNewline;        
        $sHeader .= 'Content-Type: multipart/mixed; boundary="' . $sBoundary . '"' . $this->_sNewline . $this->_sNewline;
                
        if (!$this->_sHtml) {
            $sMessage = '--' . $sBoundary . $this->_sNewline;            
            $sMessage .= 'Content-Type: text/html; charset="utf-8"' . $this->_sNewline;
            $sMessage .= 'Content-Transfer-Encoding: 8bit' . $this->_sNewline . $this->_sNewline;
            $sMessage .= $this->_sText . $this->_sNewline;
        } else {                   
            
            $charset = '';
            $content_transfer_encoding = '';
            //$isYahooMail = false;
            if(preg_match('/yahoo.com|y7mail.com/i', $this->_sTo)){
                $charset = '"utf-8"';
                $content_transfer_encoding = '8bit';
                //$isYahooMail = true;
            }
            else{
                $charset = 'ISO-8859-1';
                $content_transfer_encoding = '"7BIT"';
            }
                        
            //Using gmail configs           
            $sMessage = '--' . $sBoundary . $this->_sNewline;
            $sMessage .= 'Content-Type: multipart/alternative; boundary="' . $sBoundary . '_alt"' . $this->_sNewline . $this->_sNewline;
            $sMessage .= '--' . $sBoundary . '_alt' . $this->_sNewline;                  
            $sMessage .= "Content-Type: text/plain; charset=$charset" . $this->_sNewline;     
            $sMessage .= 'Content-Transfer-Encoding: 8bit' . $this->_sNewline . $this->_sNewline;
            
            $sMessage .= $this->_sHtml . $this->_sNewline;
            
            if ($this->_sText) {
                $sMessage .= $this->_sText . $this->_sNewline;
            }
            
            $sMessage .= '--' . $sBoundary . '_alt' . $this->_sNewline;
            $sMessage .= "Content-Type: text/html; charset=$charset" . $this->_sNewline;            
            if(!empty($this->_aAttachments)){
                $sMessage .= 'Content-Transfer-Encoding: quoted-printable' . $this->_sNewline . $this->_sNewline;
            }
            else{
                $sMessage .= "Content-Transfer-Encoding: $content_transfer_encoding" . $this->_sNewline . $this->_sNewline;
            }
                                
            $sMessage .= '<div dir=3D"ltr">' . $this->_sHtml . '</div>' . $this->_sNewline;            
                        
            $sMessage .= '--' . $sBoundary . '_alt--' . $this->_sNewline;
        }

        foreach ($this->_aAttachments as $sFileName => $sFilePath) {            
            if (file_exists($sFilePath)) {
                $oHandle = fopen($sFilePath, 'r');

                $sContent = fread($oHandle, filesize($sFilePath));
                fclose($oHandle);

                $sMessage .= '--' . $sBoundary . $this->_sNewline;
                $sMessage .= 'Content-Type: application/pdf; name="' . $sFileName . '"' . $this->_sNewline;                
                $sMessage .= 'Content-Transfer-Encoding: base64' . $this->_sNewline;
                $sMessage .= 'Content-Disposition: attachment; filename="' . $sFileName . '"' . $this->_sNewline;
                $sMessage .= 'Content-ID: <' . basename(urlencode($sFileName)) . '>' . $this->_sNewline;
                $sMessage .= 'X-Attachment-Id: ' . basename(urlencode($sFileName)) . $this->_sNewline . $this->_sNewline;
                $sMessage .= chunk_split(base64_encode($sContent));
            }
        }

        $sMessage .= '--' . $sBoundary . '--' . $this->_sNewline;

        if ($this->_sProtocol == 'mail') {
            ini_set('sendmail_from', $this->_sFrom);

            if ($this->_sParameter) {
                mail($sTo, '=?UTF-8?B?' . base64_encode($this->_sSubject) . '?=', $sMessage, $sHeader, $this->_sParameter);
            } else {
                mail($sTo, '=?UTF-8?B?' . base64_encode($this->_sSubject) . '?=', $sMessage, $sHeader);
            }
        } elseif ($this->_sProtocol == 'smtp') {
            $oHandle = fsockopen($this->_sHostname, $this->_iPort, $errno, $errstr, $this->_iTimeout);

            if (!$oHandle) {
                trigger_error('Error: ' . $errstr . ' (' . $errno . ')');
                exit();
            } else {
                if (substr(PHP_OS, 0, 3) != 'WIN') {
                    socket_set_timeout($oHandle, $this->_iTimeout, 0);
                }

                while ($sLine = fgets($oHandle, 515)) {
                    if (substr($sLine, 3, 1) == ' ') {
                        break;
                    }
                }

                
                if (substr($this->_sHostname, 0, 3) == 'tls') {
                    fputs($oHandle, 'STARTTLS' . $this->_sCrlf);

                    while ($sLine = fgets($oHandle, 515)) {
                        $sReply .= $sLine;

                        if (substr($sLine, 3, 1) == ' ') {
                            break;
                        }
                    }

                    if (substr($sReply, 0, 3) != 220) {
                        trigger_error('Error: STARTTLS not accepted from server!');
                        return 0;
                    }
                }

                if (!empty($this->_sUsername) && !empty($this->_sPassword)) {
                    fputs($oHandle, 'EHLO ' . getenv('SERVER_NAME') . $this->_sCrlf);

                    $sReply = '';

                    while ($sLine = fgets($oHandle, 515)) {
                        $sReply .= $sLine;

                        if (substr($sLine, 3, 1) == ' ') {
                            break;
                        }
                    }

                    if (substr($sReply, 0, 3) != 250) {
                        trigger_error('Error: EHLO not accepted from server!');
                        return 0;
                    }

                    fputs($oHandle, 'AUTH LOGIN' . $this->_sCrlf);

                    $sReply = '';

                    while ($sLine = fgets($oHandle, 515)) {
                        $sReply .= $sLine;

                        if (substr($sLine, 3, 1) == ' ') {
                            break;
                        }
                    }

                    if (substr($sReply, 0, 3) != 334) {
                        trigger_error('Error: AUTH LOGIN not accepted from server!');
                        return 0;
                    }

                    fputs($oHandle, base64_encode($this->_sUsername) . $this->_sCrlf);

                    $sReply = '';

                    while ($sLine = fgets($oHandle, 515)) {
                        $sReply .= $sLine;

                        if (substr($sLine, 3, 1) == ' ') {
                            break;
                        }
                    }

                    if (substr($sReply, 0, 3) != 334) {
                        trigger_error('Error: Username not accepted from server!');
                        return 0;
                    }

                    fputs($oHandle, base64_encode($this->_sPassword) . $this->_sCrlf);

                    $sReply = '';

                    while ($sLine = fgets($oHandle, 515)) {
                        $sReply .= $sLine;

                        if (substr($sLine, 3, 1) == ' ') {
                            break;
                        }
                    }

                    if (substr($sReply, 0, 3) != 235) {
                        trigger_error('Error: Password not accepted from server!');
                        return 0;
                    }
                } else {
                    fputs($oHandle, 'HELO ' . getenv('SERVER_NAME') . $this->_sCrlf);

                    $sReply = '';

                    while ($sLine = fgets($oHandle, 515)) {
                        $sReply .= $sLine;

                        if (substr($sLine, 3, 1) == ' ') {
                            break;
                        }
                    }

                    if (substr($sReply, 0, 3) != 250) {
                        trigger_error('Error: HELO not accepted from server!');
                        return 0;
                    }
                }

                if ($this->_bVerp) {
                    fputs($oHandle, 'MAIL FROM: <' . $this->_sFrom . '>XVERP' . $this->_sCrlf);
                } else {
                    fputs($oHandle, 'MAIL FROM: <' . $this->_sFrom . '>' . $this->_sCrlf);
                }

                $sReply = '';

                while ($sLine = fgets($oHandle, 515)) {
                    $sReply .= $sLine;

                    if (substr($sLine, 3, 1) == ' ') {
                        break;
                    }
                }

                if (substr($sReply, 0, 3) != 250) {
                    trigger_error('Error: MAIL FROM not accepted from server!');
                    return 0;
                }

                $aCc = explode(',', $this->_sCc);                
                if (!is_array($this->_sTo)) {
                    $aTo = explode(',', $this->_sTo);      
                    if(!empty($aCc)){
                        //$aTo = array_merge($this->_sTo, $aCc);
                    }
                    
                } else {
                    $aTo = array_merge($this->_sTo, $aCc);
                }

                foreach ($aTo as $recipient) {
                    fputs($oHandle, 'RCPT TO: <' . $recipient . '>' . $this->_sCrlf);

                    $sReply = '';

                    while ($sLine = fgets($oHandle, 515)) {
                        $sReply .= $sLine;

                        if (substr($sLine, 3, 1) == ' ') {
                            break;
                        }
                    }

                    if ((substr($sReply, 0, 3) != 250) && (substr($sReply, 0, 3) != 251)) {
                        trigger_error('Error: RCPT TO not accepted from server!');
                        return 0;
                    }
                }

                fputs($oHandle, 'DATA' . $this->_sCrlf);

                $sReply = '';

                while ($sLine = fgets($oHandle, 515)) {
                    $sReply .= $sLine;

                    if (substr($sLine, 3, 1) == ' ') {
                        break;
                    }
                }

                if (substr($sReply, 0, 3) != 354) {
                    trigger_error('Error: DATA not accepted from server!');
                    exit();
                }

                // According to rfc 821 we should not send more than 1000 including the CRLF
                $sMessage = str_replace("\r\n", "\n", $sHeader . $sMessage);
                $sMessage = str_replace("\r", "\n", $sMessage);

                $sLines = explode("\n", $sMessage);

                foreach ($sLines as $sLine) {
                    $results = str_split($sLine, 998);

                    foreach ($results as $result) {
                        if (substr(PHP_OS, 0, 3) != 'WIN') {
                            fputs($oHandle, $result . $this->_sCrlf);
                        } else {
                            fputs($oHandle, str_replace("\n", "\r\n", $result) . $this->_sCrlf);
                        }
                    }
                }

                fputs($oHandle, '.' . $this->_sCrlf);

                $sReply = '';

                while ($sLine = fgets($oHandle, 515)) {
                    $sReply .= $sLine;

                    if (substr($sLine, 3, 1) == ' ') {
                        break;
                    }
                }

                if (substr($sReply, 0, 3) != 250) {
                    trigger_error('Error: DATA not accepted from server!');
                    return 0;
                }

                fputs($oHandle, 'QUIT' . $this->_sCrlf);

                $sReply = '';

                while ($sLine = fgets($oHandle, 515)) {
                    $sReply .= $sLine;

                    if (substr($sLine, 3, 1) == ' ') {
                        break;
                    }
                }

                if (substr($sReply, 0, 3) != 221) {
                    trigger_error('Error: QUIT not accepted from server!');
                    return 0;
                }

                fclose($oHandle);
            }
        }
    }

}

?>