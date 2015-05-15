<?php namespace Quince\PersianGD;

use Quince\PersianGD\Contracts\GDTool as GDToolContract;
use Quince\PersianGD\Exceptions\PersianDGException;

class GDTool implements GDToolContract {

	/**
	 * The canvas width
	 *
	 * @var int
	 */
	protected $width = 500;

	/**
	 * Output file name
	 *
	 * @var string
	 */
	protected $fileName;

	/**
	 * Flag for saving image or output
	 *
	 * @var bool
	 */
	protected $outputImage = false;

	/**
	 * Image background hexadecimal color code
	 *
	 * @var string
	 */
	protected $backgroundColor = '#FFFFFF';

	/**
	 * Image background color allocated code
	 *
	 * @var int
	 */
	protected $backgroundColorAllocate;

	/**
	 * Image font hexadecimal color code
	 *
	 * @var string
	 */
	protected $fontColor = '#000000';

	/**
	 * Image font color allocated code
	 *
	 * @var int
	 */
	protected $fontColorAllocate;

	/**
	 * Image font size in point
	 *
	 * @var int
	 */
	protected $fontSize = 12;

	/**
	 * Text angle in degrees
	 *
	 * @var int
	 */
	protected $angle = 0;

	/**
	 * The coordinates of the first character
	 *
	 * @var int
	 */
	protected $horizontalPosition = 10;

	/**
	 * Line height of each line
	 *
	 * @var int
	 */
	protected $lineHeight = 25;

	/**
	 * The font to be used to generate strings
	 *
	 * @var string
	 */
	protected $font;

	/**
	 * Array of lines to generated
	 *
	 * @var array
	 */
	protected $lines = [];

	/**
	 * GD image resource
	 *
	 * @var resource
	 */
	protected $imageResource;

	/**
	 * @param array $options
	 */
	public function __construct(array $options = [])
	{
		$this->setOptions($options);
	}

	/**
	 * Set the image canvas width
	 *
	 * @param int $width
	 * @return GDTool
	 */
	public function setWidth($width)
	{
		$this->width = $width;

		return $this;
	}

	/**
	 * Set the name of output image file
	 *
	 * @param string $fileName
	 * @return GDTool
	 */
	public function setFileName($fileName)
	{
		$this->fileName = $fileName;

		return $this;
	}

	/**
	 * Set the condition of saving or outputing image
	 *
	 * @param boolean $outputImage
	 * @return GDTool
	 */
	public function setOutputImage($outputImage)
	{
		$this->outputImage = $outputImage;

		return $this;
	}

	/**
	 * Set background color hexadecimal code
	 *
	 * @param string $backgroundColor
	 * @return GDTool
	 */
	public function setBackgroundColor($backgroundColor)
	{
		$this->backgroundColor = $backgroundColor;

		return $this;
	}

	/**
	 * Set font color hexadecimal code
	 *
	 * @param string $fontColor
	 * @return GDTool
	 */
	public function setFontColor($fontColor)
	{
		$this->fontColor = $fontColor;

		return $this;
	}

	/**
	 * Set font size
	 *
	 * @param int $fontSize
	 * @return GDTool
	 */
	public function setFontSize($fontSize)
	{
		$this->fontSize = $fontSize;

		return $this;
	}

	/**
	 * Set height of each lines
	 *
	 * @param int $lineHeight
	 * @return GDTool
	 */
	public function setLineHeight($lineHeight)
	{
		$this->lineHeight = $lineHeight;

		return $this;
	}

	/**
	 * Set the font to be used
	 *
	 * @param string $font
	 * @return GDTool
	 */
	public function setFont($font)
	{
		$this->font = $font;

		return $this;
	}

	/**
	 * @param int $angle
	 * @return GDTool
	 */
	public function setAngle($angle)
	{
		$this->angle = $angle;

		return $this;
	}

	/**
	 * @param int $horizontalPosition
	 * @return GDTool
	 */
	public function setHorizontalPosition($horizontalPosition)
	{
		$this->horizontalPosition = $horizontalPosition;

		return $this;
	}

