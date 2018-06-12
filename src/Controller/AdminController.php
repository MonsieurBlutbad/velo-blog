<?php
/**
 * Created by PhpStorm.
 * User: BK
 * Date: 18.05.18
 * Time: 16:02
 */
namespace App\Controller;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

/**
 * Class AdminController
 * @package AppBundle\Controller
 */
class AdminController extends BaseAdminController
{


    protected function prePersistEntity($entity)
    {
        $this->beforeUpdateOrPersist($entity);

        parent::prePersistEntity($entity);
    }

    protected function preUpdateEntity($entity)
    {
        $this->beforeUpdateOrPersist($entity);

        parent::preUpdateEntity($entity);
    }

    protected function beforeUpdateOrPersist($entity) {
        if (method_exists($entity, 'setUpdatedAt')) {
            $entity->setUpdatedAt(new \DateTime());
        }
        if ($entity instanceof Post) {
            if ($entity->getImages()) {
                foreach($entity->getImages() as $image) {
                    if ($image->getPost() !== $entity) {
                        $image->setPost($entity);
                        $this->updateEntity($image);
                    }
                }
            }
        }
    }
}