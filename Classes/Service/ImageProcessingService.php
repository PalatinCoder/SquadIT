<?php
namespace SquadIT\WebApp\Service;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\ResourceManagement\PersistentResource;
use Neos\Flow\ResourceManagement\ResourceManager;
use Neos\Flow\Utility\Environment;
use Imagine\Image\ImagineInterface;
use SquadIT\WebApp\Utility\CircleImageFilter;
use Neos\Flow\Exception;

/**
 * @Flow\Scope("singleton")
 * @codeCoverageIgnore
 */
class ImageProcessingService
{

    /**
     * @var ResourceManager
     * @Flow\Inject
     */
    protected $resourceManager;

    /**
     * @var ImagineInterface
     * @Flow\Inject(lazy = false)
     */
    protected $imagineService;

    /**
     * @Flow\Inject
     * @var Environment
     */
    protected $environment;

    /**
     * Process an image to be used as a profile picture
     *
     * @param PersistentResource $image The image to be processed
     * @return PersistentResource The processed image
     */
    public function processProfilepicture(PersistentResource $image)
    {
        //now process the image
        $resourceUri = $image->createTemporaryLocalCopy();
        $resultingFileExtension = $image->getFileExtension();
        $transformedImageTemporaryPath = $this->environment->getPathToTemporaryDirectory() . uniqid('ProcessedImage-') . '.' . $resultingFileExtension;

        if (!file_exists($resourceUri)) {
            throw new Exception(sprintf('An error occurred while transforming an image: the resource data of the original image does not exist (%s, %s).', $originalResource->getSha1(), $resourceUri), 1374848224);
        }

        $imagineImage = $this->imagineService->open($resourceUri);
        $circleFilter = new CircleImageFilter($this->imagineService, new \Imagine\Image\Box(200, 200));
        $circleFilter->apply($imagineImage)->save($transformedImageTemporaryPath);

        // import the processed image
        $processedImageResource = $this->resourceManager->importResource($transformedImageTemporaryPath);
        unlink($transformedImageTemporaryPath); // delete the temporary copy
        $this->resourceManager->deleteResource($image); // delete the unprocessed image

        return $processedImageResource;
    }
}
