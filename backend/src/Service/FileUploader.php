<?php

namespace App\Service;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 19/06/2019
 */
class FileUploader {
    private $targetDirectory;
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct($targetDirectory, LoggerInterface $logger) {
        $this->targetDirectory = $targetDirectory;
        $this->logger = $logger;
    }

    public function upload(UploadedFile $file) {
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();

        $file->move($this->getTargetDirectory(), $fileName);

        $this->logger->info($fileName);

        return $fileName;
    }

    public function getTargetDirectory() {
        return $this->targetDirectory;
    }
}
