/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	CKEDITOR.config.forcePasteAsPlainText = false;
	CKEDITOR.config.pasteFromWordRemoveFontStyles = false;
	CKEDITOR.config.pasteFromWordRemoveStyles = false;
	CKEDITOR.config.allowedContent = true;
	CKEDITOR.config.extraAllowedContent = 'p(mso*,Normal)';
	CKEDITOR.config.pasteFilter = null;

	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
};
