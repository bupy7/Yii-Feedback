Yii-Feedback
============

Yii-Feedback - this is extension for send email from Yii. This modification extension YiiFeedbackWidget https://github.com/gazbond/YiiFeedbackWidget.

### Install
Download or close the files from repository https://github.com/PHPMailer/PHPMailer to your extensions directory:
```
[app-root]/protected/extensions/phpmailer/
```

Download or clone the files to your extensions directory:
```
[app-root]/protected/extensions/feedback/
```
Add in your view follow code:
```php
$this->widget(
    'ext.feedback.FeedbackWidget', 
    array(
        'topicOptions' => array(
            'first_topic',
            'second_topic',
            'third_topic',
        ),
        'toEmail' => 'your@email.com',
        'title' => 'Title feedback',
    )
);
```

### Changes
###### Added:
+ Rewrited with using Yii-booster.
+ Support PHPMailer.
+ Russian language.
+ Transition to anchor after send mail.
+ Title in config options for feedback form.

###### Removed:
+ "position" from config options.
