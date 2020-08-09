<?php

namespace Quince\PersianGD\Contracts;

interface GDTool
{
    /**
     * Sets the image canvas width.
     *
     * @param int $width
     *
     * @return \Quince\PersianGD\GDTool
     */
    public function setWidth($width);

    /**
     * Sets the name of output image file.
     *
     * @param string $fileName
     *
     * @return \Quince\PersianGD\GDTool
     */
    public function setFileName($fileName);

    /**
     * Sets the condition of saving or outputting image.
     *
     * @param bool $outputImage
     *
     * @return \Quince\PersianGD\GDTool
     */
    public function setOutputImage($outputImage);

    /**
     * Sets background color hexadecimal code.
     *
     * @param string $backgroundColor
     *
     * @return \Quince\PersianGD\GDTool
     */
    public function setBackgroundColor($backgroundColor);

    /**
     * Sets the font to be used.
     *
     * @param string $font
     *
     * @return \Quince\PersianGD\GDTool
     */
    public function setFont($font);

    /**
     * Sets font color hexadecimal code.
     *
     * @param string $fontColor
     *
     * @return \Quince\PersianGD\GDTool
     */
    public function setFontColor($fontColor);

    /**
     * Sets font size.
     *
     * @param int $fontSize
     *
     * @return \Quince\PersianGD\GDTool
     */
    public function setFontSize($fontSize);

    /**
     * Sets height of each lines.
     *
     * @param int $lineHeight
     *
     * @return \Quince\PersianGD\GDTool
     */
    public function setLineHeight($lineHeight);

    /**
     * Sets the angle of the line.
     *
     * @param int $angle
     *
     * @return \Quince\PersianGD\GDTool
     */
    public function setAngle($angle);

    /**
     * Sets the horizontal position of the text.
     *
     * @param int $horizontalPosition
     *
     * @return \Quince\PersianGD\GDTool
     */
    public function setHorizontalPosition($horizontalPosition);

    /**
     * Sets the vertical position of the text.
     *
     * @param int $verticalPosition
     *
     * @return \Quince\PersianGD\GDTool
     */
    public function setVerticalPosition($verticalPosition);

    /**
     * Set whether using local (Persian) numeric character or not.
     *
     * @param bool $useLocalNumber
     *
     * @return \Quince\PersianGD\GDTool
     */
    public function setUseLocalNumber($useLocalNumber);

    /**
     * Sets the decorator.
     *
     * @param StringDecorator $decorator
     *
     * @return \Quince\PersianGD\GDTool
     */
    public function setDecorator(StringDecorator $decorator);

    /**
     * Sets class options.
     *
     * @param array $options
     *
     * @return \Quince\PersianGD\GDTool
     */
    public function setOptions(array $options);

    /**
     * Add new string line to image.
     *
     * @param string $line
     *
     * @return \Quince\PersianGD\GDTool
     */
    public function addLine($line);

    /**
     * Add multiple line to the list of lines to be generated.
     *
     * @param array $lines
     *
     * @return \Quince\PersianGD\GDTool
     */
    public function addLines(array $lines);

    /**
     * Generate requested image.
     *
     * @return false|string
     */
    public function build();
}
