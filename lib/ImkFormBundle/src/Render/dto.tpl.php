<?= "<?php\n"; ?>

namespace <?= $namespace; ?>;
use Symfony\Component\Validator\Constraints as Assert;
/*
* DTO class for <?= $class_name; ?>.<?php echo "\n"; ?>
* By odiceeRobot.
*/
class <?= $class_name . "\n"; ?>
{
<?php foreach ($form_fields as $form_field => $typeOptions) : ?> <?= "\n"; ?>
    <?php foreach ($typeOptions as $field => $itemTypeOption): ?><?= "\n"; ?>
        /**
        *  @var <?= '$'.$field.';'; ?><?= "\n"; ?>
        <?php if (array_key_exists($field, $form_validator)) : foreach ($form_validator[$field] as $keys => $item) : echo "\t\t * ".$item."\n"; endforeach; endif; ?>
        */
        private <?= '$'.$field.';'; ?><?= "\n"; ?>
    <?php endforeach; ?>
<?php endforeach; ?>

<?php foreach ($form_fields as $form_field => $typeOptions): ?>
    <?php foreach ($typeOptions as $field => $itemTypeOption): ?>

        /**
        *  DTO getter for field <?= $field; ?>.<?php echo "\n"; ?>
        */
        public function <?= 'get' . ucfirst(strtolower($field) . '()'); ?><?php echo "\n"; ?>
        {
        return $this-><?= $field.';'; ?><?php echo "\n"; ?>
        }

        /**
        * DTO setter for field <?= $field; ?>.<?php echo "\n"; ?>
        */
        public function <?= 'set' . ucfirst(strtolower($field) . '(' . '$' . $field . ')'); ?><?php echo "\n"; ?>
        {
        return $this-><?= $field; ?> = <?= '$'.$field.';'; ?><?php echo "\n"; ?>
        }
    <?php endforeach; ?>
<?php endforeach; ?>


}
