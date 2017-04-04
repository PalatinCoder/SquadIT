<?php
namespace SquadIT\WebApp\Utility;

use Imagine\Filter\FilterInterface;
use Imagine\Image\ImagineInterface;
use Imagine\Image\ImageInterface;
use Imagine\Image\BoxInterface;

class CircleImageFilter implements FilterInterface
{
    private $imagine;

    public function __construct(ImagineInterface $imagine, BoxInterface $size)
    {
        $this->imagine = $imagine;
        $this->size = $size;
    }

    public function apply(ImageInterface $image)
    {
        // create a thumbnail
        $thumbnail = $image->thumbnail(
            $this->size,
            ImageInterface::THUMBNAIL_OUTBOUND
        );

        // create a new image to hold our mask
        // make the background white
        $palette = new \Imagine\Image\Palette\RGB();
        $white = $palette->color('fff',0);
        $black = $palette->color('000',0);
        $mask = $this->imagine->create($this->size, $white);

        // draw a black circle at the center of our new image
        // use $this->size to make it full width and height
        $mask->draw()
            ->ellipse(
                new \Imagine\Image\Point\Center($this->size),
                $this->size,
                $black,
                true
            );

        // apply the mask to the thumbnail and return it
        return $thumbnail->applyMask($mask);
    }
}