	/**
	 * Set class options
	 *
	 * @param array $options
	 */
	public function setOptions(array $options)
	{
		foreach ($options as $option => $value) {
			if (in_array($option, $this->getAvailableOptions())) {
				$this->$option = $value;
			}
		}
	}

	/**
	 * Add new string line to image
	 *
	 * @param string $line
	 * @return $this
	 */
	public function addLine($line)
	{
		array_push($this->lines, $line);

		return $this;
	}

	/**
	 * Add multiple line to the list of lines to be generated
	 *
	 * @param array $lines
	 * @return $this
	 */
	public function addLines(array $lines)
	{
		$lines = array_filter($lines, function ($line) {
			return is_string($line);
		});

		$this->lines = array_merge($this->lines, $lines);

		return $this;
	}

	/**
	 * Generate requested image
	 */
	public function build()
	{
		$this->initImage();
		$this->generateColorAllocates();
		$this->writeLines();

		return $this->generate();
	}

	/**
	 * Get available options for class
	 *
	 * @return array
	 */
	protected function getAvailableOptions()
	{
		return array_keys(get_object_vars($this));
	}

	/**
	 * Initialize image canvas
	 */
	protected function initImage()
	{
		$this->imageResource = imagecreate($this->width, $this->getHeight());
	}

	/**
	 * Calculate and return the height of canvas
	 *
	 * @return int
	 */
	protected function getHeight()
	{
		$lineCounts = count($this->lines);

		return ($lineCounts + 1) * $this->lineHeight;
	}

	protected function generateColorAllocates()
	{
		$this->generateBackgroundAllocate();
		$this->generateFontAllocate();
	}

	protected function generateBackgroundAllocate()
	{
		list($red, $green, $blue) = $this->getRGBValues($this->backgroundColor);
		$this->backgroundColorAllocate = imagecolorallocate(
			$this->imageResource, $red, $green, $blue
		);
	}

	protected function generateFontAllocate()
	{
		list($red, $green, $blue) = $this->getRGBValues($this->fontColor);
		$this->fontColorAllocate = imagecolorallocate(
			$this->imageResource, $red, $green, $blue
		);
	}

	/**
	 * Get RGB value of a hexadecimal color code
	 *
	 * @param string $hexColor
	 * @return array
	 * @throws PersianDGException
	 */
	protected function getRGBValues($hexColor)
	{
		if (substr($hexColor, 0, 1) != '#') {
			throw new PersianDGException('Invalid hexadecimal color code provided');
		}

		$hexColor = substr($hexColor, 1);

		if (strlen($hexColor) == 3) {
			$red = str_repeat(substr($hexColor, 0, 1), 2);
			$green = str_repeat(substr($hexColor, 1, 1), 2);
			$blue = str_repeat(substr($hexColor, 2, 1), 2);
		} else {
			if (strlen($hexColor) == 6) {
				$red = substr($hexColor, 0, 2);
				$green = substr($hexColor, 2, 2);
				$blue = substr($hexColor, 4, 2);
			} else {
				throw new PersianDGException('Invalid hexadecimal color code provided');
			}
		}

		return [
			'red'   => hexdec($red),
			'green' => hexdec($green),
			'blue'  => hexdec($blue),
		];
	}

	protected function writeLines()
	{
		$gdHelper = new GDTool();

		$verticalPos = $this->lineHeight;
		foreach ($this->lines as $line) {
			imagettftext(
				$this->imageResource,
				$this->fontSize,
				$this->angle,
				$this->horizontalPosition,
				$verticalPos,
				$this->fontColorAllocate,
				$this->font,
				$gdHelper->persianText($line)
			);

			$verticalPos += $this->lineHeight;
		}
	}

	protected function generate()
	{
		if ($this->outputImage) {
			ob_start();
			imagepng($this->imageResource);

			return ob_get_clean();
		}

		imagepng($this->imageResource, $this->fileName);

		return $this->fileName;
	}

}
