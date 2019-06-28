<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

use Symfony\Bundle\FrameworkBundle\Controller\<?= $parent_class_name; ?>;
<?php if ($with_template) { ?>
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
<?php } ?>
use Symfony\Component\Routing\Annotation\Route;

class <?= $class_name; ?> extends <?= $parent_class_name; ?><?= "\n" ?>
{
    /**
     * @Route("<?= $route_path ?>", name="<?= $route_name ?>")
<?php if ($with_template) { ?>
     * @Template
<?php } ?>
     */
    public function index()
    {
<?php if ($with_template) { ?>
        return [
            'controller_name' => '<?= $class_name ?>',
        ];
<?php } else { ?>
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => '<?= $relative_path; ?>',
        ]);
<?php } ?>
    }
}
