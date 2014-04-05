<?php
/**
 * @author Vasilij "BuPy7" Belosludcev
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version 1.1.0
 */

class FeedbackForm extends CFormModel
{

    public $topic;
    public $email;
    public $message;

    public function rules()
    {
        return array(
            array('topic,email,message', 'required'),
            array('email', 'email'),
        );
    }
    
    public function attributeLabels()
    {
        return array(
            'topic' => Yii::t('feedbackwidget.feedback', 'Topic'), 
            'message' => Yii::t('feedbackwidget.feedback', 'Message'), 
            'email' => Yii::t('feedbackwidget.feedback', 'Email'), 
        );
    }

}
