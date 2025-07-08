<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProductImage extends Component
{
    public $imageUrl;
    public $altText;

    public function __construct($imageUrl, $altText)
    {
        $this->imageUrl = $imageUrl;
        $this->altText = $altText;
    }

    public function render()
    {
        return view('components.product-image');
    }
}
