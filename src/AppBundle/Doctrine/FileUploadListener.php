<?php

namespace AppBundle\Doctrine;

use Doctrine\Common\EventSubscriber;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\Avatar;
use AppBundle\Service\FileUploader;

class FileUploadListener implements EventSubscriber
{
    private $uploader;

    public function __construct(FileUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->removeOldFile($entity);
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->removeOldFile($entity);
    }

    public function getSubscribedEvents()
    {
        return ['prePersist', 'preUpdate', 'postPersist', 'postUpdate'];
    }

    private function uploadFile($entity)
    {
        // upload only works for Avatar entities
        if (!$entity instanceof Avatar) {
            return;
        }

        $file = $entity->getFile();

        // only upload new files
        if ($file instanceof UploadedFile) {
            $fileName = $this->uploader->upload($file);
            $alt = $file->getClientOriginalName();
            $entity->setAlt($alt);
            $entity->setFilePath($fileName);
        }
    }

    private function removeOldFile($entity)
    {
        if (!$entity instanceof Avatar) {
            return;
        }

        $tempPath = $entity->getTempPath();

        if ($tempPath !== null) {
            $oldFile = $this->uploader->getTargetDir().'/'.$tempPath;
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }
    }
}
