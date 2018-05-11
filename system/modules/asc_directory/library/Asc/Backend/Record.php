<?php
 
/**
 * ASC - Directory
 *
 * Copyright (C) 2018 Andrew Stevens Consulting
 *
 * @package    AscDirectory
 * @link       https://andrewstevens.consulting
 */

 
namespace Asc\Backend;

use Asc\Model\DirectoryRecord;

class Record extends \Backend
{

    public function generateLabel($row, $label, $dc, $args)
    {
        $objDirectoryRecord = DirectoryRecord::findByPk($row['id']);
		
		$args[1] = '';
		
		if ($objDirectoryRecord->image) {
			$strImage = '';
			$uuid = \StringUtil::binToUuid($objDirectoryRecord->image);
			$objFile = \FilesModel::findByUuid($uuid);
			$strImage = $objFile->path;
			if ($objFile) {
				$args[1] = sprintf(
					'<a href="%s" onclick="Backend.openModalImage({\'width\':%s,\'title\':\'%s\',\'url\':\'%s\'});return false"><img src="%s" alt="%s" align="left"></a>',
					TL_FILES_URL . $strImage,
					'50',
					str_replace("'", "\\'", $objDirectoryRecord->name),
					TL_FILES_URL . $strImage,
					TL_ASSETS_URL . \Image::get($strImage, 50, 50, 'proportional'),
					$objDirectoryRecord->name
				);
			}
		}

        return $args;
    }
}
