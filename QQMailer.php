<?php
require_once './PHPMailer.php';
require_once './SMTP.php';

class QQMailer
{
    public static $HOST = 'smtp.qq.com'; // QQ ����ķ�������ַ
    //public static $PORT = 465; // smtp ��������Զ�̷������˿ں�
    //public static $SMTP = 'ssl'; // ʹ�� ssl ���ܷ�ʽ��¼
    public static $PORT = 587;
    public static $SMTP = 'tls';
    public static $CHARSET = 'UTF-8'; // ���÷��͵��ʼ��ı���

    private static $USERNAME = '695415974@qq.com'; // ��Ȩ��¼���˺�
    private static $PASSWORD = 'rfkwwtedfejqbcfj'; // ��Ȩ��¼������
    private static $NICKNAME = 'admins'; // �����˵��ǳ�

    /**
     * QQMailer constructor.
     * @param bool $debug [����ģʽ]
     */
    public function __construct($debug = false)
    {
        $this->mailer = new PHPMailer\PHPMailer\PHPMailer();
        $this->mailer->SMTPDebug = $debug ? 1 : 0;
        $this->mailer->isSMTP(); // ʹ�� SMTP ��ʽ�����ʼ�
    }

    /**
     * @return PHPMailer
     */
    public function getMailer()
    {
        return $this->mailer;
    }

    private function loadConfig()
    {
        /* Server Settings  */
        $this->mailer->SMTPAuth = true; // ���� SMTP ��֤
        $this->mailer->Host = self::$HOST; // SMTP ��������ַ
        $this->mailer->Port = self::$PORT; // Զ�̷������˿ں�
        $this->mailer->SMTPSecure = self::$SMTP; // ��¼��֤��ʽ
        /* Account Settings */
        $this->mailer->Username = self::$USERNAME; // SMTP ��¼�˺�
        $this->mailer->Password = self::$PASSWORD; // SMTP ��¼����
        $this->mailer->From = self::$USERNAME; // �����������ַ
        $this->mailer->FromName = self::$NICKNAME; // �������ǳƣ��������ݣ�
        /* Content Setting  */
        $this->mailer->isHTML(true); // �ʼ������Ƿ�Ϊ HTML
        $this->mailer->CharSet = self::$CHARSET; // ���͵��ʼ��ı���
    }

    /**
     * Add attachment
     * @param $path [����·��]
     */
    public function addFile($path)
    {
        $this->mailer->addAttachment($path);
    }


    /**
     * Send Email
     * @param $email [�ռ���]
     * @param $title [����]
     * @param $content [����]
     * @return bool [����״̬]
     */
    public function send($email, $title, $content)
    {
        $this->loadConfig();
        $this->mailer->addAddress($email); // �ռ�������
        $this->mailer->Subject = $title; // �ʼ�����
        $this->mailer->Body = $content; // �ʼ���Ϣ
        return (bool)$this->mailer->send(); // �����ʼ�
    }
}
