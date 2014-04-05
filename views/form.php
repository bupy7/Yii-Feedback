<?php
/**
 * @author Vasilij "BuPy7" Belosludcev
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version 1.1.0
 *
 * @var $this Controller
 * @var $feedbackForm FeedbackForm
 * @var $topicOptions array
 * @var $title string
 */
?>
<div id="feedback">
    <a name="feedback"></a>
    <div class="text-center title"><strong><?php echo CHtml::encode($title); ?></strong></div>
    <?php 
    $this->widget(
        'bootstrap.widgets.TbAlert', 
        array(
            'block' => true, 
            'fade' => true,
            'closeText' => '&times;',
            'alerts' => array(
                'feedbackwidget-success' => array(
                    'htmlOptions' => array(
                        'class' => 'alert-success',
                    ),
                ),
                'feedbackwidget-error' => array(
                    'htmlOptions' => array(
                        'class' => 'alert-error',
                    ),
                ),
            ),
        )
    );
    $form = $this->beginWidget(
        'bootstrap.widgets.TbActiveForm', 
        array(
            'htmlOptions' => array(
                'id' => 'feedback-form',
            ),
            'type' => 'horizontal',
            'action' => '#feedback',
        )
    );
    echo $form->dropDownListRow(
        $feedbackForm, 
        'topic', 
        $topicOptions,
        array(
            'class' => 'span7',
        )
    );

    echo $form->emailFieldRow(
        $feedbackForm, 
        'email',
        array(
            'class' => 'span7',
        )
    );

    echo $form->textAreaRow(
        $feedbackForm, 
        'message',
        array(
            'class' => 'span7',
        )
    );
    ?>
    <div class="control-group">
        <div class="controls span7 text-right">
            <?php
            echo CHtml::submitButton(
                Yii::t('feedbackwidget.feedback', 'Send'), 
                array(
                    'name' => CHtml::activeName($feedbackForm, 'submit'),
                    'class' => 'btn btn-primary',
                )
            );
            ?>
        </div>
    </div>
<?php $this->endWidget(); ?>
</div>