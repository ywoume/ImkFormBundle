<?= "<?php\n"; ?>

namespace <?= $namespace; ?>;

<?php foreach ($form_fields as $form_field => $typeOptions): ?>
<?php if(array_key_exists('validation', $typeOptions) && count($typeOptions['validation']) > 0):?>
use Symfony\Component\Validator\Constraints as Assert;
<?php endif; ?>
<?php endforeach; ?>
<?php foreach ($form_fields as $form_field => $typeOptions): ?>
    <?php foreach ($typeOptions as $k => $itemOptions): ?>

        <?php
            if($itemOptions['config']['isValidation']){
                foreach ($itemOptions['validation'] as $itemOption) {

                }
            }
        ?>
    <?php endforeach; ?>
<?php endforeach; ?>

/**
* DTO class for <?= $class_name; ?>.<?php echo "\n"; ?>
* By odiceeRobot.
*/
class <?= $class_name . "\n"; ?>
{
<?php foreach ($form_fields as $form_field => $typeOptions): ?>
<?php foreach ($typeOptions as $field => $itemTypeOption): ?>

    /**
    *  @var <?= array_key_exists('attr', $itemTypeOption) ? $itemTypeOption['attr']['type'] : 'var' ?><?php echo "\n"; ?>
    *
    */
    private <?= '$' . $field . ';'; ?>

<?php endforeach; ?>
<?php endforeach; ?>
<?php foreach ($form_fields as $form_field => $typeOptions): ?>
<?php foreach ($typeOptions as $field => $itemTypeOption): ?>

    /**
    *  DTO getter for field <?= $field; ?>.<?php echo "\n"; ?>
    */
    public function <?= 'get' . ucfirst(strtolower($field) . '()'); ?><?php echo "\n"; ?>
    {
       return $this-><?= $field . ';'; ?><?php echo "\n"; ?>
    }

    /**
    * DTO setter for field <?= $field; ?>.<?php echo "\n"; ?>
    */
    public function <?= 'set' . ucfirst(strtolower($field) . '(' . '$' . $field . ')'); ?><?php echo "\n"; ?>
    {
        return $this-><?= $field; ?> = <?= '$' . $field . ';'; ?><?php echo "\n"; ?>
    }


<?php endforeach; ?>
<?php endforeach; ?>
<?php
/*
$formuleExpl = explode(' ', $formule);
$result = [];
foreach ($formuleExpl as $item) {
    if ($item !== '*' and $item !== '+' and $item !== '/' and $item !== '-') {
        $result[] = $item;
    }
}
$variable = implode(', ', $result);
*/?>

}
