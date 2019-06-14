<?php 
namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader{

	private $directory;

	public function __construct($targetDirectory){
		$this->directory = $targetDirectory;
	}

	public function upload(UploadedFile $file, $sousdossier, $oldfilename = null){

		$filename = md5(uniqid()) . '.' . $file->guessExtension();

		$file->move($this->directory . $sousdossier, $filename);

		if ($oldfilename && file_exists($this->directory .$sousdossier . '/' . $oldfilename)) {
			unlink($this->directory .$sousdossier . '/' . $oldfilename);
		}

		return $filename;
	}


}
