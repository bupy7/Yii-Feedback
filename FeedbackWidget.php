<?php
/**
 * @author Vasilij "BuPy7" Belosludcev
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version 1.1.0
 */

Yii::import('ext.feedback.models.FeedbackForm');
Yii::import('ext.phpmailer.PHPMailerAutoload', true);

class FeedbackWidget extends CWidget
{

    /**
     * @var array topic dropdown options
     */
    public $topicOptions = null;

    /**
     * @var string to email address
     */
    public $toEmail = null;
    
    /**
     * @var string Title of feedback
     */
    public $title = 'Feedback';

    public function init()
    {
        if ($this->topicOptions === null)
        {
            throw new CException("Config error: missing 'topicOptions'");
        }
        if ($this->toEmail === null)
        {
            throw new CException("Config error: missing 'toEmail'");
        }

        $localPath = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets';
        $publicPath = Yii::app()->getAssetManager()->publish($localPath);
        
        Yii::app()->clientScript->registerCssFile($publicPath . '/feedback.css');
    }

    public function run()
    {
        $feedbackForm = new FeedbackForm();
        if (Yii::app()->request->getPost('FeedbackForm'))
        {
            $feedbackForm->attributes = Yii::app()->request->getPost('FeedbackForm');
            if ($feedbackForm->validate())
            {
                if ($this->sendMail($feedbackForm))
                {
                    Yii::app()->user->setFlash('feedbackwidget-success', Yii::t('feedbackwidget.feedback', 'Message was successfully sent!'));
                }
                else
                {
                    Yii::app()->user->setFlash('feedbackwidget-error', Yii::t('feedbackwidget.feedback', 'While sending the message the error occurred. Try again later.'));
                }
            }
        }

        $this->render(
            'form', 
            array(
                'feedbackForm' => $feedbackForm,
                'topicOptions' => $this->topicOptions,
                'title' => $this->title,
            )
        );
    }
    
    protected function sendMail(&$form)
    {
        $mail = new PHPMailer();
        $mail->CharSet = Yii::app()->charset;
        $mail->Encoding = 'base64';

        $mail->From = $form->email;
        $mail->FromName = $form->email;
        $mail->addAddress($this->toEmail); 

        $mail->Subject = $this->topicOptions[$form->topic];
        $mail->Body = $form->message;

        return $mail->send();
    }

}
