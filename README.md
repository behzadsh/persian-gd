# persian-gd
PHP GD library for Persian text support

## Installation

Add persian-gd to your composer.json:

```json
"require": {
  "quince/persian-gd": "~1.0"
}
```

or run:

```
composer require quince/persian-gd ~1.0
```

## Usage

### Simple usage

```php
<?php

$gdTool = new Quince\PersianGD\GDTool();

$gdTool->setFileName('/path/to/output/image')
       ->addLine($myText)
       ->build();
```

### Advanced Usage

GDTool has many option that you can set them in two different way.

#### Setting GDTools options on construction

You can set the options while you're constructing a GDTool instance.

```php
<?php

$gdTool = new Quince\PersianGD\GDTool([
    'with' => 500,
    'backgroundColor' => '#FFF000',
    'fontColor' => '#000000',
    // ...
]);

$gdTool->addLine('Lorem ipsum dolor sit amet, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.')
       ->addLine('Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi  ex ea commodo consequat.')
       ->addLine('But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born')
       ->build();
```

#### Setting GDTools options on the go

In a situation that you have an instance of GDTool, you can set (or change) any option you want by their setter method.

```php
<?php

function foo(Quince\PersianGD\GDTool $gdTool) {

    $gdTool->setWidth(500)                          // set image width - default: 500
           ->setFont('/path/to/font')               // set path to your desired font
           ->setBackgroundColor('#FF0000')          // set background color in hex code - default: #FFFFFF
           ->setFontColor('#00FF00')                // set foreground color in hex code - default: #000000
           ->setFontSize(10)                        // set size of font in px - default: 12
           ->setLineHeight(16)                      // set line height - default: 25
           ->setAngle(45)                           // set angle of text in degree - default: 0
           ->setHorizontalPosition(100)             // set position of start point from top of image - default: 10
           ->setHVerticalPosition(100)              // set position of start point from left or right of image - default: 10
           ->setUseLocalNumber(true)                // set weather use local (persian) numbers character or not - default: true
           ->setFileName('/path/to/output/image')   // set the path of output image
           ->addLine('Lorem ipsum dolor sit amet, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.')
           ->addLine('Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi  ex ea commodo consequat.')
           ->build();

}
```

#### Add multiple line at once

You can pass an array of strings, and GDTool will print them in given order in canvas.

```php
<?php

$gdTool = new Quince\PersianGD\GDTool();

$gdTool->addLines([
    'Lorem ipsum dolor sit amet, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
    'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi  ex ea commodo consequat.',
    'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born'
])->setFileName('/path/to/output/image')->build();
```

#### Outputing generating image

There may be a situation that you don't want to save generated image in a file, and you want for example return it as image response.

```php
<?php

$gdTool = new Quince\PersianGD\GDTool();

$imageContent = $gdTool->setOutputImage(false)
                       ->addLine('This is a sample text.')
                       ->build();

header('content-type', 'image/png');
echo $imageContent;

```