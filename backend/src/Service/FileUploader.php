<?php

namespace App\Service;

use google\appengine\api\cloud_storage\CloudStorageTools;
use Google\Cloud\Storage\StorageClient;
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
    private $baseDir;

    public function __construct($targetDirectory, $baseDir, LoggerInterface $logger) {
        $this->targetDirectory = $targetDirectory;
        $this->logger = $logger;
        $this->baseDir = $baseDir;
    }

    public function upload(UploadedFile $file) {
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();
        if (strpos($this->targetDirectory, 'gs') === 0) {
            // Do google upload
            $storage = new StorageClient();
            $bucket = $storage->bucket('mmsr-244518.appspot.com');
            $bucket->upload(fopen($file->getRealPath(), 'r'), [
                'name' => $fileName,
                'predefinedAcl' => 'publicRead'
            ]);
            return CloudStorageTools::getPublicUrl($this->targetDirectory . '/' . $fileName, true);
        } else {
            file_put_contents($this->baseDir . '/' . $this->targetDirectory . '/' . $fileName, file_get_contents($file->getRealPath()));

            return $fileName;
        }
    }

    public function getTargetDirectory() {
        return $this->targetDirectory;
    }
}
