# persian-gd
PHP GD library for Persian text support

## Installation

Add persian-gd to your composer.json:

```
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
       ->addLine("سلام دنیا")
       ->build();
```

### Advanced Usage

GDTool has many options that you can set them in two different way.

#### Setting GDTools options on construction

You can set the options while you're constructing a GDTool instance.

```php
<?php

$gdTool = new Quince\PersianGD\GDTool([
    'with' => 1200,
    'backgroundColor' => '#FFF000',
    'fontColor' => '#000000',
    // ...
]);

$gdTool->addLine('لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.')
       ->addLine('چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.')
       ->addLine('کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد.')
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
           ->setVerticalPosition(100)              // set position of start point from left or right of image - default: 10
           ->setUseLocalNumber(true)                // set weather use local (persian) numbers character or not - default: true
           ->setFileName('/path/to/output/image')   // set the path of output image
           ->addLine('لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.')
           ->addLine('چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.')
           ->build();

}
```

#### Add multiple line at once

You can pass an array of strings, and GDTool will print them in given order in canvas.

```php
<?php

$gdTool = new Quince\PersianGD\GDTool();

$gdTool->addLines([
    'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.',
    'چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.',
    'کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد.',
])->setFileName('/path/to/output/image')->build();
```

#### Outputting generating image

There may be a situation that you don't want to save generated image in a file, and you want for example return it as image response.

```php
<?php

$gdTool = new Quince\PersianGD\GDTool();

$imageContent = $gdTool->setOutputImage(false)
                       ->addLine('سلام دنیا!')
                       ->build();

header('content-type', 'image/png');
echo $imageContent;

```
