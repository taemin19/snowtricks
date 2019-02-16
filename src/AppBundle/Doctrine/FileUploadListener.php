<?php

namespace AppBundle\Doctrine;

use AppBundle\Entity\Avatar;
use AppBundle\Entity\Image;
use AppBundle\Service\FileUploader;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
        if (!$entity instanceof Avatar && !$entity instanceof Image) {
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
        if (!$entity instanceof Avatar && !$entity instanceof Image) {
            return;
        }

        $tempPath = $entity->getTempPath();

        if (null !== $tempPath) {
            $oldFile = $this->uploader->getTargetDir().'/'.$tempPath;
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }
    }
}
