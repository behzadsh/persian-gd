<?php namespace Quince\PersianGD\Contracts;

interface GDTool {

	/**
	 * @param array $options
	 */
	public function __construct(array $options = []);

	/**
	 * Set the image canvas width
	 *
	 * @param int $width
	 * @return \Quince\PersianGD\GDTool
	 */
	public function setWidth($width);

	/**
	 * Set the name of output image file
	 *
	 * @param string $fileName
	 * @return \Quince\PersianGD\GDTool
	 */
	public function setFileName($fileName);

	/**
	 * Set the condition of saving or outputing image
	 *
	 * @param boolean $outputImage
	 * @return \Quince\PersianGD\GDTool
	 */
	public function setOutputImage($outputImage);

	/**
	 * Set background color hexadecimal code
	 *
	 * @param string $backgroundColor
	 * @return \Quince\PersianGD\GDTool
	 */
	public function setBackgroundColor($backgroundColor);

	/**
	 * Set font color hexadecimal code
	 *
	 * @param string $fontColor
	 * @return \Quince\PersianGD\GDTool
	 */
	public function setFontColor($fontColor);

	/**
	 * Set font size
	 *
	 * @param int $fontSize
	 * @return \Quince\PersianGD\GDTool
	 */
	public function setFontSize($fontSize);

	/**
	 * Set height of each lines
	 *
	 * @param int $lineHeight
	 * @return \Quince\PersianGD\GDTool
	 */
	public function setLineHeight($lineHeight);

	/**
	 * Set the font to be used
	 *
	 * @param string $font
	 * @return \Quince\PersianGD\GDTool
	 */
	public function setFont($font);

	/**
	 * @param int $angle
	 * @return \Quince\PersianGD\GDTool
	 */
	public function setAngle($angle);

	/**
	 * @param int $horizontalPosition
	 * @return \Quince\PersianGD\GDTool
	 */
	public function setHorizontalPosition($horizontalPosition);

	/**
	 * Set class options
	 *
	 * @param array $options
	 */
	public function setOptions(array $options);

	/**
	 * Add new string line to image
	 *
	 * @param string $line
	 * @return \Quince\PersianGD\GDTool
	 */
	public function addLine($line);

	/**
	 * Add multiple line to the list of lines to be generated
	 *
	 * @param array $lines
	 * @return \Quince\PersianGD\GDTool
	 */
	public function addLines(array $lines);

	/**
	 * Generate requested image
	 */
	public function build();
}
